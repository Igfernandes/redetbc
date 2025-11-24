<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto válido.',
            'name.max' => 'O nome não pode ter mais que 255 caracteres.',

            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O email deve ser um texto válido.',
            'email.email' => 'Por favor, insira um endereço de email válido.',
            'email.max' => 'O email não pode ter mais que 255 caracteres.',
            'email.unique' => 'Este email já está cadastrado.',

            'password.required' => 'A palavra-passe é obrigatória.',
            'password.string' => 'A palavra-passe deve ser um texto válido.',
            'password.min' => 'A palavra-passe deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da palavra-passe não corresponde.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register', ['page_title' => __("Cadastrar-se")]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'publish',
            'email_verified_at' => now(),
        ]);
    }
}
