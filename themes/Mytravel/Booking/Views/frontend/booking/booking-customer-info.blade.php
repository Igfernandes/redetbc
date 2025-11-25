<div class="pt-4 pb-5 px-5 border-bottom booking-review">
    <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
        {{ __("Suas Informações") }}
    </h5>
    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
        <li class="info-first-name d-flex justify-content-between py-2">
            <div class="label">{{__('Primeiro nome')}}</div>
            <div class="val">{{$booking->first_name}}</div>
        </li>
        <li class="info-last-name d-flex justify-content-between py-2">
            <div class="label">{{__('Sobrenome')}}</div>
            <div class="val">{{$booking->last_name}}</div>
        </li>
        <li class="info-email d-flex justify-content-between py-2">
            <div class="label">{{__('E-mail')}}</div>
            <div class="val">{{$booking->email}}</div>
        </li>
        <li class="info-phone d-flex justify-content-between py-2">
            <div class="label">{{('Telefone')}}</div>
            <div class="val">{{$booking->phone}}</div>
        </li>
        <li class="info-address d-flex justify-content-between py-2">
            <div class="label">{{('Endereço 1')}}</div>
            <div class="val">{{$booking->address}}</div>
        </li>
        <li class="info-address2 d-flex justify-content-between py-2">
            <div class="label">{{('Endereço 2')}}</div>
            <div class="val">{{$booking->address2}}</div>
        </li>
        <li class="info-city d-flex justify-content-between py-2">
            <div class="label">{{__('Cidade')}}</div>
            <div class="val">{{$booking->city}}</div>
        </li>
        <li class="info-state d-flex justify-content-between py-2">
            <div class="label">{{__('Estado/Província/Região')}}</div>
            <div class="val">{{$booking->state}}</div>
        </li>
        <li class="info-zip-code d-flex justify-content-between py-2">
            <div class="label">{{__('CEP/Código Postal')}}</div>
            <div class="val">{{$booking->zip_code}}</div>
        </li>
        <li class="info-country d-flex justify-content-between py-2">
            <div class="label">{{__('País')}}</div>
            <div class="val">{{get_country_name($booking->country)}}</div>
        </li>
        <li class="info-notes d-flex justify-content-between py-2">
            <div class="label">{{__('Requisitos Especiais')}}</div>
            <div class="val">{{$booking->customer_notes}}</div>
        </li>
    </ul>
    </div>