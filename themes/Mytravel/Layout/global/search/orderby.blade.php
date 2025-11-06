@if(empty($hideMap))
<div class="item">
    <a href="{{ route($routeName,['_layout'=>'map']) }}">{{__("Mostrar no mapa")}}</a>
</div>
@endif
<div class="item orderby">
    @php
        $param = request()->input();
        $orderby =  request()->input("orderby");
    @endphp
    <div class="item-title">
        {{ __("Ordenar por:") }}
    </div>
    <input type="hidden" name="orderby" value="{{$orderby}}">
    <div class="dropdown ">
        <span class=" dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @switch($orderby)
                @case("price_low_high")
                {{ __("Preço (do menor para o maior)") }}
                @break
                @case("price_high_low")
                {{ __("Preço (do mais alto para o mais baixo)") }}
                @break
                @case("rate_high_low")
                {{ __("Classificação (de alta a baixa)") }}
                @break
                @default
                {{ __("Recomendado") }}
            @endswitch
        </span>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" data-value="">{{ __("Recomendado") }}</a>
            <a class="dropdown-item" href="#" data-value="price_low_high">{{ __("Preço (do menor para o maior)") }}</a>
            <a class="dropdown-item" href="#" data-value="price_high_low">{{ __("Preço (do mais alto para o mais baixo)") }}</a>
            <a class="dropdown-item" href="#" data-value="rate_high_low">{{ __("Classificação (de alta a baixa)") }}</a>
        </div>
    </div>
</div>
