
<?php $__env->startSection('title',__('Página não encontrada')); ?>
<?php $__env->startSection('message',$exception->getMessage()??__("Desculpe, não conseguimos encontrar a página que você está procurando.")); ?>
<?php $__env->startSection('code',404); ?>
<?php echo $__env->make('errors.illustrated-layout',['title'=>__('Página não encontrada')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\resources\views/errors/404.blade.php ENDPATH**/ ?>