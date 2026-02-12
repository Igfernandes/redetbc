@extends('Layout::user')

@section('content')
<div class="container my-5">

    @php
    $authId = Auth::id();

    $vendor = $booking->vendor ?? \App\User::find($booking->vendor_id);
    $customer = $booking->customer ?? \App\User::find($booking->customer_id);

    $profileUser = null;

    if($vendor && $authId == $vendor->id){
    $profileUser = $customer;
    }elseif($customer && $authId == $customer->id){
    $profileUser = $vendor;
    }

    /*
    |--------------------------------------------------------------------------
    | 🔁 MAPAS DE TRADUÇÃO LOCAL
    |--------------------------------------------------------------------------
    */

    $civilStatusMap = [
    'SINGLE' => 'Solteiro(a)',
    'MARRIED' => 'Casado(a)',
    ];

    $religionMap = [
    'CATHOLIC' => 'Católico(a)',
    'EVANGELICAL' => 'Evangélico(a)',
    'BOTH' => 'Católico(a) e Evangélico(a)',
    ];

    $sexMap = [
    'MASCULINE' => 'Masculino',
    'FEMININE' => 'Feminino',
    ];

    // Status do usuário
    $userStatusMap = [
    'draft' => 'Rascunho',
    'published' => 'Publicado',
    'refused' => 'Recusado',
    ];

    // Status da reserva (ajuste se tiver mais status no seu sistema)
    $bookingStatusMap = [
    'draft' => 'Rascunho',
    'published' => 'Confirmado',
    'refused' => 'Recusado',
    ];
    @endphp


    <div class="text-end mb-3">
        <a href="{{route('user.chat', ['bk' => $booking->id])}}" class="btn btn-info">
            Retornar a conversa
        </a>
    </div>

    {{-- ================= TABS ================= --}}
    <ul class="nav nav-tabs mb-4" role="tablist">

        <li class="nav-item">
            <button class="nav-link active"
                data-bs-toggle="tab"
                data-bs-target="#booking-detail-{{ $booking->id }}"
                type="button">
                Detalhes da Reserva
            </button>
        </li>

        @if($profileUser)
        <li class="nav-item">
            <button class="nav-link"
                data-bs-toggle="tab"
                data-bs-target="#booking-profile-{{ $booking->id }}"
                type="button">
                {{ $authId == $vendor?->id ? 'Perfil do Cliente' : 'Perfil do Fornecedor' }}
            </button>
        </li>
        @endif

        @if(count($booking->passengers))
        <li class="nav-item">
            <button class="nav-link"
                data-bs-toggle="tab"
                data-bs-target="#booking-guests-{{ $booking->id }}"
                type="button">
                Informações dos Passageiros
            </button>
        </li>
        @endif
    </ul>


    <div class="tab-content">

        {{-- ================= DETALHES ================= --}}
        <div class="tab-pane fade show active" id="booking-detail-{{ $booking->id }}">

            @php
            $translatedBookingStatus = $bookingStatusMap[$booking->status] ?? $booking->status;

            // Cor automática do badge
            $bookingBadgeColor = match($booking->status){
            'published' => 'success',
            'draft' => 'warning',
            'refused' => 'danger',
            default => 'warning'
            };
            @endphp

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Resumo da Reserva</h5>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Status</strong>
                            <span class="badge px-4 py-2 text-white bg-{{ $bookingBadgeColor }}">
                                {{ $translatedBookingStatus }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Data</strong>
                            <span>{{ display_date($booking->created_at) }}</span>
                        </li>

                        @if($vendor)
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Fornecedor</strong>
                            <span>{{ $vendor->getDisplayName() }}</span>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>

        </div>


        {{-- ================= PERFIL ================= --}}
        @if($profileUser)
        <div class="tab-pane fade" id="booking-profile-{{ $booking->id }}">

            @php
            $translatedUserStatus = $userStatusMap[$profileUser->status] ?? $profileUser->status;
            @endphp

            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3 text-center">
                            <img src="{{ $profileUser->avatar_url }}"
                                class="rounded-circle mb-3"
                                style="width:120px;height:120px;object-fit:cover;">

                            <h5>{{ $profileUser->getDisplayName(true) }}</h5>

                            <span class="badge text-white px-4 py-1 bg-{{ $profileUser->status === 'publish' ? 'success' : 'secondary' }}">
                                {{ $translatedUserStatus === "publish" ? "Ativo": "Inativo" }}
                            </span>
                        </div>

                        <div class="col-md-9">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <strong>Nascimento:</strong><br>
                                    {{ $profileUser->birthday ? display_date($profileUser->birthday) : '-' }}
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Sexo:</strong><br>
                                    {{ $profileUser->sex 
                                        ? ($sexMap[$profileUser->sex] ?? $profileUser->sex) 
                                        : '-' }}
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Estado Civil:</strong><br>
                                    {{ $profileUser->civil_status 
                                        ? ($civilStatusMap[$profileUser->civil_status] ?? $profileUser->civil_status) 
                                        : '-' }}
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Religião:</strong><br>
                                    {{ $profileUser->religion 
                                        ? ($religionMap[$profileUser->religion] ?? $profileUser->religion) 
                                        : '-' }}
                                </div>

                                <div class="col-md-12 mb-3">
                                    <strong>Endereço:</strong><br>
                                    {{ $profileUser->address }} {{ $profileUser->address2 }}<br>
                                    {{ $profileUser->city }} - {{ $profileUser->state }}<br>
                                    {{ $profileUser->country }} - {{ $profileUser->zip_code }}
                                </div>

                                @if($profileUser->bio)
                                <div class="col-md-12">
                                    <hr>
                                    <strong>Bio:</strong>
                                    <p class="mb-0">{{ $profileUser->bio }}</p>
                                </div>
                                @endif

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
        @endif

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection