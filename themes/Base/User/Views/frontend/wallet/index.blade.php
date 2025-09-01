@extends('layouts.user')
@section('content')
<h2 class="title-bar">
    {{__("Wallet")}}
    <a href="{{route('user.wallet.buy')}}" class="btn-change-password">{{__("Buy credits")}}</a>
</h2>
@include('admin.message')
<div class="bravo-user-dashboard">
    <div class="row dashboard-price-info row-eq-height mb-5">
        <div class="col-lg-3 col-md-3">
            <div class="dashboard-item">
                <div class="wrap-box">
                    <div class="title">
                        {{"Credit balance"}}
                    </div>
                    <div class="details">
                        <div class="number">{{__(':amount',['amount'=>2560])}}</div>
                    </div>
                    @if($row->balance)
                    <div class="desc">~ {{format_money(2560)}} </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="dashboard-item">
                <div class="wrap-box">
                    <div class="title">
                        {{"Pending Credit"}}
                    </div>
                    <div class="details">
                        <div class="number">{{__(':amount',['amount'=>152])}}</div>
                    </div>
                    @if($row->pending_balance)
                    <div class="desc">~ {{format_money(credit_to_money($row->pending_balance))}} </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>
        .box-plan {
            padding: 7%;
            text-align: center;
            box-shadow: #00000059 0 0 2px;
            border-radius: .5rem;
        }
    </style>

    <div class="plans mb-4">
        <div class="row">
            @if(count($plans))
            @foreach($plans as $index => $plan)
            @php
            $translate = $plan->translate();
            @endphp
            <div class="col-12 col-md-4">
                <div class="inner-box box-plan h-100" style="display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        @if($plan->is_recommended  )
                        <div class="text-center mb-4">
                            <span class="tag {{ $plan->title == 'Anfitrião' ? 'bg-info': 'bg-success'}}  p-2 text-white" style="border-radius: 5px">{{ $plan->title == "Anfitrião" ? __('Current Plan') : __('Recommended')}}</span>
                        </div>
                        @endif
                        <div class="title text-center mb-2">
                            <h5><strong>{{$plan->title}}</strong></h5>
                        </div>
                        <div class="price text-center">
                            <i> <span style="font-size: 1.2rem">{{$plan->price ? format_money($plan->price) : __('Free')}}</span>
                                @if($plan->price)
                                <span class="duration">/ {{$plan->duration > 1 ? $plan->duration : ''}} {{$plan->duration_type_text}}</span>
                                @endif</i>
                        </div>
                        <div class="table-content text-justify mt-4">
                            {!! clean($translate->content) !!}
                        </div>
                    </div>
                    <div class="table-footer mt-4">
                        @if($index === 0)
                        @if( $index === 0 )
                        <div class="d-flex justify-content-center text-center">
                            <a href="{{ route('user.plan') }}" class="btn btn-success btn-style-one mr-2">{{__("Current Plan")}}</a>
                         
                        </div>
                        @else
                        <a href="{{route('user.plan.buy',['id'=>$plan->id])}}" class="btn btn-warning">{{__('Repurchase')}}</a>
                        @endif
                        @else
                        <a href="{{route('user.plan.buy',['id'=>$plan->id])}}" class="btn btn-primary">{{ $plan->title == "Anfitrião" ? __('Upgrade') : __('Select')}}</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="panel">
        <div class="panel-title"><strong>{{__("Latest Transactions")}}</strong></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('Type')}}</th>
                            <th scope="col">{{__('Amount')}}</th>
                            <th scope="col">{{__('Gateway')}}</th>
                            <th scope="col">{{__('Status')}}</th>
                            <th scope="col">{{__("Description")}}</th>
                            <th scope="col">{{__("Date")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($transactions))
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{$transaction->id}}</td>
                            <td>{{ucfirst($transaction->type)}}</td>
                            <td>{{$transaction->amount}}</td>
                            <td>
                                @if($transaction->payment->gateway_obj)
                                {{$transaction->payment->gateway_obj->getDisplayName() ?? ''}}
                                @endif
                            </td>
                            <td><span class="badge badge-{{$transaction->status_class}}">{{$transaction->status_name ?? ''}}</span></td>
                            <td>
                                @if(!empty($transaction->meta['admin_deposit']))
                                {{__("Deposit by :name",['name'=>$transaction->author->display_name ?? ''])}}
                                @endif
                            </td>
                            <td>{{display_datetime($transaction->created_at)}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5">{{__("No data found")}}</td>
                        </tr>
                        @endif
                    </tbody>
                    {{$transactions->links()}}
                </table>
            </div>
        </div>
    </div>
</div>
@endsection