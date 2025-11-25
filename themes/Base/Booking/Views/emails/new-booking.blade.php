@extends('Email::layout')
@section('content')

    <div class="b-container">
        <div class="b-panel">
            @switch($to)
                @case ('admin')
                    <h3 class="email-headline"><strong>{{__('Olá Administrador')}}</strong></h3>
                    <p>{{__('Nova reserva foi feita')}}</p>
                @break
                @case ('vendor')
                    <h3 class="email-headline"><strong>{{__('Olá :name',['name'=>$booking->vendor->nameOrEmail ?? ''])}}</strong></h3>
                    <p>{{__('Seu serviço tem uma nova reserva')}}</p>
                @break

                @case ('customer')
                    <h3 class="email-headline"><strong>{{__('Olá :name',['name'=>$booking->first_name ?? ''])}}</strong></h3>
                    <p>{{__('Obrigado por reservar conosco. Aqui estão as informações da sua reserva:')}}</p>
                @break

            @endswitch

            @include($service->email_new_booking_file ?? '')
        </div>
        @include('Booking::emails.parts.panel-customer')
        @include('Booking::emails.parts.panel-passengers')
    </div>
@endsection