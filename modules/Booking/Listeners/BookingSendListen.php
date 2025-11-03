<?php

namespace Modules\Booking\Listeners;

use App\User;
use Illuminate\Support\Facades\Mail;
use Modules\Booking\Emails\NewBookingVendorEmail;
use Modules\Booking\Events\BookingSendEvent;

class BookingSendListen
{
    /**
     * Handle the event.
     *
     * @param BookingSendEvent $event
     * @return void
     */
    public function handle(BookingSendEvent $event)
    {
        Mail::to(User::find($event->booking->create_user))->send(new NewBookingVendorEmail($event->booking));
    }
}
