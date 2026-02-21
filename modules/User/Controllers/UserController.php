<?php

namespace Modules\User\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Validation\Rule;
use Matrix\Exception;
use Modules\Assistance\Models\Assistance;
use Modules\Booking\Models\Service;
use Modules\Event\Models\Event;
use Modules\FrontendController;
use Modules\Hotel\Models\Hotel;
use Modules\Space\Models\Space;
use Modules\Tour\Models\Tour;
use Modules\User\Events\UserSubscriberSubmit;
use Modules\User\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Booking;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Booking\Models\Enquiry;
use Illuminate\Support\Str;

class UserController extends FrontendController
{
    use AuthenticatesUsers;

    protected $enquiryClass;
    private Booking $booking;

    public function __construct(Booking $booking, Enquiry $enquiry)
    {
        $this->enquiryClass = $enquiry;
        parent::__construct();
        $this->booking = $booking;
    }

    public function dashboard(Request $request)
    {
        $this->checkPermission('dashboard_vendor_access');
        $user_id = Auth::id();
        $data = [
            'cards_report'       => $this->booking->getTopCardsReportForVendor($user_id),
            'earning_chart_data' => $this->booking->getEarningChartDataForVendor(strtotime('monday this week'), time(), $user_id),
            'page_title'         => __("Painel do Fornecedor"),
            'breadcrumbs'        => [
                [
                    'name'  => __('Painel'),
                    'class' => 'active'
                ]
            ]
        ];
        return view('User::frontend.dashboard', $data);
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        $user_id = Auth::id();
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                return $this->sendSuccess([
                    'data' => $this->booking->getEarningChartDataForVendor(strtotime($from), strtotime($to), $user_id)
                ]);
                break;
        }
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        $data = [
            'dataUser'         => $user,
            'page_title'       => __("Perfil"),
            'breadcrumbs'      => [
                [
                    'name'  => __('Configurações'),
                    'class' => 'active'
                ]
            ],
            'is_vendor_access' => $this->hasPermission('dashboard_vendor_access')
        ];
        return view('User::frontend.profile', $data);
    }

    public function profileUpdate(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|url|max:255',
            'email'      => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'purposes' => 'required|array|min:3',
            'purposes.*' => 'string',
            'phone'       => [
                'required',
                Rule::unique('users')->ignore($user->id)
            ],
        ], [
            'purposes.required' => 'Selecione pelo menos 3 finalidades.',
            'purposes.min' => 'Você precisa escolher no mínimo :min finalidades.',
            'purposes.array' => 'Selecione opções válidas.',
        ]);

        if ($request->input('facebook') == null && $request->input('instagram') == null) {
            return redirect()->back()->with('error', 'É obrigatório colocar o link de pelo menos do facebook ou instagram');
        }

        $input = $request->except('bio');
        $purposes = $request->input('purposes', []);
        $input['purposes'] = implode(',', $purposes);

        $user->fill($input);
        $user->bio = clean($request->input('bio'));
        $birthday = DateTime::createFromFormat('d/m/Y', $input['birthday']);
        $user->birthday = $birthday?->format('Y-m-d');
        $user->user_name = Str::slug($request->input('first_name'), "_");

        $user->save();
        return redirect()->back()->with('success', __('Atualizado com sucesso'));
    }

    public function bookingHistory(Request $request)
    {
        $user_id = Auth::id();
        $data = [
            'bookings' => $this->booking->getBookingHistory($request->input('status'), $user_id),
            'statues'     => config('booking.statuses'),
            'breadcrumbs' => [
                [
                    'name'  => __('Reservas'),
                    'class' => 'active'
                ]
            ],
            'page_title'  => __("Histórico de Reservas"),
        ];
        return view('User::frontend.bookingHistory', $data);
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);
        $check = Subscriber::withTrashed()->where('email', $request->input('email'))->first();
        if ($check) {
            if ($check->trashed()) {
                $check->restore();
                return $this->sendSuccess([], __('Obrigado por se inscrever'));
            }
            return $this->sendError(__('Você já está inscrito'));
        } else {
            $a = new Subscriber();
            $a->email = $request->input('email');
            $a->first_name = $request->input('first_name');
            $a->last_name = $request->input('last_name');
            $a->save();

            event(new UserSubscriberSubmit($a));

            return $this->sendSuccess([], __('Obrigado por se inscrever'));
        }
    }



    public function upgradeVendorPlans()
    {

        $plans = User::query()->whereStatus('publish')->get();

        $plansAnnual = \array_filter($plans->toArray(), fn($plan) => !empty($plan['annual_price']) && $plan['annual_price'] > 0);

        $data = [
            'page_title' => __('Pacotes de Preços'),
            'plans' => $plans,
            'has_annual' => \count($plansAnnual) > 0,
            'user' => auth()->user(),
        ];

        return view("User::frontend.plan.index", $data);
    }

    public function permanentlyDelete(Request $request)
    {
        if (is_demo_mode()) {
            return back()->with('error', "Demo mode: disabled");
        }
        if (!empty(setting_item('user_enable_permanently_delete'))) {
            $user = Auth::user();
            \DB::beginTransaction();
            try {
                Service::where('author_id', $user->id)->delete();
                Tour::where('author_id', $user->id)->delete();
                Space::where('author_id', $user->id)->delete();
                Hotel::where('author_id', $user->id)->delete();
                Event::where('author_id', $user->id)->delete();
                Assistance::where('author_id', $user->id)->delete();
                $user->sendEmailPermanentlyDelete();
                $user->delete();
                \DB::commit();
                Auth::logout();
                if (is_api()) {
                    return $this->sendSuccess([], 'Excluído');
                }
                return redirect(route('home'));
            } catch (\Exception $exception) {
                \DB::rollBack();
            }
        }
        if (is_api()) {
            return $this->sendError('Erro. Você não pode excluir permanentemente');
        }
        return back()->with('error', __('Erro. Você não pode excluir permanentemente'));
    }
}
