<tr>
    <td class="booking-history-type">
        @if($service = $booking->service)
            <i class="{{$service->getServiceIconFeatured()}}"></i>
        @endif
        <small>{{$booking->object_model}}</small>
    </td>
    <td>
        @if($service = $booking->service)
            <a target="_blank" href="{{$service->getDetailUrl()}}">
                {{$service->title}}
            </a>
            <small>
                <div>{{ __("Informações do Cliente") }}</div>
                <div>
                    {{ __("Primeiro Nome") }}: {{ $booking->first_name }}
                </div>
                <div>
                    {{ __("Sobrenome") }}: {{ $booking->last_name }}
                </div>
            </small>
        @else
            {{__("[Excluído]")}}
        @endif
    </td>
    <td class="a-hidden">{{display_date($booking->created_at)}}</td>
    <td class="a-hidden">
        {{__("Data de Início")}} : {{display_date($booking->start_date)}} <br>
        {{__("Data de Fim")}} : {{display_date($booking->end_date)}} <br>
        {{__("Duração")}} :
        @if($booking->getMeta("booking_type") == "by_day")
            @if($booking->duration_days <= 1)
                {{__(':count dia',['count'=>$booking->duration_days])}}
            @else
                {{__(':count dias',['count'=>$booking->duration_days])}}
            @endif
        @endif
        @if($booking->getMeta("booking_type") == "by_night")
            @if($booking->duration_nights <= 1)
                {{__(':count noite',['count'=>$booking->duration_nights])}}
            @else
                {{__(':count noites',['count'=>$booking->duration_nights])}}
            @endif
        @endif
    </td>
    <td>
        <div>{{__("Total")}}: {{format_money_main($booking->total)}}</div>
        <div>{{__("Pago")}}: {{format_money_main($booking->paid)}}</div>
        <div>{{__("Restante")}}: {{format_money($booking->total - $booking->paid)}}</div>
    </td>
    <td>
        {{ format_money($booking->commission) }}
    </td>
    <td class="{{$booking->status}} a-hidden">{{$booking->statusName}}</td>
    <td width="2%">
        @if($service = $booking->service)
            <a class="btn btn-xs btn-primary btn-info-booking" data-ajax="{{route('booking.modal',['booking'=>$booking])}}" data-toggle="modal" data-id="{{$booking->id}}" data-target="#modal_booking_detail">
                <i class="fa fa-info-circle"></i>{{__("Detalhes")}}
            </a>
        @endif
        <a href="{{route('user.booking.invoice',['code'=>$booking->code])}}" class="btn btn-xs btn-primary btn-info-booking open-new-window mt-1" onclick="window.open(this.href); return false;">
            <i class="fa fa-print"></i>{{__("Fatura")}}
        </a>
        @if(!empty(setting_item("space_allow_vendor_can_change_their_booking_status")))
            <a class="btn btn-xs btn-info btn-make-as" data-toggle="dropdown">
                <i class="icofont-ui-settings"></i>
                {{__("Ação")}}
            </a>
            <div class="dropdown-menu">
                @if(!empty($statues))
                    @foreach($statues as $status)
                        <a href="{{ route("space.vendor.booking_report.bulk_edit" , ['id'=>$booking->id , 'status'=>$status]) }}">
                            <i class="icofont-long-arrow-right"></i> {{__('Marcar como: :name',['name'=>booking_status_to_text($status)])}}
                        </a>
                    @endforeach
                @endif
            </div>
        @endif
            @if(!empty(setting_item("space_allow_vendor_can_change_paid_amount")))
                <a class="btn btn-xs btn-info btn-info-booking mt-1" data-toggle="modal" data-target="#modal-paid-{{$booking->id}}">
                    <i class="fa fa-dollar"></i>{{__("Definir Pago")}}
                </a>
                @include ($service->set_paid_modal_file ?? '')
            @endif
    </td>
</tr>