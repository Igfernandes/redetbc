<form class="form bravo-form-register" method="post" action="<?php echo e(route('auth.register.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="<?php echo e(__("Primeiro Nome")); ?>">
                    <i class="input-icon field-icon icofont-waiter-alt"></i>
                    <span class="invalid-feedback error error-first_name"></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="<?php echo e(__("Sobrenome")); ?>">
                    <i class="input-icon field-icon icofont-waiter-alt"></i>
                    <span class="invalid-feedback error error-last_name"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" autocomplete="off" placeholder="<?php echo e(__('Telefone')); ?>">
            <i class="input-icon field-icon icofont-ui-touch-phone"></i>
            <span class="invalid-feedback error error-phone"></span>
        </div>
        <div class="box-icons roles">
            <div>
                <span><?php echo e(__('Selecione seu perfil')); ?>*</span>
                <span class="invalid-feedback error error-role"></span>
            </div>
            <ul>
                <?php if(isset($roles['traveler'])): ?>
                <li>
                    <input type="radio" name="role" value="<?php echo e($roles['traveler']); ?>">
                    <div class="text">
                        <i class="icofont-travelling"></i>
                        <span><?php echo e(__('Traveler')); ?></span>
                    </div>
                </li>
                <?php endif; ?>
                <?php if(isset($roles['presenter'])): ?>
                <li>
                    <input type="radio" name="role" value="<?php echo e($roles['presenter']); ?>">
                    <div class="text">
                        <i class="icofont-hotel-boy-alt"></i>
                        <span><?php echo e(__('Anfitrião')); ?></span>
                    </div>
                </li>
                <?php endif; ?>
                <?php if(isset($roles['hotel'])): ?>
                <li>
                    <input type="radio" name="role" value="<?php echo e($roles['hotel']); ?>">
                    <div class="text">
                        <i class="icofont-building-alt"></i>
                        <span><?php echo e(__('Hotel')); ?></span>
                    </div>
                </li>
                <?php endif; ?>
                <?php if(isset($roles['assistance'])): ?>
                <li>
                    <input type="radio" name="role" value="<?php echo e($roles['assistance']); ?>">
                    <div class="text">
                        <i class="icofont-building-alt"></i>
                        <span><?php echo e(__('Services')); ?></span>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="form-group mt-2">
            <input type="email" class="form-control" name="email" autocomplete="off" placeholder="<?php echo e(__('Email address')); ?>">
            <i class="input-icon field-icon icofont-mail"></i>
            <span class="invalid-feedback error error-email"></span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" autocomplete="off" placeholder="<?php echo e(__('Password')); ?>">
            <i class="input-icon field-icon icofont-ui-password"></i>
            <span class="invalid-feedback error error-password"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="term">
            <input id="term" type="checkbox" name="term" class="mr5">
            <?php echo __("Eu li e aceito os <a href=':link' target='_blank'>Termos e Política de Privacidade</a>",['link'=>get_page_url(setting_item('booking_term_conditions'))]); ?>

            <span class="checkmark fcheckbox"></span>
        </label>
        <div><span class="invalid-feedback error error-term"></span></div>
    </div>
    <?php if(setting_item("user_enable_register_recaptcha")): ?>
    <div class="form-group">
        <?php echo e(recaptcha_field($captcha_action ?? 'register')); ?>

    </div>
    <div><span class="invalid-feedback error error-g-recaptcha-response"></span></div>
    <?php endif; ?>
    <div class="error message-error invalid-feedback"></div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-submit">
            <?php echo e(__('Cadastrar')); ?>

            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>

    <div class="c-grey f14 text-center">
        <?php echo e(__(" Já tem uma conta?")); ?>

        <a href="#" data-target="#login" data-toggle="modal"><?php echo e(__("Conectar-se")); ?></a>
    </div>
</form><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Layout/auth/register-form.blade.php ENDPATH**/ ?>