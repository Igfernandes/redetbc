@extends('Email::layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            <h1>{{__("Olá :name",['name'=>$user->business_name ? $user->business_name : $user->first_name])}}</h1>

            <p>{{__('Você está recebendo este e-mail porque atualizamos seus dados de verificação de fornecedor.')}}</p>
            <ul>
                @if(!empty($user->verification_fields))
                    @foreach($user->verification_fields as $field)
                        <li>
                            <strong>{{$field['name']}}:</strong>
                            <i>@if(!empty($field['is_verified'])) {{__("Verificado")}} @else {{__("Não verificado")}} @endif</i>
                        </li>
                    @endforeach
                @endif
            </ul>
            <p>{{__('Você pode verificar suas informações aqui:')}} <a href="{{route('user.verification.index')}}">{{__('Ver dados de verificação')}}</a></p>

            <br>
            <p>{{__('Atenciosamente')}},<br>{{setting_item('site_title')}}</p>
        </div>
    </div>
@endsection