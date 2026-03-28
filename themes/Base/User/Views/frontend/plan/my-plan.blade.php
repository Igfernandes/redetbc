@extends('layouts.user')
@section('content')
<h2 class="title-bar">
    {{__("Meu Plano Atual")}}
</h2>
@include('admin.message')
<div class="row">
    <div class="col-lg-12">
        <div class="ls-widget">
            <div class="tabs-box">
                <div class="widget-content">
                    @php
                    $user_plans = $user->userPlans;
                    @endphp
                    <table class="table table-bordered table-striped  mb-5">
                        <thead>
                            <tr>
                                <th>{{__("ID")}}</th>
                                <th>{{__("Nome do Plano")}}</th>
                                <th>{{__("Expira em")}}</th>
                                <th>{{__("Total")}}</th>
                                <th>{{__("Preço")}}</th>
                                <th>{{__("Status")}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($user_plans && count($user_plans) > 0)
                            @foreach($user_plans as $user_plan)
                            <tr>
                                <td>#{{$user_plan->plan_id}}</td>
                                <td class="trans-id">{{$user_plan->plan->title ?? ''}}</td>
                                <td class="total-jobs">{{!empty($user_plan->end_date) ? display_datetime($user_plan->end_date) : '--' }}</td>
                                <td class="used">@if(!$user_plan->max_service) {{__("Ilimitado")}} @else {{$user_plan->used}}/{{$user_plan->max_service}} @endif</td>
                                <td class="remaining">{{format_money($user_plan->price ?? $user_plan->annual_price)}}</td>
                                <td>
                                    @if($user_plan->status==0)
                                    <div class="text-warning mb-3">{{__('Pendente')}}</div>
                                    <div>
                                        <a href="{{route('user.plan.buy',['id'=>$user_plan->plan_id,'annual'=>1, 'is_upgrade' => 1])}}" class="btn btn-primary">
                                            {{__('Finalizar Pagamento')}}
                                        </a>
                                    </div>
                                    @elseif($user_plan->status==2)
                                    <div class="text-warning mb-3">{{__('Cancelar')}}</div>
                                    @elseif($user_plan->isValid())
                                    <span class="text-success">{{__('Ativo')}}</span>
                                    @else
                                    <div class="text-danger mb-3">{{__('Expirado')}}</div>
                                    <div>
                                        <a href="{{route('plan')}}" class="btn btn-warning">{{__('Renovar')}}</a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    {{__("Nenhum Item")}}
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection