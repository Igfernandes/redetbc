
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__('Função')); ?></h1>
            <div class="title-actions">
                <a href="<?php echo e(route('user.admin.role.verifyFields')); ?>" class="btn btn-warning"><i class="fa fa-check-circle-o"></i> <?php echo e(__('Verificar Configurações')); ?></a>
                <a href="<?php echo e(route('user.admin.role.permission_matrix')); ?>" class="btn btn-info"><?php echo e(__('Permission Matrix')); ?></a>
                <a href="<?php echo e(route('user.admin.role.create')); ?>" class="btn btn-primary"><?php echo e(__('Adicionar nova função')); ?></a>
            </div>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="panel">
            <div class="panel-title"><?php echo e(__('Todas Funções')); ?></div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="60px"><input type="checkbox" class="check-all"></th>
                        <th><?php echo e(__('ID')); ?></th>
                        <th><?php echo e(__('Nome')); ?></th>
                        <th><?php echo e(__('Código')); ?></th>
                        <th><?php echo e(__('Data')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?php echo e($row->id); ?>"></td>
                            <td>#<?php echo e($row->id); ?></td>
                            <td class="title">
                                <a href="<?php echo e(route('user.admin.role.detail',['id' => $row->id])); ?>"><?php echo e(ucfirst($row->name)); ?></a>
                            </td>
                            <td><?php echo e($row->code); ?></td>
                            <td><?php echo e(display_date($row->updated_at)); ?></td>
                            <td>
                                <a href="<?php echo e(route('user.admin.role.detail',['id' => $row->id])); ?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> <?php echo e(__("Editar")); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($rows->withQueryString()->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/User/Views/admin/role/index.blade.php ENDPATH**/ ?>