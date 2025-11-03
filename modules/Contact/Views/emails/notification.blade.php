@extends('Email::layout')
@section('content')

    <div class="b-container">
        <div class="b-panel">
            <h3 class="email-headline"><strong>{{__('Olá Administrador')}}</strong></h3>
            <p>{{__('Aqui estão as novas informações de contato:')}}</p>
            <br>
            <div class="b-panel">
                <div class="b-table-wrap">
                    <table class="b-table" cellspacing="0" cellpadding="0">
                        <tr class="info-first-name">
                            <td class="label">{{__('Nome')}}</td>
                            <td class="val">{{$contact->name}}</td>
                        </tr>
                        <tr class="info-first-name">
                            <td class="label">{{__('Email')}}</td>
                            <td class="val">{{$contact->email}}</td>
                        </tr>
                        <tr class="info-first-name">
                            <td class="label">{{__('Mensagem')}}</td>
                            <td class="val">{{$contact->message}}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
