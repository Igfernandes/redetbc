@extends('admin.layouts.app')

@section('content')
    <form action="{{route('user.admin.wallet.store',['id'=>$row->id])}}" method="post" >
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="d-flex justify-content-between mb20">
                        <div class="">
                            <h1 class="title-bar">{{__('Adicionar crédito para :name',['name'=>$row->display_name])}}</h1>
                        </div>
                    </div>
                    @include('admin.message')
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('Adicionar crédito')}}</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__("Saldo")}}</label>
                                        <input type="number" readonly value="{{$row->balance}}" step="0.1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__("Quantia de Crédito")}}</label>
                                        <input type="number" name="credit_amount" value="0" step="0.1" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary" type="submit">{{ __('Adicionar agora')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection