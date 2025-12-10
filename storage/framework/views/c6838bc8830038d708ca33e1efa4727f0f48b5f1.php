<div class="sec-title text-center">
    <h2><?php echo e(setting_item_with_lang('user_plans_page_title', app()->getLocale()) ?? __("Pacotes de Preços")); ?></h2>
    <div class="text"><?php echo e(setting_item_with_lang('user_plans_page_sub_title', app()->getLocale()) ?? __("Escolha seu plano de preços")); ?></div>
</div>
<div class="pricing-tabs tabs-box" data-client='<?php echo e(Auth()->user()->gateway_customer_id); ?>'>
    <?php if($has_annual): ?>
    <div class="tab-buttons">
        <h4><?php echo e(setting_item_with_lang('user_plans_sale_text', app()->getLocale()) ?? __('Economize até 10%')); ?></h4>
        <ul class="tab-btns">
            <li data-tab="#monthly" class="tab-btn active-btn"><?php echo e(__('Mensal')); ?></li>
            <li data-tab="#annual" class="tab-btn"><?php echo e(__('Anual')); ?></li>
        </ul>
    </div>
    <?php endif; ?>;
    <div class="tabs-content">
        <div class="tab active-tab" id="monthly">
            <div class="content">
                <div class="row <?php if(!$has_annual): ?> justify-content-center <?php endif; ?>;">
                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $translate = $plan->translate();
                    ?>
                    <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="title"><?php echo e($translate->title); ?></div>
                            <div class="price"><?php echo e($plan->price ? format_money($plan->price) : __('Grátis')); ?>

                                <?php if($plan->price): ?>
                                <span class="duration">/ <?php echo e($plan->duration > 1 ? $plan->duration : ''); ?> <?php echo e($plan->duration_type_text); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="table-content">
                                <?php echo clean($translate->content); ?>

                            </div>
                            <div class="table-footer">
                                <div>
                                    <div class="price-subtitle"><?php echo e(__('Total:')); ?> <strong><?php echo e($plan->price ? format_money($plan->price * 12) : __('Grátis')); ?></strong></div>
                                </div>
                                <?php if($user and $user_plan = $user->user_plan and $user_plan->plan_id == $plan->id): ?>
                                <?php if($user_plan->is_valid): ?>
                                <div class="d-flex text-center">
                                    <a href="<?php echo e(route('user.plan')); ?>" class="theme-btn btn-style-one mr-2"><?php echo e(__("Plano Atual")); ?></a>
                                    <?php if(setting_item_with_lang('enable_multi_user_plans')): ?>
                                    <a href="<?php echo e(route('user.upgrade.store',['id'=>$plan->id])); ?>" class="btn btn-warning"><?php echo e(__('Recomprar')); ?></a>
                                    <?php endif; ?>
                                </div>
                                <?php else: ?>
                                <a href="<?php echo e(route('user.upgrade.store',['id'=>$plan->id])); ?>" class="btn btn-warning"><?php echo e(__('Recomprar')); ?></a>
                                <?php endif; ?>
                                <?php else: ?>
                                <a href="<?php echo e(route('user.upgrade.store',['id'=>$plan->id])); ?>" class="btn btn-primary"><?php echo e(__('Começar Agora')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php if($has_annual): ?>
        <div class="tab" id="annual">
            <div class="content">
                <div class="row">
                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!$plan->annual_price) continue; ?>
                    <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="title"><?php echo e($plan->title); ?></div>
                            <div class="price"><?php echo e(format_money($plan->annual_price)); ?> <span class="duration">/ <?php echo e(__("Ano")); ?></span></div>
                            <div class="table-content">
                                <?php echo clean($plan->content); ?>

                            </div>
                            <div class="table-footer">
                                <?php if($user and $user_plan = $user->user_plan and $user_plan->plan_id == $plan->id): ?>
                                <?php if($user_plan->is_valid): ?>
                                <div class="d-flex text-center">
                                    <a href="<?php echo e(route('user.plan')); ?>" class="theme-btn btn-style-one mr-2"><?php echo e(__("Plano Atual")); ?></a>
                                    <?php if(setting_item_with_lang('enable_multi_user_plans')): ?>
                                    <a href="<?php echo e(route('user.plan.buy',['id'=>$plan->id])); ?>" class="btn btn-warning"><?php echo e(__('Recomprar')); ?></a>
                                    <?php endif; ?>
                                </div>
                                <?php else: ?>
                                <a href="<?php echo e(route('user.plan.buy',['id'=>$plan->id,'annual'=>1])); ?>" class="btn btn-warning"><?php echo e(__('Recomprar')); ?></a>
                                <?php endif; ?>
                                <?php else: ?>
                                <a href="<?php echo e(route('user.plan.buy',['id'=>$plan->id,'annual'=>1])); ?>" class="btn btn-primary"><?php echo e(__('Selecionar')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>;
    </div>
</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Base/User/Views/frontend/upgrade/list.blade.php ENDPATH**/ ?>