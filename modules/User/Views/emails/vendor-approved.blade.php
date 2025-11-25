@extends('Email::layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            <h1>{{__("Olá :name",['name'=>$user->first_name])}}</h1>

            <p>{{__('Você está recebendo este e-mail porque aprovamos sua solicitação de registro de fornecedor.')}}</p>
            <p>{{__('Você pode verificar seu painel aqui:')}} <a href="{{url('user/dashboard')}}">{{__('Ver painel')}}</a></p>

            <br>
            <p>{{__('Saudações')}},<br>{{setting_item('site_title')}}</p>
        </div>
    </div>
@endsection