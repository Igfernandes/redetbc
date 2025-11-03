@if(is_default_lang())
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Check-out de convidado')}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" >{{__("Ativar check-out de convidado")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="booking_guest_checkout" value="1" @if(!empty($settings['booking_guest_checkout'])) checked @endif /> {{__("Sim, por favor")}} </label>
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="" >{{__("Habilitar informações do ingresso/convidado")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="booking_enable_ticket_guest_info" value="1" @if(!empty($settings['booking_enable_ticket_guest_info'])) checked @endif /> {{__("Sim, por favor")}} </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Página de check-out')}}</h3>
        <p class="form-group-desc">{{__('Altere as opções da sua página de checkout')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" >{{__("Habilitar formulário de reserva do reCapcha")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="booking_enable_recaptcha" value="1" @if(!empty($settings['booking_enable_recaptcha'])) checked @endif /> {{__("No ReCaptcha")}} </label>
                        <br>
                        <small class="form-text text-muted">{{__("Ative o modo para formulário de reserva")}}</small>
                    </div>
                </div>
                <div class="form-group">
                    <label >{{__("Página de Termos e Condições")}}</label>
                    <div class="form-controls">
                        <?php
                            $template = !empty($settings['booking_term_conditions']) ? \Modules\Page\Models\Page::find($settings['booking_term_conditions'] ) : false;
                            \App\Helpers\AdminForm::select2('booking_term_conditions',[
                            'configs'=>[
                                    'ajax'=>[
                                        'url'=>route('page.admin.getForSelect2'),
                                        'dataType'=>'json'
                                    ]
                                ]
                            ],
                            !empty($template->id) ? [$template->id,$template->title] :false
                            )
                        ?>
                    </div>
                </div>
                @php do_action(\Modules\Booking\Hook::BOOKING_SETTING_AFTER_TERM, $settings) @endphp
            </div>
        </div>
    </div>
</div>
<hr>
@endif
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Página da fatura')}}</h3>
        <p class="form-group-desc">{{__('Alterar as opções da página da fatura')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label>{{__("Logotipo da fatura")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('logo_invoice_id',$settings['logo_invoice_id'] ?? '') !!}
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="">{{__("Informações da empresa de fatura")}}</label>
                    <div class="form-controls">
                        <textarea name="invoice_company_info" class="d-none has-ckeditor" cols="30" rows="10">{{setting_item_with_lang('invoice_company_info',request()->query('lang')) }}</textarea>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<hr>
@php do_action(\Modules\Booking\Hook::BOOKING_SETTING_AFTER_INVOICE) @endphp
