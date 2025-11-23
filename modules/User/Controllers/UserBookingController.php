<?php

namespace Modules\User\Controllers;

use Modules\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Booking;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Booking\Models\Enquiry;

class UserBookingController extends FrontendController
{
    use AuthenticatesUsers;

    protected $enquiryClass;
    private Booking $booking;

    public function __construct(Booking $booking, Enquiry $enquiry)
    {
        $this->enquiryClass = $enquiry;
        parent::__construct();
        $this->booking = $booking;
    }

    public function history(Request $request)
    {
        $user_id = Auth::id();

        $bookings = Booking::where(function ($q) use ($user_id) {
            $q->where('customer_id', $user_id)
                ->orWhere('vendor_id', $user_id);
        })->get();
        $data = [
            'bookings' => $bookings,
            'statues'     => config('booking.statuses'),
            'breadcrumbs' => [
                [
                    'name'  => __('Reservas'),
                    'class' => 'active'
                ]
            ],
            'page_title'  => __("Histórico de Reservas"),
        ];
        return view('User::frontend.booking.overview', $data);
    }

    public function preview(Request $request)
    {
        $bookingId = $request->get("bk");
        $booking =  Booking::where("id", $bookingId)->first();

        if (empty($booking))
            redirect()->back();

        $data = [
            'booking'     => $booking,
            'service'     => $booking->service,
            'statues'     => config('booking.statuses'),
            'breadcrumbs' => [
                [
                    'name'  => __('Reservas'),
                    'class' => 'active'
                ]
            ],
            'page_title'  => __("Histórico de Reservas"),
        ];
        return view('User::frontend.booking.preview', $data);
    }
}
