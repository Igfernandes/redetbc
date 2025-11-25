@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center bravo-login-form-page bravo-login-page bc-two-tactor-authentication">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Confirmar Senha') }}</div>
                    <div class="card-body">
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar.') }}
                        </div>

                        @include('Layout::admin.message')

                        <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>
                                <div class="col-md-6">
                                    <input autocomplete="current-password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Confirmar') }}
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