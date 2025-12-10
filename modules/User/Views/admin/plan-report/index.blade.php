@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb20">
        <h1 class="title-bar">{{__("Planos")}}</h1>
    </div>
    @include('admin.message')
    <div class="row">
        <div class="col-md-12">
            <div class="filter-div d-flex justify-content-between ">
                <div class="col-left">
                    {{-- @if(!empty($rows))--}}
                    {{-- <form method="post" action="{{ route('user.admin.plan_report.bulkEdit')  }}"--}}
                    {{-- class="filter-form filter-form-left d-flex justify-content-start">--}}
                    {{-- {{csrf_field()}}--}}
                    {{-- <select name="action" class="form-control">--}}
                    {{-- <option value="">{{__(" Ações em Massa ")}}</option>--}}
                    {{-- <option value="publish">{{__(" Publicar ")}}</option>--}}
                    {{-- <option value="draft">{{__(" Mover para Lixeira ")}}</option>--}}
                    {{-- </select>--}}
                    {{-- <button data-confirm="{{__("Você quer apagar?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Aplicar')}}</button>--}}
                    {{-- </form>--}}
                    {{-- @endif--}}
                </div>
                <div class="col-left">
                    <form method="get" action="" class="filter-form filter-form-right d-flex justify-content-end" role="search">
                        @if(is_admin())
                        <?php
                        $company = \App\User::find(Request()->input('create_user'));
                        \App\Helpers\AdminForm::select2('create_user', [
                            'configs' => [
                                'ajax'        => [
                                    'url' => route('user.admin.getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'allowClear'  => true,
                                'placeholder' => __('-- Selecionar Empregador --')
                            ]
                        ], !empty($company->id) ? [
                            $company->id,
                            $company->getDisplayName()
                        ] : false)
                        ?>
                        @endif
                        <select name="plan_id" class="form-control">
                            <option value="">{{__(" Todos os Planos ")}}</option>
                            @foreach($plans as $plan)
                            <option @if(Request()->plan_id == $plan->id) selected @endif value="{{ $plan->id }}">{{ $plan->title }}</option>
                            @endforeach
                        </select>
                        <button class="btn-info btn btn-icon btn_search" id="search-submit" type="submit">{{__('Procurar')}}</button>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <form method="POST" action="{{route('user.admin.plan.bulkEdit')}}" class="bravo-form-item">
                        @csrf
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th>{{__("ID")}}</th>
                                    <th>{{__("Cliente")}}</th>
                                    <th>{{__("Nome do Plano")}}</th>
                                    <th>{{__("Expira em")}}</th>
                                    <th>{{__("Preço")}}</th>
                                    <th>{{__("Status")}}</th>
                                    <th width="100px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($rows->total() > 0)
                                @foreach($rows as $row)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{$row->id}}" class="check-item">
                                    <td>#{{$row->id}}</td>
                                    <td>{{ $row->user ? $row->user->getDisplayName() : '' }}</td>
                                    <td class="trans-id">{{$row->plan->title ?? ''}}</td>
                                    <td class="total-jobs">{{display_datetime($row->end_date)}}</td>
                                    <td class="remaining">{{format_money($row->price)}}</td>
                                    <td>
                                        @if($row->status==0)
                                        <div class="text-warning mb-3">{{__('Pendente')}}</div>
                                        @elseif($row->status==2)
                                        <div class="text-warning mb-3">{{__('Cancelar')}}</div>
                                        @elseif($row->is_valid)
                                        <span class="text-success">{{__('Ativo')}}</span>
                                        @else
                                        <div class="text-danger mb-3">{{__('Expirado')}}</div>
                                     
                                        @endif
                                    </td>
                                    <td>
                                        <select name="action[]" class="form-control">
                                            <option value="">{{__("--")}}</option>
                                            <option value="gratuity">{{__("Atribuir Gratuidade")}}</option>
                                            <option value="delete">{{__("Excluir")}}</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="text-center">
                                    <td colspan="6">{{__("Sem dados")}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        {{$rows->appends(request()->query())->links()}}
                        <div class="form-group text-right">
                            <button data-confirm="{{__("Você quer apagar?")}}" class="btn btn-primary dungdt-apply-form-btn" type="button">{{__('Aplicar')}}</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection