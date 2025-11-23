
<?php $__env->startSection('title',__('Página not found')); ?>
<?php $__env->startSection('message',$exception->getMessage()??__("Sorry, we couldn't find the page you're looking for.")); ?>
<?php $__env->startSection('code',404); ?>

<?php echo $__env->make('errors.illustrated-layout',['title'=>__('Página not found')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\resources\views/errors/404.blade.php ENDPATH**/ ?>