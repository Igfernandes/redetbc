<div class="booking-review">
    <h4 class="booking-review-title">{{__('Suas informações')}}</h4>
    <div class="booking-review-content">
        <div class="review-section">
            <div class="info-form">
                <ul>
                    <li class="info-first-name">
                        <div class="label">{{__('Primeiro nome')}}</div>
                        <div class="val">{{$booking->first_name}}</div>
                    </li>
                    <li class="info-last-name">
                        <div class="label">{{__('Sobrenome')}}</div>
                        <div class="val">{{$booking->last_name}}</div>
                    </li>
                    <li class="info-email">
                        <div class="label">{{__('Email')}}</div>
                        <div class="val">{{$booking->email}}</div>
                    </li>
                    <li class="info-phone">
                        <div class="label">{{__('Telefone')}}</div>
                        <div class="val">{{$booking->phone}}</div>
                    </li>
                    <li class="info-address">
                        <div class="label">{{__('Endereço 1')}}</div>
                        <div class="val">{{$booking->address}}</div>
                    </li>
                    <li class="info-address2">
                        <div class="label">{{__('Endereço 2')}}</div>
                        <div class="val">{{$booking->address2}}</div>
                    </li>
                    <li class="info-city">
                        <div class="label">{{__('Cidade')}}</div>
                        <div class="val">{{$booking->city}}</div>
                    </li>
                    <li class="info-state">
                        <div class="label">{{__('Estado/Província/Região')}}</div>
                        <div class="val">{{$booking->state}}</div>
                    </li>
                    <li class="info-zip-code">
                        <div class="label">{{__('Código postal/CEP')}}</div>
                        <div class="val">{{$booking->zip_code}}</div>
                    </li>
                    <li class="info-country">
                        <div class="label">{{__('País')}}</div>
                        <div class="val">{{get_country_name($booking->country)}}</div>
                    </li>
                    <li class="info-notes">
                        <div class="label">{{__('Requisitos especiais')}}</div>
                        <div class="val">{{$booking->customer_notes}}</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
