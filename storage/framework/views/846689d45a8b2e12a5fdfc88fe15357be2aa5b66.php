
<?php $__env->startSection('content'); ?>
    <div class="b-container">
        <div class="b-panel">
            <h1><?php echo e(__("Olá Administrador")); ?></h1>

            <p><?php echo e(__('Um usuário enviou seus dados para verificação.')); ?></p>
            <p><?php echo e(__('Nome: :name',['name'=>$user->business_name ? $user->business_name : $user->first_name])); ?></p>

            <p><?php echo e(__('Você pode aprovar a solicitação aqui:')); ?> <a href="<?php echo e(route('user.admin.verification.detail',['id'=>$user->id])); ?>"><?php echo e(__('Visualizar solicitação')); ?></a></p>

            <br>
            <p><?php echo e(__('Atenciosamente')); ?>,<br><?php echo e(setting_item('site_title')); ?></p>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Email::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/User/Views/emails/user-submit-verify-data.blade.php ENDPATH**/ ?>