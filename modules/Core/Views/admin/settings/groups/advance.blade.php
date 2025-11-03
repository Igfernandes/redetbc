@if(is_default_lang())
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Opções de pesquisa")}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{__("Pesquisar guia aberta")}}</label>
                        <div class="form-controls">
                            <select name="search_open_tab" class="form-control" >
                                <option value="current_tab" {{ setting_item('search_open_tab') == 'current_tab' ? 'selected' : ''  }}>{{__("Current Tab")}}</option>
                                <option value="new_tab" {{ setting_item('search_open_tab') == 'new_tab' ? 'selected' : ''  }}>{{__('Abra uma nova guia')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Unidade de tamanho quadrado")}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{__("Unidade de tamanho")}}</label>
                        <div class="form-controls">
                            <select name="size_unit" class="form-control" >
                                <option value="m2" {{ setting_item('size_unit') == 'm2' ? 'selected' : ''  }}>{{__("Metro quadrado (m2)")}}</option>
                                <option value="ft" {{setting_item('size_unit') == 'ft' ? 'selected' : ''  }}>{{__('Pés quadrados')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Provedor de mapas")}}</h3>
        <p class="form-group-desc">{{__('Alterar o provedor de mapas do seu site')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__("Provedor de mapas")}}</label>
                    <div class="form-controls">
                        <select name="map_provider" class="form-control" >
                            <option value="osm" {{ setting_item('map_provider') == 'osm' ? 'selected' : ''  }}>{{__("OpenStreetMap.org")}}</option>
                            <option value="gmap" {{setting_item('map_provider') == 'gmap' ? 'selected' : ''  }}>{{__('Mapa do Google')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" data-condition="map_provider:is(gmap)">
                    <label>{{__("Chave de API do Gmap")}}</label>
                    <div class="form-controls">
                        <input type="text" name="map_gmap_key" value="{{setting_item('map_gmap_key')}}" class="form-control">
                        <p><i><a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="blank">{{__("Aprenda como obter uma chave de API")}}</a></i></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-title"><strong>{{__('Opções de mapa padrão')}}</strong></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>{{__("Mapa Lat. Padrão")}}</label>
                        <div class="form-controls">
                            <input type="text" name="map_lat_default" value="{{setting_item('map_lat_default')}}" class="form-control" placeholder="21.030513">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>{{__("Mapa Lng Padrão")}}</label>
                        <div class="form-controls">
                            <input type="text" name="map_lng_default" value="{{setting_item('map_lng_default')}}" class="form-control" placeholder="105.840565">
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                       <i> {{ __('Obtenha lat - lng aqui') }} <a href="https://www.latlong.net" target="_blank">https://www.latlong.net</a></i>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label>{{__("Agrupamento de mapas")}}</label>
                    <div class="form-controls">
                        <select name="map_clustering" class="form-control" >
                            <option value="" {{ setting_item('map_clustering') == '' ? 'selected' : ''  }}>{{__("Desligado")}}</option>
                            <option value="on" {{setting_item('map_clustering') == 'on' ? 'selected' : ''  }}>{{__('Ligado')}}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label>{{__("Mapa fitBounds")}}</label>
                    <div class="form-controls">
                        <select name="map_fit_bounds" class="form-control" >
                            <option value="" {{ setting_item('map_fit_bounds') == '' ? 'selected' : ''  }}>{{__("Desligado")}}</option>
                            <option value="on" {{setting_item('map_fit_bounds') == 'on' ? 'selected' : ''  }}>{{__('Ligado')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Login Social")}}</h3>
        <p class="form-group-desc">{{__('Alterar informações de login social para seu site')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__('Facebook')}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label> <input type="checkbox" @if(setting_item('facebook_enable') == 1) checked @endif name="facebook_enable" value="1"> {{__("Ativar login no Facebook?")}}</label>
                </div>
                <div class="form-group" data-condition="facebook_enable:is(1)">
                    <label>{{__("ID do cliente do Facebook")}}</label>
                    <div class="form-controls">
                        <input type="text" name="facebook_client_id" value="{{setting_item('facebook_client_id')}}" class="form-control">
                    </div>
                </div>
                <div class="form-group" data-condition="facebook_enable:is(1)">
                    <label>{{__("Segredo do cliente do Facebook")}}</label>
                    <div class="form-controls">
                        <input type="text" name="facebook_client_secret" value="{{setting_item('facebook_client_secret')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-title"><strong>{{__('Google')}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label><input type="checkbox" @if(setting_item('google_enable') == 1) checked @endif name="google_enable" value="1"> {{__("Ativar login do Google?")}}</label>
                </div>
                <div class="form-group" data-condition="google_enable:is(1)">
                    <label>{{__("ID do cliente Google")}}</label>
                    <div class="form-controls">
                        <input type="text" name="google_client_id" value="{{setting_item('google_client_id')}}" class="form-control">
                    </div>
                </div>
                <div class="form-group" data-condition="google_enable:is(1)">
                    <label>{{__("Segredo do cliente Google")}}</label>
                    <div class="form-controls">
                        <input type="text" name="google_client_secret" value="{{setting_item('google_client_secret')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-title"><strong>{{__('Twitter')}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label> <input type="checkbox" @if(setting_item('twitter_enable') == 1) checked @endif name="twitter_enable" value="1"> {{__("Ativar login no Twitter?")}}</label>
                </div>
                <div class="form-group" data-condition="twitter_enable:is(1)">
                    <label>{{__("ID do cliente do Twitter")}}</label>
                    <div class="form-controls">
                        <input type="text" name="twitter_client_id" value="{{setting_item('twitter_client_id')}}" class="form-control">
                    </div>
                </div>
                <div class="form-group" data-condition="twitter_enable:is(1)">
                    <label>{{__("Segredo do cliente do Twitter")}}</label>
                    <div class="form-controls">
                        <input type="text" name="twitter_client_secret" value="{{setting_item('twitter_client_secret')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Captcha")}}</h3>
        <p class="form-group-desc">{{__('Alterar o provedor de mapas do seu site')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Configuração do ReCaptcha")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="form-controls">
                        <label ><input type="checkbox" @if(setting_item('recaptcha_enable') == 1) checked @endif name="recaptcha_enable" value="1"> {{__("Habilitar ReCaptcha")}}</label>
                    </div>
                </div>
                <div class="form-group" data-condition="recaptcha_enable:is(1)">
                    <label>{{__("Versão")}}</label>
                    <div class="form-controls">
                        <select name="recaptcha_version" id="recaptcha_version" class="form-control">
                            <option value="">{{ __("Versão 2") }}</option>
                            <option @if(setting_item('recaptcha_version') =='v3' ) selected @endif value="v3">{{ __("Versão 3") }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" data-condition="recaptcha_enable:is(1)">
                    <label>{{__("Chave de API")}}</label>
                    <div class="form-controls">
                        <input type="text" name="recaptcha_api_key" value="{{setting_item('recaptcha_api_key')}}" class="form-control">
                        <p><i><a href="http://www.google.com/recaptcha/admin" target="blank">{{__("Aprenda como obter uma chave de API")}}</a></i></p>
                    </div>
                </div>
                <div class="form-group" data-condition="recaptcha_enable:is(1)">
                    <label>{{__("Segredo da API")}}</label>
                    <div class="form-controls">
                        <input type="text" name="recaptcha_api_secret" value="{{setting_item('recaptcha_api_secret')}}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Scripts personalizados para todos os idiomas")}}</h3>
        <p class="form-group-desc">{{__('Adicione um script HTML personalizado antes e depois do conteúdo, como um código de rastreamento')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Scripts personalizados")}}</strong></div>
            <div class="panel-body">
                <div class="form-group" >
                    <label>{{__("Script principal")}}</label>
                    <div class="form-controls">
                        <textarea name="head_scripts"  cols="30" rows="10" class="form-control">{{setting_item('head_scripts')}}</textarea>
                        <p><i>{{__('scripts antes de fechar a tag head')}}</i></p>
                    </div>
                </div>
                <div class="form-group" >
                    <label>{{__("Script Corporal")}}</label>
                    <div class="form-controls">
                        <textarea name="body_scripts"  cols="30" rows="10" class="form-control">{{setting_item('body_scripts')}}</textarea>
                        <p><i>{{__('scripts após a abertura da tag body')}}</i></p>
                    </div>
                </div>
                <div class="form-group" >
                    <label>{{__("Script de rodapé")}}</label>
                    <div class="form-controls">
                        <textarea name="footer_scripts"  cols="30" rows="10" class="form-control">{{setting_item('footer_scripts')}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Scripts personalizados para :name",['name'=>request()->query('lang')])}}</h3>
        <p class="form-group-desc">{{__('Adicione um script HTML personalizado antes e depois do conteúdo, como um código de rastreamento')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Scripts personalizados")}}</strong></div>
            <div class="panel-body">
                <div class="form-group" >
                    <label>{{__("Script principal")}}</label>
                    <div class="form-controls">
                        <textarea name="head_scripts"  cols="30" rows="10" class="form-control">{{setting_item_with_lang_raw('head_scripts',request()->get('lang'))}}</textarea>
                        <p><i>{{__('scripts antes de fechar a tag head')}}</i></p>
                    </div>
                </div>
                <div class="form-group" >
                    <label>{{__("Script Corporal")}}</label>
                    <div class="form-controls">
                        <textarea name="body_scripts"  cols="30" rows="10" class="form-control">{{setting_item_with_lang_raw('body_scripts',request()->get('lang'))}}</textarea>
                        <p><i>{{__('scripts após a abertura da tag body')}}</i></p>
                    </div>
                </div>
                <div class="form-group" >
                    <label>{{__("Script de rodapé")}}</label>
                    <div class="form-controls">
                        <textarea name="footer_scripts"  cols="30" rows="10" class="form-control">{{setting_item_with_lang_raw('footer_scripts',request()->get('lang'))}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Acordo de cookies")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Configuração do acordo de cookies")}}</strong></div>
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <div class="form-controls">
                            <label ><input type="checkbox" @if(setting_item('cookie_agreement_enable') ?? '' == 1) checked @endif name="cookie_agreement_enable" value="1"> {{__("Ativar contrato de cookies")}}</label>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <div class="form-controls">
                            <label ><input type="checkbox" @if(setting_item('cookie_agreement_enable') ?? '' == 1) checked @endif name="cookie_agreement_enable" disabled value="1"> {{__("Ativar contrato de cookies")}}</label>
                        </div>
                    </div>
                    @if(setting_item('cookie_agreement_enable') != 1)
                        <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                    @endif
                @endif


                <div class="form-group" data-condition="cookie_agreement_enable:is(1)">
                    <label>{{__("Botão Concordar Texto")}}</label>
                    <div class="form-controls">
                        <input type="text" name="cookie_agreement_button_text" value="{{setting_item_with_lang('cookie_agreement_button_text',request()->query('lang')) ?? ''}}" class="form-control">

                    </div>
                </div>
                <div class="form-group" data-condition="cookie_agreement_enable:is(1)">
                    <label>{{__("Contente")}}</label>
                    <div class="form-controls">
                        <textarea name="cookie_agreement_content" rows="8" class="form-control d-none has-ckeditor">{{setting_item_with_lang('cookie_agreement_content',request()->query('lang')) ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@include('Core::admin.settings.groups.parts.cookie-consent-setting')
@include('Core::admin.settings.groups.parts.pusher')
