

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center bravo-login-form-page bravo-login-page">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Verifique seu endereço de e-mail')); ?></div>

                <div class="card-body">
                    <?php if(session('resent')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(__('Um novo link de verificação foi enviado para o seu endereço de e-mail.')); ?>

                        </div>
                    <?php endif; ?>

                    <p>
                        <?php echo e(__('Antes de continuar, por favor verifique seu e-mail para acessar o link de verificação.')); ?>

                        <?php echo e(__('Se você não recebeu o e-mail')); ?>,
                    </p>

                    <form action="<?php echo e(route('verification.send')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-primary" type="submit">
                            <?php echo e(__('clique aqui para solicitar outro')); ?>.
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\resources\views/auth/verify.blade.php ENDPATH**/ ?>