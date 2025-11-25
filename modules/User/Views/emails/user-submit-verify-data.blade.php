@extends('Email::layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            <h1>{{__("Olá Administrador")}}</h1>

            <p>{{__('Um usuário enviou seus dados para verificação.')}}</p>
            <p>{{__('Nome: :name',['name'=>$user->business_name ? $user->business_name : $user->first_name])}}</p>

            <p>{{__('Você pode aprovar a solicitação aqui:')}} <a href="{{route('user.admin.verification.detail',['id'=>$user->id])}}">{{__('Visualizar solicitação')}}</a></p>

            <br>
            <p>{{__('Atenciosamente')}},<br>{{setting_item('site_title')}}</p>
        </div>
    </div>
@endsection