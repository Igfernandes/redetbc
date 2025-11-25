<?php


namespace Modules\User\Controllers\Auth;


use App\Helpers\ReCaptchaEngine;
use App\Services\AsaasService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rules\Password;
use Matrix\Exception;
use Modules\User\Events\SendMailUserRegistered;

class RegisterController extends \App\Http\Controllers\Auth\RegisterController
{

    public function register(Request $request)
    {
        if (!is_enable_registration()) {
            return $this->sendError(__("Você não tem permissão para se registrar"));
        }
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
            'last_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'role'  => [
                'required',
                'exists:core_roles,id'
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
            'phone'       => ['required', 'unique:users'],
            'term'       => ['required']
        ];
        $messages = [
            'phone.required'      => __('Telefone é um campo obrigatório'),
            'email.required'      => __('Email é um campo obrigatório'),
            'email.email'         => __('Email inválido'),
            'password.required'   => __('Senha é um campo obrigatório'),
            'role.exists'             => __('A opção de função é inválida'),
            'first_name.required' => __('O primeiro nome é um campo obrigatório'),
            'last_name.required'  => __('O sobrenome é um campo obrigatório'),
            'term.required'       => __('O campo de termos e condições é obrigatório'),
        ];
        if (ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")) {
            $codeCapcha = $request->input('g-recaptcha-response');
            if (!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)) {
                $errors = new MessageBag(['message_error' => __('Por favor, verifique o captcha')]);
                return response()->json([
                    'error'    => true,
                    'messages' => $errors
                ], 200);
            }
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors()
            ], 200);
        } else {
            $data = [
                'name' => explode("@", "$request->input('email')")[0],
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
                'email'      => $request->input('email'),
                'password'   => Hash::make($request->input('password')),
                'status'    => $request->input('publish', 'publish'),
                'phone'    => $request->input('phone'),
                'is_affiliate' => true
            ];

            $relationKey = session('relationKey');

            if (!empty($relationKey))
                $data['owner_id'] = $relationKey;

            $user = \App\User::create($data);

            event(new Registered($user));
            Auth::loginUsingId($user->id);

            try {
                event(new SendMailUserRegistered($user));
            } catch (Exception $exception) {

                Log::warning("SendMailUserRegistered: " . $exception->getMessage());
            }
            $user->assignRole($request->input('role'));
            
            return response()->json([
                'error'    => false,
                'messages' => false,
                'redirect' => url('/plan')
            ],);
        }
    }
}