<div class="g-rules border-bottom">
    <h3 class="font-size-21 font-weight-bold text-dark mb-4">{{__("Regras - Políticas do Hotel")}}</h3>
    <div class="description">
        <div class="row">
            <div class="col-lg-4">
                <div class="key">{{__("Check-in")}}</div>
            </div>
            <div class="col-lg-8">
                <div class="value">	<strong>{{$row->check_in_time}}</strong> </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="key">{{__("Check-out")}}</div>
            </div>
            <div class="col-lg-8">
                <div class="value">	<strong>{{$row->check_out_time}}</strong> </div>
            </div>
        </div>
        @if($translation->policy)
            <div class="row">
                <div class="col-lg-4">
                    <div class="key">{{__("Políticas do Hotel")}}</div>
                </div>
                <div class="col-lg-8">
                    @foreach($translation->policy as $key => $item)
                        <div class="item @if($key > 1) d-none @endif">
                            <div class="strong">{{$item['title']}}</div>
                            <div class="context">{!! $item['content'] !!}</div>
                        </div>
                    @endforeach
                    @if( count($translation->policy) > 2)
                        <div class="btn-show-all">
                            <span class="text">{{__("Mostrar Tudo")}}</span>
                            <i class="fa fa-caret-down"></i>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>