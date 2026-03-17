<?php

namespace App\Services\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\User\Models\PlanPayment;
use Modules\User\Models\WithdrawAccount;
use Carbon\Carbon;

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

            $now = Carbon::now();

            if ($now->day >= 5) {
                $schedule = $now->addMonth()->day(5);
            } else {
                $schedule = $now->day(5);
            }

            $payload['scheduleDate'] = $schedule->format('Y-m-d');

            // Chamada à API Asaas
            $response = Http::withoutVerifying()->withHeaders([
                'access_token' => env('GATEWAY_ACCESS_TOKEN'),
                'accept' => 'application/json'
            ])->post(env('GATEWAY_API_URL') . "/transfers", $payload);

            dd($response->body(),  $payload);
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

            dd($th);
            Log::error('Erro interno ao criar saque', ['error' => $th->getMessage()]);
            return false;
        }
    }
}
