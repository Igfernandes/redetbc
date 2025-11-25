<?php
namespace Modules\Vendor\Controllers;

use App\Helpers\ReCaptchaEngine;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rules\Password;
use Matrix\Exception;
use Modules\FrontendController;
use Modules\User\Events\NewVendorRegistered;
use Modules\User\Events\SendMailUserRegistered;
use Modules\Vendor\Models\VendorRequest;
use Modules\Booking\Models\Booking;


class VendorController extends FrontendController
{
    protected $bookingClass;
    public function __construct()
    {
        $this->bookingClass = Booking::class;
        parent::__construct();
    }
    public function register(Request $request)
    {
        $rules = [
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'business_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password'   => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'term'       => ['required'],
        ];
        $messages = [
            'email.required'      => __('Email é um campo obrigatório'),
            'email.email'         => __('Email inválido'),
            'password.required'   => __('Senha é um campo obrigatório'),
            'first_name.required' => __('O primeiro nome é um campo obrigatório'),
            'last_name.required'  => __('O último nome é um campo obrigatório'),
            'business_name.required'  => __('O nome da empresa é um campo obrigatório'),
            'term.required'       => __('O campo de termos e condições é obrigatório'),
        ];
        if (ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")) {
            $messages['g-recaptcha-response.required'] = __('Por favor, verifique o captcha');
            $rules['g-recaptcha-response'] = ['required'];
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors()
            ], 200);
        } else {
            if (ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")) {
                $codeCapcha = $request->input('g-recaptcha-response');
                if (!ReCaptchaEngine::verify($codeCapcha)) {
                    $errors = new MessageBag(['message_error' => __('Por favor, verifique o captcha')]);
                    return response()->json([
                        'error'    => true,
                        'messages' => $errors
                    ], 200);
                }
            }
            $user = new \App\User();

            $user = $user->fill([
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
                'business_name'=>$request->input('business_name'),
                'phone'=>$request->input('phone'),
            ]);
            $user->status = 'publish';

            $user->save();
            if (empty($user)) {
                return $this->sendError(__("Não é possível registrar"));
            }

            //                check vendor auto approved
            $vendorAutoApproved = setting_item('vendor_auto_approved');
            $dataVendor['role_request'] = setting_item('vendor_role');
            if ($vendorAutoApproved) {
                if ($dataVendor['role_request']) {
                    $user->assignRole($dataVendor['role_request']);
                }
                $dataVendor['status'] = 'approved';
                $dataVendor['approved_time'] = now();
            } else {
                $dataVendor['status'] = 'pending';
                $user->assignRole(setting_item('user_role'));
            }
            $vendorRequestData = $user->vendorRequest()->save(new VendorRequest($dataVendor));
            Auth::loginUsingId($user->id);
            try {
                event(new NewVendorRegistered($user, $vendorRequestData));
            } catch (Exception $exception) {
                Log::warning("NewVendorRegistered: " . $exception->getMessage());
            }
            if ($vendorAutoApproved) {
                return $this->sendSuccess([
                    'redirect' => url(app_get_locale(false, '/')),
                ]);
            } else {
                return $this->sendSuccess([
                    'redirect' => url(app_get_locale(false, '/')),
                ], __("Registro realizado com sucesso. Por favor, aguarde a aprovação do administrador"));
            }
        }
    }

    public function bookingReport(Request $request)
    {
        $data = [
            'bookings'    => $this->bookingClass::getBookingHistory($request->input('status'), $request->input('customer_name'), Auth::id(),false,$request->input('from'),$request->input('to')),
            'statues'     => config('booking.statuses'),
            'breadcrumbs' => [
                [
                    'name'  => __('Relatório de Reservas'),
                    'class' => 'active'
                ],
            ],
            'page_title'  => __("Relatório de Reservas"),
        ];
        return view('Vendor::frontend.bookingReport.index', $data);
    }
}