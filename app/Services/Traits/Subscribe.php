<?php

namespace App\Services\Traits;

use Illuminate\Support\Facades\Http;
use Modules\User\Models\Plan;
use Modules\User\Models\UserPlan;

trait Subscribe
{
    /**
     * Retorno da criação de checkout no Asaas.
     *
     * @return array{
     *     id: string,                                    ID único do checkout no Asaas
     *     link: string,                                 Link do checkout no Asaas (sandbox ou produção)
     *     status: string,                                Status atual do checkout (ex.: ACTIVE)
     *     minutesToExpire: int,                          Minutos para expirar o checkout
     *     externalReference: string|null,                Referência externa (se enviada)
     *     billingTypes: array<int, string>,              Tipos de cobrança aceitos (ex.: CREDIT_CARD)
     *     chargeTypes: array<int, string>,               Tipos de cobrança (ex.: RECURRENT)
     *     callback: array{                               URLs de callback
     *         cancelUrl: string,
     *         expiredUrl: string,
     *         successUrl: string
     *     },
     *     items: array<int, array{                       Itens do checkout
     *         name: string,                              Nome do item
     *         description: string,                       Descrição detalhada do item (aceita HTML)
     *         externalReference: string|null,            ID externo do item (se enviado)
     *         quantity: int,                             Quantidade
     *         value: float                               Valor unitário
     *     }>,
     *     subscription: array{                           Dados da assinatura
     *         cycle: string,
     *         nextDueDate: string,
     *     }|null,
     *     installment: mixed|null,                       Parcelamento (se houver)
     *     split: mixed|null,                             Split de pagamentos (se houver)
     *     customer: string|null,                         ID do cliente no Asaas
     *     customerData: mixed|null                       Dados do cliente (se retornados)
     * }
     */
    public function subscribe(Plan $plan, array $options = [])
    {
        date_default_timezone_set('America/Sao_Paulo');
        $daysGratuity = $plan->days_gratuity;
        if (!empty($daysGratuity) && $daysGratuity > 0) {
            $dateMoreOneMonth = date("Y-m-d H:i:s", strtotime("+{$daysGratuity} days"));
        } else {
            $dateMoreOneMonth = date("Y-m-d H:i:s");
        }

        $checkoutToken = "redetbc" . uniqid();
        $host = env('APP_URL');

        $payload = [
            "billingTypes" => [
                "CREDIT_CARD"
            ],
            "chargeTypes" => [
                "RECURRENT"
            ],
            "minutesToExpire" => 120,
            "callback" => [
                "cancelUrl" =>  "$host/plan",
                "expiredUrl" => "$host/plan",
                "successUrl" => "$host/user/verification"
            ],
            "items" => [
                [
                    "name" => "Plano" . $plan->title,
                    "description" => $plan->snippet ?? "Assinatura Mensal: " . $plan->title,
                    "quantity" => 1,
                    "value" => $plan->price,
                    "externalReference" => $checkoutToken,
                ]
            ],
            "subscription" => [
                "cycle" => "MONTHLY",
                "nextDueDate" => $dateMoreOneMonth,
            ]
        ];

        if (isset($options['customer']) && !empty($options['customer']))
            $payload['customer'] = $options['customer'];

        $response = Http::withHeaders([
            'access_token' => env('GATEWAY_ACCESS_TOKEN'), // se precisar de token
        ])->post(env('GATEWAY_API_URL') . "/checkouts", $payload);

        $data = $response->json();
        $plan_page = route('plan');

        if (empty($data) || !isset($data['id']))
            redirect()->to($plan_page)->with("warning", __("We are experiencing technical issues to proceed with the payment. Please try again later."));

        $userPlan = new UserPlan();
        $userPlan->store($plan, [
            "status" => 0,
            "gateway_key" => (string) $data['id']
        ]);
        return $data;
    }
}
