<div class="card_twocheckout">
    <i class="icofont-ui-v-card bg"></i>
    <label>
        <span>{{__("Nome no Cartão")}}</span>
        <input id="bravo_twocheckout_card_name" name="card_name" placeholder="{{__("Nome no Cartão")}}">
    </label>
    <label>
        <span>{{__("Número do Cartão")}}</span>
        <input id="bravo_twocheckout_card_number" placeholder="{{__("Número do Cartão")}}">
        <i class="icofont-credit-card"></i>
    </label>
    <label class="item">
        <span>{{__("Mês de Expiração")}}</span>
        <input id="bravo_twocheckout_card_expiry_month" placeholder="{{__("Mês de Expiração")}}">
    </label>
    <label class="item">
        <span>{{__("Ano de Expiração")}}</span>
        <input id="bravo_twocheckout_card_expiry_year" placeholder="{{__("Ano de Expiração")}}">
    </label>
    <label class="item">
        <span>{{__("CVC")}}</span>
        <input id="bravo_twocheckout_card_cvc" placeholder="{{__("CVC")}}">
    </label>
    <input name="token" type="hidden" value="" id="bravo_twocheckout_token"/>
    <div class="card_twocheckout_msg"></div>
</div>