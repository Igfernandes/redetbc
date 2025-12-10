<?php

namespace App\Services\Traits;

use Illuminate\Support\Facades\Http;
use Modules\User\Models\Plan;
use Modules\User\Models\UserPlan;

trait Checkout
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
    public function checkout(Plan $plan, array $options = [])
    {
        date_default_timezone_set('America/Sao_Paulo');
        $host = env('APP_URL');

        if (!isset($options['callback']))
            $options['callback'] =  [
                "cancelUrl" =>  "$host/plan",
                "expiredUrl" => "$host/plan",
                "successUrl" => "$host/user/verification"
            ];

        $payload = [
            "billingTypes" => ["CREDIT_CARD", "PIX"],
            "chargeTypes" => ["DETACHED"],
            "minutesToExpire" => 120,
            "callback" => $options['callback'],
            "items" => [
                [
                    "name" => "Plano " . $plan->title,
                    "description" => "Solicitaçao de adesão ao plano " . $plan->title,
                    "quantity" => 1,
                    "value" => $plan->annual_price
                ]
            ]
        ];

        if (isset($options['customer']) && !empty($options['customer']))
            $payload['customer'] = $options['customer'];

        $response = Http::withHeaders([
            'access_token' => env('GATEWAY_ACCESS_TOKEN'), // se precisar de token
        ])->post(env('GATEWAY_API_URL') . "/checkouts", $payload);

        $data = $response->json();
        $plan_page = route('plan');

        if (empty($data) || !isset($data['id']) || $response->failed())
            redirect()->to($plan_page)->with("warning", __("Estamos com problemas técnicos para prosseguir com o pagamento. Tente novamente mais tarde."));

        $userPlan = new UserPlan();
        $userPlan->store($plan, [
            "status" => 0,
            "gateway_key" => (string) $data['id'],
            "is_annuity" => 1
        ]);
        return $data;
    }
}
