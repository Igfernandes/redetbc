@extends('Layout::user')

@section('content')
<div class="container my-5">
    <div class="text-right">
        <a href="{{route('user.chat', ['bk' => $booking->id])}}" class="btn btn-info">
            {{__('Retornar a conversa')}}
        </a>
    </div>
    {{-- 🧭 Abas de navegação --}}
    <ul class="nav nav-tabs mb-4" id="bookingTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="detail-tab-{{ $booking->id }}" data-bs-toggle="tab" href="#booking-detail-{{ $booking->id }}" role="tab">
                <i class="bi bi-info-circle"></i> {{ __("Detalhes da Reserva") }}
            </a>
        </li>

        @if(count($booking->passengers))
        <li class="nav-item">
            <a class="nav-link" id="guests-tab-{{ $booking->id }}" data-bs-toggle="tab" href="#booking-guests-{{ $booking->id }}" role="tab">
                <i class="bi bi-people"></i> {{ __('Informações dos Passageiros') }}
            </a>
        </li>
        @endif
    </ul>

    {{-- 🗂 Conteúdo das abas --}}
    <div class="tab-content" id="bookingTabsContent">

        {{-- 🧾 Detalhes da Reserva --}}
        <div class="tab-pane fade show active" id="booking-detail-{{ $booking->id }}" role="tabpanel">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ __('Resumo da Reserva') }}</h5>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>{{ __('Status da Reserva') }}</strong>
                            <span>{{ $booking->statusName }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>{{ __('Data da Reserva') }}</strong>
                            <span>{{ display_date($booking->created_at) }}</span>
                        </li>

                        @php $vendor = $service->author; @endphp

                        @if($vendor->hasPermission('dashboard_vendor_access') && !$vendor->hasPermission('dashboard_access'))
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>{{ __("Fornecedor") }}</strong>
                            <a href="{{ route('user.profile', ['id' => $vendor->id]) }}" target="_blank">
                                {{ $vendor->getDisplayName() }}
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- 📋 Detalhes adicionais --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    @include($service->checkout_booking_detail_file ?? '')
                </div>
            </div>
        </div>

        {{-- 👤 Informações do Cliente --}}
        <div class="tab-pane fade" id="booking-customer-{{ $booking->id }}" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body">
                    @include($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info')
                </div>
            </div>
        </div>

        {{-- 🧍‍♂️ Passageiros --}}
        @if(count($booking->passengers))
        <div class="tab-pane fade" id="booking-guests-{{ $booking->id }}" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body">
                    @include('Booking::frontend.detail.passengers')
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection