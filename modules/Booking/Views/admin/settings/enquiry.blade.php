@if(is_default_lang())
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('Consulta de configurações para serviço')}}</h3>
            <p class="form-group-desc">{{__('Alterar suas opções de consulta')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Habilitar consulta para Hotel")}}</label>
                                <div class="form-controls">
                                    <label><input type="checkbox" name="booking_enquiry_for_hotel" value="1" @if(!empty($settings['booking_enquiry_for_hotel'])) checked @endif /> {{__("Habilitar formulário de consulta")}} </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{__("Tipo de consulta")}}</label>
                            <div class="form-controls">
                                <select name="booking_enquiry_type_hotel" class="form-control">
                                    <option {{ ($settings['booking_enquiry_type_hotel'] ?? '') == 'booking_and_enquiry' ? 'selected' : '' }} value="booking_and_enquiry">{{__("Reserva e Consulta")}}</option>
                                    <option {{ ($settings['booking_enquiry_type_hotel'] ?? '') == 'only_enquiry' ? 'selected' : '' }} value="only_enquiry">{{__("Apenas consulta")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Habilitar consulta para Tour")}}</label>
                                <div class="form-controls">
                                    <label><input type="checkbox" name="booking_enquiry_for_tour" value="1" @if(!empty($settings['booking_enquiry_for_tour'])) checked @endif /> {{__("Habilitar formulário de consulta")}} </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{__("Tipo de consulta")}}</label>
                            <div class="form-controls">
                                <select name="booking_enquiry_type_tour" class="form-control">
                                    <option {{ ($settings['booking_enquiry_type_tour'] ?? '') == 'booking_and_enquiry' ? 'selected' : '' }} value="booking_and_enquiry">{{__("Reserva e Consulta")}}</option>
                                    <option {{ ($settings['booking_enquiry_type_tour'] ?? '') == 'only_enquiry' ? 'selected' : '' }} value="only_enquiry">{{__("Apenas consulta")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Habilitar consulta para espaço")}}</label>
                                <div class="form-controls">
                                    <label><input type="checkbox" name="booking_enquiry_for_space" value="1" @if(!empty($settings['booking_enquiry_for_space'])) checked @endif /> {{__("Habilitar formulário de consulta")}} </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{__("Tipo de consulta")}}</label>
                            <div class="form-controls">
                                <select name="booking_enquiry_type_space" class="form-control">
                                    <option {{ ($settings['booking_enquiry_type_space'] ?? '') == 'booking_and_enquiry' ? 'selected' : '' }} value="booking_and_enquiry">{{__("Reserva e Consulta")}}</option>
                                    <option {{ ($settings['booking_enquiry_type_space'] ?? '') == 'only_enquiry' ? 'selected' : '' }} value="only_enquiry">{{__("Apenas consulta")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Habilitar consulta para carro")}}</label>
                                <div class="form-controls">
                                    <label><input type="checkbox" name="booking_enquiry_for_car" value="1" @if(!empty($settings['booking_enquiry_for_car'])) checked @endif /> {{__("Habilitar formulário de consulta")}} </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{__("Tipo de Consulta")}}</label>
                            <div class="form-controls">
                                <select name="booking_enquiry_type_car" class="form-control">
                                    <option {{ ($settings['booking_enquiry_type_car'] ?? '') == 'booking_and_enquiry' ? 'selected' : '' }} value="booking_and_enquiry">{{__("Reserva e Consulta")}}</option>
                                    <option {{ ($settings['booking_enquiry_type_car'] ?? '') == 'only_enquiry' ? 'selected' : '' }} value="only_enquiry">{{__("Somente Consulta")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Habilitar consulta para evento")}}</label>
                                <div class="form-controls">
                                    <label><input type="checkbox" name="booking_enquiry_for_event" value="1" @if(!empty($settings['booking_enquiry_for_event'])) checked @endif /> {{__("Habilitar formulário de consulta")}} </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{__("Tipo de Consulta")}}</label>
                            <div class="form-controls">
                                <select name="booking_enquiry_type_event" class="form-control">
                                    <option {{ ($settings['booking_enquiry_type_event'] ?? '') == 'booking_and_enquiry' ? 'selected' : '' }} value="booking_and_enquiry">{{__("Reserva e Consulta")}}</option>
                                    <option {{ ($settings['booking_enquiry_type_event'] ?? '') == 'only_enquiry' ? 'selected' : '' }} value="only_enquiry">{{__("Somente Consulta")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Habilitar consulta para serviço")}}</label>
                                <div class="form-controls">
                                    <label><input type="checkbox" name="booking_enquiry_for_assistance" value="1" @if(!empty($settings['booking_enquiry_for_assistance'])) checked @endif /> {{__("Habilitar formulário de consulta")}} </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{__("Tipo de Consulta")}}</label>
                            <div class="form-controls">
                                <select name="booking_enquiry_type_assistance" class="form-control">
                                    <option {{ ($settings['booking_enquiry_type_assistance'] ?? '') == 'booking_and_enquiry' ? 'selected' : '' }} value="booking_and_enquiry">{{__("Reserva e Consulta")}}</option>
                                    <option {{ ($settings['booking_enquiry_type_assistance'] ?? '') == 'only_enquiry' ? 'selected' : '' }} value="only_enquiry">{{__("Somente Consulta")}}</option>
                                </select>
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
            <h3 class="form-group-title">{{__('Consulta de configurações')}}</h3>
            <p class="form-group-desc">{{__('Alterar suas opções de consulta')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{__("Habilitar re-catpcha para consulta?")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="booking_enquiry_enable_recaptcha" value="1" @if(!empty($settings['booking_enquiry_enable_recaptcha'])) checked @endif /> {{__("Habilitar re-captcha no formulário de consulta")}} </label>
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
            <h3 class="form-group-title">{{__('Configurações de consulta por e-mail')}}</h3>
            <p class="form-group-desc">{{__('Alterar suas opções de consulta por e-mail')}}</p>
            @foreach(\Modules\Booking\Listeners\EnquirySendListen::CODE as $item=>$value)
                <div><code>{{$value}}</code></div>
            @endforeach
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">

                    @if(is_default_lang())
                        <div class="form-group">
                            <label> <input type="checkbox" @if($settings['booking_enquiry_enable_mail_to_vendor'] ?? '' == 1) checked @endif name="booking_enquiry_enable_mail_to_vendor" value="1"> {{__("Habilitar envio de e-mail ao fornecedor")}}</label>
                        </div>
                    @else
                        <div class="form-group">
                            <label> <input type="checkbox" @if($settings['booking_enquiry_enable_mail_to_vendor'] ?? '' == 1) checked @endif disabled name="booking_enquiry_enable_mail_to_vendor" value="1"> {{__("Habilitar envio de e-mail ao fornecedor")}}</label>
                        </div>
                        @if($settings['booking_enquiry_enable_mail_to_vendor'] != 1)
                            <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                        @endif
                    @endif
                    <div class="form-group" data-condition="booking_enquiry_enable_mail_to_vendor:is(1)">
                        <label>{{__("Conteúdo do e-mail para o fornecedor")}}</label>
                        <div class="form-controls">
                            <textarea name="booking_enquiry_mail_to_vendor_content" class="d-none has-ckeditor" cols="30" rows="10">{{setting_item_with_lang('booking_enquiry_mail_to_vendor_content',request()->query('lang'))?? '' }}</textarea>
                        </div>
                    </div>

                    @if(is_default_lang())
                        <div class="form-group">
                            <label> <input type="checkbox" @if($settings['booking_enquiry_enable_mail_to_admin'] ?? '' == 1) checked @endif name="booking_enquiry_enable_mail_to_admin" value="1"> {{__("Habilitar envio de e-mail ao administrador")}}</label>
                        </div>
                    @else
                        <div class="form-group">
                            <label> <input type="checkbox" @if($settings['booking_enquiry_enable_mail_to_admin'] ?? '' == 1) checked @endif disabled name="booking_enquiry_enable_mail_to_admin" value="1"> {{__("Habilitar envio de e-mail ao administrador")}}</label>
                        </div>
                        @if($settings['booking_enquiry_enable_mail_to_admin'] != 1)
                            <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                        @endif
                    @endif
                    <div class="form-group" data-condition="booking_enquiry_enable_mail_to_admin:is(1)">
                        <label>{{__("E-mail para conteúdo do administrador")}}</label>
                        <div class="form-controls">
                            <textarea name="booking_enquiry_mail_to_admin_content" class="d-none has-ckeditor" cols="30" rows="10">{{setting_item_with_lang('booking_enquiry_mail_to_admin_content',request()->query('lang'))?? '' }}</textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
