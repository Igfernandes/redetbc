<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Opções de Planos de Usuário")}}</h3>
        <p class="form-group-desc">{{__('Configurar página de planos de usuário')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                @if(is_default_lang())
                <div class="form-group">
                    <label>{{__("Habilitar Planos de Usuário")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="user_plans_enable" value="1" @if(!empty($settings['user_plans_enable'])) checked @endif /> {{__("Ligado")}} </label>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label> <input type="checkbox" @if(setting_item('user_plans_enable') ?? ''==1) checked @endif name="user_plans_enable" disabled value="1"> {{__("Ligado")}}</label>
                </div>
                @if(setting_item('user_plans_enable')!= 1)
                <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                @endif
                @endif


                <div data-condition="user_plans_enable:is(1)">
                    <div class="form-group">
                        <label>{{__("Título da Página")}}</label>
                        <div class="form-controls">
                            <input type="text" name="user_plans_page_title" class="form-control" value="{{setting_item_with_lang('user_plans_page_title',request()->query('lang')) ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Subtítulo da Página")}}</label>
                        <div class="form-controls">
                            <input type="text" name="user_plans_page_sub_title" class="form-control" value="{{setting_item_with_lang('user_plans_page_sub_title',request()->query('lang')) ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Texto de Venda")}}</label>
                        <div class="form-controls">
                            <input type="text" name="user_plans_sale_text" class="form-control" value="{{setting_item_with_lang('user_plans_sale_text',request()->query('lang')) ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Habilitar Múltiplos Planos de Usuário")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="user_plans_multiple_buy" value="1" @if(!empty($settings['enable_multi_user_plans'])) checked @endif /> {{__("Ligado")}} </label>
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
        <h3 class="form-group-title">{{__("Opções de Solicitação de Plano")}}</h3>
        <div class="form-group-desc">{{ __('Conteúdo do email enviado ao Cliente ou Administrador.')}}
            @foreach(\Modules\User\Emails\PlanPaymentEmail::CODE as $item=>$value)
            <div><code>{{$value}}</code></div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel" data-condition="user_plans_enable:is(1)">
            <div class="panel-title"><strong>{{__("Nova solicitação de plano")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#NewRequestPlanAdmin">{{__("Administrador")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#NewRequestPlanUser">{{__("Cliente")}}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="NewRequestPlanAdmin">
                            @if(is_default_lang())
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('plan_new_payment_admin_enable')?? ''==1) checked @endif name="plan_new_payment_admin_enable" value="1"> {{__("Habilitar envio de email para o Administrador?")}}</label>
                            </div>
                            @else
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('plan_new_payment_admin_enable') ?? ''==1) checked @endif name="plan_new_payment_admin_enable" disabled value="1"> {{__("Habilitar envio de email para o Administrador?")}}</label>
                            </div>
                            @if(setting_item('plan_new_payment_admin_enable')!= 1)
                            <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                            @endif
                            @endif
                            <div data-condition="plan_new_payment_admin_enable:is(1)">
                                <div class="form-group">
                                    <label>{{__("Assunto")}}</label>
                                    <div class="form-controls">
                                        <textarea name="plan_new_payment_admin_subject" rows="8" class="form-control">{{setting_item_with_lang('plan_new_payment_admin_subject',request()->query('lang')) ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__("Mensagem")}}</label>
                                    <div class="form-controls">
                                        <textarea name="plan_new_payment_admin_content" rows="8" class="form-control">{{setting_item_with_lang('plan_new_payment_admin_content',request()->query('lang')) ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="NewRequestPlanUser">
                            @if(is_default_lang())
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('plan_new_payment_user_enable')?? ''==1) checked @endif name="plan_new_payment_user_enable" value="1"> {{__("Habilitar envio de email para o cliente?")}}</label>
                            </div>
                            @else
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('plan_new_payment_user_enable') ?? ''==1) checked @endif name="plan_new_payment_user_enable" disabled value="1"> {{__("Habilitar envio de email para o cliente?")}}</label>
                            </div>
                            @if(setting_item('plan_new_payment_user_enable')!= 1)
                            <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                            @endif
                            @endif
                            <div data-condition="plan_new_payment_user_enable:is(1)">
                                <div class="form-group">
                                    <label>{{__("Assunto")}}</label>
                                    <div class="form-controls">
                                        <textarea name="plan_new_payment_user_subject" rows="8" class="form-control">{{setting_item_with_lang('plan_new_payment_user_subject',request()->query('lang')) ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__("Mensagem")}}</label>
                                    <div class="form-controls">
                                        <textarea name="plan_new_payment_user_content" rows="8" class="form-control">{{setting_item_with_lang('plan_new_payment_user_content',request()->query('lang')) ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel" data-condition="user_plans_enable:is(1)">
            <div class="panel-title"><strong>{{__("Atualizar solicitação de plano")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#UpdateRequestPlanAdmin">{{__("Administrador")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#UpdateRequestPlanUser">{{__("Cliente")}}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="UpdateRequestPlanAdmin">
                            @if(is_default_lang())
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('plan_update_payment_admin_enable')?? ''==1) checked @endif name="plan_update_payment_admin_enable" value="1"> {{__("Habilitar envio de email para o Administrador?")}}</label>
                            </div>
                            @else
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('plan_update_payment_admin_enable') ?? ''==1) checked @endif name="plan_update_payment_admin_enable" disabled value="1"> {{__("Habilitar envio de email para o Administrador?")}}</label>
                            </div>
                            @if(setting_item('plan_update_payment_admin_enable')!= 1)
                            <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                            @endif
                            @endif
                            <div data-condition="plan_update_payment_admin_enable:is(1)">
                                <div class="form-group">
                                    <label>{{__("Assunto")}}</label>
                                    <div class="form-controls">
                                        <textarea name="plan_update_payment_admin_subject" rows="8" class="form-control">{{setting_item_with_lang('plan_update_payment_admin_subject',request()->query('lang')) ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__("Mensagem")}}</label>
                                    <div class="form-controls">
                                        <textarea name="plan_update_payment_admin_content" rows="8" class="form-control">{{setting_item_with_lang('plan_update_payment_admin_content',request()->query('lang')) ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="UpdateRequestPlanUser">
                            @if(is_default_lang())
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('plan_update_payment_user_enable')?? ''==1) checked @endif name="plan_update_payment_user_enable" value="1"> {{__("Habilitar envio de email para o cliente?")}}</label>
                            </div>
                            @else
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('plan_update_payment_user_enable') ?? ''==1) checked @endif name="plan_update_payment_user_enable" disabled value="1"> {{__("Habilitar envio de email para o cliente?")}}</label>
                            </div>
                            @if(setting_item('plan_update_payment_user_enable')!= 1)
                            <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                            @endif
                            @endif
                            <div data-condition="plan_update_payment_user_enable:is(1)">
                                <div class="form-group">
                                    <label>{{__("Assunto")}}</label>
                                    <div class="form-controls">
                                        <textarea name="plan_update_payment_user_subject" rows="8" class="form-control">{{setting_item_with_lang('plan_update_payment_user_subject',request()->query('lang')) ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__("Mensagem")}}</label>
                                    <div class="form-controls">
                                        <textarea name="plan_update_payment_user_content" rows="8" class="form-control">{{setting_item_with_lang('plan_update_payment_user_content',request()->query('lang')) ?? '' }}</textarea>
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