<?php

namespace App\Services\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\User\Models\PlanPayment;
use Modules\User\Models\WithdrawAccount;

trait Withdrawal
{
    public function transferAccount(
        float $value,
        WithdrawAccount $wallet,
        ?string $description = null,
        ?string $scheduleDate = null
    ) {
        try {
            date_default_timezone_set('America/Sao_Paulo');

            $externalReference = uniqid("withdraw_");

            $payload = [
                "value" => $value,
                "description" => $description ?? "Saque solicitado pelo usuário",
                "externalReference" => $externalReference,
            ];

            if (isset($wallet->pix_address_key)) {
                $payload['operationType'] = $wallet->operation_type ?? 'PIX';
                $payload['pixAddressKey'] = $wallet->pix_address_key;
                $payload['pixAddressKeyType'] = $wallet->pix_address_key_type ?? 'EMAIL';
            } else {
                $payload['bankAccount'] = [
                    "bank" => ["accountName" => $wallet->account_name],
                    "ownerName" => $wallet->owner_name,
                    "ownerBirthDate" => $wallet->owner_birthdate,
                    "cpfCnpj" => $wallet->document,
                    "agency" => $wallet->agency,
                    "account" => $wallet->account,
                    "accountDigit" => $wallet->account_digit,
                    "bankAccountType" => $wallet->bank_account_type,
                    "ispb" => $wallet->ispb,
                ];
                $payload['operationType'] = $wallet->operation_type ?? 'TED';
            }

            // Agenda 30 dias à frente se não informado
            $payload['scheduleDate'] = $scheduleDate ?? now()->addDays(30)->format('Y-m-d');

            // Chamada à API Asaas
            $response = Http::withHeaders([
                'access_token' => env('GATEWAY_ACCESS_TOKEN'),
                'accept' => 'application/json'
            ])->post(env('GATEWAY_API_URL') . "/transfers", $payload);

            if ($response->failed()) {
                Log::error('Erro ao solicitar saque', [
                    'payload' => $payload,
                    'response' => $response->body()
                ]);
                $data = json_decode($response->body(), true);
                return  [
                    "error" => $data['errors'][0]['description'] ?? 'Erro ao solicitar o saque.'
                ];
            }

            $user = auth()->user();

            // Cria registro de saque no PlanPayment com status "pending"
            $planPayment = new PlanPayment();
            $planPayment->object_model = 'withdraw';
            $planPayment->object_id = $wallet->id;
            $planPayment->meta = $externalReference; // para ligar ao webhook
            $planPayment->status = 'pending';
            $planPayment->payment_gateway = 'Asaas';
            $planPayment->amount = $value;
            $planPayment->currency = 'BRL';
            $planPayment->user_id = $user->id;
            $planPayment->save();

            return $response->json();
        } catch (\Throwable $th) {

            Log::error('Erro interno ao criar saque', ['error' => $th->getMessage()]);
            return false;
        }
    }
}
