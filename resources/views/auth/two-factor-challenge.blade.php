@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center bravo-login-form-page bravo-login-page">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Autenticação de Dois Fatores') }}</div>
                    <div class="card-body">

                        @include('Layout::admin.message')

                        <form method="POST" action="{{ url('two-factor-challenge') }}">
                        @csrf
                        @switch(request('type'))
                            @case("recovery_code")
                                <div class="mb-4 text-sm text-gray-600">
                                    {{ __('Por favor, confirme o acesso à sua conta inserindo um dos seus códigos de recuperação de emergência.') }}
                                </div>
                                <div class="form-group row">
                                    <label for="recovery_code" class="col-md-4 col-form-label text-md-right">{{ __('Código de Recuperação') }}</label>
                                    <div class="col-md-6">
                                        <input id="recovery_code" type="text" class="form-control{{ $errors->has('recovery_code') ? ' is-invalid' : '' }}" name="recovery_code"  required>
                                        @if ($errors->has('recovery_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('recovery_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @break
                            @default
                                <div class="mb-4 text-sm text-gray-600">
                                    {{ __('Por favor, confirme o acesso à sua conta inserindo o código de autenticação fornecido pelo seu aplicativo autenticador.') }}
                                </div>
                                <div class="form-group row">
                                    <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Código') }}</label>
                                    <div class="col-md-6">
                                        <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code"  required>
                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @break
                        @endswitch
                            <div class="flex justify-end mt-4">
                                <div class="form-group row mb-0">
                                    <div class="offset-md-4">
                                        @if(request('type') == 'recovery_code')
                                            <a href="{{route('two-factor.login')}}" class="btn btn-link">{{__('Usar um código de autenticação')}}</a>
                                        @else
                                            <a href="{{route('two-factor.login',['type'=>'recovery_code'])}}" class="btn btn-link">{{__('Usar um código de recuperação')}}</a>
                                        @endif
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Enviar') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection