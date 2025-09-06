@extends('layouts.user')

@section('content')
<h2 class="title-bar">
    {{__("Verification data")}}
</h2>
@include('admin.message')
<div class="booking-history-manager">
    <div class="text">
        <p class="text-justify">Para que possamos garantir a segurança das informações, a legitimidade dos usuários e o uso adequado de todos os recursos da plataforma, será necessário realizar um processo de verificação de identidade. Esse processo tem como objetivo confirmar que o cadastro está sendo feito por uma pessoa real e que os documentos apresentados são autênticos.</p>
    </div>
    @foreach($fields as $field)
    @switch($field['type'])
    @case("email")
    @include('User::frontend.verification.fields.email')
    @break
    @case("phone")
    @include('User::frontend.verification.fields.phone')
    @break 
    @case("upload-image")
    @include('User::frontend.verification.fields.upload-image')
    @break
    @case("file")
    @include('User::frontend.verification.fields.file')
    @break
    @case("multi_files")
    @include('User::frontend.verification.fields.multi_files')
    @break
    @case('text')
    @default
    @include('User::frontend.verification.fields.text')
    @break
    @endswitch
    @endforeach
    <hr>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <a href="{{route('user.verification.update')}}" class="btn btn-warning"> <i class="fa fa-edit"></i> &nbsp;&nbsp; {{__("Update verification data")}} </a>
        </div>
    </div>
</div>
@endsection