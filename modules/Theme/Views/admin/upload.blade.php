@extends('Layout::admin.app')
@section("content")
    <div class="container">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('Fazer Upload do Tema')}}</h1>
        </div>
        @include('admin.message')
        <form action="{{route('theme.admin.upload_post')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong>{{__("Selecionar arquivo do tema")}}</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label >{{__("Selecionar arquivo zip do tema:")}}</label>
                                    <div class="custom-file">
                                        <input type="file" name="file" accept="application/zip" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Escolher arquivo</label>
                                    </div>
                                    <p><i>{{__("O tamanho máximo do arquivo é: ")}}{{formatBytes(getMaximumFileUploadSize(),0)}}</i></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary">{{__('Fazer Upload Agora')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection