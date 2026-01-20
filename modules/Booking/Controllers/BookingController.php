<?php

namespace Modules\Booking\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Booking\Events\EnquirySendEvent;
use Modules\Booking\Models\BookingPassenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\Enquiry;
use App\Helpers\ReCaptchaEngine;
use Modules\Booking\Events\BookingConfirmEvent;
use Modules\Booking\Models\BookingMessage;

class BookingController extends \App\Http\Controllers\Controller
{
    use AuthorizesRequests;

    protected $booking;
    protected $enquiryClass;
    protected $bookingInst;

    public function __construct(Booking $booking, Enquiry $enquiryClass)
    {
        $this->booking = $booking;
        $this->enquiryClass = $enquiryClass;
    }

    protected function validateCheckout($code)
    {

        if (!is_enable_guest_checkout() and !Auth::check()) {
            $error = __("Você precisa fazer login para fazer isso");
            if (\request()->isJson()) {
                return $this->sendError($error)->setStatusCode(401);
            }
            return redirect(route('login', ['redirect' => \request()->fullUrl()]))->with('error', $error);
        }

        $booking = $this->booking::where('code', $code)->first();

        $this->bookingInst = $booking;

        if (empty($booking)) {
            abort(404);
        }
        if (!is_enable_guest_checkout() and $booking->customer_id != Auth::id()) {
            abort(404);
        }
        return true;
    }

    public function checkout($code)
    {
        $res = $this->validateCheckout($code);
        if ($res !== true) return $res;

        $booking = $this->bookingInst;

        if (!in_array($booking->status, ['draft', 'unpaid'])) {
            return redirect('/');
        }

        $is_api = request()->segment(1) == 'api';

        $data = [
            'page_title' => __('Checkout'),
            'booking'    => $booking,
            'service'    => $booking->service,
            'gateways' => get_available_gateways(),
            'user'       => auth()->user(),
            'is_api'     => $is_api
        ];
        return view('Booking::frontend/checkout', $data);
    }

    protected function savePassengers(Booking $booking, Request $request)
    {
        if ($totalPassenger = $booking->calTotalPassenger()) {
            $booking->passengers()->delete();
            $input = $request->input('passengers', []);
            for ($i = 1; $i <= $totalPassenger; $i++) {
                $passenger = new BookingPassenger();
                $data = [
                    'booking_id' => $booking->id,
                    'first_name' => $input[$i]['first_name'] ?? '',
                    'last_name'  => $input[$i]['last_name'] ?? '',
                    'email'      => $input[$i]['email'] ?? '',
                    'phone'      => $input[$i]['phone'] ?? '',
                ];
                $passenger->fillByAttr(array_keys($data), $data);
                $passenger->save();
            }
        }
    }

    public function decide(Request $request)
    {
        $bookingId = $request->input('bk');

        $booking = Booking::where('id', $bookingId)->first();
        $booking->status = 'publish';
        $booking->save();

        BookingMessage::create([
            'booking_id' => $bookingId,
            'sender_id' => Auth::id(),
            'message' => "Olá! Acabei de solicitar a reserva. Aguardando confirmação do proprietário.",
        ]);

        event(new BookingConfirmEvent($booking));

        return $this->sendSuccess([
            'url' => "/user/chat?bk=$bookingId",
        ]);
    }

