@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center bravo-login-form-page bravo-login-page">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique seu endereço de e-mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link de verificação foi enviado para o seu endereço de e-mail.') }}
                        </div>
                    @endif

                    <p>
                        {{ __('Antes de continuar, por favor verifique seu e-mail para acessar o link de verificação.') }}
                        {{ __('Se você não recebeu o e-mail') }},
                    </p>

                    <form action="{{ route('verification.send') }}" method="post">
                        @csrf
                        <button class="btn btn-primary" type="submit">
                            {{ __('clique aqui para solicitar outro') }}.
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
