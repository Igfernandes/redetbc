
<?php $__env->startSection('content'); ?>
    <?php
    $user = \Illuminate\Support\Facades\Auth::user();
    $hasAvailableTools = false;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="d-flex justify-content-between mb20">
                    <h1 class="title-bar"><?php echo e(__('Ferramentas')); ?></h1>
                </div>
                <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="panel">
                    <div class="panel-body pd15">
                        <div class="row area-setting-row">
                            <?php if($user->hasPermission('setting_update')): ?>
                                <?php $hasAvailableTools = true; ?>
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="<?php echo e(route('core.admin.module.index')); ?>">
                                        <span class="setting-item-media">
                                            <i class="icon ion-md-color-wand"></i>
                                        </span>
                                            <span class="setting-item-info">
                                            <span class="setting-item-title"><?php echo e(__("Módulos")); ?></span>
                                            <span class="setting-item-desc"><?php echo e(__("Módulos para o Booking Core")); ?></span>
                                        </span>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($user->hasPermission('language_manage')): ?>
                                <?php $hasAvailableTools = true; ?>
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="<?php echo e(route('language.admin.index')); ?>">
                                            <span class="setting-item-media">
                                                <i class="icon ion-ios-globe"></i>
                                            </span>
                                            <span class="setting-item-info">
                                                <span class="setting-item-title"><?php echo e(__("Idiomas")); ?></span>
                                                <span class="setting-item-desc"><?php echo e(__("Gerenciar idiomas do seu site")); ?></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($user->hasPermission('language_translation')): ?>
                                <?php $hasAvailableTools = true; ?>
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="<?php echo e(route('language.admin.translations.index')); ?>">
                                            <span class="setting-item-media">
                                                <i class="icon ion-ios-globe"></i>
                                            </span>
                                            <span class="setting-item-info">
                                                <span class="setting-item-title"><?php echo e(__("Traduções")); ?></span>
                                                <span class="setting-item-desc"><?php echo e(__("Gerente de tradução do seu site")); ?></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($user->hasPermission('system_log_view')): ?>
                                <?php $hasAvailableTools = true; ?>
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="<?php echo e(url('admin/logs')); ?>">
                                                <span class="setting-item-media">
                                                    <i class="icon ion-ios-nuclear"></i>
                                                </span>
                                            <span class="setting-item-info">
                                                <span class="setting-item-title"><?php echo e(__("Visualizador de log do sistema")); ?></span>
                                                <span class="setting-item-desc"><?php echo e(__("Visualiza e gerencia o log do sistema do seu site")); ?></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($user->hasPermission('system_log_view')): ?>
                                <?php $hasAvailableTools = true; ?>
                                <div class="col-md-4 d-none">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="<?php echo e(route('core.admin.updater.index')); ?>">
                                        <span class="setting-item-media">
                                            <i class="icon ion-ios-nuclear"></i>
                                        </span>
                                            <span class="setting-item-info">
                                            <span class="setting-item-title"><?php echo e(__("Atualizador")); ?></span>
                                            <span class="setting-item-desc"><?php echo e(__("Atualizador de Reservas Core")); ?></span>
                                        </span>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="<?php echo e(route('core.tool.clearCache')); ?>">
                                        <span class="setting-item-media">
                                            <i class="icon ion-ios-hammer"></i>
                                        </span>
                                            <span class="setting-item-info">
                                            <span class="setting-item-title"><?php echo e(__("Limpar Cache")); ?></span>
                                            <span class="setting-item-desc"><?php echo e(__("Limpar cache para o núcleo de reservas")); ?></span>
                                        </span>
                                        </a>
                                    </div>
                                </div>
                            <?php if(!$hasAvailableTools): ?>
                                <div class="col-md-12">
                                    <?php echo e(__("Nenhuma ferramenta disponível")); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Core/Views/admin/tools/index.blade.php ENDPATH**/ ?>