@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('Página')}}</h1>
            <div class="title-actions">
                <a href="{{route('user.admin.permission.create')}}" class="btn btn-primary">{{ __('Adicionar nova permissão')}}</a>
            </div>
        </div>
        @include('admin.message')
        <div class="panel">
            <div class="panel-title">{{ __('Todas Permissões')}}</div>
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="60px"><input type="checkbox" class="check-all"></th>
                        <th>{{ __('Nome')}}</th>
                        <th>{{ __('Data')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{$row->id}}"></td>
                            <td class="title">
                                <a href="{{route('user.admin.permission.detail',['id'=>$row->id])}}">{{$row->name}}</a>
                            </td>
                            <td>{{display_date($row->updated_at)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                {{$rows->links()}}
            </div>
        </div>
    </div>
@endsection
