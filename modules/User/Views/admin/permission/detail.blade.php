@extends('admin.layouts.app')
@section('content')

    <form action="" method="post">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? 'Editar: '.$row->name : 'Adicionar nova permissão'}}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title">{{ __('Conteúdo da Permissão')}}</h3>
                            <div class="form-group">
                                <label>{{ __('Nome')}}</label>
                                <input type="text" value="{{$row->name}}" placeholder="{{ __('Nome')}}" name="name" class="form-control">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>&nbsp;</span>
                        <button class="btn btn-primary" type="submit">{{ __('Salvar Alterações')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection