<div class="card_stripe">
    <i class="icofont-ui-v-card bg"></i>
    <label>
        <span>{{__("Nome no cartão")}}</span>
        <input id="bravo_card_name" name="card_name" placeholder="{{__("Nome no Cartão")}}">
    </label>
    <label>
        <span>{{__("Número do cartão")}}</span>
        <div id="bravo_card_number" class="input"></div>
        <i class="icofont-credit-card"></i>
    </label>
    <label class="item">
        <span>{{__("Expiração")}}</span>
        <div id="bravo_stripe_card_expiry" class="input"></div>
    </label>
    <label class="item">
        <span>{{__("CVC")}}</span>
        <div id="bravo_stripe_card_cvc" class="input"></div>
    </label>
    <input name="token" type="hidden" value="" id="bravo_stripe_token"/>
</div>