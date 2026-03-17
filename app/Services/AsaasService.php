<?php

namespace App\Services;

use App\Services\Traits\Checkout;
use App\Services\Traits\HandlePlan;
use App\Services\Traits\HandleTransfer;
use App\Services\Traits\Subscribe;
use App\Services\Traits\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AsaasService
{
    use Subscribe, Checkout, Withdrawal, HandlePlan, HandleTransfer;

    protected string $baseUrl = "";
    protected string $apiKey = "";

    public function __construct()
    {
        $this->baseUrl = env('GATEWAY_API_URL') ?? ""; // ex: https://sandbox.asaas.com/api/v3
        $this->apiKey = env('GATEWAY_ACCESS_TOKEN') ?? "";
    }

    /**
     * Realiza uma requisição genérica para a API do Asaas
     *
     * @param string $method   Método HTTP (get, post, put, delete)
     * @param string $endpoint Caminho do endpoint (ex: "customers")
     * @param array  $data     Dados para enviar (query ou body)
     *
     * @return array Retorno da API em formato array
     *
     * @throws \Exception Se a requisição falhar
     */
    protected function request(string $method, string $endpoint, array $data = [])
    {
        $response = Http::withHeaders([
            'Content-Type'  => 'application/json',
            'access_token'  => $this->apiKey,
        ])->$method("{$this->baseUrl}/{$endpoint}", $data);

        if ($response->failed()) {
            // Pode lançar uma exception customizada
            throw new \Exception("Erro na API Asaas: " . $response->body());
        }

        return $response->json();
    }

    public function findCustomerByEmail(string $email)
    {
        $response = $this->request('get', 'customers', [
            'email' => $email
        ]);

        if (!empty($response['data'])) {
            return $response['data'][0];
        }

        return null;
    }

    public function getOrCreateCustomer(array $data)
    {
        // tenta encontrar por email
        $customer = $this->findCustomerByEmail($data['email']);

        if ($customer) {
            return $customer;
        }

        // se não encontrou cria
        return $this->createCustomer($data);
    }

    /**
     * Cria um cliente no Asaas
     *
     * @param array $data [
     *   'name' => string Nome completo ou razão social,
     *   'cpfCnpj' => string CPF ou CNPJ do cliente,
     *   'email' => string|null E-mail do cliente,
     *   'phone' => string|null Telefone,
     * ]
     *
     * @return array Dados do cliente criado
     */
    public function createCustomer(array $data)
    {
        return $this->request('post', 'customers', $data);
    }

    /**
     * Consulta informações de um pagamento
     *
     * @param string $id ID do pagamento no Asaas
     *
     * @return array Dados do pagamento
     */
    public function getCustomers(array $queryParams)
    {
        return $this->request('get', "customers", $queryParams);
    }

    /**
     * Consulta informações de um pagamento
     *
     * @param string $id ID do pagamento no Asaas
     *
     * @return array Dados do pagamento
     */
    public function getPayment(string $id)
    {
        return $this->request('get', "payments/{$id}");
    }

    /**
     * Remove um cliente do Asaas
     *
     * @param string $id ID do cliente
     *
     * @return array Resposta da API (normalmente status de deleção)
     */
    public function deleteCustomer(string $id)
    {
        return $this->request('delete', "customers/{$id}");
    }

    /**
     * Consulta informações de um pagamento
     *
     * @param string $id ID do pagamento no Asaas
     *
     * @return array Dados do pagamento
     */
    public function webhook(Request $request)
    {
        // Pega todo o payload enviado pelo Asaas
        $webhookData = $request->all();
        if (isset($webhookData['payment']))
            $payment = $webhookData['payment'];
        elseif (isset($webhookData['subscription']))
            $payment =  $webhookData['subscription'];
        else $payment = [];

        if (isset($payment['checkoutSession']) && !empty($payment['checkoutSession']))
            return $this->plan($payment);
        else {
            return $this->transfer($webhookData);
        }

        response()->json(['status' => false]);
    }
}
