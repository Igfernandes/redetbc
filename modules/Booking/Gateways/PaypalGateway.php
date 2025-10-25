<?php
namespace Modules\Booking\Gateways;

use App\Currency;
use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Booking\Events\BookingCreatedEvent;
use Modules\Booking\Events\BookingUpdatedEvent;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\Payment;
use Omnipay\Omnipay;
use Omnipay\PayPal\ExpressGateway;
use Illuminate\Support\Facades\Log;

class PaypalGateway extends BaseGateway
{
    public $name = 'Paypal Express Checkout';
    /**
     * @var $gateway ExpressGateway
     */
    protected $gateway;

    public function getOptionsConfigs()
    {
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Habilitar o Paypal Standard?')
            ],
            [
                'type'       => 'input',
                'id'         => 'name',
                'label'      => __('Nome personalizado'),
                'std'        => __("Paypal"),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'upload',
                'id'    => 'logo_id',
                'label' => __('Logotipo personalizado'),
            ],
            [
                'type'  => 'editor',
                'id'    => 'html',
                'label' => __('Descrição HTML personalizada'),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'checkbox',
                'id'    => 'test',
                'label' => __('Habilitar Sandbox Mod?')
            ],
            [
                'type'    => 'select',
                'id'      => 'convert_to',
                'label'   => __('Convert To'),
                'desc'    => __('Caso a moeda principal não seja suportada pelo PayPal, você deve selecionar a moeda e inserir a taxa de câmbio correspondente à moeda suportada pelo PayPal.'),
                'options' => $this->supportedCurrency()
            ],
            [
                'type'       => 'input',
                'input_type' => 'number',
                'id'         => 'exchange_rate',
                'label'      => __('Taxa de câmbio'),
                'desc'       => __('Example: A moeda principal é VND (que não é aceita pelo PayPal). Você pode convertê-la para USD quando o cliente finalizar a compra, então a taxa de câmbio deve ser 23400 (1 USD ~ 23400 VND)'),
            ],
            [
                'type'      => 'input',
                'id'        => 'test_account',
                'label'     => __('Nome de usuário da API do Sandbox'),
                'condition' => 'g_paypal_test:is(1)'
            ],
            [
                'type'      => 'input',
                'id'        => 'test_client_id',
                'label'     => __('Senha da API Sandbox'),
                'condition' => 'g_paypal_test:is(1)'
            ],
            [
                'type'      => 'input',
                'id'        => 'test_client_secret',
                'label'     => __('Assinatura da caixa de areia'),
                'std'       => '',
                'condition' => 'g_paypal_test:is(1)'
            ],
            [
                'type'      => 'input',
                'id'        => 'account',
                'label'     => __('Nome de usuário da API'),
                'condition' => 'g_paypal_test:is()'
            ],
            [
                'type'      => 'input',
                'id'        => 'client_id',
                'label'     => __('Senha da API'),
                'condition' => 'g_paypal_test:is()'
            ],
            [
                'type'      => 'input',
                'id'        => 'client_secret',
                'label'     => __('Assinatura'),
                'std'       => '',
                'condition' => 'g_paypal_test:is()'
            ],
        ];
    }

    public function process(Request $request, $booking, $service)
    {
        if (in_array($booking->status, [
            $booking::PAID,
            $booking::COMPLETED,
            $booking::CANCELLED
        ])) {

            throw new Exception(__("O status da reserva precisa ser pago"));
        }
        if (!$booking->pay_now) {
            throw new Exception(__("O total da reserva é zero. Não é possível processar o gateway de pagamento!"));
        }
        $this->getGateway();
        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->payment_gateway = $this->id;
        $payment->status = 'draft';
        $data = $this->handlePurchaseData([
            'amount'        => (float)$booking->pay_now,
            'transactionId' => $booking->code . '.' . time()
        ], $booking, $payment);
        $response = $this->gateway->purchase($data)->send();
        if ($response->isRedirect()) {
            $payment->save();
            $booking->status = $booking::UNPAID;
            $booking->payment_id = $payment->id;
            $booking->save();
            try{
                event(new BookingCreatedEvent($booking));
            } catch(\Swift_TransportException $e){
                Log::warning($e->getMessage());
            }
            // redirect to offsite payment gateway
            response()->json([
                'url' => $response->getRedirectUrl()
            ])->send();
        } else {
            throw new Exception('Paypal Gateway: ' . $response->getMessage());
        }
    }

    public function confirmPayment(Request $request)
    {
        $c = $request->query('c');
        $booking = Booking::where('code', $c)->first();
        if (!empty($booking) and in_array($booking->status, [$booking::UNPAID])) {
            $this->getGateway();
            $data = $this->handlePurchaseData([
                'amount'        => (float)$booking->pay_now,
                'transactionId' => $booking->code . '.' . time()
            ], $booking);
            $response = $this->gateway->completePurchase($data)->send();
            if ($response->isSuccessful()) {
                $payment = $booking->payment;
                if ($payment) {
                    $payment->status = 'completed';
                    $payment->logs = \GuzzleHttp\json_encode($response->getData());
                    $payment->save();
                }
                try{
//                    $oldPaynow = (float)$booking->pay_now;
                    $booking->paid += (float)$booking->pay_now;
//                    $booking->pay_now = (float)($oldPaynow - $data['originalAmount'] < 0 ? 0 : $oldPaynow - $data['originalAmount']);
                    $booking->markAsPaid();

                } catch(\Swift_TransportException $e){
                    Log::warning($e->getMessage());
                }
                return redirect($booking->getDetailUrl())->with("success", __("Seu pagamento foi processado com sucesso"));
            } else {

                $payment = $booking->payment;
                if ($payment) {
                    $payment->status = 'fail';
                    $payment->logs = \GuzzleHttp\json_encode($response->getData());
                    $payment->save();
                }
                try{
                    $booking->markAsPaymentFailed();

                } catch(\Swift_TransportException $e){
                    Log::warning($e->getMessage());
                }
                return redirect($booking->getDetailUrl())->with("error", __("Falha no pagamento"));
            }
        }
        if (!empty($booking)) {
            return redirect($booking->getDetailUrl(false));
        } else {
            return redirect(url('/'));
        }
    }

    public function confirmNormalPayment()
    {
        /**
         * @var Payment $payment
         */
        $request = \request();
        $c = $request->query('pid');
        $payment = Payment::where('code', $c)->first();

        if (!empty($payment) and in_array($payment->status,['draft'])) {
            $this->getGateway();
            $data = $this->handlePurchaseDataNormal([
                'amount'        => (float)$payment->amount,
                'transactionId' => $payment->code . '.' . time()
            ], $payment);
            $response = $this->gateway->completePurchase($data)->send();
            if ($response->isSuccessful()) {
                return $payment->markAsCompleted(\GuzzleHttp\json_encode($response->getData()));

            } else {
                return $payment->markAsFailed(\GuzzleHttp\json_encode($response->getData()));
            }
        }
        if($payment){
            if($payment->status == 'cancel'){
                return [false,__("Seu pagamento foi cancelado")];
            }
        }
        return [false];
    }


    public function processNormal($payment)
    {
        $this->getGateway();
        $payment->payment_gateway = $this->id;
        $data = $this->handlePurchaseDataNormal([
            'amount'        => (float)$payment->amount,
            'transactionId' => $payment->code . '.' . time()
        ],  $payment);

        $response = $this->gateway->purchase($data)->send();

        if($response->isSuccessful()){
            return [true];
        }elseif($response->isRedirect()){
            return [true,false,$response->getRedirectUrl()];
        }else{
            return [false,$response->getMessage()];
        }
    }

    public function cancelPayment(Request $request)
    {
        $c = $request->query('c');
        $booking = Booking::where('code', $c)->first();
        if (!empty($booking) and in_array($booking->status, [$booking::UNPAID])) {
            $payment = $booking->payment;
            if ($payment) {
                $payment->status = 'cancel';
                $payment->logs = \GuzzleHttp\json_encode([
                    'customer_cancel' => 1
                ]);
                $payment->save();
            }

            // Refund without check status
            $booking->tryRefundToWallet(false);

            return redirect($booking->getDetailUrl())->with("error", __("Você cancelou o pagamento"));
        }
        if (!empty($booking)) {
            return redirect($booking->getDetailUrl());
        } else {
            return redirect(url('/'));
        }
    }

    public function getGateway()
    {

        $this->gateway = Omnipay::create('PayPal_Express');
        $this->gateway->setUsername($this->getOption('account'));
        $this->gateway->setPassword($this->getOption('client_id'));
        $this->gateway->setSignature($this->getOption('client_secret'));
        $this->gateway->setTestMode(false);
        if ($this->getOption('test')) {
            $this->gateway->setUsername($this->getOption('test_account'));
            $this->gateway->setPassword($this->getOption('test_client_id'));
            $this->gateway->setSignature($this->getOption('test_client_secret'));
            $this->gateway->setTestMode(true);
        }
    }

    public function handlePurchaseDataNormal($data, &$payment = null)
    {
        $main_currency = setting_item('currency_main');
        $supported = $this->supportedCurrency();
        $convert_to = $this->getOption('convert_to');
        $data['currency'] = $main_currency;
        $data['returnUrl'] = $this->getReturnUrl(true) . '?pid=' . $payment->code;
        $data['cancelUrl'] = $this->getCancelUrl(true) . '?pid=' . $payment->code;
        if (!array_key_exists($main_currency, $supported)) {
            if (!$convert_to) {
                throw new Exception(__("PayPal não suporta currency: :name", ['name' => $main_currency]));
            }
            if (!$exchange_rate = $this->getOption('exchange_rate')) {
                throw new Exception(__("Taxa de câmbio para :name deve ser específico. Entre em contato com o proprietário do site", ['name' => $convert_to]));
            }
            if ($payment) {
                $payment->converted_currency = $convert_to;
                $payment->converted_amount = $payment->amount / $exchange_rate;
                $payment->exchange_rate = $exchange_rate;
                $payment->save();
            }
            $data['amount'] = number_format( $payment->amount / $exchange_rate , 2 );
            $data['currency'] = $convert_to;
        }
        return $data;
    }
    public function handlePurchaseData($data, $booking, &$payment = null)
    {
        $main_currency = setting_item('currency_main');
        $supported = $this->supportedCurrency();
        $convert_to = $this->getOption('convert_to');
        $data['currency'] = $main_currency;
        $data['returnUrl'] = $this->getReturnUrl() . '?c=' . $booking->code;
        $data['cancelUrl'] = $this->getCancelUrl() . '?c=' . $booking->code;
        if (!array_key_exists($main_currency, $supported)) {
            if (!$convert_to) {
                throw new Exception(__("PayPal does not support currency: :name", ['name' => $main_currency]));
            }
            if (!$exchange_rate = $this->getOption('exchange_rate')) {
                throw new Exception(__("Exchange rate to :name must be specific. Please contact site owner", ['name' => $convert_to]));
            }
            if ($payment) {
                $payment->converted_currency = $convert_to;
                $payment->converted_amount = $booking->pay_now / $exchange_rate;
                $payment->exchange_rate = $exchange_rate;
            }
            $data['originalAmount'] = (float)$booking->pay_now;
            $data['amount'] = number_format( (float)$booking->pay_now / $exchange_rate , 2 );
            $data['currency'] = $convert_to;
        }
        return $data;
    }

    public function supportedCurrency()
    {
        return [
            "aud" => "Australian dollar",
            "brl" => "Brazilian real 2",
            "cad" => "Canadian dollar",
            "cny" => "Chinese Renmenbi 3",
            "czk" => "Czech koruna",
            "dkk" => "Danish krone",
            "eur" => "Euro",
            "hkd" => "Hong Kong dollar",
            "huf" => "Hungarian forint 1",
            "ils" => "Israeli new shekel",
            "jpy" => "Japanese yen 1",
            "myr" => "Malaysian ringgit 2",
            "mxn" => "Mexican peso",
            "twd" => "New Taiwan dollar 1",
            "nzd" => "New Zealand dollar",
            "nok" => "Norwegian krone",
            "php" => "Philippine peso",
            "pln" => "Polish złoty",
            "gbp" => "Pound sterling",
            "rub" => "Russian ruble",
            "sgd" => "Singapore dollar ",
            "sek" => "Swedish krona",
            "chf" => "Swiss franc",
            "thb" => "Thai baht",
            "usd" => "United States dollar",
        ];
    }
}
