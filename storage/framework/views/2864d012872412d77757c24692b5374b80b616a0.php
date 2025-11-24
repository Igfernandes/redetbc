
<?php $__env->startSection('content'); ?>
    <h2 class="title-bar">
        <?php echo e(__("Alterar senha")); ?>

    </h2>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form action="<?php echo e(route("user.change_password.update")); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__("Senha Atual")); ?></label>
                    <input type="password" required name="current-password" placeholder="<?php echo e(__("Senha Atual")); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo e(__("Nova Senha")); ?></label>
                    <input type="password" required name="new-password" minlength="8" placeholder="<?php echo e(__("Nova Senha")); ?>" class="form-control">
                    <p><i><?php echo e(__("* Exige pelo menos uma letra maiúscula, uma letra minúscula, um número e um símbolo.")); ?></i></p>
               </div>
                <div class="form-group">
                    <label><?php echo e(__("Confirmação de Senha")); ?></label>
                    <input type="password" required name="new-password_confirmation" minlength="8" placeholder="<?php echo e(__("Confirmação de Senha")); ?>" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <input type="submit" class="btn btn-primary" value="<?php echo e(__("Alterar senha")); ?>">
                <a href="<?php echo e(route("user.profile.index")); ?>" class="btn btn-default"><?php echo e(__("Cancelar")); ?></a>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Base/User/Views/frontend/changePassword.blade.php ENDPATH**/ ?>