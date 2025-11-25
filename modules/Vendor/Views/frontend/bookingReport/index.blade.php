@extends('layouts.user')
@section('content')

    <h2 class="title-bar no-border-bottom">
        {{__("Relatório de Reserva")}}
    </h2>
    @include('admin.message')
    <div class="booking-history-manager">
        <div class="tabbable">
            <ul class="nav nav-tabs ht-nav-tabs">
                <?php $status_type = Request::query('status'); ?>
                <li class="@if(empty($status_type)) active @endif">
                    <a href="{{route("vendor.bookingReport")}}">{{__("Todas as Reservas")}}</a>
                </li>
                @if(!empty($statues))
                    @foreach($statues as $status)
                        <li class="@if(!empty($status_type) && $status_type == $status) active @endif">
                            <a href="{{route("vendor.bookingReport",['status'=>$status])}}">{{booking_status_to_text($status)}}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            @if(!empty($bookings) and $bookings->total() > 0)
                <div class="tab-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-booking-history">
                            <thead>
                            <tr>
                                <th width="2%">{{__("Tipo")}}</th>
                                <th>{{__("Título")}}</th>
                                <th class="a-hidden">{{__("Data do Pedido")}}</th>
                                <th class="a-hidden">{{__("Tempo de Execução")}}</th>
                                <th width="15%">{{__("Detalhe do Pagamento")}}</th>
                                <th>{{__("Comissão")}}</th>
                                <th class="a-hidden">{{__("Status")}}</th>
                                <th>{{__("Ação")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                @include(ucfirst($booking->object_model).'::frontend.bookingReport.loop')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="bravo-pagination">
                        {{$bookings->appends(request()->query())->links()}}
                    </div>
                </div>
            @else
                {{__("Nenhum Histórico de Reserva")}}
            @endif
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).on('click', '#set_paid_btn', function (e) {
            var id = $(this).data('id');
            $.ajax({
                url:bookingCore.url+'/booking/setPaidAmount',
                data:{
                    id: id,
                    remain: $('#modal-paid-'+id+' #set_paid_input').val(),
                },
                dataType:'json',
                type:'post',
                success:function(res){
                    alert(res.message);
                    window.location.reload();
                }
            });
        });
    </script>
@endpush