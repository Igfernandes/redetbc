<?php

namespace Modules\Booking\Listeners;

use App\User;
use Illuminate\Support\Facades\Mail;
use Modules\Booking\Emails\NewBookingClientEmail;
use Modules\Booking\Events\BookingConfirmEvent;
use Modules\Booking\Events\BookingSendEvent;

class BookingConfirmListen
{
    /**
     * Handle the event.
     *
     * @param BookingSendEvent $event
     * @return void
     */
    public function handle(BookingSendEvent|BookingConfirmEvent $event)
    {
        Mail::to(User::find($event->booking->customer_id))->send(new NewBookingClientEmail($event->booking));
    }
}
