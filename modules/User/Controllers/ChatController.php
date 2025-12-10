<?php

namespace Modules\User\Controllers;

use Modules\FrontendController;
use Modules\Booking\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Modules\Booking\Events\BookingReplySendEvent;
use Modules\Booking\Models\BookingMessage;

class ChatController extends FrontendController
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $bookings = Booking::query()
            ->with(['vendor', 'customer'])
            ->where(function ($query) use ($userId) {
                $query->where('customer_id', $userId)
                    ->orWhere('vendor_id', $userId);
            })
            ->orderByDesc('id')
            ->get();
        $user = Auth::user();
        $data = [
            'user'        => $user,
            'fields'      => $user->verification_fields,
            'page_title' => __("Mensagens"),
            'bookings'   => $bookings,
            'bookingTarget' => $request->get('bk'),
            'userId'     => $userId,
            'breadcrumbs' => [
                [
                    'name' => __('Verificação'),
                    'url'  => route('user.verification.index')
                ],
                [
                    'name'  => __('Atualizar dados de verificação'),
                    'class' => 'active'
                ],
            ],
        ];
        
        return view("User::frontend.chat.index", $data);
    }

    // Carrega mensagens do chat
    public function getMessages($bookingId)
    {
        $messages = BookingMessage::where('booking_id', $bookingId)
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    // Envia nova mensagem
    public function sendMessage(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bravo_bookings,id',
            'message'    => 'required|string|max:2000',
        ]);

        $msg = BookingMessage::create([
            'booking_id' => $request->booking_id,
            'sender_id'  => Auth::id(),
            'message'    => $request->message,
        ]);

        $booking = Booking::find($request->booking_id);
        event(new BookingReplySendEvent($booking));

        return response()->json([
            'status' => 'success',
            'data' => $msg->load('sender'),
        ]);
    }
}
