
<?php $__env->startSection('content'); ?>
    <div class="b-container">
        <div class="b-panel">
            <h1><?php echo e(__("Olá :name",['name'=>$user->business_name ? $user->business_name : $user->first_name])); ?></h1>

            <p><?php echo e(__('Você está recebendo este e-mail porque atualizamos seus dados de verificação de fornecedor.')); ?></p>
            <ul>
                <?php if(!empty($user->verification_fields)): ?>
                    <?php $__currentLoopData = $user->verification_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <strong><?php echo e($field['name']); ?>:</strong>
                            <i><?php if(!empty($field['is_verified'])): ?> <?php echo e(__("Verificado")); ?> <?php else: ?> <?php echo e(__("Não verificado")); ?> <?php endif; ?></i>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
            <p><?php echo e(__('Você pode verificar suas informações aqui:')); ?> <a href="<?php echo e(route('user.verification.index')); ?>"><?php echo e(__('Ver dados de verificação')); ?></a></p>

            <br>
            <p><?php echo e(__('Atenciosamente')); ?>,<br><?php echo e(setting_item('site_title')); ?></p>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Email::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/User/Views/emails/admin-submit-verify-data.blade.php ENDPATH**/ ?>