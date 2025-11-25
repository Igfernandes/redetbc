<div class="b-panel">
    <div class="b-panel-title">{{__('Informações do Cliente')}}</div>
    <div class="b-table-wrap">
        <div class="b-table b-table-div">
            <div class="info-first-name b-tr">
                <div class="label">{{__('Nome')}}</div>
                <div class="val">{{$booking->first_name}}</div>
            </div>
            <div class="info-last-name b-tr" style="clear: both">
                <div class="label">{{__('Sobrenome')}}</div>
                <div class="val">{{$booking->last_name}}</div>
            </div>
            <div class="info-email b-tr">
                <div class="label">{{__('Email')}}</div>
                <div class="val">{{$booking->email}}</div>
            </div>
            <div class="info-phone b-tr">
                <div class="label">{{__('Telefone')}}</div>
                <div class="val">{{$booking->phone}}</div>
            </div>
            <div class="info-address b-tr">
                <div class="label">{{__('Endereço 1')}}</div>
                <div class="val">{{$booking->address}}</div>
            </div>
            <div class="info-address2 b-tr">
                <div class="label">{{__('Endereço 2')}}</div>
                <div class="val">{{$booking->address2}}</div>
            </div>
            <div class="info-city b-tr">
                <div class="label">{{__('Cidade')}}</div>
                <div class="val">{{$booking->city}}</div>
            </div>
            <div class="info-state b-tr">
                <div class="label">{{__('Estado/Província/Região')}}</div>
                <div class="val">{{$booking->state}}</div>
            </div>
            <div class="info-zip-code b-tr">
                <div class="label">{{__('CEP/Código Postal')}}</div>
                <div class="val">{{$booking->zip_code}}</div>
            </div>
            <div class="info-country b-tr">
                <div class="label">{{__('País')}}</div>
                <div class="val">{{get_country_name($booking->country)}}</div>
            </div>
            <div class="info-notes b-tr">
                <div class="label">{{__('Requisitos Especiais')}}</div>
                <div class="val">{{$booking->customer_notes}}</div>
            </div>
        </div>
    </div>
</div>