    /**
     * @param Request $request
     * @return string json
     * @todo Handle Add To Cart Validate
     *
     */
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return $this->sendError(__("Você precisa fazer login para fazer isso"))->setStatusCode(401);
        }

        $validator = Validator::make($request->all(), [
            'service_id'   => 'required|integer',
            'service_type' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }
        $service_type = $request->input('service_type');
        $service_id = $request->input('service_id');

        $allServices = get_bookable_services();

        if (empty($allServices[$service_type])) {
            return $this->sendError(__('Tipo de serviço não encontrado'));
        }

        $module = $allServices[$service_type];
        $service = $module::find($service_id);

        if (empty($service) or !is_subclass_of($service, '\\Modules\\Booking\\Models\\Bookable')) {
            return $this->sendError(__('Serviço não encontrado'));
        }
        if (!$service->isBookable()) {
            return $this->sendError(__('O serviço não pode ser reservado'));
        }

        if (\auth()->user() && Auth::id() == $service->author_id) {
            return $this->sendError(__('Você não pode reservar seu próprio serviço'));
        }

        return $service->addToCart($request);
    }

    public function detail(Request $request, $code)
    {
        if (!is_enable_guest_checkout() and !Auth::check()) {
            return $this->sendError(__("Você precisa fazer login para fazer isso"))->setStatusCode(401);
        }

        $booking = $this->booking::where('code', $code)->first();
        if (empty($booking)) {
            abort(404);
        }

        if ($booking->status == 'draft') {
            return redirect($booking->getCheckoutUrl());
        }
        if (!is_enable_guest_checkout() and $booking->customer_id != Auth::id()) {
            abort(404);
        }
        $data = [
            'page_title' => __('Detalhes da reserva'),
            'booking'    => $booking,
            'service'    => $booking->service,
        ];
        if ($booking->gateway) {
            $data['gateway'] = get_payment_gateway_obj($booking->gateway);
        }
        return view('Booking::frontend/detail', $data);
    }

    public function exportIcal($type, $id = false)
    {
        if (empty($type) or empty($id)) {
            return $this->sendError(__('Serviço não encontrado'));
        }

        $allServices = get_bookable_services();
        $allServices['room'] = 'Modules\Hotel\Models\HotelRoom';
        if (empty($allServices[$type])) {
            return $this->sendError(__('Tipo de serviço não encontrado'));
        }
        $module = $allServices[$type];

        $path = '/ical/';
        $fileName = 'booking_' . $type . '_' . $id . '.ics';
        $fullPath = $path . $fileName;

        $content = $this->booking::getContentCalendarIcal($type, $id, $module);
        Storage::disk('uploads')->put($fullPath, $content);
        $file = Storage::disk('uploads')->get($fullPath);

        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        echo $file;
    }

    public function addEnquiry(Request $request)
    {
        $rules = [
            'service_id'    => 'required|integer',
            'service_type'  => 'required',
            'enquiry_name'  => 'required',
            'enquiry_note'  => 'required',
            'enquiry_email' => [
                'required',
                'email',
                'max:255',
            ],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendError('', ['errors' => $validator->errors()]);
        }

        if (setting_item('booking_enquiry_enable_recaptcha')) {
            $codeCapcha = trim($request->input('g-recaptcha-response'));
            if (empty($codeCapcha) or !ReCaptchaEngine::verify($codeCapcha)) {
                return $this->sendError(__("Por favor, verifique o captcha"));
            }
        }

        $service_type = $request->input('service_type');
        $service_id = $request->input('service_id');
        $allServices = get_bookable_services();
        if (empty($allServices[$service_type])) {
            return $this->sendError(__('Tipo de serviço não encontrado'));
        }
        $module = $allServices[$service_type];
        $service = $module::find($service_id);
        if (empty($service) or !is_subclass_of($service, '\\Modules\\Booking\\Models\\Bookable')) {
            return $this->sendError(__('Serviço não encontrado'));
        }
        $row = new $this->enquiryClass();
        $row->fill([
            'name'  => $request->input('enquiry_name'),
            'email' => $request->input('enquiry_email'),
            'phone' => $request->input('enquiry_phone'),
            'note'  => $request->input('enquiry_note'),
        ]);
        $row->object_id = $request->input("service_id");
        $row->object_model = $request->input("service_type");
        $row->status = "pending";
        $row->vendor_id = $service->author_id;
        $row->save();
        event(new EnquirySendEvent($row));
        return $this->sendSuccess([
            'message' => __("Obrigado por entrar em contato conosco! Entraremos em contato em breve.")
        ]);
    }

    public function modal(Booking $booking)
    {
        if (!is_admin() and $booking->vendor_id != auth()->id() and $booking->customer_id != auth()->id()) abort(404);

        return view('Booking::frontend.detail.modal', ['booking' => $booking, 'service' => $booking->service]);
    }
}
