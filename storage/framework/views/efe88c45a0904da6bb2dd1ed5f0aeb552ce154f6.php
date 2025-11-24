
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(!empty($recovery) ? __('Recuperação') : __("Todos Popups")); ?></h1>
            <div class="title-actions">
                <?php if(empty($recovery)): ?>
                <a href="<?php echo e(route('popup.admin.create')); ?>" class="btn btn-primary"><?php echo e(__("Adicionar novo popup")); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                <?php if(!empty($rows)): ?>
                    <form method="post" action="<?php echo e(route('popup.admin.bulkEdit')); ?>" class="filter-form filter-form-left d-flex justify-content-start">
                        <?php echo e(csrf_field()); ?>

                        <select name="action" class="form-control">
                            <option value=""><?php echo e(__(" Ações em Massa ")); ?></option>

                            <?php if(!empty($recovery)): ?>
                                <option value="recovery"><?php echo e(__(" Recovery ")); ?></option>
                                <option value="permanently_delete"><?php echo e(__("Permanently delete")); ?></option>
                            <?php else: ?>
                                <option value="publish"><?php echo e(__(" Publicar ")); ?></option>
                                <option value="draft"><?php echo e(__(" Mover para Lixeira ")); ?></option>
                                <option value="pending"><?php echo e(__("Move to Pending")); ?></option>
                                <option value="clone"><?php echo e(__(" Clone ")); ?></option>
                                <option value="delete"><?php echo e(__("Excluir")); ?></option>
                            <?php endif; ?>
                        </select>
                        <button data-confirm="<?php echo e(__("Você quer apagar?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button"><?php echo e(__('Aplicar')); ?></button>
                    </form>
                <?php endif; ?>
            </div>
            <div class="col-left">
                <form method="get" action="<?php echo e(!empty($recovery) ? route('popup.admin.recovery') : route('popup.admin.index')); ?>" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Pesquisar por nome')); ?>" class="form-control">
                    <button class="btn-info btn btn-icon btn_search" type="submit"><?php echo e(__('Procurar')); ?></button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i><?php echo e(__('Encontrado :total items',['total'=>$rows->total()])); ?></i></p>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="60px"><input type="checkbox" class="check-all"></th>
                            <th> <?php echo e(__('Nome')); ?></th>
                            <th width="100px"> <?php echo e(__('Status')); ?></th>
                            <th width="100px"> <?php echo e(__('Data')); ?></th>
                            <th width="100px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($rows->total() > 0): ?>
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($row->status); ?>">
                                    <td><input type="checkbox" name="ids[]" class="check-item" value="<?php echo e($row->id); ?>">
                                    </td>
                                    <td class="title">
                                        <a href="<?php echo e(route('popup.admin.edit',['id'=>$row->id])); ?>"><?php echo e($row->title); ?></a>
                                    </td>
                                    <td><span class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span></td>
                                    <td><?php echo e(display_date($row->updated_at)); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('popup.admin.edit',['id'=>$row->id])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> <?php echo e(__('Editar')); ?>

                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7"><?php echo e(__("No popup found")); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                </form>
                <?php echo e($rows->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Popup/Views/admin/index.blade.php ENDPATH**/ ?>