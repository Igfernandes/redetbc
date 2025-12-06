<style>
    .js-header-fix-moment {
        box-shadow: 1px 1px 4px #dddddd;
    }

    .js-header-fix-moment .filter-key span {
        color: black;
    }

    .js-header-fix-moment .filter-key i {
        color: #003583;
    }


    .bravo_wrap .subscribe-plan .content {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ffa636;
        font-weight: 500;
        padding: 10px;
    }

    @media (max-width: 768px) {
        .bravo_wrap .subscribe-plan .content {
            display: block;
        }
    }

    .bravo_wrap .subscribe-plan .content p {
        display: inline;
        color: #fff;
        margin: 0;
    }

    @media (max-width: 768px) {
        .bravo_wrap .subscribe-plan .content p {
            width: 100%;
        }
    }

    .bravo_wrap .subscribe-plan .content a {
        text-decoration: underline;
        margin-left: 4px;
    }

    @media (max-width: 768px) {
        .bravo_wrap .subscribe-plan .content a {
            display: inline;
        }
    }

    @media (max-width: 768px) {
        .bravo_wrap .bravo_topbar {
            display: none;
        }
    }
</style>
<?php
$religion = null;

if (isset($_GET['religion'])) {
    session(['FILTER_RELIGION' => $_GET['religion']]);
    $religion = session('FILTER_RELIGION');
}
?>
<header id="header"
    class="<?php if(!empty($is_home) or !empty($header_transparent)): ?>

            u-header u-header--abs-top u-header--white-nav-links-xl u-header--bg-transparent u-header--show-hide border-bottom border-xl-bottom-0 border-color-white

        <?php else: ?>

            header-white u-header u-header--dark-nav-links-xl u-header--show-hide-xl u-header--static-xl border-bottom

        <?php endif; ?>"

    data-header-fix-moment="500" data-header-fix-effect="slide">
    <?php if(Auth::user() == null || !Auth::user()->user_plan): ?>
    <div class="subscribe-plan">
        <div class="content">
            <?php if(Auth::user() && Auth::user()->user_plan): ?>
            <p>
                <?php echo e(__("Junte-se ao clube: escolha seu plano e tenha acesso completo.")); ?>

            </p> &nbsp;
            <?php else: ?>
            <p>
                <?php echo e(__("Junte-se ao clube: Faça o seu cadastro para ter acesso completo.")); ?>

            </p> &nbsp;
            <?php endif; ?>

            <?php if(Auth::user() == null): ?>
            <a data-target="#register" data-toggle="modal"><?php echo e(__("Cadastre-se agora")); ?></a>
            <?php else: ?>
            <a href="/plan"><?php echo e(__("Escolha seu plano")); ?></a>
            <?php endif; ?>
        </div>
    </div>
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

                        <div class="d-flex align-items-center" style="cursor: pointer;">
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

                            <div class="filter-key  ml-2">
                                <a href="./?religion=CATHOLIC">
                                    <span class="text" <?php if($religion==="CATHOLIC" ): ?> style="color: #ffa636;" <?php endif; ?>>
                                        <?php echo e(__('Católico')); ?>

                                    </span>
                                </a>
                                <i class="icofont-key"></i>
                                <a href="./?religion=EVANGELIC">
                                    <span class="text" <?php if($religion==="EVANGELIC" ): ?> style="color: #ffa636;" <?php endif; ?>>
                                        <?php echo e(__('Evangélico')); ?>

                                    </span>
                                </a>
                            </div>
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

                                <ul class="dropdown-menu text-left">



                                    <?php if(Auth::user()->hasPermission('dashboard_vendor_access')): ?>

                                    <li><a href="<?php echo e(route('vendor.dashboard')); ?>"><i class="icon ion-md-analytics"></i> <?php echo e(__("Painel do Fornecedor")); ?></a></li>

                                    <?php endif; ?>

                                    <li class="<?php if(Auth::user()->hasPermission('dashboard_vendor_access')): ?> menu-hr <?php endif; ?>">

                                        <a href="<?php echo e(route('user.profile.index')); ?>"><i class="icon ion-md-construct"></i> <?php echo e(__("Meu perfil")); ?></a>

                                    </li>

                                    <?php if(setting_item('inbox_enable')): ?>

                                    <li class="menu-hr"><a href="<?php echo e(route('user.chat')); ?>"><i class="fa fa-comments"></i> <?php echo e(__("Reservas")); ?></a></li>

                                    <?php endif; ?>

                                    <li class="menu-hr"><a href="<?php echo e(route('user.booking_history')); ?>"><i class="fa fa-clock-o"></i> <?php echo e(__("Histórico de Reservas")); ?></a></li>

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

                        <button class="bravo-more-menu">

                            <i class="fa fa-bars"></i>

                        </button>

                    </div>

                </div>

            </div>

            <div class="bravo-menu-mobile" style="display:none;">

                <div class="user-profile">

                    <div class="b-close"><i class="icofont-scroll-left"></i></div>

                    <div class="avatar"></div>

                    <ul>

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
                        <li>
                            <a href="/user/verification">
                                <span class="icon text-center"><i class="fa fa-id-card-o"></i></span>
                                Minhas Verificações
                            </a>
                        </li>

                        <li>
                            <a href="/user/network">
                                <span class="icon text-center"><i class="fa fa-sitemap"></i></span>
                                Minha Rede
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost:8000/user/booking-history">
                                <span class="icon text-center"><i class="fa fa-clock-o"></i></span>
                                Minhas Reservas
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost:8000/user/chat">
                                <span class="icon text-center"><i class="fa fa-comments"></i></span>
                                Minhas Mensagens
                            </a>
                        </li>

                        <?php if(Auth::user()->hasPermission('dashboard_vendor_access')): ?>

                        <li>

                            <a href="<?php echo e(route('vendor.dashboard')); ?>">

                                <i class="icon ion-md-analytics"></i> <?php echo e(__("Painel do Fornecedor")); ?>


                            </a>

                        </li>

                        <?php endif; ?>

                        <?php if(Auth::user()->hasPermission('dashboard_access')): ?>

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