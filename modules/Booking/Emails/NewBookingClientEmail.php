<?php

namespace Modules\Booking\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\User\Models\User;
use Modules\Booking\Models\Booking;

class NewBookingClientEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $bookingId;
    protected $destinyType;

    public $booking;
    public $client;
    public $vendor;
    public $immobile;

    /**
     * Construtor
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Mapeamento dos possíveis modelos vinculados ao booking.
     */
    protected function getBookableModel(string $modelKey)
    {
        $map = [
            'hotel' => \Modules\Hotel\Models\Hotel::class,
            'assistance' => \Modules\Assistance\Models\Assistance::class,
            'tour' => \Modules\Tour\Models\Tour::class,
            'space' => \Modules\Space\Models\Space::class,
            'event' => \Modules\Event\Models\Event::class,
        ];

        return $map[$modelKey] ?? null;
    }

    /**
     * Monta o e-mail dinamicamente
     */
    public function build()
    {
        $site_name = setting_item('site_title', 'RedeTBC');

        // 🔎 Busca a reserva
        $booking = $this->booking;
        if (!$booking) {
            throw new \Exception("Reserva não encontrada para o ID {$this->bookingId}");
        }

        // 🔎 Busca cliente e anunciante
        $client = User::find($booking->customer_id);
        $vendor = User::find($booking->vendor_id);

        // 🔎 Busca o imóvel vinculado (baseado em object_model + object_id)
        $immobile = null;
        if (!empty($booking->object_model) && !empty($booking->object_id)) {
            $modelClass = $this->getBookableModel($booking->object_model);
            if ($modelClass && class_exists($modelClass)) {
                $immobile = $modelClass::find($booking->object_id);
            }
        }

        // 📨 Define o assunto do e-mail
        $subject = __('[:site_name] Resposta sobre o imóvel que você consultou', [
            'site_name' => $site_name
        ]);

        // 🧱 Prepara os dados para a view
        $this->booking = [
            'id' => $booking->id,
            'start_date' => optional($booking->start_date)->format('d/m/Y'),
            'end_date' => optional($booking->end_date)->format('d/m/Y'),
            'guest' => $booking->total_guests,
        ];

        $this->client = [
            'name' => $client ? trim($client->first_name . ' ' . $client->last_name) : $booking->first_name,
            'email' => $client->email ?? $booking->email,
            'phone' => $client->phone ?? $booking->phone,
        ];

        $this->vendor = [
            'name' => $vendor ? trim($vendor->first_name . ' ' . $vendor->last_name) : 'Anunciante',
            'phone' => $vendor->phone ?? null,
        ];
        $titles = [
            "hotel" => "Hotel",
            "assistance" => "Serviço",
            "space" => "Espaço",
            "tour" => "Passeio"
        ];

        $this->immobile = [
            'id' => $immobile->id ?? $booking->object_id,
            'name' => $immobile->title ?? 'Imóvel',
            "type" => $titles[$booking->object_model ?? "hotel"],
            'image' => [
                'file_path' => method_exists($immobile, 'getImageUrl')
                    ? $immobile->getImageUrl()
                    : null,
            ],
        ];

        // 📤 Retorna a view Blade com os dados
        return $this->subject($subject)
            ->view('Booking::emails.booking-client')
            ->with([
                'booking' => $this->booking,
                'client' => $this->client,
                'vendor' => $this->vendor,
                'immobile' => $this->immobile,
            ]);
    }
}
