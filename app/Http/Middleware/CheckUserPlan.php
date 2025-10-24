<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Modules\User\Models\UserPlan;
use Modules\Booking\Models\Payment;

class CheckUserPlan
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // Busca o plano ativo do usuário
            $userPlan = UserPlan::where('user_id', $user->id)
                ->where('status', 1) // ativo
                ->first();

            if ($userPlan) {
                $planCreatedAt = Carbon::parse($userPlan->created_at);

                // 🔹 Caso seja ANUAL
                if ($userPlan->is_annuity) {
                    // Se já passou mais de 1 ano da data do plano, desativa
                    if (Carbon::now()->greaterThanOrEqualTo($planCreatedAt->copy()->addYear())) {
                        $userPlan->status = 0;
                        $userPlan->save();
                    }
                } else {
                    // 🔹 Caso seja MENSAL
                    $currentMonth = Carbon::now()->month;
                    $currentYear  = Carbon::now()->year;

                    // Verifica pagamento do mês atual (<= dia do plano)
                    $pagamento = Payment::where('user_id', $user->id)
                        ->whereMonth('created_at', $currentMonth)
                        ->whereYear('created_at', $currentYear)
                        ->whereDate('created_at', '<=', $planCreatedAt->day) // opcional: se precisar até dia do plano
                        ->first();

                    // Se não existir pagamento válido do mês atual, desativa
                    if (!$pagamento) {
                        $userPlan->status = 0;
                        $userPlan->save();
                    }
                }
            }
        }

        return $next($request);
    }
}
