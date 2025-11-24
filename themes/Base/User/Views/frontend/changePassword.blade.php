@extends('layouts.user')
@section('content')
    <h2 class="title-bar">
        {{__("Alterar senha")}}
    </h2>
    @include('admin.message')
    <form action="{{ route("user.change_password.update") }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{__("Senha Atual")}}</label>
                    <input type="password" required name="current-password" placeholder="{{__("Senha Atual")}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{__("Nova Senha")}}</label>
                    <input type="password" required name="new-password" minlength="8" placeholder="{{__("Nova Senha")}}" class="form-control">
                    <p><i>{{__("* Exige pelo menos uma letra maiúscula, uma letra minúscula, um número e um símbolo.")}}</i></p>
               </div>
                <div class="form-group">
                    <label>{{__("Confirmação de Senha")}}</label>
                    <input type="password" required name="new-password_confirmation" minlength="8" placeholder="{{__("Confirmação de Senha")}}" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <input type="submit" class="btn btn-primary" value="{{__("Alterar senha")}}">
                <a href="{{ route("user.profile.index") }}" class="btn btn-default">{{__("Cancelar")}}</a>
            </div>
        </div>
    </form>
@endsection
@push('js')

@endpush
