@extends('layouts.user')

@section('content')
<h2 class="title-bar no-border-bottom">
    {{ __("Minhas Reservas") }}
</h2>

@include('admin.message')

<div class="booking-history-manager">
    <div class="tabbable">
        @if($bookings->count() > 0)
        <div class="tab-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-booking-history align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="3%">{{ __("Tipo") }}</th>
                            <th>{{ __("Serviço") }}</th>
                            <th>{{ __("Período") }}</th>
                            <th>{{ __("Status") }}</th>
                            <th>{{ __("Criado em") }}</th>
                            <th width="100px">{{ __("Ações") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            {{-- Tipo --}}
                            <td class="booking-history-type text-center">
                                @if($service = $booking->service)
                                <i class="{{ $service->getServiceIconFeatured() }} fs-5"></i>
                                @endif
                                <small class="d-block text-muted">{{ ucfirst($booking->object_model ?? 'hotel') }}</small>
                            </td>

                            {{-- Serviço --}}
                            <td>
                                @if($service)
                                <a href="{{ $service->getDetailUrl() }}" target="_blank" class="fw-semibold">
                                    {{ $service->title ?? 'Serviço' }}
                                </a>
                                <div class="small text-muted">{{ $service->address ?? '' }}</div>
                                @else
                                <span class="text-muted fst-italic">{{ __("[Serviço removido]") }}</span>
                                @endif
                            </td>

                            {{-- Período --}}
                            <td>
                                <div>
                                    <i class="icofont-calendar"></i>
                                    {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}
                                    <span class="text-muted">até</span>
                                    {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}
                                </div>
                            </td>

                            {{-- Status --}}
                            <td>
                                @php
                                $status = [
                                'draft' => [
                                'color' => 'warning',
                                'text' => 'Pendente'
                                ],
                                'published' => [
                                'color' => 'success',
                                'text' => 'Finalizada'
                                ],
                                'refused' => [
                                'color' => 'danger',
                                'text' => $booking->vendor_id != Auth::user()->id ? 'Cancelada' ?'Recusada'
                                ]
                                ];
                                @endphp
                                <span class="badge bg-{{ $status[$booking->status ?? 'draft']['color'] }}">
                                    {{ ucfirst($status[$booking->status ?? 'draft']['text']) }}
                                </span>
                            </td>

                            {{-- Criado em --}}
                            <td>{{ display_datetime($booking->created_at) }}</td>

                            {{-- Ações --}}
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-info text-white dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        {{ __("Ações") }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end bg-white">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.booking_history.request', ['bk' => $booking->id]) }}">
                                                <i class="icofont-eye"></i> &nbsp; {{ __("Visualizar") }}
                                            </a>
                                        </li>
                                        @if( $booking->status === "draft")
                                        @if($booking->vendor_id == Auth::user()->id)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.accept', ['id' => $booking->id]) }}">
                                                <i class="icofont-check"></i> &nbsp; {{ __("Aceitar") }}
                                            </a>
                                        </li>
                                        @endif
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.refuse', ['id' => $booking->id]) }}">
                                                <i class="icofont-close"></i> &nbsp; {{ __( $booking->vendor_id != Auth::user()->id ? "Cancelar" :"Recusar") }}
                                            </a>
                                        </li>
                                        @elseif($booking->status === "published")
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.chat', ['bk' => $booking->id]) }}">
                                                <i class="icofont-comments"></i> &nbsp; {{ __("Conversar") }}
                                            </a>
                                        </li>
                                        @endif

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="alert alert-info my-4">
            {{ __("Nenhuma reserva encontrada.") }}
        </div>
        @endif
    </div>
</div>
@endsection