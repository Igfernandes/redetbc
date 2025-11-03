@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('Gerenciamento de cardápio')}}</h1>
            <div class="title-actions">
                <a href="{{route('core.admin.menu.create')}}" class="btn btn-primary">{{__("Adicionar novo")}}</a>
            </div>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                    <form method="post" action="{{route('core.admin.menu.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Ações em massa ")}}</option>
                            <option value="delete">{{__("Excluir")}}</option>
                        </select>
                        <button data-confirm="{{__("Você quer apagar?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Aplicar')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">

            </div>
        </div>
        <div class="panel">
            <div class="panel-title">{{__('Todos os menus')}}</div>
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="60px"><input type="checkbox" class="check-all"></th>
                            <th>{{__('Título')}}</th>
                            <th>{{__("Usar para")}}</th>
                            <th>{{__('Data')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                </td>
                                <td>
                                    <a href="{{route('core.admin.menu.edit',['id'=>$row->id])}}">{{$row->name}}</a>
                                </td>
                                <td>
                                    @foreach($menu_locations as $l=>$menu_id)
                                        @if($menu_id == $row->id and isset($locations[$l]))
                                            {{$locations[$l]}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$row->updated_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$rows->links()}}
                </form>
            </div>
        </div>
    </div>
@endsection
