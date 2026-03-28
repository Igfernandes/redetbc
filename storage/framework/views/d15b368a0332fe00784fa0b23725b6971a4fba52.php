<style>
    .js-header-fix-moment {
        box-shadow: 1px 1px 4px #dddddd;
    }

    .js-header-fix-moment .filter-key span {
        color: black;
    }

    .js-header-fix-moment .filter-key i {
        color: #003583;
        text-shadow: 0 0 BLACK;
    }

    .subscribe-plan-mobile {
        display: none;
    }

    @media (max-width: 700px) {
        .subscribe-plan {
            display: none;
        }

        .subscribe-plan-mobile {
            display: block;
        }
    }

    .subscribe-plan .content,
    .subscribe-plan-mobile .content {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ffa636;
        font-weight: 500;
        padding: 10px;
    }

    .subscribe-plan .content a,
    .subscribe-plan-mobile .content a {
        margin-left: 4px;
    }

    .subscribe-plan .content a:hover,
    .subscribe-plan-mobile .content a:hover {
        color: #fff;
    }

    @media (max-width: 768px) {

        .subscribe-plan .content a,
        .subscribe-plan-mobile .content a {
            width: 41%;
            font-size: 0.7rem;
            background: #19427f;
            color: #fff;
            text-align: center;
            padding: 5px;
            text-decoration: none;
            font-weight: 500;
            border-radius: 3px;
        }
    }

    @media (max-width: 380px) {

        .subscribe-plan .content a,
        .subscribe-plan-mobile .content a {
            font-size: 0.65rem;
        }
    }

    @media (max-width: 330px) {

        .subscribe-plan .content a,
        .subscribe-plan-mobile .content a {
            font-size: 0.6rem;
            width: 37%;
        }
    }

    .subscribe-plan .content p,
    .subscribe-plan-mobile .content p {
        color: #fff;
        margin: 0;
    }

    @media (max-width: 768px) {

        .subscribe-plan .content p,
        .subscribe-plan-mobile .content p {
            width: 53%;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 380px) {

        .subscribe-plan .content p,
        .subscribe-plan-mobile .content p {
            font-size: 0.65rem;
        }
    }

    @media (max-width: 330px) {

        .subscribe-plan .content p,
        .subscribe-plan-mobile .content p {
            font-size: 0.6rem;
            width: 56%;
        }
    }

    .subscribe-plan-mobile {
        width: 100%;
    }

    @media (max-width: 768px) {
        .bravo_wrap .bravo_topbar {
            display: none;
        }
    }

    .menu-main-mobile::-webkit-scrollbar {
        width: 10px;
        /* largura da barra vertical */
        height: 10px;
        /* altura da barra horizontal */
    }

    .menu-main-mobile::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* fundo da barra */
        border-radius: 4px;
    }

    .menu-main-mobile::-webkit-scrollbar-thumb {
        background-color: #1a2b48;
        /* cor da barra de rolagem */
        border-radius: 4px;
        border: 2px solid #f1f1f1;
        /* espaço entre thumb e track */
    }

    .menu-main-mobile::-webkit-scrollbar-thumb {
        background-color: #16203a;
        /* cor ao passar o mouse */
    }

    /* Para Firefox */
    .menu-main-mobile {
        scrollbar-width: thin;
        /* "thin" ou "auto" */
        scrollbar-color: #1a2b48 #f1f1f1;
        /* thumb e track */
    }

    .menu-main-content {
        position: relative;
    }

    .menu-main-content .arrows .arrow {
        transform: rotate(90deg);
        color: #1a2b48;
        text-shadow: 0 0 BLACK;
        font-size: 1.2rem;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 55px;
        height: 28px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #2196F3;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<?php
$religion = session('FILTER_RELIGION');

if (isset($_GET['religion'])) {
    session(['FILTER_RELIGION' => $_GET['religion']]);
    $religion =  $_GET['religion'];
}
?>
<header id="header"
    class="<?php if(!empty($is_home) or !empty($header_transparent)): ?>

            u-header u-header--abs-top u-header--white-nav-links-xl u-header--bg-transparent u-header--show-hide border-bottom border-xl-bottom-0 border-color-white

        <?php else: ?>

            header-white u-header u-header--dark-nav-links-xl u-header--show-hide-xl u-header--static-xl border-bottom

        <?php endif; ?>"

    data-header-fix-moment="500" data-header-fix-effect="slide">
    <?php if(Auth::user() == null || (Auth::user()->user_plan && Auth::user()->user_plan->status != 1)): ?>
    <div class="subscribe-plan">
        <div class="content">
            <?php if(Auth::user() && (!Auth::user()->user_plan || Auth::user()->user_plan->status != 1)): ?>
            <p>
                <?php echo e(__("Junte-se ao clube: escolha seu plano e tenha acesso completo.")); ?>

            </p> &nbsp;
            <?php else: ?>
            <p>
                <?php echo e(__("Viaje com 0 taxas. Seja Membro.")); ?>

            </p> &nbsp;
            <?php endif; ?>

            <?php if(Auth::user() == null): ?>
            <a data-target="#register" data-toggle="modal"><?php echo e(__("Cadastre-se Agora")); ?></a>
            <?php else: ?>
            <a href="/plan"><?php echo e(__("Escolha seu plano")); ?></a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php
    $authUser = Auth::user();
    ?>

    <?php if( !empty($authUser) && !empty($authUser->user_plan)): ?>
    <?php if( $authUser->user_plan->status === 1 && $authUser->user_plan->isValid() === 0): ?>
    <div class="subscribe-plan">
        <div class="content">
            <p>
                <?php echo e(__("Seu plano expirou. Renove e continue fazendo parte da comunidade.")); ?>

            </p> &nbsp;
            <a href="<?php echo e(route('user.plan')); ?>"><?php echo e(__("Renovar Agora")); ?></a>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <?php if(hasUpgradePlanRequest() && !Route::is('user.upgrade_vendor_plans')): ?>
    <div class="upgrade-plan ">
        <div class="content d-flex justify-content-center text-center py-2 bg-warning">
            <p class="mb-0">
                <?php echo e(__("Sua solicitação de atualização de plano foi aprovada.")); ?>

            </p> &nbsp;&nbsp;
            <a href="<?php echo e(route('user.upgrade_vendor_plans')); ?>"><?php echo e(__("Complete a atualização do plano")); ?></a>
        </div>
    </div>
    <?php endif; ?>

    <div class="u-header__section u-header__shadow-on-show-hide">

        <?php echo $__env->make('Layout::parts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="bravo_header">

            <div class="<?php echo e($container_class ?? 'container'); ?>">

                <div class="content">

                    <div class="header-left">

                        <div class="box-content d-flex  align-items-center " style="cursor: pointer;">
                            <div class="col-12 col-lg-6 px-0 d-flex justify-content-between">
                                <div class="w-100 d-flex justify-content-between align-items-center">
                                    <a href="<?php echo e(url(app_get_locale(false,'/'))); ?>" class="bravo-logo navbar-brand u-header__navbar-brand-default u-header__navbar-brand-center u-header__navbar-brand-text-white mr-0 mr-xl-5">

                                        <?php if($logo_id = setting_item("logo_id")): ?>

                                        <?php $logo = get_file_url($logo_id, 'full') ?>

                                        <img src="<?php echo e($logo); ?>" alt="<?php echo e(setting_item("site_title")); ?>">

                                        <?php endif; ?>

                                    </a>
                                    <a class="bravo-logo navbar-brand u-header__navbar-brand u-header__navbar-brand-center u-header__navbar-brand-on-scroll" href="<?php echo e(url(app_get_locale(false,'/'))); ?>">

                                        <?php if($logo_id = setting_item("logo_id_2")): ?>

                                        <?php $logo = get_file_url($logo_id, 'full') ?>

                                        <img src="<?php echo e($logo); ?>" alt="<?php echo e(setting_item("site_title")); ?>">

                                        <?php endif; ?>


                                    </a>
                                </div>
                                <button class="ml-2 bravo-more-menu">

                                    <i class="fa fa-bars"></i>

                                </button>
                            </div>
                            <?php if(Auth::user() == null || (Auth::user()->user_plan && Auth::user()->user_plan->status != 1)): ?>
                            <div class="subscribe-plan-mobile">
                                <div class="content">
                                    <?php if(Auth::user() && !Auth::user()->user_plan): ?>
                                    <p>
                                        <?php echo e(__("Junte-se ao clube: escolha seu plano e tenha acesso completo.")); ?>

                                    </p> &nbsp;
                                    <?php else: ?>
                                    <p>
                                        <?php echo e(__("Viaje com 0 taxas. Seja Membro.")); ?>

                                    </p> &nbsp;
                                    <?php endif; ?>

                                    <?php if(Auth::user() == null): ?>
                                    <a data-target="#register" data-toggle="modal"><?php echo e(__("Cadastre-se Agora")); ?></a>
                                    <?php else: ?>
                                    <a href="/plan"><?php echo e(__("Escolha seu plano")); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="filter-key d-flex  ml-2 mt-3 mt-md-0" style="align-items: center;">
                                <a class="mb-2" href="<?= url()->current() ?>?religion=CATHOLIC">
                                    <span class="text" <?php if($religion==="CATHOLIC" ): ?> style="color: #ffae00;" <?php endif; ?>>
                                        <strong> <?php echo e(__('Católico')); ?></strong>
                                    </span>
                                </a>
                                <label class="switch mx-2">
                                    <input type="checkbox" <?php echo e($religion==="EVANGELICAL" ? 'checked' : ''); ?>>
                                    <span class="slider round"></span>
                                </label>
                                <a class="mb-2" href="<?= url()->current() ?>?religion=EVANGELICAL">
                                    <span class="text" <?php if($religion==="EVANGELICAL" ): ?> style="color: #ffae00;" <?php endif; ?>>
                                        <strong><?php echo e(__('Evangélico')); ?></strong>
                                    </span>
                                </a>
                            </div>
                            <script>
                                const switcher = document.querySelector('.switch input');
                                switcher.addEventListener('change', function() {
                                    if (this.checked) {
                                        window.location.href = '<?= url()->current() ?>?religion=EVANGELICAL';
                                    } else {
                                        window.location.href = '<?= url()->current() ?>?religion=CATHOLIC';
                                    }
                                });
                            </script>
                        </div>

                        <div class="bravo-menu">

                            <?php generate_menu('primary') ?>

                        </div>

                    </div>

                    <div class="header-right">

                        <?php if(!empty($header_right_menu)): ?>

                        <ul class="topbar-items">

                            <?php echo $__env->make('Core::frontend.currency-switcher', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php if(!Auth::id()): ?>

                            <li class="login-item">

                                <a href="#login" data-toggle="modal" data-target="#login" class="login"><?php echo e(__('Conectar-se')); ?></a>

                            </li>

                            <li class="signup-item">

                                <a href="#register" data-toggle="modal" data-target="#register" class="signup"><?php echo e(__('Cadastrar-se')); ?></a>

                            </li>

                            <?php else: ?>

                            <li class="login-item dropdown">

                                <a href="#" data-toggle="dropdown" class="is_login">

                                    <?php if($avatar_url = Auth::user()->getAvatarUrl()): ?>

                                    <img class="avatar" src="<?php echo e($avatar_url); ?>" alt="<?php echo e(Auth::user()->getDisplayName()); ?>">

                                    <?php else: ?>

                                    <span class="avatar-text"><?php echo e(ucfirst( Auth::user()->getDisplayName()[0])); ?></span>

                                    <?php endif; ?>

                                    <?php echo e(__("Oi, :Name",['name'=>Auth::user()->getDisplayName()])); ?>


                                    <i class="fa fa-angle-down"></i>

                                </a>

                                <ul data-menu="navbar" class="dropdown-menu text-left">

                                    <?php if(Auth::user()->hasPermission('dashboard_vendor_access')): ?>

                                    <li><a href="<?php echo e(route('vendor.dashboard')); ?>"><i class="icon ion-md-analytics"></i> <?php echo e(__("Painel do Fornecedor")); ?></a></li>

                                    <?php endif; ?>

                                    <li class="<?php if(Auth::user()->hasPermission('dashboard_vendor_access')): ?> menu-hr <?php endif; ?>">

                                        <a href="<?php echo e(route('user.profile.index')); ?>"><i class="icon ion-md-construct"></i> <?php echo e(__("Meu perfil")); ?></a>

                                    </li>

                                    <?php if(setting_item('inbox_enable')): ?>

                                    <li class="menu-hr"><a href="<?php echo e(route('user.chat')); ?>"><i class="fa fa-comments"></i> <?php echo e(__("Reservas")); ?></a></li>

                                    <?php endif; ?>

                                    <?php if(Auth::user()->is_verified === 1): ?>
                                    <li class="menu-hr"><a href="<?php echo e(route('user.booking_history')); ?>"><i class="fa fa-clock-o"></i> <?php echo e(__("Histórico de Reservas")); ?></a></li>
                                    <?php endif; ?>
                                    <li class="menu-hr"><a href="<?php echo e(route('user.change_password')); ?>"><i class="fa fa-lock"></i> <?php echo e(__("Alterar senha")); ?></a></li>

                                    <?php if(Auth::user()->hasPermission('dashboard_access')): ?>

                                    <li class="menu-hr"><a href="<?php echo e(url('/admin')); ?>"><i class="icon ion-ios-ribbon"></i> <?php echo e(__("Painel do Administrador")); ?></a></li>


                                    <?php endif; ?>

                                    <li class="menu-hr">

                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <?php echo e(__("Sair")); ?></a>

                                    </li>

                                </ul>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">

                                    <?php echo e(csrf_field()); ?>


                                </form>

                            </li>

                            <?php endif; ?>

                        </ul>

                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="bravo-menu-mobile" style="display:none;">

                <div class="user-profile">

                    <div class="b-close"><i class="icofont-scroll-left"></i></div>

                    <div class="avatar"></div>


                    <div class="menu-main-content">
                        <!-- <div class="arrows">
                            <span class="arrow">
                                < </span>
                                    <span> ></span>
                        </div> -->
                        <ul class="menu-main-mobile" style="overflow: scroll;height: 46vh;">

                            <?php if(!Auth::id() || Auth::user() === null ): ?>

                            <li>

                                <a href="#login" data-toggle="modal" data-target="#login" class="login"><?php echo e(__('Entrar')); ?></a>

                            </li>

                            <li>

                                <a href="#register" data-toggle="modal" data-target="#register" class="signup"><?php echo e(__('Cadastrar-se')); ?></a>

                            </li>

                            <?php else: ?>

                            <li>

                                <a href="<?php echo e(route('user.profile.index')); ?>">

                                    </i> <?php echo e(__("Oi, :Name",['name'=>Auth::user()->getDisplayName()])); ?>


                                </a>

                            </li>

                            <li style="margin-top: 2rem;">

                                <a href="<?php echo e(route('user.profile.index')); ?>">
                                    <i class="icon ion-md-construct"></i> <?php echo e(__("Meu perfil")); ?>

                                </a>
                            </li>
                            <?php if(Auth::user()->is_verified === 1): ?>
                            <li>
                                <a href="<?php echo e(route('user.plan')); ?>">
                                    <span class="icon text-center"><i class="fa fa-list-alt"></i></span>
                                    Meu Plano
                                </a>
                            </li>
                            <?php endif; ?>

                            <?php echo $__env->make('Layout::parts.authmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php if(Auth::user()->hasPermission('dashboard_vendor_access')): ?>

                            <li>

                                <a href="<?php echo e(route('vendor.dashboard')); ?>">

                                    <i class="icon ion-md-analytics"></i> <?php echo e(__("Painel do Fornecedor")); ?>


                                </a>

                            </li>

                            <?php endif; ?>

                            <?php if(Auth::user()->hasPermission('dashboard_access') && Auth::user()->is_verified === 1): ?>

                            <li>

                                <a href="<?php echo e(url('/admin')); ?>"><i class="icon ion-ios-ribbon"></i> <?php echo e(__("Painel do Administrador")); ?></a>

                            </li>

                            <?php endif; ?>

                            <li style="margin-top: 2rem;">

                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">

                                    <i class="fa fa-sign-out"></i> <?php echo e(__("Sair")); ?>


                                </a>

                                <form id="logout-form-mobile" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">

                                    <?php echo e(csrf_field()); ?>


                                </form>

                            </li>



                            <?php endif; ?>

                        </ul>
                    </div>

                    <ul class="multi-lang">

                        <?php echo $__env->make('Core::frontend.currency-switcher-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </ul>

                </div>

                <div class="g-menu">

                    <?php generate_menu('primary') ?>

                </div>

            </div>

        </div>

    </div>

</header><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Mytravel/Layout/parts/header.blade.php ENDPATH**/ ?>