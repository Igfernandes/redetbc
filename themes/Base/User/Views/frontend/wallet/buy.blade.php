@extends('layouts.user')

@push('css')
    <link rel="stylesheet" href="{{asset('module/booking/css/checkout.css')}}">
@endpush

@section('content')
    <h2 class="title-bar">
        {{__("Comprar créditos")}}
    </h2>

    @include('admin.message') {{-- Inclui mensagens de sucesso/erro do admin --}}

    <form action="{{route('user.wallet.buyProcess')}}" method="post">
        <div class="bravo-user-dashboard">
            <div class="panel">
                <div class="panel-title"><strong>{{__("Comprar")}}</strong></div>
                <div class="panel-body">
                    @csrf {{-- Token CSRF para segurança --}}

                    {{-- Se o tipo de depósito for "lista" --}}
                    @if(setting_item('wallet_deposit_type') == 'list')
                        @if(!empty($wallet_deposit_lists))
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{__('Nome')}}</th>
                                        <th scope="col">{{__("Preço")}}</th>
                                        <th scope="col">{{__('Créditos')}}</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wallet_deposit_lists as $k=>$item)
                                        <tr>
                                            <td>{{$k + 1}}</td>
                                            <td>{{$item['name']}}</td>
                                            <td>{{format_money($item['amount'])}}</td>
                                            <td>{{$item['credit']}}</td>
                                            <td>
                                                <label class="btn btn-info">
                                                    <input type="radio" name="deposit_option" value="{{$k}}">
                                                    {{__("Selecionar")}}
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning">{{__("Desculpe, nenhuma opção encontrada")}}</div>
                        @endif

                    {{-- Se o tipo de depósito for valor livre --}}
                    @else
                        <div class="form-section mt-3">
                            <h4 class="form-section-title">{{__("Quanto você deseja depositar?")}}</h4>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control update_exchange_value" name="deposit_amount" placeholder="{{__('Valor do depósito')}}" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text deposit_exchange_value" data-rate="{{(float)setting_item('wallet_deposit_rate',1)}}" ></span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Seleção do método de pagamento --}}
                    <div class="form-section mt-3">
                        <h4 class="form-section-title">{{__('Selecionar método de pagamento')}}</h4>
                        <div class="gateways-table accordion mt-3" id="accordionExample">
                            @foreach($gateways as $k=>$gateway)
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="mb-0">
                                            <label data-toggle="collapse" data-target="#gateway_{{$k}}">
                                                <input type="radio" name="payment_gateway" value="{{$k}}">
                                                @if($logo = $gateway->getDisplayLogo())
                                                    <img src="{{$logo}}" alt="{{$gateway->getDisplayName()}}">
                                                @endif
                                                {{$gateway->getDisplayName()}}
                                            </label>
                                        </strong>
                                    </div>
                                    <div id="gateway_{{$k}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="gateway_name">
                                                {!! $gateway->getDisplayName() !!}
                                            </div>
                                            {!! $gateway->getDisplayHtml() !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @php
                        $term_conditions = setting_item('booking_term_conditions');
                    @endphp

                    {{-- Aceitação dos termos e condições --}}
                    <div class="form-group mt-3">
                        <label class="term-conditions-checkbox">
                            <input type="checkbox" name="term_conditions"> {{__('Li e aceito os')}}  
                            <a target="_blank" href="{{get_page_url($term_conditions)}}">{{__('termos e condições')}}</a>
                        </label>
                    </div>
                </div>

                {{-- Botão de envio do formulário --}}
                <div class="panel-footer">
                    <button class="btn btn-primary" type="submit">{{ __('Processar agora')}}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
