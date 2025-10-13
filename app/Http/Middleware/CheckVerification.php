<?php

namespace App\Http\Middleware;

use App\Helpers\Constants;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckVerification
{
    public function handle(Request $request, Closure $next)
    {
        $relationParam = $request->query('rk');

        if (!empty($relationParam)) {
            $relationKey  = \str_replace(Constants::RELATION_AFFILIATE_PREFIX, "", $relationParam);
            session(['relationKey' => $relationKey]);
        }

        $user = Auth::user();

        $isRouteException = $request->is('api/*', 'webhook/*', 'asaas/webhook')
            ||  \array_search($request->path(), ["/", "login", "register"]) !== false;

        if (is_admin() ||  $isRouteException)
            return $next($request);

        // Usuário não logado → redireciona para registro/login
        if (!$user && $request->path() !== "/") {
            return redirect('/?action=register');
        }

        // Defina as rotas/paths que DEVEM ser liberadas mesmo sem verificação
        $except = [
            '/',               // home
            'logout',          // logout
            'login',           // login
            'register',        // registro
            'plan',           // tela de planos,
            'user/plan/*',
            'user/profile',
            'user/verification',
            'news',
            'page/eventos',
            'page/noticias',
            'webhook/*',
            '/asaas/webhook'
        ];

        // Se não verificado e não está em nenhuma das rotas liberadas
        if (!auth()->user()->user_plan && !$request->is($except)) {
            return redirect(route('plan'));
        }

        return $next($request);
    }
}
