<div class="item">
    <a href="{{ route("hotel.search",['_layout'=>'map']) }}">{{__("Mostrar no mapa")}}</a>
</div>
<div class="item">
    @php
        $param = request()->input();
        $orderby =  request()->input("orderby");
    @endphp
    <div class="item-title">
        {{ __("Ordenar por:") }}
    </div>
    <div class="dropdown">
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
            @php $param['orderby'] = "" @endphp
            <a class="dropdown-item" href="{{ route("hotel.search",$param) }}">{{ __("Recomendado") }}</a>
            @php $param['orderby'] = "price_low_high" @endphp
            <a class="dropdown-item" href="{{ route("hotel.search",$param) }}">{{ __("Preço (do menor para o maior)") }}</a>
            @php $param['orderby'] = "price_high_low" @endphp
            <a class="dropdown-item" href="{{ route("hotel.search",$param) }}">{{ __("Preço (do mais alto para o mais baixo)") }}</a>
            @php $param['orderby'] = "rate_high_low" @endphp
            <a class="dropdown-item" href="{{ route("hotel.search",$param) }}">{{ __("Classificação (de alta a baixa)") }}</a>
        </div>
    </div>
</div>
