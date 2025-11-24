<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Página de Busca")}}</h3>
        <p class="form-group-desc">{{__('Configurar a página de busca do seu site')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Opções Gerais")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__("Título da Página")}}</label>
                    <div class="form-controls">
                        <input type="text" name="hotel_page_search_title" value="{{setting_item_with_lang('hotel_page_search_title',request()->query('lang'))}}" class="form-control">
                    </div>
                </div>

                @if(is_default_lang())
                <div class="form-group">
                    <label>{{__("Banner da Página")}}</label>
                    <div class="form-controls form-group-image">
                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('hotel_page_search_banner',$settings['hotel_page_search_banner'] ?? "") !!}
                    </div>
                </div>

                <div class="form-group">
                    <label>{{__("Layout da Busca")}}</label>
                    <div class="form-controls">
                        <select name="hotel_layout_search" class="form-control">
                            @foreach(config('hotel.layouts',['normal'=>__("Layout Normal"),'map'=>__("Layout com Mapa")]) as $id=>$name))
                                <option value="{{$id}}" {{ setting_item('hotel_layout_search','normal') == $id ? 'selected' : '' }}>{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <?php do_action(\Modules\Hotel\Hook::HOTEL_SETTING_AFTER_LAYOUT_SEARCH) ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Estilo de Busca por Localização")}}</label>
                            <div class="form-controls">
                                <select name="hotel_location_search_style" class="form-control">
                                    <option {{ ($settings['hotel_location_search_style'] ?? '') == 'normal' ? 'selected' : '' }} value="normal">{{__("Normal")}}</option>
                                    <option {{ ($settings['hotel_location_search_style'] ?? '') == 'autocomplete' ? 'selected' : '' }} value="autocomplete">{{__('Autocomplete das Localizações')}}</option>
                                    <option {{ ($settings['hotel_location_search_style'] ?? '') == 'autocompletePlace' ? 'selected' : '' }} value="autocompletePlace">{{__('Autocomplete do Google Places')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{__("Limite de itens por página")}}</label>
                            <div class="form-controls">
                                <input type="number" min="1" name="hotel_page_limit_item" placeholder="{{ __('Padrão: 9') }}" value="{{setting_item_with_lang('hotel_page_limit_item',request()->query('lang'), 9)}}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" data-condition="hotel_location_search_style:is(autocompletePlace)">
                        <label>{{__("Opções de Raio de Busca")}}</label>
                        <div class="input-group mb-3">
                            <input type="number" name="hotel_location_radius_value" min="0" value="{{ setting_item('hotel_location_radius_value',1)}}" class="form-control">
                            <div class="input-group-append">
                                <select name="hotel_location_radius_type">
                                    <option {{ (setting_item('hotel_location_radius_type') ?? '') == 3959 ? 'selected' : '' }} value="3959">{{__('Milhas')}}</option>
                                    <option {{ (setting_item('hotel_location_radius_type') ?? '') == 6371 ? 'selected' : '' }} value="6371">{{__('Km')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Layout dos Itens na Busca")}}</label>
                            <div class="form-controls">
                                <select name="hotel_layout_item_search" class="form-control">
                                    <option value="list" {{($settings['hotel_layout_item_search'] ?? '') == 'list' ? 'selected' : ''}}>{{__('Lista')}}</option>
                                    <option value="grid" {{($settings['hotel_layout_item_search'] ?? '') == 'grid' ? 'selected' : ''}}>{{__("Grade")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" data-condition="hotel_layout_item_search:is(list)">
                            <label>{{__("Quais atributos exibir na listagem?")}}</label>
                            <div class="form-controls">
                                <?php
                                $attribute = !empty($settings['hotel_attribute_show_in_listing_page'])
                                    ? \Modules\Core\Models\Attributes::find($settings['hotel_attribute_show_in_listing_page'])
                                    : false;
                                \App\Helpers\AdminForm::select2('hotel_attribute_show_in_listing_page', [
                                    'configs' => [
                                        'ajax' => [
                                            'url'      => route('hotel.admin.attribute.getForSelect2'),
                                            'dataType' => 'json'
                                        ]
                                    ]
                                ],
                                !empty($attribute->id) ? [$attribute->id, $attribute->name] : false
                                )
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{__("Opções do Mapa")}}</label>
                    <div class="form-controls">
                        <select name="hotel_layout_map_option" class="form-control">
                            <option {{ (setting_item_with_lang('hotel_layout_map_option',request()->query('lang')) ?? '') == 'map_left' ? 'selected' : '' }} value="map_left">{{__('Mapa à Esquerda')}}</option>
                            <option {{ (setting_item_with_lang('hotel_layout_map_option',request()->query('lang')) ?? '') == 'map_right' ? 'selected' : '' }} value="map_right">{{__("Mapa à Direita")}}</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label>{{__("Latitude Padrão do Mapa")}}</label>
                        <div class="form-controls">
                            <input type="text" name="hotel_map_lat_default" value="{{$settings['hotel_map_lat_default'] ?? ''}}" class="form-control" placeholder="21.030513">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label>{{__("Longitude Padrão do Mapa")}}</label>
                        <div class="form-controls">
                            <input type="text" name="hotel_map_lng_default" value="{{$settings['hotel_map_lng_default'] ?? ''}}" class="form-control" placeholder="105.840565">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label>{{__("Zoom Padrão do Mapa")}}</label>
                        <div class="form-controls">
                            <input type="text" name="hotel_map_zoom_default" value="{{$settings['hotel_map_zoom_default'] ?? ''}}" class="form-control" placeholder="13">
                        </div>
                    </div>

                    <div class="col-md-12 mt-1">
                        <i>{{ __('Pegue latitude e longitude aqui:') }}
                            <a href="https://www.latlong.net" target="_blank">https://www.latlong.net</a>
                        </i>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label>{{__("Ícone do Marcador no Mapa")}}</label>
                    <div class="form-controls form-group-image">
                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('hotel_icon_marker_map',$settings['hotel_icon_marker_map'] ?? "") !!}
                    </div>
                </div>

                @php do_action(\Modules\Hotel\Hook::HOTEL_SETTING_AFTER_MAP) @endphp
                @endif
            </div>
        </div>

        @include('Hotel::admin.settings.form-search')
        @include('Hotel::admin.settings.map-search')

        <div class="panel">
            <div class="panel-title"><strong>{{__("Opções de SEO")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#seo_1">{{__("Opções Gerais")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_2">{{__("Compartilhamento no Facebook")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_3">{{__("Compartilhamento no Twitter")}}</a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="seo_1">
                            <div class="form-group">
                                <label class="control-label">{{__("Título SEO")}}</label>
                                <input type="text" name="hotel_page_list_seo_title" class="form-control" placeholder="{{__("Digite o título...")}}" value="{{ setting_item_with_lang('hotel_page_list_seo_title',request()->query('lang'))}}">
                            </div>

                            <div class="form-group">
                                <label class="control-label">{{__("Descrição SEO")}}</label>
                                <input type="text" name="hotel_page_list_seo_desc" class="form-control" placeholder="{{__("Digite a descrição...")}}" value="{{setting_item_with_lang('hotel_page_list_seo_desc',request()->query('lang'))}}">
                            </div>

                            @if(is_default_lang())
                            <div class="form-group form-group-image">
                                <label class="control-label">{{__("Imagem de Destaque")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('hotel_page_list_seo_image', $settings['hotel_page_list_seo_image'] ?? "" ) !!}
                            </div>
                            @endif
                        </div>

                        @php
                        $seo_share = json_decode(setting_item_with_lang('hotel_page_list_seo_share',request()->query('lang'),'[]'),true);
                        @endphp

                        <div class="tab-pane" id="seo_2">
                            <div class="form-group">
                                <label class="control-label">{{__("Título para Facebook")}}</label>
                                <input type="text" name="hotel_page_list_seo_share[facebook][title]" class="form-control" placeholder="{{__("Digite o título...")}}" value="{{$seo_share['facebook']['title'] ?? "" }}">
                            </div>

                            <div class="form-group">
                                <label class="control-label">{{__("Descrição para Facebook")}}</label>
                                <input type="text" name="hotel_page_list_seo_share[facebook][desc]" class="form-control" placeholder="{{__("Digite a descrição...")}}" value="{{$seo_share['facebook']['desc'] ?? "" }}">
                            </div>

                            @if(is_default_lang())
                            <div class="form-group form-group-image">
                                <label class="control-label">{{__("Imagem para Facebook")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('hotel_page_list_seo_share[facebook][image]',$seo_share['facebook']['image'] ?? "" ) !!}
                            </div>
                            @endif
                        </div>

                        <div class="tab-pane" id="seo_3">
                            <div class="form-group">
                                <label class="control-label">{{__("Título para Twitter")}}</label>
                                <input type="text" name="hotel_page_list_seo_share[twitter][title]" class="form-control" placeholder="{{__("Digite o título...")}}" value="{{$seo_share['twitter']['title'] ?? "" }}">
                            </div>

                            <div class="form-group">
                                <label class="control-label">{{__("Descrição para Twitter")}}</label>
                                <input type="text" name="hotel_page_list_seo_share[twitter][desc]" class="form-control" placeholder="{{__("Digite a descrição...")}}" value="{{$seo_share['twitter']['desc'] ?? "" }}">
                            </div>

                            @if(is_default_lang())
                            <div class="form-group form-group-image">
                                <label class="control-label">{{__("Imagem para Twitter")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('hotel_page_list_seo_share[twitter][image]', $seo_share['twitter']['image'] ?? "" ) !!}
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
        <h3 class="form-group-title">{{__("Opções de Avaliações")}}</h3>
        <p class="form-group-desc">{{__('Configurar avaliações dos hotéis')}}</p>
    </div>

    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                <div class="form-group">
                    <label>{{__("Ativar sistema de avaliações?")}}</label>
                    <div class="form-controls">
                        <label>
                            <input type="checkbox" name="hotel_enable_review" value="1" @if(!empty($settings['hotel_enable_review'])) checked @endif />
                            {{__("Sim, ativar")}}
                        </label>
                        <br>
                        <small class="form-text text-muted">{{__("Ative para permitir avaliações dos hotéis")}}</small>
                    </div>
                </div>

                <div class="form-group" data-condition="hotel_enable_review:is(1)">
                    <label>{{__("O cliente precisa reservar antes de avaliar?")}}</label>
                    <div class="form-controls">
                        <label>
                            <input type="checkbox" name="hotel_enable_review_after_booking" value="1" @if(!empty($settings['hotel_enable_review_after_booking'])) checked @endif />
                            {{__("Sim")}}
                        </label>
                        <br>
                        <small class="form-text text-muted">{{__("ON: avaliar somente após reserva — OFF: avaliar sem reserva")}}</small>
                    </div>
                </div>

                <div class="form-group" data-condition="hotel_enable_review:is(1),hotel_enable_review_after_booking:is(1)">
                    <label>{{__("Permitir avaliação após qual status de reserva?")}}</label>
                    <div class="form-controls">
                        @php
                        $status = config('booking.statuses');
                        $settings_status = !empty($settings['hotel_allow_review_after_making_completed_booking'])
                            ? json_decode($settings['hotel_allow_review_after_making_completed_booking'])
                            : [];
                        @endphp

                        <div class="row">
                            @foreach($status as $item)
                                <div class="col-md-4">
                                    <label>
                                        <input type="checkbox" name="hotel_allow_review_after_making_completed_booking[]" value="{{$item}}" @if(in_array($item,$settings_status)) checked @endif>
                                        {{booking_status_to_text($item)}}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <small class="form-text text-muted">{{__("Selecione os status permitidos")}}</small>
                        <small class="form-text text-muted">{{__("Deixe em branco para permitir em todos os status")}}</small>
                    </div>
                </div>

                <div class="form-group" data-condition="hotel_enable_review:is(1)">
                    <label>{{__("Avaliações precisam ser aprovadas?")}}</label>
                    <div class="form-controls">
                        <label>
                            <input type="checkbox" name="hotel_review_approved" value="1" @if(!empty($settings['hotel_review_approved'])) checked @endif />
                            {{__("Sim")}}
                        </label>
                        <br>
                        <small class="form-text text-muted">{{__("ON: admin precisa aprovar — OFF: aprovar automaticamente")}}</small>
                    </div>
                </div>

                <div class="form-group" data-condition="hotel_enable_review:is(1)">
                    <label>{{__("Quantidade de avaliações por página")}}</label>
                    <div class="form-controls">
                        <input type="number" class="form-control" name="hotel_review_number_per_page" value="{{ $settings['hotel_review_number_per_page'] ?? 5 }}">
                        <small class="form-text text-muted">{{__("Paginação das avaliações")}}</small>
                    </div>
                </div>

                <div class="form-group" data-condition="hotel_enable_review:is(1)">
                    <label>{{__("Critérios de avaliação")}}</label>
                    <div class="form-controls">
                        <div class="form-group-item">
                            <div class="g-items-header">
                                <div class="row">
                                    <div class="col-md-5">{{__("Título")}}</div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>

                            <div class="g-items">
                                <?php if(!empty($settings['hotel_review_stats'])) {
                                    $social_share = json_decode($settings['hotel_review_stats']);
                                ?>
                                @foreach($social_share as $key=>$item)
                                <div class="item" data-number="{{$key}}">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input type="text" name="hotel_review_stats[{{$key}}][title]" class="form-control" value="{{$item->title}}" placeholder="{{__('Ex: Serviço')}}">
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-danger btn-sm btn-remove-item">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <?php } ?>
                            </div>

                            <div class="text-right">
                                <span class="btn btn-info btn-sm btn-add-item">
                                    <i class="icon ion-ios-add-circle-outline"></i>
                                    {{__('Adicionar item')}}
                                </span>
                            </div>

                            <div class="g-more hide">
                                <div class="item" data-number="__number__">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input type="text" __name__="hotel_review_stats[__number__][title]" class="form-control" placeholder="{{__('Ex: Serviço')}}">
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-danger btn-sm btn-remove-item">
                                                <i class="fa fa-trash"></i>
                                            </span>
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
        <h3 class="form-group-title">{{__("Taxas do Comprador")}}</h3>
        <p class="form-group-desc">{{__('Configurar taxas adicionais para reservas de hotel')}}</p>
    </div>

    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                <div class="form-group-item">
                    <label class="control-label">{{__('Taxas do Comprador')}}</label>

                    <div class="g-items-header">
                        <div class="row">
                            <div class="col-md-5">{{__("Nome")}}</div>
                            <div class="col-md-3">{{__("Preço")}}</div>
                            <div class="col-md-3">{{__('Tipo')}}</div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="g-items">
                        <?php $languages = \Modules\Language\Models\Language::getActive(); ?>

                        @if(!empty($settings['hotel_booking_buyer_fees']))
                            <?php $hotel_booking_buyer_fees = json_decode($settings['hotel_booking_buyer_fees'],true); ?>

                            @foreach($hotel_booking_buyer_fees as $key=>$buyer_fee)
                            <div class="item" data-number="{{$key}}">
                                <div class="row">

                                    <div class="col-md-5">
                                        @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))

                                            @foreach($languages as $language)
                                            <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : "" ?>

                                            <div class="g-lang">
                                                <div class="title-lang">{{$language->name}}</div>

                                                <input type="text" name="hotel_booking_buyer_fees[{{$key}}][name{{$key_lang}}]" class="form-control" value="{{$buyer_fee['name'.$key_lang] ?? ''}}" placeholder="{{__('Nome da taxa')}}">

                                                <input type="text" name="hotel_booking_buyer_fees[{{$key}}][desc{{$key_lang}}]" class="form-control" value="{{$buyer_fee['desc'.$key_lang] ?? ''}}" placeholder="{{__('Descrição da taxa')}}">
                                            </div>

                                            @endforeach

                                        @else

                                            <input type="text" name="hotel_booking_buyer_fees[{{$key}}][name]" class="form-control" value="{{$buyer_fee['name'] ?? ''}}" placeholder="{{__('Nome da taxa')}}">
                                            <input type="text" name="hotel_booking_buyer_fees[{{$key}}][desc]" class="form-control" value="{{$buyer_fee['desc'] ?? ''}}" placeholder="{{__('Descrição da taxa')}}">

                                        @endif
                                    </div>

                                    <div class="col-md-3">
                                        <input type="number" min="0" step="0.1" name="hotel_booking_buyer_fees[{{$key}}][price]" class="form-control" value="{{$buyer_fee['price']}}">
                                        
                                        <select name="hotel_booking_buyer_fees[{{$key}}][type]" class="form-control mt-1">
                                            <option value="fixed" {{ ($buyer_fee['type'] ?? '') === 'fixed' ? 'selected' : '' }}>{{__('Fixo')}}</option>
                                            <option value="percent" {{ ($buyer_fee['type'] ?? '') === 'percent' ? 'selected' : '' }}>{{__('Percentual')}}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        @endif

                    </div>

                    <div class="text-right">
                        <span class="btn btn-info btn-sm btn-add-item">
                            <i class="icon ion-ios-add-circle-outline"></i>
                            {{__('Adicionar taxa')}}
                        </span>
                    </div>

                    <div class="g-more hide">
                        <div class="item" data-number="__number__">
                            <div class="row">

                                <div class="col-md-5">
                                    <input type="text" __name__="hotel_booking_buyer_fees[__number__][name]" class="form-control" placeholder="{{__('Nome da taxa')}}">
                                    <input type="text" __name__="hotel_booking_buyer_fees[__number__][desc]" class="form-control" placeholder="{{__('Descrição da taxa')}}">
                                </div>

                                <div class="col-md-3">
                                    <input type="number" min="0" step="0.1" __name__="hotel_booking_buyer_fees[__number__][price]" class="form-control">

                                    <select __name__="hotel_booking_buyer_fees[__number__][type]" class="form-control mt-1">
                                        <option value="fixed">{{__('Fixo')}}</option>
                                        <option value="percent">{{__('Percentual')}}</option>
                                    </select>
                                </div>

                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div> <!-- group-item -->

            </div>
        </div>
    </div>

</div>
@endif
