<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Pesquisa de página")}}</h3>
        <p class="form-group-desc">{{__('Página de configuração de pesquisa do seu site')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Opções Gerais")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="" >{{__("Página de título")}}</label>
                    <div class="form-controls">
                        <input type="text" name="event_page_search_title" value="{{setting_item_with_lang('event_page_search_title',request()->query('lang'))}}" class="form-control">
                    </div>
                </div>
                @if(is_default_lang())
                    <div class="form-group">
                        <label class="" >{{__("Página de banner")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('event_page_search_banner',$settings['event_page_search_banner'] ?? "") !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Pesquisa de layout")}}</label>
                        <div class="form-controls">
                            <select name="event_layout_search" class="form-control" >
                                @foreach(config('event.layouts',['normal'=>__("Layout normal"),'map'=>__("Layout do mapa")]) as $id=>$name))
                                    <option value="{{$id}}" {{ setting_item('event_layout_search','normal') == $id ? 'selected' : ''  }}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" >{{__("Estilo de pesquisa de localização")}}</label>
                                <div class="form-controls">
                                    <select name="event_location_search_style" class="form-control">
                                        <option {{ ($settings['event_location_search_style'] ?? '') == 'normal' ? 'selected' : ''  }}      value="normal">{{__("Normal")}}</option>
                                        <option {{ ($settings['event_location_search_style'] ?? '') == 'autocomplete' ? 'selected' : '' }} value="autocomplete">{{__('Preenchimento automático de locais')}}</option>
                                        <option {{ ($settings['event_location_search_style'] ?? '') == 'autocompletePlace' ? 'selected' : '' }} value="autocompletePlace">{{__('Preenchimento automático do Gmap Place')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" >{{__("Limitar item por página")}}</label>
                                <div class="form-controls">
                                    <input type="number" min="1" name="event_page_limit_item" placeholder="{{ __("Default: 9") }}" value="{{setting_item_with_lang('event_page_limit_item',request()->query('lang'), 9)}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" data-condition="event_location_search_style:is(autocompletePlace)">
                            <label class="" >{{__("Opções de raio")}}</label>
                            <div class="input-group mb-3">
                                <input type="number" name="event_location_radius_value" min="0" value="{{ setting_item('event_location_radius_value',1)}}" class="form-control" >
                                <div class="input-group-append">
                                    <select name="event_location_radius_type" id="">
                                        <option  {{ (setting_item('event_location_radius_type') ?? '') == 3959 ? 'selected' : ''  }} value="3959">{{__('Milhas')}}</option>
                                        <option  {{ (setting_item('event_location_radius_type') ?? '') == 6371 ? 'selected' : ''  }} value="6371">{{__('Km')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Opção de mapa de layout")}}</label>
                        <div class="form-controls">
                            <select name="event_layout_map_option" class="form-control">
                                <option {{ (setting_item_with_lang('event_layout_map_option',request()->query('lang')) ?? '') == 'map_left' ? 'selected' : '' }} value="map_left">{{__('Mapa à esquerda')}}</option>
                                <option {{ (setting_item_with_lang('event_layout_map_option',request()->query('lang')) ?? '') == 'map_right' ? 'selected' : ''  }} value="map_right">{{__("Mapa à direita")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>{{__("Mapa Lat. Padrão")}}</label>
                            <div class="form-controls">
                                <input type="text" name="event_map_lat_default" value="{{$settings['event_map_lat_default'] ?? ''}}" class="form-control" placeholder="21.030513">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{__("Mapa Lng Padrão")}}</label>
                            <div class="form-controls">
                                <input type="text" name="event_map_lng_default" value="{{$settings['event_map_lng_default'] ?? ''}}" class="form-control" placeholder="105.840565">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{__("Padrão de zoom do mapa")}}</label>
                            <div class="form-controls">
                                <input type="text" name="event_map_zoom_default" value="{{$settings['event_map_zoom_default'] ?? ''}}" class="form-control" placeholder="13">
                            </div>
                        </div>
                        <div class="col-md-12 mt-1">
                            <i> {{ __('Obtenha lat - lng aqui') }} <a href="https://www.latlong.net" target="_blank">https://www.latlong.net</a></i>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label class="" >{{__("Marcador de ícone no mapa")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('event_icon_marker_map',$settings['event_icon_marker_map'] ?? "") !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @include('Event::admin.settings.form-search')
        @include('Event::admin.settings.map-search')
        <div class="panel">
            <div class="panel-title"><strong>{{__("Opções de SEO")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#seo_1">{{__("Opções Gerais")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_2">{{__("Compartilhar Facebook")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_3">{{__("Compartilhar Twitter")}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" >
                        <div class="tab-pane active" id="seo_1">
                            <div class="form-group" >
                                <label class="control-label">{{__("Título SEO")}}</label>
                                <input type="text" name="event_page_list_seo_title" class="form-control" placeholder="{{__("Insira o título...")}}" value="{{ setting_item_with_lang('event_page_list_seo_title',request()->query('lang'))}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{__("Descrição de SEO")}}</label>
                                <input type="text" name="event_page_list_seo_desc" class="form-control" placeholder="{{__("Insira a descrição...")}}" value="{{setting_item_with_lang('event_page_list_seo_desc',request()->query('lang'))}}">
                            </div>
                            @if(is_default_lang())
                                <div class="form-group form-group-image">
                                    <label class="control-label">{{__("Imagem em destaque")}}</label>
                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('event_page_list_seo_image', $settings['event_page_list_seo_image'] ?? "" ) !!}
                                </div>
                            @endif
                        </div>
                        @php
                            $seo_share = json_decode(setting_item_with_lang('event_page_list_seo_share',request()->query('lang'),'[]'),true);
                        @endphp
                        <div class="tab-pane" id="seo_2">
                            <div class="form-group">
                                <label class="control-label">{{__("Título do Facebook")}}</label>
                                <input type="text" name="event_page_list_seo_share[facebook][title]" class="form-control" placeholder="{{__("Insira o título...")}}" value="{{$seo_share['facebook']['title'] ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{__("Descrição do Facebook")}}</label>
                                <input type="text" name="event_page_list_seo_share[facebook][desc]" class="form-control" placeholder="{{__("Insira a descrição...")}}" value="{{$seo_share['facebook']['desc'] ?? "" }}">
                            </div>
                            @if(is_default_lang())
                                <div class="form-group form-group-image">
                                    <label class="control-label">{{__("Imagem do Facebook")}}</label>
                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('event_page_list_seo_share[facebook][image]',$seo_share['facebook']['image'] ?? "" ) !!}
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane" id="seo_3">
                            <div class="form-group">
                                <label class="control-label">{{__("Título do Twitter")}}</label>
                                <input type="text" name="event_page_list_seo_share[twitter][title]" class="form-control" placeholder="{{__("Insira o título...")}}" value="{{$seo_share['twitter']['title'] ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{__("Descrição do Twitter")}}</label>
                                <input type="text" name="event_page_list_seo_share[twitter][desc]" class="form-control" placeholder="{{__("Insira a descrição...")}}" value="{{$seo_share['twitter']['title'] ?? "" }}">
                            </div>
                            @if(is_default_lang())
                                <div class="form-group form-group-image">
                                    <label class="control-label">{{__("Imagem do Twitter")}}</label>
                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('event_page_list_seo_share[twitter][image]', $seo_share['twitter']['image'] ?? "" ) !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(is_default_lang())
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Opções de revisão")}}</h3>
            <p class="form-group-desc">{{__('Revisão de configuração para evento')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("Habilitar sistema de revisão para eventos?")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="event_enable_review" value="1" @if(!empty($settings['event_enable_review'])) checked @endif /> {{__("Sim, por favor, habilite-o")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("Ative o modo de revisão de eventos")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="event_enable_review:is(1)">
                        <label class="" >{{__("O cliente deve reservar um evento antes de escrever uma avaliação?")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="event_enable_review_after_booking" value="1"  @if(!empty($settings['event_enable_review_after_booking'])) checked @endif /> {{__("Sim, por favor")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("LIGADO: Publique uma avaliação somente após a reserva - Desativado: Publique uma avaliação sem reservar")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="event_enable_review:is(1),event_enable_review_after_booking:is(1)">
                        <label>{{__("Permitir revisão após concluir a reserva?")}}</label>
                        <div class="form-controls">
                            @php
                                $status = config('booking.statuses');
                                $settings_status = !empty($settings['event_allow_review_after_making_completed_booking']) ? json_decode($settings['event_allow_review_after_making_completed_booking']) : [];
                            @endphp
                            <div class="row">
                                @foreach($status as $item)
                                    <div class="col-md-4">
                                        <label><input type="checkbox" name="event_allow_review_after_making_completed_booking[]" @if(in_array($item,$settings_status)) checked @endif value="{{$item}}"  /> {{booking_status_to_text($item)}} </label>
                                    </div>
                                @endforeach
                            </div>
                            <small class="form-text text-muted">{{__("Selecione o Status da Reserva, que permite avaliações após a reserva")}}</small>
                            <small class="form-text text-muted">{{__("Deixe em branco se você permitir escrever a avaliação com todos os status da reserva")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="event_enable_review:is(1)">
                        <label class="" >{{__("A revisão deve ser aprovada pelo administrador")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="event_review_approved" value="1"  @if(!empty($settings['event_review_approved'])) checked @endif /> {{__("Sim, por favor")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("LIGADO: A revisão deve ser aprovada pelo administrador - DESLIGADO: A revisão é aprovada automaticamente")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="event_enable_review:is(1)">
                        <label class="" >{{__("Número de revisão por página")}}</label>
                        <div class="form-controls">
                            <input type="number" class="form-control" name="event_review_number_per_page" value="{{ $settings['event_review_number_per_page'] ?? 5 }}" />
                            <small class="form-text text-muted">{{__("Divida os comentários em páginas")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="event_enable_review:is(1)">
                        <label class="" >{{__("Critérios de revisão")}}</label>
                        <div class="form-controls">
                            <div class="form-group-item">
                                <div class="g-items-header">
                                    <div class="row">
                                        <div class="col-md-5">{{__("Título")}}</div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div class="g-items">
                                    <?php
                                    if(!empty($settings['event_review_stats'])){
                                    $social_share = json_decode($settings['event_review_stats']);
                                    ?>
                                    @foreach($social_share as $key=>$item)
                                        <div class="item" data-number="{{$key}}">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <input type="text" name="event_review_stats[{{$key}}][title]" class="form-control" value="{{$item->title}}" placeholder="{{__('Ex.: Serviço')}}">
                                                </div>
                                                <div class="col-md-1">
                                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <?php } ?>
                                </div>
                                <div class="text-right">
                                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Adicionar item')}}</span>
                                </div>
                                <div class="g-more hide">
                                    <div class="item" data-number="__number__">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" __name__="event_review_stats[__number__][title]" class="form-control" value="" placeholder="{{__('Ex.: Serviço')}}">
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(is_default_lang())
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Opções de reserva")}}</h3>
            <p class="form-group-desc">{{__('Configurar reserva para evento')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-title"><strong>{{__("Tipo de reserva")}}</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="event_booking_type" class="form-control">
                                    <option value="ticket" {{($settings['event_booking_type'] ?? '') == 'ticket' ? 'selected' : ''  }}> {{__("Bilhete")}}</option>
                                    <option value="time_slot" {{($settings['event_booking_type'] ?? '') == 'time_slot' ? 'selected' : ''  }}> {{__("Horário")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group-item">
                        <label class="control-label">{{__('Taxas de reserva do comprador')}}</label>
                        <div class="g-items-header">
                            <div class="row">
                                <div class="col-md-5">{{__("Nome")}}</div>
                                <div class="col-md-3">{{__("Preço")}}</div>
                                <div class="col-md-3">{{__('Tipo')}}</div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                        <div class="g-items">
                            <?php  $languages = \Modules\Language\Models\Language::getActive();  ?>
                            @if(!empty($settings['event_booking_buyer_fees']))
                                <?php $event_booking_buyer_fees = json_decode($settings['event_booking_buyer_fees'],true); ?>
                                @foreach($event_booking_buyer_fees as $key=>$buyer_fee)
                                    <div class="item" data-number="{{$key}}">
                                        <div class="row">
                                            <div class="col-md-5">
                                                @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                                    @foreach($languages as $language)
                                                        <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                                        <div class="g-lang">
                                                            <div class="title-lang">{{$language->name}}</div>
                                                            <input type="text" name="event_booking_buyer_fees[{{$key}}][name{{$key_lang}}]" class="form-control" value="{{$buyer_fee['name'.$key_lang] ?? ''}}" placeholder="{{__('Nome da taxa')}}">
                                                            <input type="text" name="event_booking_buyer_fees[{{$key}}][desc{{$key_lang}}]" class="form-control" value="{{$buyer_fee['desc'.$key_lang] ?? ''}}" placeholder="{{__('Descrição da taxa')}}">
                                                        </div>

                                                    @endforeach
                                                @else
                                                    <input type="text" name="event_booking_buyer_fees[{{$key}}][name]" class="form-control" value="{{$buyer_fee['name'] ?? ''}}" placeholder="{{__('Nome da taxa')}}">
                                                    <input type="text" name="event_booking_buyer_fees[{{$key}}][desc]" class="form-control" value="{{$buyer_fee['desc'] ?? ''}}" placeholder="{{__('Descrição da taxa')}}">
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" min="0" step="0.1"  name="event_booking_buyer_fees[{{$key}}][price]" class="form-control" value="{{$buyer_fee['price']}}">
                                                <select name="event_booking_buyer_fees[{{$key}}][unit]" class="form-control">
                                                    <option @if( ($buyer_fee['unit'] ?? "") ==  'fixed') selected @endif value="fixed">{{ __("Fixo") }}</option>
                                                    <option @if( ($buyer_fee['unit'] ?? "") ==  'percent') selected @endif value="percent">{{ __("Por cento") }}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="event_booking_buyer_fees[{{$key}}][type]" class="form-control d-none">
                                                    <option @if($buyer_fee['type'] ==  'one_time') selected @endif value="one_time">{{__("Uma vez")}}</option>
                                                </select>
                                                <label>
                                                    <input type="checkbox" min="0" name="event_booking_buyer_fees[{{$key}}][per_ticket]" value="on" @if($buyer_fee['per_ticket'] ?? '') checked @endif >
                                                    {{__("Preço por ingresso")}}
                                                </label>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="text-right">
                            <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Adicionar item')}}</span>
                        </div>
                        <div class="g-more hide">
                            <div class="item" data-number="__number__">
                                <div class="row">
                                    <div class="col-md-5">
                                        @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                            @foreach($languages as $language)
                                                <?php $key = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                                <div class="g-lang">
                                                    <div class="title-lang">{{$language->name}}</div>
                                                    <input type="text" __name__="event_booking_buyer_fees[__number__][name{{$key}}]" class="form-control" value="" placeholder="{{__('Nome da taxa')}}">
                                                    <input type="text" __name__="event_booking_buyer_fees[__number__][desc{{$key}}]" class="form-control" value="" placeholder="{{__('Descrição da taxa')}}">
                                                </div>

                                            @endforeach
                                        @else
                                            <input type="text" __name__="event_booking_buyer_fees[__number__][name]" class="form-control" value="" placeholder="{{__('Nome da taxa')}}">
                                            <input type="text" __name__="event_booking_buyer_fees[__number__][desc]" class="form-control" value="" placeholder="{{__('Descrição da taxa')}}">
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" min="0" step="0.1"  __name__="event_booking_buyer_fees[__number__][price]" class="form-control" value="">
                                        <select __name__="event_booking_buyer_fees[__number__][unit]" class="form-control">
                                            <option value="fixed">{{ __("Fixo") }}</option>
                                            <option value="percent">{{ __("Por cento") }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select __name__="event_booking_buyer_fees[__number__][type]" class="form-control d-none">
                                            <option value="one_time">{{__("Uma vez")}}</option>
                                        </select>
                                        <label>
                                            <input type="checkbox" min="0" __name__="event_booking_buyer_fees[__number__][per_ticket]" value="on">
                                            {{__("Preço por ingresso")}}
                                        </label>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(is_default_lang())
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Opções do fornecedor")}}</h3>
            <p class="form-group-desc">{{__('Configuração do fornecedor para evento')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("O evento criado pelo fornecedor deve ser aprovado pelo administrador")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="event_vendor_create_service_must_approved_by_admin" value="1" @if(!empty($settings['event_vendor_create_service_must_approved_by_admin'])) checked @endif /> {{__("Sim, por favor")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("LIGADO: Quando o fornecedor publica um serviço, ele precisa ser aprovado pelo administrador")}}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Permitir que o fornecedor altere seu status de reserva")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="event_allow_vendor_can_change_their_booking_status" value="1" @if(!empty($settings['event_allow_vendor_can_change_their_booking_status'])) checked @endif /> {{__("Sim, por favor")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("LIGADO: O fornecedor pode alterar seu status de reserva")}}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Permitir que o fornecedor altere o valor pago pela reserva")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="event_allow_vendor_can_change_paid_amount" value="1" @if(!empty($settings['event_allow_vendor_can_change_paid_amount'])) checked @endif /> {{__("Sim, por favor")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("LIGADO: O fornecedor pode alterar o valor pago pela reserva")}}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Permitir que o fornecedor adicione uma taxa de serviço")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="event_allow_vendor_can_add_service_fee" value="1" @if(!empty($settings['event_allow_vendor_can_add_service_fee'])) checked @endif /> {{__("Sim, por favor")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("LIGADO: O fornecedor pode adicionar taxa de serviço")}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if(is_default_lang())
<hr>

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Depósito de reserva")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Opções de depósito de reserva")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="form-controls">
                    <label><input type="checkbox" name="event_deposit_enable" value="1" @if(setting_item('event_deposit_enable')) checked @endif > {{__('Sim, por favor, habilite-o')}}</label>
                    </div>
                </div>
                <div class="form-group" data-condition="event_deposit_enable:is(1)">
                    <label >{{__('Valor do depósito')}}</label>
                    <div class="form-controls">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="number" name="event_deposit_amount" class="form-control" step="0.1" value="{{old('event_deposit_amount',setting_item('event_deposit_amount',0))}}" >
                                    <select name="event_deposit_type"  class="form-control">
                                        <option value="fixed">{{__("Fixo")}}</option>
                                        <option @if(old('event_deposit_type',setting_item('event_deposit_type')) == 'percent') selected @endif value="percent">{{__("Por cento")}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" data-condition="event_deposit_enable:is(1)">
                    <label class="" >{{__("Fórmula de Depósito")}}</label>
                    <div class="form-controls">
                        <div class="row">
                            <div class="col-md-6">
                                <select name="event_deposit_fomular" class="form-control" >
                                    <option value="default" {{($settings['event_deposit_fomular'] ?? '') == 'default' ? 'selected' : ''  }}>{{__('Padrão')}}</option>
                                    <option value="deposit_and_fee" {{ ($settings['event_deposit_fomular'] ?? '') == 'deposit_and_fee' ? 'selected' : ''  }}>{{__("Valor do depósito + Comprador grátis")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Desativar módulo de evento?")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Desativar módulo de evento")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="form-controls">
                    <label><input type="checkbox" name="event_disable" value="1" @if(setting_item('event_disable')) checked @endif > {{__('Sim, por favor desabilite-o')}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif

