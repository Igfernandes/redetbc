<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AsaasService
{
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
     * Cria um pagamento
     *
     * @param array $data [
     *   'customer' => string ID do cliente Asaas,
     *   'billingType' => string Tipo de cobrança (ex: "CREDIT_CARD", "BOLETO"),
     *   'value' => float Valor da cobrança,
     *   'dueDate' => string Data de vencimento (Y-m-d),
     * ]
     *
     * @return array Dados do pagamento criado
     */
    public function createPayment(array $data)
    {
        return $this->request('post', 'payments', $data);
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
}
