<form class="form bravo-form-register" method="post" action="{{route('auth.register.store')}}">
    @csrf
    <div class="">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="{{__("Primeiro Nome")}}">
                    <i class="input-icon field-icon icofont-waiter-alt"></i>
                    <span class="invalid-feedback error error-first_name"></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="{{__("Sobrenome")}}">
                    <i class="input-icon field-icon icofont-waiter-alt"></i>
                    <span class="invalid-feedback error error-last_name"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" autocomplete="off" placeholder="{{__('Telefone')}}">
            <i class="input-icon field-icon icofont-ui-touch-phone"></i>
            <span class="invalid-feedback error error-phone"></span>
        </div>
        <div class="box-icons roles">
            <div>
                <span>{{__('Selecione seu perfil')}}*</span>
                <span class="invalid-feedback error error-role"></span>
            </div>
            <ul>
                @if(isset($roles['traveler']))
                <li>
                    <input type="radio" name="role" value="{{$roles['traveler']}}">
                    <div class="text">
                        <i class="icofont-travelling"></i>
                        <span>{{__('Viajante')}}</span>
                    </div>
                </li>
                @endif
                @if(isset($roles['presenter']))
                <li>
                    <input type="radio" name="role" value="{{$roles['presenter']}}">
                    <div class="text">
                        <i class="icofont-hotel-boy-alt"></i>
                        <span>{{__('Anfitrião')}}</span>
                    </div>
                </li>
                @endif
                @if(isset($roles['hotel']))
                <li>
                    <input type="radio" name="role" value="{{$roles['hotel']}}">
                    <div class="text">
                        <i class="icofont-building-alt"></i>
                        <span>{{__('Hotel')}}</span>
                    </div>
                </li>
                @endif
                @if(isset($roles['assistance']))
                <li>
                    <input type="radio" name="role" value="{{$roles['assistance']}}">
                    <div class="text">
                        <i class="icofont-building-alt"></i>
                        <span>{{__('Serviços')}}</span>
                    </div>
                </li>
                @endif
            </ul>
        </div>

        <div class="form-group mt-2">
            <input type="email" class="form-control" name="email" autocomplete="off" placeholder="{{__("E-mail")}}">
            <i class="input-icon field-icon icofont-mail"></i>
            <span class="invalid-feedback error error-email"></span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" autocomplete="off" placeholder="{{__('Senha')}}">
            <i class="input-icon field-icon icofont-ui-password"></i>
            <span class="invalid-feedback error error-password"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="term">
            <input id="term" type="checkbox" name="term" class="mr5">
            {!! __("Eu li e aceito os <a href=':link' target='_blank'>Termos e Política de Privacidade</a>",['link'=>get_page_url(setting_item('booking_term_conditions'))]) !!}
            <span class="checkmark fcheckbox"></span>
        </label>
        <div><span class="invalid-feedback error error-term"></span></div>
    </div>
    @if(setting_item("user_enable_register_recaptcha"))
    <div class="form-group">
        {{recaptcha_field($captcha_action ?? 'register')}}
    </div>
    <div><span class="invalid-feedback error error-g-recaptcha-response"></span></div>
    @endif
    <div class="error message-error invalid-feedback"></div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-submit">
            {{ __('Cadastrar') }}
            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>

    <div class="c-grey f14 text-center">
        {{__(" Já tem uma conta?")}}
        <a href="#" data-target="#login" data-toggle="modal">{{__("Conectar-se")}}</a>
    </div>
</form>