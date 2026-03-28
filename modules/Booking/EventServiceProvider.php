<?php

namespace Modules\Booking;

use Modules\Booking\Events\BookingAcceptedEvent;
use Modules\Booking\Events\BookingCanceledEvent;
use Modules\Booking\Events\BookingRefusedEvent;
use Modules\Booking\Events\EnquiryReplyCreated;
use Modules\Booking\Listeners\BookingStatusChangedListener;
use Modules\Booking\Listeners\SendEnquiryReplyNotification;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    protected $listen = [
        EnquiryReplyCreated::class => [
            SendEnquiryReplyNotification::class
        ],
        BookingAcceptedEvent::class => [
            BookingStatusChangedListener::class,
        ],
        BookingRefusedEvent::class => [
            BookingStatusChangedListener::class,
        ],
        BookingCanceledEvent::class => [
            BookingStatusChangedListener::class
        ]
    ];
}
