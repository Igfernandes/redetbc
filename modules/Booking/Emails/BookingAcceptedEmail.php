<?php
namespace Modules\Booking\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Booking\Models\Booking;
use Modules\User\Models\User;

class BookingAcceptedEmail extends Mailable
{
    use SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        $booking = $this->booking;

        $client = User::find($booking->customer_id);
        $vendor = User::find($booking->vendor_id);

        return $this->subject('Sua solicitação foi aceita 🎉')
            ->view('Booking::emails.booking-accepted')
            ->with([
                'booking' => $booking,
                'client' => $client,
                'vendor' => $vendor,
            ]);
    }
}
