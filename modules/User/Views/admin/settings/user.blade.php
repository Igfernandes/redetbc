@if(is_default_lang())
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Opções de registro")}}</h3>
            <p class="form-group-desc">{{__('Opções de configuração de registro')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("Desativar Registro?")}}</label>
                        <div class="form-controls">
                            <label ><input type="checkbox" name="user_disable_register" value="1" @if(setting_item('user_disable_register')) checked @endif> {{__("Sim, por favor desative")}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Função Padrão de Registro do Usuário")}}</label>
                        <div class="form-controls">
                            <select name="user_role" class="form-control">
                                <option value="">{{__('-- Selecione --')}}</option>
                                @foreach(\Modules\User\Models\Role::all() as $role)
                                    <option value="{{$role->id}}" {{setting_item('user_role') == $role->id ? 'selected': ''  }}>{{ucfirst($role->name)}}</option>
                                @endforeach
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
            <h3 class="form-group-title">{{__("Inbox System")}}</h3>
            <p class="form-group-desc">{{__('Opção de configuração da caixa de entrada')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("Permitir que o cliente envie mensagem para o vendedor na página de detalhes")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="inbox_enable" value="1" @if(!empty($settings['inbox_enable'])) checked @endif /> {{__("Sim please")}} </label>
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
            <h3 class="form-group-title">{{__("Opções do Google reCAPTCHA")}}</h3>
            <p class="form-group-desc">{{__('Configurar o Google reCAPTCHA para o sistema')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="">{{__("Habilitar reCAPTCHA no formulário de login")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="user_enable_login_recaptcha" value="1" @if(!empty($settings['user_enable_login_recaptcha'])) checked @endif /> {{__("On")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("Ativar o modo para o formulário de login")}}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{__("Habilitar reCAPTCHA no formulário de registro")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="user_enable_register_recaptcha" value="1" @if(!empty($settings['user_enable_register_recaptcha'])) checked @endif /> {{__("On")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("Ativar o modo para o formulário de registro")}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Desativar recurso de verificação?")}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-title"><strong>{{__("Desativar recurso de verificação")}}</strong></div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-controls">
                            <label><input type="checkbox" name="user_disable_verification_feature" value="1" @if(setting_item('user_disable_verification_feature')) checked @endif > {{__('Yes, please disable it')}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Autenticação de Dois Fatores")}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-title"><strong>{{__("Autenticação de Dois Fatores")}}</strong></div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-controls">
                            <label><input type="checkbox" name="user_enable_2fa" value="1" @if(setting_item('user_enable_2fa')) checked @endif > {{__('Yes, please enable it')}}</label>
                        </div>
                        <p>{{__('Quando a autenticação de dois fatores está ativada, o usuário precisa inserir um código numérico de seis dígitos durante o processo de autenticação. Esse código é gerado usando uma senha de uso único baseada em tempo (TOTP) que pode ser obtida em qualquer aplicativo de autenticação móvel compatível com TOTP, como o Google Authenticator.')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@includeIf('User::admin.settings._permanently_delete')
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Content Email User Registered')}}</h3>
        <div class="form-group-desc">{{ __('Content email send to Customer or Administrator when user registered.')}}
            @foreach(\Modules\User\Listeners\SendMailUserRegisteredListen::CODE as $item=>$value)
                <div><code>{{$value}}</code></div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label> <input type="checkbox" @if($settings['enable_mail_user_registered'] ?? '' == 1) checked @endif name="enable_mail_user_registered" value="1"> {{__("Enable send email to customer when customer registered ?")}}</label>
                    </div>
                @else
                    <div class="form-group">
                        <label> <input type="checkbox" @if($settings['enable_mail_user_registered'] ?? '' == 1) checked @endif disabled name="enable_mail_user_registered" value="1"> {{__("Enable send email to customer when customer registered ?")}}</label>
                    </div>
                    @if($settings['enable_mail_user_registered'] != 1)
                        <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                    @endif
                @endif

                <div class="form-group" data-condition="enable_mail_user_registered:is(1)">
                    <label>{{__("E-mail para conteúdo do cliente")}}</label>
                    <div class="form-controls">
                        <textarea name="user_content_email_registered" class="d-none has-ckeditor" cols="30" rows="10">{{setting_item_with_lang('user_content_email_registered',request()->query('lang')) ?? '' }}</textarea>
                    </div>
                </div>


                @if(is_default_lang())
                    <div class="form-group">
                        <label> <input type="checkbox" @if($settings['admin_enable_mail_user_registered'] ?? '' == 1) checked @endif name="admin_enable_mail_user_registered" value="1"> {{__("Enable send email to Administrator when customer registered ?")}}</label>
                    </div>
                @else
                    <div class="form-group">
                        <label> <input type="checkbox" @if($settings['admin_enable_mail_user_registered'] ?? '' == 1) checked @endif disabled name="admin_enable_mail_user_registered" value="1"> {{__("Enable send email to Administrator when customer registered ?")}}</label>
                    </div>
                        @if($settings['admin_enable_mail_user_registered'] != 1)
                            <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                        @endif
                @endif
                <div class="form-group" data-condition="admin_enable_mail_user_registered:is(1)">
                    <label>{{__("-mail para conteúdo do Administrador")}}</label>
                    <div class="form-controls">
                        <textarea name="admin_content_email_user_registered" class="d-none has-ckeditor" cols="30" rows="10">{{setting_item_with_lang('admin_content_email_user_registered',request()->query('lang'))?? '' }}</textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Conteúdo do E-mail de Verificação do Usuário Registrado')}}</h3>
        <div class="form-group-desc">{{ __('Conteúdo do e-mail de verificação enviado ao cliente quando o usuário se registra.')}}
            @foreach(\Modules\User\Emails\EmailUserVerifyRegister::CODE as $item=>$value)
                <div><code>{{$value}}</code></div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label> <input type="checkbox" @if($settings['enable_verify_email_register_user'] ?? '' == 1) checked @endif name="enable_verify_email_register_user" value="1"> {{__("Enable must verify email when customer registered ?")}}</label>
                    </div>
                @else
                    <div class="form-group">
                        <label> <input type="checkbox" @if($settings['enable_verify_email_register_user'] ?? '' == 1) checked @endif disabled name="enable_verify_email_register_user" value="1"> {{__("Enable must verify email when customer registered ?")}}</label>
                    </div>
                    @if($settings['enable_verify_email_register_user'] != 1)
                        <p>{{__('Você deve habilitar no idioma principal.')}}</p>
                    @endif
                @endif
                <div class="form-group">
                    <label>{{__("Assunto")}}</label>
                    <div class="form-controls">
                        <input type="text" name="subject_email_verify_register_user" class="form-control"  value="{{setting_item_with_lang('subject_email_verify_register_user',request()->query('lang')) ?? '' }}">
                    </div>
                </div>
                <div class="form-group" >
                    <label>{{__("Conteúdo")}}</label>
                    <div class="form-controls">
                        <textarea name="content_email_verify_register_user" class="d-none has-ckeditor" cols="30" rows="10">{{setting_item_with_lang('content_email_verify_register_user',request()->query('lang')) ?? '' }}</textarea>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Content Email User Forgot Password')}}</h3>
        <div class="form-group-desc">
            @foreach(\Modules\User\Emails\ResetPasswordToken::CODE as $item=>$value)
                <div><code>{{$value}}</code></div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                <div class="form-group">
                    <label>{{__("Conteúdo")}}</label>
                    <div class="form-controls">
                        <textarea name="user_content_email_forget_password" class="d-none has-ckeditor" cols="30" rows="10">{{setting_item_with_lang('user_content_email_forget_password',request()->query('lang')) ?? '' }}</textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
