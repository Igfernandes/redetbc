<?php


namespace Modules\User\Controllers;


use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\FrontendController;
use Illuminate\Validation\Rules\Password;


class PasswordController extends FrontendController
{

    use ResetsPasswords;

    public function changePassword(Request $request)
    {
        $data = [
            'breadcrumbs' => [
                [
                    'name' => __('Configuração'),
                    'url'  => route("user.profile.index")
                ],
                [
                    'name'  => __('Alterar Senha'),
                    'class' => 'active'
                ]
            ],
            'page_title'  => __("Alterar senha"),
        ];
        return view('User::frontend.changePassword', $data);
    }

    public function changePasswordUpdate(Request $request)
    {
        if(is_demo_mode()){
            return back()->with('error',__("Modo Demo: desabilitado"));
        }
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", __("Sua senha atual não corresponde à senha que você forneceu. Por favor, tente novamente."));
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", __("A Nova Senha não pode ser igual à sua senha atual. Por favor, escolha uma senha diferente."));
        }
        $request->validate([
            'current-password' => 'required',
            'new-password'     => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed',
            ],
        ]);
        //Change Password
        $user = Auth::user();
        $this->resetPassword($user,$request->input('new-password'));

        return redirect()->back()->with('success', __('Senha alterada com sucesso!'));
    }

}