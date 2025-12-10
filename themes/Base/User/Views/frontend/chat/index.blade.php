@extends('layouts.user')

@section('content')
<style>
    .box-message {
        height: 80vh;
        overflow-y: auto;
    }

    @media (max-width: 768px) {
        .content-solicitations{
            margin-bottom: 1rem;
        }
        .box-message {
            max-height: 40vh;
        }

    }
</style>
<div class="container my-5" style="position: sticky; top: 0;left: 0;">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-12 col-md-4 content-solicitations">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <div>
                        <h5 class="mb-0">{{ __('Minhas Solicitações') }}</h5>
                    </div>
                </div>
                <ul class="list-group list-group-flush  box-message">
                    @foreach($bookings as $booking)
                    @php
                    $isVendor = $booking->vendor_id === $userId;
                    $partner = $isVendor ? $booking->customer : $booking->vendor;
                    $statusBadge = match($booking->status) {
                    'published' => 'success',
                    'draft' => 'warning',
                    };
                    @endphp
                    <li class="list-group-item booking-item" style="cursor:pointer;">

                        <div class="row mb-1">
                            <div class="col-12 col-md-8">
                                <div class="fw-bold">{{ $booking->service->title ?? 'Serviço' }}</div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div><span class="badge bg-{{ $statusBadge }}">{{ ucfirst($booking->status == "draft" ? "Pendente" : "Finalizada") }}</span></div>
                            </div>
                        </div>
                        <div>
                            <small><i>{{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y H:i') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y H:i') }}</i></small>
                        </div>
                        <small>{{ $isVendor ? 'Cliente: ' : 'Proprietário: ' }}{{ $partner->name ?? 'Usuário' }}</small>
                        <div class="row mt-2">
                            <div class="col-12 col-md-6">
                                <button class="btn btn-success see-chat" chat-initial='{{($bookingTarget ?? 0) === $booking->id}}' data-booking-id="{{ $booking->id }}">
                                    {{__('Conversar')}}
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="btn btn-info" href="{{route('user.booking_history.request', ['bk' => $booking->id ])}}">{{__('Revisar')}}</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @if(count($bookings) === 0)
                    <li class="list-group-item text-center text-muted">
                        {{ __('Nenhuma solicitação encontrada.') }}
                    </li>
                    @endif
                </ul>
            </div>
        </div>

        {{-- Chat --}}
        <div class="col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0" id="chatTitle">{{ __('Chat da Solicitação') }}</h5>
                </div>
                <div class="card-body" id="chatBox" style="height:400px; overflow-y:auto;">
                    <div class="text-center text-muted mt-5">{{ __('Selecione uma solicitação na lista.') }}</div>
                </div>
                <div class="card-footer">
                    <form id="chatForm" class="d-flex">
                        <input type="hidden" id="booking_id">
                        <input type="text" class="form-control me-2" id="messageInput" placeholder="Digite sua mensagem..." disabled>
                        <button type="submit" class="btn btn-primary" disabled>Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let activeBookingId = null;

    const handle = async (item) => {
        activeBookingId = item.getAttribute('data-booking-id');
        document.getElementById('booking_id').value = activeBookingId;
        document.getElementById('messageInput').disabled = false;
        document.querySelector('#chatForm button').disabled = false;

        const chatBox = document.getElementById('chatBox');
        chatBox.innerHTML = '<div class="text-center text-muted my-5">Carregando mensagens...</div>';

        const response = await fetch(`/user/chat/messages/${activeBookingId}`);
        const messages = await response.json();

        if (!messages.length) {
            chatBox.innerHTML = '<div class="text-center text-muted my-5">Nenhuma mensagem ainda.</div>';
            return;
        }

        chatBox.innerHTML = '';
        messages.forEach(msg => {
            const mine = msg.sender_id == @json($userId);
            chatBox.innerHTML += `
                <div class="d-flex mb-2 ${mine ? 'justify-content-end' : ''}">
                    <div class="p-2 rounded ${mine ? 'bg-info text-white' : 'bg-light'}" style="max-width:70%;">
                        <small>${msg.sender.name}</small><br>
                        ${msg.message}
                        <div class="text-right"><small class="text-white"><i>${new Date(msg.created_at).toLocaleString()}</i></small></div>
                    </div>
                </div>
            `;
        });

        chatBox.scrollTop = chatBox.scrollHeight;
    }
    let initialItemChat = {};
    document.querySelectorAll('.see-chat').forEach((item, key) => {
        item.addEventListener('click', () => handle(item));
        const hasInitial = item.getAttribute("chat-initial")

        if (key == 0) {
            initialItemChat = item
        }

        if (hasInitial === 'true') {
            initialItemChat = item
        }
    });

    handle(initialItemChat)

    document.getElementById('chatForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const message = document.getElementById('messageInput').value.trim();
        if (!message) return;

        const booking_id = document.getElementById('booking_id').value;
        const res = await fetch('/user/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                booking_id,
                message
            })
        });

        const data = await res.json();
        if (data.status === 'success') {
            document.getElementById('messageInput').value = '';
            document.querySelector(`[data-booking-id="${booking_id}"]`).click();
        }
    });
</script>
@endsection