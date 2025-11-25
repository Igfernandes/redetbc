<?php
namespace Plugins\PaymentTwoCheckout;

use Modules\ModuleServiceProvider;
use Plugins\PaymentTwoCheckout\Gateway\TwoCheckoutGateway;

class ModuleProvider extends ModuleServiceProvider
{
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getPaymentGateway()
    {
        return [
            'two_checkout_gateway' => TwoCheckoutGateway::class
        ];
    }

    public static function getPluginInfo()
    {
        return [
            'title'   => __('Gateway 2Checkout'),
            'desc'    => __('Gateway 2Checkout é um dos melhores Gateways de pagamento para aceitar pagamentos online de compradores em todo o mundo, o que permite que seus clientes façam compras em muitos métodos de pagamento, 15 idiomas, 87 moedas e mais de 200 mercados no mundo.'),
            'author'  => "Booking Core",
            'version' => "1.0.0",
        ];
    }
}