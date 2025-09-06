<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckVerification
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (is_admin())
            return $next($request);

        // Usuário não logado → redireciona para registro/login
        if (!$user) {
            return redirect('/?action=register');
        }

        // Defina as rotas/paths que DEVEM ser liberadas mesmo sem verificação
        $except = [
            '/',               // home
            'logout',          // logout
            'login',           // login
            'register',        // registro
            'plans',           // tela de planos
            'news',
            'page/eventos',
            'page/noticias',
        ];

        // Se não verificado e não está em nenhuma das rotas liberadas
        if ($user->is_verified == 0 && !$request->is($except)) {
            return redirect('/?action=plans');
        }

        return $next($request);
    }
}
