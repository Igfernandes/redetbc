<?php

namespace Modules\Booking\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Booking\Models\Booking;

class BookingRefusedEvent
{
    use Dispatchable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }
}
