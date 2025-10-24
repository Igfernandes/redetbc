<?php

namespace App\Services\Traits;

use Modules\User\Models\PlanPayment;

trait HandleTransfer
{
    public function transfer(array $notification)
    {
        // Procura o registro de saque pendente pelo external_reference
        $planPayment = PlanPayment::where('meta', $notification['id'])
            ->where('status', 'pending')
            ->first();

        if (!$planPayment) {
            \Log::warning("Transferência Asaas não encontrada ou já processada: {$notification['id']}");
            return response()->json(['status' => 'not_found']);
        }

        // Atualiza status se confirmado
        if ($notification['status'] === 'CONFIRMED') {
            $planPayment->status = 'publish';
            $planPayment->save();
        }

        \Log::info("Transferência de Webhook Asaas processada", $notification);

        return response()->json(['status' => 'ok']);
    }
}
