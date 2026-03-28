<?php

namespace Modules\Booking\Listeners;

use Illuminate\Support\Facades\Mail;
use Modules\Booking\Events\BookingAcceptedEvent;
use Modules\Booking\Events\BookingRefusedEvent;
use Modules\Booking\Emails\BookingAcceptedEmail;
use Modules\Booking\Emails\BookingCanceledEmail;
use Modules\Booking\Emails\BookingRefusedEmail;
use Modules\User\Models\User;

class BookingStatusChangedListener
{
    public function handle($event)
    {
        $booking = $event->booking;

        $client = User::find($booking->customer_id);

        if ($event instanceof BookingAcceptedEvent) {
            Mail::to($client)->send(new BookingAcceptedEmail($booking));
        }

        if ($event instanceof BookingRefusedEvent) {
            Mail::to($client)->send(new BookingRefusedEmail($booking));
        }

        if ($event instanceof BookingCanceledEmail) {
            $vendor = User::find($booking->vendor_id);
            Mail::to($vendor)->send(new BookingCanceledEmail($booking));
        }
    }
}
