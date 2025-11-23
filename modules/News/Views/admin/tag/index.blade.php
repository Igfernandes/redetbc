@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('Notícias Tags')}} </h1>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-title">{{ __('Add Tag')}}</div>
                    <div class="panel-body">
                        <form action="{{route('news.admin.tag.store',['id'=>-1])}}" method="post">
                            @csrf
                            @include('News::admin/tag/form',['parents'=>$rows])
                            <div class="">
                                <button class="btn btn-primary" type="submit"> {{ __('Add new')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        @if(!empty($rows))
                            <form method="post" action="{{route('news.admin.tag.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                                {{csrf_field()}}
                                <select name="action" class="form-control">
                                    <option value="">{{__("Ação em massa")}}</option>
                                    <option value="delete">{{__("Excluir")}}</option>
                                </select>
                                <button data-confirm="{{__("Você quer apagar?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Aplicar')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-left">
                        <form method="get" action="{{route('news.admin.tag.index')}} " class="filter-form filter-form-right d-flex justify-content-end" role="search">
                            @csrf
                            <input placeholder="{{__("Procurar keyword ...")}}" type="text" name="s" value="{{ Request()->s }}" class="form-control">
                            <button class="btn-info btn btn-icon btn_search" id="search-submit" type="submit">{{__('Search Tag')}}</button>
                        </form>
                    </div>
                </div>
                <div class="text-right">
                    <p><i>{{__('Encontrado :total items',['total'=>$rows->total()])}}</i></p>
                </div>
                <div class="panel">
                    <form action="" class="bravo-form-item">
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th>{{ __('Nome')}}</th>
                                    <th>{{ __('Slug')}}</th>
                                    <th>{{ __('Data')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($rows->total() > 0)
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}">
                                            </td>
                                            <td class="title">
                                                <a href="{{route('news.admin.tag.edit',['id'=>$row->id])}}">{{ $row->name}}</a>
                                            </td>
                                            <td>{{ $row->slug}}</td>
                                            <td>{{ display_date($row->updated_at)}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">{{__("Sem dados")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
