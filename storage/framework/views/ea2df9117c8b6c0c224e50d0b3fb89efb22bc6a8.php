<?php
$isVerification = null !== auth()->user() ? is_admin() ?? auth()->user()->is_verification : false;
?>
<div class="bravo_topbar u-header__hide-content u-header__topbar u-header__topbar-lg border-bottom <?php if(!empty($is_home)|| !empty($header_transparent)): ?>border-color-white <?php else: ?>  border-color-8 <?php endif; ?>">
    <div class="<?php echo e($container_class ?? 'container'); ?>">
        <div class="d-flex align-items-center">
            <div class="list-inline u-header__topbar-nav-divider mb-0 topbar_left_text font-size-14 <?php if(!empty($is_home)|| !empty($header_transparent)): ?> <?php else: ?>  list-inline-dark <?php endif; ?>">
                <?php echo setting_item_with_lang("topbar_left_text"); ?>

            </div>
            <div class="ml-auto d-flex align-items-center">
                <?php if(!empty($phone_contact = setting_item("Celular_contact"))): ?>
                <div class="d-flex align-items-center  px-3" style="color:#003583;">
                    <i class="flaticon-phone-call mr-2 ml-1 font-size-18"></i>
                    <span class="d-inline-block font-size-14 mr-1"><?php echo e($phone_contact); ?></span>
                </div>
                <?php endif; ?>
                <?php echo $__env->make('Core::frontend.currency-switcher', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('Layout::parts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="position-relative px-3 u-header__login-form dropdown-connector-xl u-header__topbar-divider">
                    <?php if(!Auth::id() || null === Auth::user()): ?>
                    <a href="javascript:;" class="d-flex align-items-center  py-3"
                        data-toggle="modal" data-target="#login">
                        <i class="flaticon-user mr-2 ml-1 font-size-18"></i>
                        <span class="d-inline-block font-size-14 mr-1"><?php echo e(__("Conecte-se ou cadastra-se")); ?></span>
                    </a>
                    <?php else: ?>
                    <div class="d-flex align-items-center  py-3 dropdown">
                        <i class="flaticon-user mr-2 ml-1 font-size-18"></i>
                        <span class="d-inline-block font-size-14 mr-1 dropdown-nav-link" data-toggle="dropdown">
                            <?php echo e(__("Oi, :name",['name'=>Auth::user()->getDisplayName()])); ?>


                        </span>

                        <ul class="dropdown-menu dropdown-menu-user text-left dropdown">
                            <?php if(is_vendor() && $isVerification): ?>
                            <li class=""><a href="<?php echo e(route('vendor.dashboard')); ?>" class=""><i class="icon ion-md-analytics"></i> <?php echo e(__("Fornecedor Dashboard")); ?></a></li>
                            <?php endif; ?>
                            <li class="<?php if(is_vendor()): ?>  <?php endif; ?>">
                                <a href="<?php echo e(route('user.profile.index')); ?>"><i class="icon ion-md-construct"></i> <?php echo e(__("Meu perfil")); ?></a>
                            </li>
                            <li class="<?php if(is_vendor()): ?>  <?php endif; ?>">
                                <a href="<?php echo e(route('user.verification.index')); ?>"><i class="fa fa-id-card-o"></i> <?php echo e(__("Verificação")); ?></a>
                            </li>
                            <?php if(auth()->user()->is_verified && auth()->user()->user_plan->isValid() === 1): ?>
                            <li class=""><a href="<?php echo e(route('user.network')); ?>"><i class="fa fa-globe"></i> <?php echo e(__("Minha Rede")); ?></a></li>
                            <li class=""><a href="<?php echo e(route('user.booking_history')); ?>"><i class="fa fa-clock-o"></i> <?php echo e(__("Histórico de Reservas")); ?></a></li>
                            <li class=""><a href="<?php echo e(route('user.chat')); ?>"><i class="fa fa-comments"></i> <?php echo e(__("Chat")); ?></a></li>
                            <li class=""><a href="<?php echo e(route('user.plan')); ?>"><i class="fa fa-list-alt"></i> <?php echo e(__("Meu plano")); ?></a></li>
                            <?php endif; ?>
                            <li class=""><a href="<?php echo e(route('user.change_password')); ?>"><i class="fa fa-lock"></i> <?php echo e(__("Alterar senha")); ?></a></li>
                            <?php if(is_admin()): ?>
                            <li class=""><a href="<?php echo e(url('/admin')); ?>"><i class="icon ion-ios-ribbon"></i> <?php echo e(__("Painel de administração")); ?></a></li>
                            <?php endif; ?>


                            <li class="">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> <?php echo e(__("Sair")); ?></a>
                            </li>
                        </ul>
                        <form id="logout-form-topbar" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Mytravel/Layout/parts/topbar.blade.php ENDPATH**/ ?>