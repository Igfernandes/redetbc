@extends('Email::layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            @if($to == 'vendor')
                <h1>{{__("Olá :name",['name'=>$user->getDisplayName()])}}</h1>

                @if($action == 'insert')
                    <p>{{__('Sua solicitação de pagamento foi enviada:')}}</p>
                @elseif($action ==  'update')
                    <p>{{__('Sua solicitação de pagamento foi atualizada:')}}</p>
                @elseif($action ==  'reject')
                    <p>{{__('Sua solicitação de pagamento foi rejeitada:')}}</p>
                @elseif($action ==  'delete')
                    <p>{{__('Sua solicitação de pagamento foi excluída')}}</p>
                @endif

                @if(!in_array($action,['insert','delete']))
                    <ul>
                        <li><strong>{{__('Status:')}}</strong> <strong>{{$payout_request->status_text}}</strong></li>
                        @if($payout_request->pay_date)
                            <li><strong>{{__('Data de pagamento:')}}</strong> <strong>{{display_date($payout_request->pay_date)}}</strong></li>
                        @endif
                        @if($payout_request->note_to_vendor)
                            <li><strong>{{__('Nota para o fornecedor:')}}</strong> <strong>{!! clean($payout_request->note_to_vendor) !!}</strong></li>
                        @endif
                    </ul>
                    <p>{{__('Informações de pagamento:')}}</p>
                @endif

                <ul>
                    <li><strong>{{__("ID do Pagamento:")}}</strong> <strong>#{{$payout_request->id}}</strong></li>
                    <li><strong>{{__('Valor: ')}}</strong> <strong>{{format_money($payout_request->amount)}}</strong></li>
                    <li><strong>{{__('Método de pagamento: ')}}</strong>
                        {{__(':name para :info',['name'=>$payout_request->payout_method_name,'info'=>$payout_request->account_info])}}
                    </li>
                    @if($payout_request->note_to_admin)
                    <li><strong>{{__('Nota para o administrador: ')}}</strong>
                        {{$payout_request->note_to_admin}}
                    </li>
                    @endif
                    <li><strong>{{__('Criado em: ')}}</strong>
                        {{display_datetime($payout_request->created_at)}}
                    </li>

                </ul>
                <p>{{__('Você pode verificar sua solicitação de pagamento aqui:')}} <a class="btn btn-primary" target="_blank" href="{{route('vendor.payout.index')}}">{{__('Visualizar pagamentos')}}</a></p>

                <br>
            @else
                <h1>{{__("Olá administrador")}}</h1>

                @if($action == 'insert')
                    <p>{{__('Um fornecedor enviou uma solicitação de pagamento:')}}</p>
                @elseif($action ==  'update')
                    <p>{{__('Uma solicitação de pagamento foi atualizada:')}}</p>
                @elseif($action ==  'reject')
                    <p>{{__('Uma solicitação de pagamento foi rejeitada:')}}</p>
                @elseif($action ==  'delete')
                    <p>{{__('Uma solicitação de pagamento foi excluída')}}</p>
                @endif

                @if(!in_array($action,['insert','delete']))
                    <ul>
                        <li><strong>{{__('Status:')}}</strong> <strong>{{$payout_request->status_text}}</strong></li>
                        @if($payout_request->pay_date)
                            <li><strong>{{__('Data de pagamento:')}}</strong> <strong>{{display_date($payout_request->pay_date)}}</strong></li>
                        @endif
                        @if($payout_request->note_to_vendor)
                        <li><strong>{{__('Nota para o fornecedor:')}}</strong> <strong>{!! clean($payout_request->note_to_vendor) !!}</strong></li>
                        @endif
                    </ul>
                    <p>{{__('Informações de pagamento:')}}</p>
                @endif

                <ul>
                    <li><strong>{{__("ID do Pagamento:")}}</strong> <strong>#{{$payout_request->id}}</strong></li>
                    <li><strong>{{__('Fornecedor: ')}}</strong> <strong><a target="_blank" href="{{route('user.profile',['id'=>$payout_request->vendor_id])}}">{{$payout_request->vendor->getDisplayName()}}</a></strong></li>
                    <li><strong>{{__('Valor: ')}}</strong> <strong>{{format_money($payout_request->amount)}}</strong></li>
                    <li><strong>{{__('Método de pagamento: ')}}</strong>
                        {{__(':name para :info',['name'=>$payout_request->payout_method_name,'info'=>$payout_request->account_info])}}
                    </li>
                    @if($payout_request->note_to_admin)
                    <li><strong>{{__('Nota para o administrador: ')}}</strong>
                        {{$payout_request->note_to_admin}}
                    </li>
                    @endif
                    <li><strong>{{__('Criado em: ')}}</strong>
                        {{display_datetime($payout_request->created_at)}}
                    </li>

                </ul>
                <p>{{__('Você pode verificar todas as solicitações de pagamento aqui:')}} <a class="btn btn-primary" target="_blank" href="{{route('vendor.admin.payout.index')}}">{{__('Gerenciar pagamentos')}}</a></p>
                <br>
            @endif
            <p>{{__('Atenciosamente')}},<br>{{setting_item('site_title')}}</p>
        </div>
    </div>
@endsection