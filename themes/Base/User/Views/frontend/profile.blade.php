@extends('layouts.user')
@section('content')
<h2 class="title-bar">
    {{__("Configurações")}}
    <a href="{{route('user.change_password')}}" class="btn-change-password">{{__("Alterar senha")}}</a>
</h2>
@include('admin.message')
<form action="{{route('user.profile.update')}}" method="post" class="input-has-icon">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-title">
                <strong>{{__("Informações Pessoais")}}</strong>
            </div>
            @if($is_vendor_access)
            <div class="form-group">
                <label>{{__("Razão Social")}}</label>
                <input type="text" value="{{old('business_name',$dataUser->business_name)}}" name="business_name" placeholder="{{__("Razão Social")}}" class="form-control">
                <i class="fa fa-user input-icon"></i>
            </div>
            @endif
            <div class="form-group">
                <label>{{__("Nome de Acesso")}} <span class="text-danger">*</span></label>
                <input type="text" required minlength="4" name="user_name" value="{{old('user_name',$dataUser->user_name)}}" placeholder="{{__("Nome de Acesso")}}" class="form-control">
                <i class="fa fa-user input-icon"></i>
            </div>
            <div class="form-group">
                <label>{{__("E-mail")}}</label>
                <input type="text" name="email" value="{{old('email',$dataUser->email)}}" placeholder="{{__("E-mail")}}" class="form-control">
                <i class="fa fa-envelope input-icon"></i>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__("Primeiro Nome")}}</label>
                        <input type="text" value="{{old('first_name',$dataUser->first_name)}}" name="first_name" placeholder="{{__("Primeiro Nome")}}" class="form-control">
                        <i class="fa fa-user input-icon"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__("Sobrenome")}}</label>
                        <input type="text" value="{{old('last_name',$dataUser->last_name)}}" name="last_name" placeholder="{{__("Sobrenome")}}" class="form-control">
                        <i class="fa fa-user input-icon"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __("Estado Civil") }}</label>
                <select name="civil_status" class="form-control">
                    <option value="">{{ __("Selecione") }}</option>
                    <option value="SINGLE" {{ old('civil_status', $dataUser->civil_status ?? '') == 'SINGLE' ? 'selected' : '' }}>
                        {{ __("Solteiro") }}
                    </option>
                    <option value="MARRIED" {{ old('civil_status', $dataUser->civil_status ?? '') == 'MARRIED' ? 'selected' : '' }}>
                        {{ __("espaçodo") }}
                    </option>
                </select>
                <i class="fa fa-church input-icon"></i>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>{{__("Nome do Conjugue")}}</label>
                        <input type="text" value="{{old('conjugue_name',$dataUser->conjugue_name)}}" name="conjugue_name" placeholder="{{__("Nome do Conjugue")}}" class="form-control">
                        <i class="fa fa-user input-icon"></i>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>{{__("Telefone do Conjugue")}}</label>
                        <input type="text" value="{{old('conjugue_phone',$dataUser->conjugue_phone)}}" name="conjugue_phone" placeholder="{{__("Telefone do Conjugue")}}" class="form-control">
                        <i class="fa fa-phone input-icon"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __("Religião") }}</label>
                        <select name="religion" class="form-control">
                            <option value="">{{ __("Selecione a religião") }}</option>
                            <option value="CATHOLIC" {{ old('religion', $dataUser->religion ?? '') == 'CATHOLIC' ? 'selected' : '' }}>
                                {{ __("Católico") }}
                            </option>
                            <option value="EVANGELICAL" {{ old('religion', $dataUser->religion ?? '') == 'EVANGELICAL' ? 'selected' : '' }}>
                                {{ __("Evangélico") }}
                            </option>
                            <option value="BOTH" {{ old('religion', $dataUser->religion ?? '') == 'BOTH' ? 'selected' : '' }}>
                                {{ __("Ambos") }}
                            </option>
                        </select>
                        <i class="fa fa-church input-icon"></i>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __("Sexo") }}</label>
                        <select name="sex" class="form-control">
                            <option value="">{{ __("Selecione o sexo") }}</option>
                            <option value="MASCULINE" {{ old('sex', $dataUser->sex ?? '') == 'MASCULINE' ? 'selected' : '' }}>
                                {{ __("Masculino") }}
                            </option>
                            <option value="FEMININE" {{ old('sex', $dataUser->sex ?? '') == 'FEMININE' ? 'selected' : '' }}>
                                {{ __("Feminino") }}
                            </option>
                        </select>
                        <i class="fa fa-venus-mars input-icon"></i>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label>{{__("Celular")}}</label>
                <input type="text" value="{{old('phone',$dataUser->phone)}}" name="phone" placeholder="{{__("Celular")}}" class="form-control">
                <i class="fa fa-phone input-icon"></i>
            </div>
            <div class="form-group">
                <label>{{__("Data de Nascimento")}}</label>
                <input type="text" value="{{ old('birthday',$dataUser->birthday? display_date($dataUser->birthday) :'') }}" name="birthday" placeholder="{{__("Data de Nascimento")}}" class="form-control date-picker">
                <i class="fa fa-birthday-cake input-icon"></i>
            </div>
            <div class="form-group">
                <label>{{__("Sobre Você")}}</label>
                <textarea name="bio" rows="5" class="form-control">{{old('bio',$dataUser->bio)}}</textarea>
            </div>
            <div class="form-group">
                <label>{{__("Avatar")}}</label>
                <div class="upload-btn-wrapper">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                {{__("Procurar")}}… <input type="file">
                            </span>
                        </span>
                        <input type="text" data-error="{{__("Erro no upload...")}}" data-loading="{{__("Carregando...")}}" class="form-control text-view" readonly value="{{ get_file_url( old('avatar_id',$dataUser->avatar_id) ) ?? $dataUser->getAvatarUrl()?? __("Sem Imagem")}}">
                    </div>
                    <input type="hidden" class="form-control" name="avatar_id" value="{{ old('avatar_id',$dataUser->avatar_id)?? ""}}">
                    <img class="image-demo" src="{{ get_file_url( old('avatar_id',$dataUser->avatar_id) ) ??  $dataUser->getAvatarUrl() ?? ""}}" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-title">
                <strong>{{__("Informações Localização")}}</strong>
            </div>
            <div class="form-group">
                <label>{{__("Endereço 1")}}</label>
                <input type="text" value="{{old('address',$dataUser->address)}}" name="address" placeholder="{{__("Endereço")}}" class="form-control">
                <i class="fa fa-location-arrow input-icon"></i>
            </div>
            <div class="form-group">
                <label>{{__("Endereço 2")}}</label>
                <input type="text" value="{{old('address2',$dataUser->address2)}}" name="address2" placeholder="{{__("Endereço2")}}" class="form-control">
                <i class="fa fa-location-arrow input-icon"></i>
            </div>
            <div class="form-group">
                <label>{{__("Cidade")}}</label>
                <input type="text" value="{{old('city',$dataUser->city)}}" name="city" placeholder="{{__("Cidade")}}" class="form-control">
                <i class="fa fa-street-view input-icon"></i>
            </div>
            <div class="form-group">
                <label>{{__("Estado")}}</label>
                <input type="text" value="{{old('state',$dataUser->state)}}" name="state" placeholder="{{__("Estado")}}" class="form-control">
                <i class="fa fa-map-signs input-icon"></i>
            </div>
            <div class="form-group">
                <label>{{__("País")}}</label>
                <select name="country" class="form-control">
                    <option value="">{{__('-- Selecione --')}}</option>
                    @foreach(get_country_lists() as $id=>$name)
                    <option @if((old('country',$dataUser->country ?? '')) == $id) selected @endif value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>{{__("CEP")}}</label>
                <input type="text" value="{{old('zip_code',$dataUser->zip_code)}}" name="zip_code" placeholder="{{__("CEP")}}" class="form-control">
                <i class="fa fa-map-pin input-icon"></i>
            </div>

        </div>
        <div class="col-md-12">
            <hr>
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Salvar alterações')}}</button>
        </div>
    </div>
</form>
@if(!empty(setting_item('user_enable_permanently_delete')) and !is_admin())
<hr>
<div class="row">
    <div class="col-md-12">
        <h4 class="text-danger">
            {{__("Excluir conta")}}
        </h4>
        <div class="mb-4 mt-2">
            {!! clean(setting_item_with_lang('user_permanently_delete_content','',__('Sua conta será permanentemente excluída. Depois de excluir sua conta, não há como voltar atrás. Por favor, tenha certeza.'))) !!}
        </div>
        <a data-toggle="modal" data-target="#permanentlyDeleteAccount" class="btn btn-danger" href="">{{__('Excluir sua conta')}}</a>
    </div>

    <div class="modal  fade" id="permanentlyDeleteAccount" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Confirmar exclusão permanente da conta')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="my-3">
                        {!! clean(setting_item_with_lang('user_permanently_delete_content_confirm')) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Fechar')}}</button>
                    <a href="{{route('user.permanently.delete')}}" class="btn btn-danger">{{__('Confirmar')}}</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endif

@endsection