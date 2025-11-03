@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('Todos os envios de contato')}}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                <form method="post" action="{{route('contact.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
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
               <form method="get" action="{{route('contact.admin.index')}} " class="filter-form filter-form-right d-flex justify-content-end" role="search">
                    <input  type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Procurar...')}}" class="form-control">
                    <button class="btn-info btn btn-icon btn_search"  type="submit">{{__('Procurar')}}</button>
                </form>
            </div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="60px"><input type="checkbox" class="check-all"></th>
                                <th >{{ __('Nome')}}</th>
                                <th class="author">{{ __('Email')}} </th>
                                <th class="author">{{ __('Telefone')}} </th>
                                <th >{{ __('Conteudo')}} </th>
                                <th class="date">{{__('Data')}} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($rows->total() > 0)
                                @foreach($rows as $row)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}"></td>
                                        <td class="title">
                                            {{$row->name}}
                                        </td>
                                        <td class="author">{{$row->email ?? ''}} </td>
                                        <td class="author">{{$row->phone ?? ''}} </td>
                                        <td>{{$row->message}}</td>
                                        <td class="date">{{ display_datetime($row->updated_at)}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">{{__("Sem dados")}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
