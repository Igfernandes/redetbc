@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb20">
        <h1 class="title-bar">{{ __('Solicitações de Verificaçãos')}}</h1>
    </div>
    @include('admin.message')
    <div class="filter-div d-flex justify-content-between ">
        <div class="col-left">
            <form method="post" action="{{ route("user.admin.verification.bulkEdit") }}" class="filter-form filter-form-left d-flex justify-content-start">
                {{csrf_field()}}
                <select name="action" class="form-control">
                    <option value="">{{__(" Ações em Massa ")}}</option>
                    <option value="delete">{{__("Excluir")}}</option>
                </select>
                <button data-confirm="{{__("Você quer apagar?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Aplicar')}}</button>
            </form>
        </div>
        <div class="col-left">
            <form method="get" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                <select class="form-control" name="role">
                    <option value="">{{ __('-- Selecione --')}}</option>
                    @foreach($roles as $role)
                    <option value="{{$role->name}}" @if(Request()->role == $role->name) selected @endif >{{ucfirst($role->name)}}</option>
                    @endforeach
                </select>
                <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Pesquisar por nome')}}" class="form-control">
                <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Buscar Usuário')}}</button>
            </form>
        </div>
    </div>
    <div class="text-right">
        <div class="header-status-control">
            <a href="{{ route('user.admin.verification.index') }}">{{__("Todas Verificações")}}</a> -
            <a href="{{ route('user.admin.verification.index',['status'=>'pending']) }}">{{__("Pendentes")}}</a> -
            <a href="{{ route('user.admin.verification.index',['status'=>'approved'])  }}">{{__("Aprovados")}}</a>
        </div>
        <p><i>{{__('Encontrado :total items',['total'=>$rows->total()])}}</i></p>
    </div>
    <div class="panel">
        <div class="panel-body">
            <form action="" class="bravo-form-item">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="60px"><input type="checkbox" class="check-all"></th>
                                <th>{{__('Nome')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Telefone')}}</th>
                                <th>{{__('Função')}}</th>
                                <th class="date">{{ __('Data')}}</th>
                                <th class="status">{{__('Status')}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($rows->total() > 0)
                            @foreach($rows as $row)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{$row->id}}" class="check-item">
                                </td>
                                <td class="title">
                                    <a href="{{route('user.admin.verification.detail',['id'=>$row->id])}}">{{$row->getDisplayName()}}</a>
                                </td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone}}</td>
                                <td>
                                    echo e(ucfirst( $row->role_name ));
                                    @endphp
                                </td>
                                <td>{{ display_date($row->created_at)}}</td>
                                <td class="status">
                                    @php
                                    $rolesTranslated = [
                                    'completed' => 'Concluído',
                                    'pending' => 'Pendente',
                                    'rejected' => 'Rejeitado',
                                    'blocked' => 'Bloqueado',
                                    'new' => 'Pendente',
                                    ];
                                    echo e(ucfirst( $rolesTranslated[strtolower($row->verify_submit_status)] ?? $row->verify_submit_status ));
                                    @endphp
                                </td>
                                <td>
                                    @if($row->verify_submit_status == "completed")
                                    <a class="btn btn-sm btn-success" href="{{route('user.admin.verification.detail',['id'=>$row->id])}}">{{__('Ver verificação')}}</a>
                                    @else
                                    <a class="btn btn-sm btn-warning" href="{{route('user.admin.verification.detail',['id'=>$row->id])}}">{{__('Ver solicitação')}}</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8">{{__("Sem dados")}}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
            {{$rows->appends(request()->query())->links()}}
        </div>
    </div>
</div>
@endsection