<?php

namespace Modules\Booking\Listeners;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Booking\Emails\BookingReplySendEmail;
use Modules\Booking\Events\BookingReplySendEvent;

class BookingReplySendListen
{
    /**
     * Handle the event.
     *
     * @param BookingReplySendEvent $event
     * @return void
     */
    public function handle(BookingReplySendEvent $event)
    {
        if (Auth::user()->id == $event->booking->vendor_id)
            Mail::to(User::find($event->booking->vendor_id))->send(new BookingReplySendEmail($event->booking));
        else
            Mail::to(User::find($event->booking->customer_id))->send(new BookingReplySendEmail($event->booking));
    }
}
