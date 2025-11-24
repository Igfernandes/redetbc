@if($meta = $row->meta)
    @if($meta->enable_open_hours)
        @php $open_hours = $meta->open_hours @endphp
        @php $n = date('N') @endphp

        <div class="owner-info widget-box" style="margin-top: 20px;">
            @for($i = 1 ; $i <= 7 ; $i++)
                <div class="open-hour-item @if($n == $i) current @endif">

                    <strong>
                        @switch($i)
                            @case(1)
                                {{__('Segunda-feira')}}
                                @break
                            @case(2)
                                {{__('Terça-feira')}}
                                @break
                            @case(3)
                                {{__('Quarta-feira')}}
                                @break
                            @case(4)
                                {{__('Quinta-feira')}}
                                @break
                            @case(5)
                                {{__('Sexta-feira')}}
                                @break
                            @case(6)
                                {{__('Sábado')}}
                                @break
                            @case(7)
                                {{__('Domingo')}}
                                @break
                        @endswitch
                    </strong>

                    <span class="open-hour-detail">
                        @if(empty($open_hours[$i]['enable']))
                            <span class="text text-danger">{{__("Fechado")}}</span>
                        @else
                            {{$open_hours[$i]['from']}} - {{$open_hours[$i]['to']}}
                        @endif
                    </span>
                </div>
            @endfor
        </div>
    @endif
@endif
