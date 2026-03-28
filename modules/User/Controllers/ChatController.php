<?php

namespace Modules\User\Controllers;

use Modules\FrontendController;
use Modules\Booking\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Modules\Booking\Events\BookingAcceptedEvent;
use Modules\Booking\Events\BookingCanceledEvent;
use Modules\Booking\Events\BookingRefusedEvent;
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

    public function accept($bookingId)
    {
        $userId = Auth::id();

        $booking = Booking::where('id', $bookingId)
            ->where(function ($query) use ($userId) {
                $query->where('customer_id', $userId)
                    ->orWhere('vendor_id', $userId);
            })
            ->firstOrFail();

        if ($booking->status !== 'draft') {
            return redirect()->back()->with('error', __('Esta reserva não pode ser aceita.'));
        }

        $booking->status = 'published';
        $booking->save();

        event(new BookingAcceptedEvent($booking));
        return redirect()->route('user.chat', ['bk' => $booking->id])
            ->with('success', __('Reserva aceita. Agora você pode conversar.'));
    }

    public function refuse($bookingId)
    {
        $userId = Auth::id();

        $booking = Booking::where('id', $bookingId)
            ->where(function ($query) use ($userId) {
                $query->where('customer_id', $userId)
                    ->orWhere('vendor_id', $userId);
            })
            ->firstOrFail();

        // Só pode recusar se estiver draft
        if ($booking->status !== 'draft') {
            return redirect()->back()->with('error', __('Esta reserva não pode ser recusada.'));
        }

        $booking->status = 'refused';
        $booking->save();

        if ($booking->vendor_id === Auth::user()->id) {
            event(new BookingRefusedEvent($booking));
        } else {
            event(new BookingCanceledEvent($booking));
        }

        return redirect()->back()->with('success', __('Reserva recusada com sucesso.'));
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
