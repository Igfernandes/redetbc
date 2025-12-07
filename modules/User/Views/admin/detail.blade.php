@extends('admin.layouts.app')

@section('content')
<form action="{{ route('user.admin.store', ['id' => $row->id ?? -1]) }}" method="post" class="needs-validation" novalidate>
    @csrf
    <div class="container">

        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">
                {{ isset($row->id) ? 'Edit: '.$row->getDisplayName() : 'Add new user' }}
            </h1>
        </div>

        @include('admin.message')

        <div class="row">
            <div class="col-md-9">
                <div class="panel">
                    <div class="panel-title"><strong>{{ __('Informações do Usuário') }}</strong></div>

                    <div class="panel-body">

                        <div class="row">
                            <!-- Razão Social -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Razão Social") }}</label>
                                    <input type="text" required name="business_name"
                                           value="{{ old('business_name', $row->business_name ?? '') }}"
                                           placeholder="{{ __('Razão Social') }}" class="form-control">
                                </div>
                            </div>

                            <!-- E-mail -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('E-mail') }}</label>
                                    <input type="email" required name="email"
                                           value="{{ old('email', $row->email ?? '') }}"
                                           placeholder="{{ __('E-mail') }}" class="form-control">
                                </div>
                            </div>

                            <!-- Nome de Acesso -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Nome de Acesso") }}</label>
                                    <input type="text" required name="user_name"
                                           value="{{ old('user_name', $row->user_name ?? '') }}"
                                           placeholder="{{ __("Nome de Acesso") }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <!-- Primeiro Nome -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Primeiro Nome") }}</label>
                                    <input type="text" required name="first_name"
                                           value="{{ old('first_name', $row->first_name ?? '') }}"
                                           placeholder="{{ __("Primeiro Nome") }}" class="form-control">
                                </div>
                            </div>

                            <!-- Sobrenome -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Sobrenome") }}</label>
                                    <input type="text" required name="last_name"
                                           value="{{ old('last_name', $row->last_name ?? '') }}"
                                           placeholder="{{ __("Sobrenome") }}" class="form-control">
                                </div>
                            </div>

                            <!-- Religião -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Religião") }}</label>
                                    <select name="religion" class="form-control">
                                        <option value="">{{ __("Selecione a religião") }}</option>
                                        @foreach(['CATHOLIC' => 'Católico', 'EVANGELICAL' => 'Evangélico', 'BOTH' => 'Ambos'] as $key => $label)
                                            <option value="{{ $key }}" {{ old('religion', $row->religion ?? '') == $key ? 'selected' : '' }}>
                                                {{ __($label) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Sexo -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Sexo") }}</label>
                                    <select name="sex" class="form-control">
                                        <option value="">{{ __("Selecione o sexo") }}</option>
                                        <option value="MASCULINE" {{ old('sex', $row->sex ?? '') == 'MASCULINE' ? 'selected' : '' }}>
                                            {{ __('Masculino') }}
                                        </option>
                                        <option value="FEMININE" {{ old('sex', $row->sex ?? '') == 'FEMININE' ? 'selected' : '' }}>
                                            {{ __('Feminino') }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Telefone -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Telefone') }}</label>
                                    <input type="text" required name="phone"
                                           value="{{ old('phone', $row->phone ?? '') }}"
                                           placeholder="{{ __('Telefone') }}" class="form-control">
                                </div>
                            </div>

                            <!-- Aniversário -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Aniversário') }}</label>
                                    <input type="text" name="birthday"
                                           value="{{ old('birthday', isset($row->birthday) ? date('Y/m/d', strtotime($row->birthday)) : '') }}"
                                           placeholder="{{ __('Aniversário') }}"
                                           class="form-control has-datepicker input-group date">
                                </div>
                            </div>

                            <!-- Endereços -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Endereço 1') }}</label>
                                    <input type="text" name="address" class="form-control"
                                           value="{{ old('address', $row->address ?? '') }}"
                                           placeholder="{{ __('Endereço 1') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Endereço 2') }}</label>
                                    <input type="text" name="address2" class="form-control"
                                           value="{{ old('address2', $row->address2 ?? '') }}"
                                           placeholder="{{ __('Endereço 2') }}">
                                </div>
                            </div>

                            <!-- Cidade / Estado -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Cidade") }}</label>
                                    <input type="text" name="city" class="form-control"
                                           value="{{ old('city', $row->city ?? '') }}" placeholder="{{ __("Cidade") }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("Estado") }}</label>
                                    <input type="text" name="state" class="form-control"
                                           value="{{ old('state', $row->state ?? '') }}" placeholder="{{ __("Estado") }}">
                                </div>
                            </div>

                            <!-- País -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("País") }}</label>
                                    <select name="country" required class="form-control">
                                        <option value="">{{ __('-- Selecione --') }}</option>
                                        @foreach(get_country_lists() as $id => $name)
                                            <option value="{{ $id }}" {{ old('country', $row->country ?? '') == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- CEP -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __("CEP") }}</label>
                                    <input type="text" name="zip_code"
                                           value="{{ old('zip_code', $row->zip_code ?? '') }}"
                                           placeholder="{{ __("CEP") }}" class="form-control">
                                </div>
                            </div>

                        </div>

                        <!-- BIO -->
                        <div class="form-group">
                            <label class="control-label">{{ __('Biografia') }}</label>
                            <textarea name="bio" class="d-none has-ckeditor" cols="30" rows="10">
                                {{ old('bio', $row->bio ?? '') }}
                            </textarea>
                        </div>

                    </div>
                </div>
            </div>

            <!-- SIDEBAR -->
            <div class="col-md-3">

                <!-- Publicação -->
                <div class="panel">
                    <div class="panel-title"><strong>{{ __('Publicar') }}</strong></div>
                    <div class="panel-body">

                        <!-- Status -->
                        <div class="form-group">
                            <label>{{ __('Status') }}</label>
                            <select name="status" required class="custom-select">
                                <option value="publish" {{ old('status', $row->status ?? '') == 'publish' ? 'selected' : '' }}>
                                    {{ __('Publicado') }}
                                </option>
                                <option value="blocked" {{ old('status', $row->status ?? '') == 'blocked' ? 'selected' : '' }}>
                                    {{ __('Bloqueado') }}
                                </option>
                            </select>
                        </div>

                        @if(is_admin())
                            @if(empty($user_type) || $user_type != 'vendor')
                                <!-- Função -->
                                <div class="form-group">
                                    <label>{{ __('Função') }} <span class="text-danger">*</span></label>
                                    <select required name="role_id" class="form-control">
                                        <option value="">{{ __('-- Selecione --') }}</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ old('role_id', $row->role_id ?? '') == $role->id ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <!-- Email Verificado -->
                            <div class="form-group">
                                <label>{{ __('E-mail Verificado?') }}</label>
                                <select name="is_email_verified" class="form-control">
                                    <option value="0" {{ old('is_email_verified', $row->email_verified_at ? 1 : 0) == 0 ? 'selected' : '' }}>
                                        {{ __('Não') }}
                                    </option>
                                    <option value="1" {{ old('is_email_verified', $row->email_verified_at ? 1 : 0) == 1 ? 'selected' : '' }}>
                                        {{ __('Sim') }}
                                    </option>
                                </select>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Comissão -->
                <div class="panel">
                    <div class="panel-title"><strong>{{ __('Afiliado') }}</strong></div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>{{ __('Comissão por redes') }}</label>
                            <input type="number" name="commission_amount" class="form-control"
                                   value="{{ old('commission_amount', $row->commission_amount ?? '') }}">
                        </div>
                    </div>
                </div>

                <!-- Avatar -->
                <div class="panel">
                    <div class="panel-title"><strong>{{ __('Avatar') }}</strong></div>
                    <div class="panel-body">
                        <div class="form-group">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('avatar_id', old('avatar_id', $row->avatar_id ?? '')) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-between">
            <span></span>
            <button class="btn btn-primary" type="submit">{{ __('Salvar Alterações') }}</button>
        </div>

    </div>
</form>
@endsection
