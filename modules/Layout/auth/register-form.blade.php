<form class="form bravo-form-register" method="post" action="{{route('auth.register.store')}}">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="{{__("First Name")}}">
                <i class="input-icon field-icon icofont-waiter-alt"></i>
                <span class="invalid-feedback error error-first_name"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="{{__("Last Name")}}">
                <i class="input-icon field-icon icofont-waiter-alt"></i>
                <span class="invalid-feedback error error-last_name"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="phone" autocomplete="off" placeholder="{{__('Phone')}}">
        <i class="input-icon field-icon icofont-ui-touch-phone"></i>
        <span class="invalid-feedback error error-phone"></span>
    </div>
    <div class="form-group">
        <label>{{__('Religion')}}</label>
        <br>
        <select name="religion" class="custom-select">
            <option value="">{{__('-- Please select --')}}</option>
            <option value="CATHOLIC">{{__("Catholic")}}</option>
            <option value="EVANGELICAL">{{__("Evangelical")}}</option>
            <option value="EVANGELICAL">{{__("Both")}}</option>
        </select>
        <span class="invalid-feedback error error-religion"></span>
    </div>
    <div class="form-group">
        <label>{{__('Sex')}}</label>
        <br>
        <select name="sex" class="custom-select">
            <option value="">{{__('-- Please select --')}}</option>
            <option value="MASCULINE">{{__("Masculine")}}</option>
            <option value="FEMININE">{{__("Feminine")}}</option>
        </select>
        <span class="invalid-feedback error error-religion"></span>
    </div>

    <div class="form-group mt-2">
        <input type="email" class="form-control" name="email" autocomplete="off" placeholder="{{__('Email address')}}">
        <i class="input-icon field-icon icofont-mail"></i>
        <span class="invalid-feedback error error-email"></span>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="{{__('Password')}}">
        <i class="input-icon field-icon icofont-ui-password"></i>
        <span class="invalid-feedback error error-password"></span>
    </div>
    <div class="form-group">
        <label for="term">
            <input id="term" type="checkbox" name="term" class="mr5">
            {!! __("I have read and accept the <a href=':link' target='_blank'>Terms and Privacy Policy</a>",['link'=>get_page_url(setting_item('booking_term_conditions'))]) !!}
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
            {{ __('Sign Up') }}
            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>
   
    <div class="c-grey f14 text-center">
        {{__(" Already have an account?")}}
        <a href="#" data-target="#login" data-toggle="modal">{{__("Log In")}}</a>
    </div>
</form>