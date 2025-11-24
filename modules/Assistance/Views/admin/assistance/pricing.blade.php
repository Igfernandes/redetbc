<?php  $languages = \Modules\Language\Models\Language::getActive();  ?>
@if(is_default_lang())
<div class="panel">
    <div class="panel-title"><strong>{{__("Preços")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Preço por hora")}}</label>
                        <input type="number" step="any" min="0" name="price_per_hour" class="form-control" value="{{$row->price_per_hour}}" placeholder="{{__("Preço por hora")}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Preço por dia")}}</label>
                        <input type="number" step="any" name="price_per_day" class="form-control" value="{{$row->price_per_day}}" placeholder="{{__("Preço por dia")}}">
                    </div>
                </div>

            </div>
        @endif
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Reservas antecipadas mínimas")}}</label>
                        <input type="number" name="min_day_before_booking" class="form-control" value="{{$row->min_day_before_booking}}" placeholder="{{__("Ex: 3")}}">
                        <i>{{ __("Deixe em branco se não precisar usar a opção de dia mínimo.") }}</i>
                    </div>
                </div>
                <div class="col-lg-6">
                    @php
                        $startTime = strtotime( '00:00' );
                        $endTime = strtotime( '23:30' );
                    @endphp
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">{{__("Reserva de horário de início")}}</label>
                            <select name="start_time_booking" class="form-control">
                                <option value="">{{ __("-- Selecione --") }}</option>
                                @for ( $i = $startTime ; $i <= $endTime ; $i = $i + 1800)
                                    <option @if($row->start_time_booking == date( 'H:i', $i )) selected @endif value="{{ date( 'H:i', $i ) }}">{{ date( 'H:i', $i ) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">{{__("Reserva de horário final")}}</label>
                            <select name="end_time_booking" class="form-control">
                                <option value="">{{ __("-- Selecione --") }}</option>
                                @for ( $i = $startTime ; $i <= $endTime ; $i = $i + 1800)
                                    <option @if($row->end_time_booking == date( 'H:i', $i )) selected @endif value="{{ date( 'H:i', $i ) }}">{{ date( 'H:i', $i ) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <i>{{ __("*Deixe em branco se não usar esses campos. O horário de término deve ser posterior ao horário de início.") }}</i>
                </div>
            </div>
        @endif
        <div class="form-group @if(!is_default_lang()) d-none @endif">
            <label><input type="checkbox" name="enable_extra_price" @if(!empty($row->enable_extra_price)) checked @endif value="1"> {{__('Ativar preço extra')}}
            </label>
        </div>
        <div class="form-group-item @if(!is_default_lang()) d-none @endif" data-condition="enable_extra_price:is(1)">
            <label class="control-label">{{__('Preço Extra')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("Nome")}}</div>
                    <div class="col-md-3">{{__("Preço")}}</div>
                    <div class="col-md-3">{{__('Tipo')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($row->extra_price))
                    @foreach($row->extra_price as $key=>$extra_price)
                        <div class="item" data-number="{{$key}}">
                            <div class="row">
                                <div class="col-md-5">
                                    @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                        @foreach($languages as $language)
                                            <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                            <div class="g-lang">
                                                <div class="title-lang">{{$language->name}}</div>
                                                <input type="text" name="extra_price[{{$key}}][name{{$key_lang}}]" class="form-control" value="{{$extra_price['name'.$key_lang] ?? ''}}" placeholder="{{__('Nome do preço extra')}}">
                                            </div>
                                        @endforeach
                                    @else
                                        <input type="text" name="extra_price[{{$key}}][name]" class="form-control" value="{{$extra_price['name'] ?? ''}}" placeholder="{{__('Nome do preço extra')}}">
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <input type="number" @if(!is_default_lang()) disabled @endif min="0" name="extra_price[{{$key}}][price]" class="form-control" value="{{$extra_price['price']}}">
                                </div>
                                <div class="col-md-3">
                                    <select name="extra_price[{{$key}}][type]" class="form-control" @if(!is_default_lang()) disabled @endif>
                                        <option @if($extra_price['type'] ==  'one_time') selected @endif value="one_time">{{__("Uma vez")}}</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    @if(is_default_lang())
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="text-right">
                @if(is_default_lang())
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Adicionar item')}}</span>
                @endif
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
                                        <input type="text" __name__="extra_price[__number__][name{{$key}}]" class="form-control" value="" placeholder="{{__('Nome do preço extra')}}">
                                    </div>
                                @endforeach
                            @else
                                <input type="text" __name__="extra_price[__number__][name]" class="form-control" value="" placeholder="{{__('Nome do preço extra')}}">
                            @endif
                        </div>
                        <div class="col-md-3">
                            <input type="number" min="0" __name__="extra_price[__number__][price]" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <select __name__="extra_price[__number__][type]" class="form-control">
                                <option value="one_time">{{__("uma vez")}}</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(is_default_lang() and (!empty(setting_item("assistance_allow_vendor_can_add_service_fee")) or is_admin()))
            <hr>
            <h3 class="panel-body-title app_get_locale">{{__('Taxa de serviço')}}</h3>
            <div class="form-group app_get_locale">
                <label><input type="checkbox" name="enable_service_fee" @if(!empty($row->enable_service_fee)) checked @endif value="1"> {{__('Ativar taxa de serviço')}}
                </label>
            </div>
            <div class="form-group-item" data-condition="enable_service_fee:is(1)">
                <label class="control-label">{{__('Taxas do comprador')}}</label>
                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-7">{{__("Nome")}}</div>
                        <div class="col-md-4">{{__("Preço")}}</div>
                        <div class="col-md-3 d-none">{{__('Tipo')}}</div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="g-items">
                    <?php  $languages = \Modules\Language\Models\Language::getActive();?>
                    @if(!empty($service_fee = $row->service_fee))
                        @foreach($service_fee as $key=>$item)
                            <div class="item" data-number="{{$key}}">
                                <div class="row">
                                    <div class="col-md-7">
                                        @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                            @foreach($languages as $language)
                                                <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                                <div class="g-lang">
                                                    <div class="title-lang">{{$language->name}}</div>
                                                    <input type="text" name="service_fee[{{$key}}][name{{$key_lang}}]" class="form-control" value="{{$item['name'.$key_lang] ?? ''}}" placeholder="{{__('Nome da taxa')}}">
                                                    <input type="text" name="service_fee[{{$key}}][desc{{$key_lang}}]" class="form-control" value="{{$item['desc'.$key_lang] ?? ''}}" placeholder="{{__('Descrição da taxa')}}">
                                                </div>

                                            @endforeach
                                        @else
                                            <input type="text" name="service_fee[{{$key}}][name]" class="form-control" value="{{$item['name'] ?? ''}}" placeholder="{{__('Nome da taxa')}}">
                                            <input type="text" name="service_fee[{{$key}}][desc]" class="form-control" value="{{$item['desc'] ?? ''}}" placeholder="{{__('Descrição da taxa')}}">
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" min="0"  step="0.1"  name="service_fee[{{$key}}][price]" class="form-control" value="{{$item['price'] ?? ""}}">
                                        <select name="service_fee[{{$key}}][unit]" class="form-control">
                                            <option @if(($item['unit'] ?? "") ==  'fixed') selected @endif value="fixed">{{ __("Fixo") }}</option>
                                            <option @if(($item['unit'] ?? "") ==  'percent') selected @endif value="percent">{{ __("Por cento") }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 d-none">
                                        <select name="service_fee[{{$key}}][type]" class="form-control d-none">
                                            <option @if($item['type'] ?? "" ==  'one_time') selected @endif value="one_time">{{__("Uma vez")}}</option>
                                        </select>
                                        <label>
                                            <input type="checkbox" min="0" name="service_fee[{{$key}}][per_person]" value="on" @if($item['per_person'] ?? '') checked @endif >
                                            {{__("Preço por pessoa")}}
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
                            <div class="col-md-7">
                                @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                    @foreach($languages as $language)
                                        <?php $key = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                        <div class="g-lang">
                                            <div class="title-lang">{{$language->name}}</div>
                                            <input type="text" __name__="service_fee[__number__][name{{$key}}]" class="form-control" value="" placeholder="{{__('Nome da taxa')}}">
                                            <input type="text" __name__="service_fee[__number__][desc{{$key}}]" class="form-control" value="" placeholder="{{__('Descrição da taxa')}}">
                                        </div>

                                    @endforeach
                                @else
                                    <input type="text" __name__="service_fee[__number__][name]" class="form-control" value="" placeholder="{{__('Nome da taxa')}}">
                                    <input type="text" __name__="service_fee[__number__][desc]" class="form-control" value="" placeholder="{{__('Descrição da taxa')}}">
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input type="number" min="0" step="0.1"  __name__="service_fee[__number__][price]" class="form-control" value="">
                                <select __name__="service_fee[__number__][unit]" class="form-control">
                                    <option value="fixed">{{ __("Fixo") }}</option>
                                    <option value="percent">{{ __("Por cento") }}</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-none">
                                <select __name__="service_fee[__number__][type]" class="form-control">
                                    <option value="one_time">{{__("uma vez")}}</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endif
