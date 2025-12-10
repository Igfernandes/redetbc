
<?php $__env->startSection('content'); ?>
<section class="pricing-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('User::frontend.upgrade.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Base/User/Views/frontend/upgrade/index.blade.php ENDPATH**/ ?>