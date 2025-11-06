<?php
namespace Modules\Booking\Gateways;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Booking\Events\BookingCreatedEvent;

class OfflinePaymentGateway extends BaseGateway
{
    public $name = 'Offline Payment';
    public $is_offline =  true;

    public function process(Request $request, $booking, $service)
    {
        $service->beforePaymentProcess($booking, $this);
        // Simple change status to processing

        if($booking->paid <= 0){
            $booking->status = $booking::PROCESSING;
        }else{
            if($booking->paid < $booking->total){
                $booking->status = $booking::PARTIAL_PAYMENT;
            }else{
                $booking->status = $booking::PAID;
            }
        }

        $booking->save();
        try{
            event(new BookingCreatedEvent($booking));
        } catch(\Swift_TransportException $e){
            Log::warning($e->getMessage());
        }

        $service->afterPaymentProcess($booking, $this);
        return response()->json([
            'url' => $booking->getDetailUrl()
        ])->send();
    }

    public function processNormal($payment)
    {
        $payment->status = 'processing';
        $payment->save();

        return [true,__("Obrigado, entraremos em contato em breve")];
    }

    public function getOptionsConfigs()
    {
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Habilitar pagamento offline?')
            ],
            [
                'type'  => 'input',
                'id'    => 'name',
                'label' => __('Nome personalizado'),
                'std'   => __("Pagamento off-line"),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'upload',
                'id'    => 'logo_id',
                'label' => __('Logotipo personalizado'),
            ],
            [
                'type'  => 'textarea',
                'id'    => 'payment_note',
                'label' => __('Nota de pagamento'),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'editor',
                'id'    => 'html',
                'label' => __('Descrição HTML personalizada'),
                'multi_lang' => "1"
            ],
        ];
    }
}
