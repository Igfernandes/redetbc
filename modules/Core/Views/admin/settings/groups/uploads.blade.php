<div class="row mb-3">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Configurar SMS')}}</h3>
        <p class="form-group-desc">{{__('Driver SMS')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label>{{__('Driver SMS')}}</label>
                        <div class="form-controls">
                            <select name="sms_driver" class="form-control">
                                @foreach(\Modules\Core\SettingClass::UPLOAD_DRIVER as $item=>$value)
                                    <option value="{{$value}}" {{setting_item('upload_drive') == $value ? 'selected' : ''  }}>{{__(strtoupper($value))}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    <p>{{__('Você pode editar no idioma principal.')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@if(is_default_lang())
    <div class="row " data-condition="sms_driver:is(nexmo)">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('Configurar driver Nexmo')}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div data-condition="sms_driver:is(nexmo)">
                        <div class="form-group">
                            <label class="">{{__("Chave de API Nexmo")}}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="sms_nexmo_api_key" value="{{setting_item('sms_nexmo_api_key',config('sms.nexmo.key')) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">{{__("Segredo da API Nexmo")}}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="sms_nexmo_api_secret" value="{{setting_item('sms_nexmo_api_secret',config('sms.nexmo.secret'))}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">{{__("De")}}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="sms_nexmo_api_from" value="{{setting_item('sms_nexmo_api_from',config('sms.nexmo.from'))}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" data-condition="sms_driver:is(twilio)">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('Configurar driver Twilio')}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div data-condition="sms_driver:is(twilio)">
                        <div class="form-group">
                            <label class="">{{__("Conta Twilio Sid")}}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="sms_twilio_account_sid" value="{{setting_item('sms_twilio_account_sid',config('sms.twilio.sid'))}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">{{__("Token de conta Twilio")}}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="sms_twilio_account_token" value="{{setting_item('sms_twilio_account_token',config('sms.twilio.token'))}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">{{__("DE")}}</label>
                            <div class="form-controls">
                                <input type="number" class="form-control" name="sms_twilio_api_from" value="{{setting_item('sms_twilio_api_from',config('sms.twilio.from'))}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endif

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Reserva de eventos por SMS')}}</h3>
        <div class="form-group-desc">
            {{__('O número de telefone deve estar no formato E.164')}}
            <p>{{__('Formatar')}}:<code> {{__('[+][country code][subscriber number including area code]')}} </code></p>
            <p>{{__('Exemplo')}}:<code> +12019480710</code></p>
            <div>{{__('Mensagem')}}:</div>
            @foreach(\Modules\Sms\Listeners\SendSmsBookingListen::CODE as $item=>$value)
                <div><code>{{$value}}</code></div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Administrador do telefone de configuração")}}</strong></div>
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label>{{__('Telefone do administrador')}} </label>
                        <div class="form-controls">
                            <input type="number" class="form-control" name="admin_phone_has_booking" value="{{setting_item_with_lang('admin_phone_has_booking',request()->query('lang')) ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{__("País")}}</label>
                        <select name="admin_country_has_booking" class="form-control" >
                            <option value="">{{__('-- Selecione --')}}</option>
                            @foreach(get_country_lists() as $id=>$name)
                                <option @if(setting_item_with_lang('admin_country_has_booking',request()->query('lang')) ==$id) selected @endif value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <p>{{__('Você pode editar no idioma principal.')}}</p>
                @endif
            </div>
        </div>
        <div class="panel">
            <div class="panel-title"><strong>{{__("Criar reserva")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#SmsAdminEventCreateBooking">{{__("Administrador")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#SmsVendorEventCreateBooking">{{__("Fornecedor")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#SmsUserEventCreateBooking">{{__("Cliente")}}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="SmsAdminEventCreateBooking">
                            @if(is_default_lang())
                                <div class="form-group">
                                    <label> <input type="checkbox" @if($settings['enable_sms_admin_has_booking'] ?? '' == 1) checked @endif name="enable_sms_admin_has_booking" value="1"> {{__("Habilitar envio de SMS para o administrador quando houver reserva?")}}</label>
                                </div>
                            @else
                                <div class="form-group">
                                    <label> <input type="checkbox" @if($settings['enable_sms_admin_has_booking'] ?? '' == 1) checked @endif name="enable_sms_admin_has_booking" disabled value="1"> {{__("Habilitar envio de SMS para o administrador quando houver reserva?")}}</label>
                                </div>
                                @if($settings['enable_sms_admin_has_booking'] != 1)
                                    <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                                @endif
                            @endif
                            <div data-condition="enable_sms_admin_has_booking:is(1)">
                                <div class="form-group">
                                    <label>{{__("Mensagem para o administrador")}}</label>
                                    <div class="form-controls">
                                        <textarea name="sms_message_admin_when_booking" rows="8" class="form-control">{{setting_item_with_lang('sms_message_admin_when_booking',request()->query('lang')) ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="SmsVendorEventCreateBooking">
                            @if(is_default_lang())
                                <div class="form-group">
                                    <label> <input type="checkbox" @if($settings['enable_sms_vendor_has_booking'] ?? '' == 1) checked @endif name="enable_sms_vendor_has_booking" value="1"> {{__("Habilitar envio de SMS ao fornecedor quando houver reserva?")}}</label>
                                </div>
                            @else
                                <div class="form-group">
                                    <label> <input type="checkbox" @if($settings['enable_sms_vendor_has_booking'] ?? '' == 1) checked @endif name="enable_sms_vendor_has_booking" disabled value="1"> {{__("Habilitar envio de SMS ao fornecedor quando houver reserva?")}}</label>
                                </div>
                                @if($settings['enable_sms_vendor_has_booking'] != 1)
                                    <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                                @endif
                            @endif
                            <div class="form-group" data-condition="enable_sms_vendor_has_booking:is(1)">
                                <label>{{__("Mensagem para o cliente")}}</label>
                                <div class="form-controls">
                                    <textarea name="sms_message_vendor_when_booking" rows="8" class="form-control">{{setting_item_with_lang('sms_message_vendor_when_booking',request()->query('lang')) ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="SmsUserEventCreateBooking">
                            @if(is_default_lang())
                                <div class="form-group">
                                    <label> <input type="checkbox" @if($settings['enable_sms_user_has_booking'] ?? '' == 1) checked @endif name="enable_sms_user_has_booking" value="1"> {{__("Habilitar envio de SMS ao cliente quando houver reserva?")}}</label>
                                </div>
                            @else
                                <div class="form-group">
                                    <label> <input type="checkbox" @if($settings['enable_sms_user_has_booking'] ?? '' == 1) checked @endif name="enable_sms_user_has_booking" disabled value="1"> {{__("Habilitar envio de SMS ao cliente quando houver reserva?")}}</label>
                                </div>
                                @if($settings['enable_sms_user_has_booking'] != 1)
                                    <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                                @endif
                            @endif
                            <div class="form-group" data-condition="enable_sms_user_has_booking:is(1)">
                                <label>{{__("Mensagem para o cliente")}}</label>
                                <div class="form-controls">
                                    <textarea name="sms_message_user_when_booking" rows="8" class="form-control">{{setting_item_with_lang('sms_message_user_when_booking',request()->query('lang')) ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-title"><strong>{{__("Atualizar reserva")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#SmsAdminEventUpdateBooking">{{__("Administrador")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#SmsVendorEventUpdateBooking">{{__("Fornecedor")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#SmsUserEventUpdateBooking">{{__("Cliente")}}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="SmsAdminEventUpdateBooking">
                            @if(is_default_lang())
                                <div class="form-group">
                                    <label> <input type="checkbox" @if($settings['enable_sms_admin_update_booking'] ?? '' == 1) checked @endif name="enable_sms_admin_update_booking" value="1"> {{__("EÉ possível enviar SMS ao administrador ao atualizar a reserva?")}}</label>
                                </div>
                            @else
                                <div class="form-group">
                                    <label> <input type="checkbox" @if($settings['enable_sms_admin_update_booking'] ?? '' == 1) checked @endif name="enable_sms_admin_update_booking" disabled value="1"> {{__("É possível enviar SMS ao administrador ao atualizar a reserva?")}}</label>
                                </div>
                                @if(@$settings['enable_sms_admin_update_booking'] != 1)
                                    <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                                @endif
                            @endif
                            <div data-condition="enable_sms_admin_update_booking:is(1)">
                                <div class="form-group">
                                    <label>{{__("Mensagem para o administrador")}}</label>
                                    <div class="form-controls">
                                        <textarea name="sms_message_admin_update_booking" rows="8" class="form-control">{{setting_item_with_lang('sms_message_admin_update_booking',request()->query('lang')) ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="SmsVendorEventUpdateBooking">
                            @if(is_default_lang())
                                <div class="form-group">
                                    <label> <input type="checkbox" @if($settings['enable_sms_vendor_update_booking'] ?? '' == 1) checked @endif name="enable_sms_vendor_update_booking" value="1"> {{__("Habilitar envio de SMS ao fornecedor ao atualizar reserva?")}}</label>
                                </div>
                            @else
                                <div class="form-group">
                                    <label> <input type="checkbox" @if(@$settings['enable_sms_vendor_update_booking'] ?? '' == 1) checked @endif name="enable_sms_vendor_update_booking" disabled value="1"> {{__("Habilitar envio de SMS ao fornecedor ao atualizar reserva?")}}</label>
                                </div>
                                @if(@$settings['enable_sms_vendor_update_booking'] != 1)
                                    <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                                @endif
                            @endif
                            <div class="form-group" data-condition="enable_sms_vendor_update_booking:is(1)">
                                <label>{{__("Mensagem para o cliente")}}</label>
                                <div class="form-controls">
                                    <textarea name="sms_message_vendor_update_booking" rows="8" class="form-control">{{setting_item_with_lang('sms_message_vendor_update_booking',request()->query('lang')) ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="SmsUserEventUpdateBooking">
                            @if(is_default_lang())
                                <div class="form-group">
                                    <label> <input type="checkbox" @if(@$settings['enable_sms_user_update_booking'] ?? '' == 1) checked @endif name="enable_sms_user_update_booking" value="1"> {{__("Habilitar envio de SMS ao cliente ao atualizar reserva?")}}</label>
                                </div>
                            @else
                                <div class="form-group">
                                    <label> <input type="checkbox" @if($settings['enable_sms_user_has_booking'] ?? '' == 1) checked @endif name="enable_sms_user_has_booking" disabled value="1"> {{__("Habilitar envio de SMS ao cliente ao atualizar reserva?")}}</label>
                                </div>
                                @if(@$settings['enable_sms_user_update_booking'] != 1)
                                    <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                                @endif
                            @endif
                            <div class="form-group" data-condition="enable_sms_user_update_booking:is(1)">
                                <label>{{__("Mensagem para o cliente")}}</label>
                                <div class="form-controls">
                                    <textarea name="sms_message_user_update_booking" rows="8" class="form-control">{{setting_item_with_lang('sms_message_user_update_booking',request()->query('lang')) ?? '' }}</textarea>
                                </div>
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
        <h3 class="form-group-title">{{__('Teste de SMS')}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <div class="form-controls">
                        <label class="">{{__("País")}}</label>
                        <select name="country" class="form-control" id="country-sms-testing">
                            <option value="">{{__('-- Selecione --')}}</option>
                            @foreach(get_country_lists() as $id=>$name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-controls">
                        <label class="">{{__("Para (phone number)")}}</label>
                        <input type="number" class="form-control" id="to-sms-testing" name="to"></input>
                    </div>

                    <div class="form-controls">
                        <label class="">{{__("Mensagem")}}</label>
                        <textarea class="form-control" id="message-sms-testing" name="message"></textarea>
                    </div>
                    <div class="form-controls">
                        <br>
                        <div id="sms-testing" style="cursor: pointer;" class="btn btn-primary">{{__('Teste de envio de SMS')}}</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-controls">
                        <div id="sms-testing-alert" class="" role="alert">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
