

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("Solicitações")); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                <?php if(!empty($rows)): ?>
                    <form method="post" action="<?php echo e(route('user.admin.userUpgradeRequestApproved')); ?>" class="filter-form filter-form-left d-flex justify-content-start">
                        <?php echo e(csrf_field()); ?>

                        <select name="action" class="form-control">
                            <option value=""><?php echo e(__(" Ações em Massa ")); ?></option>
                            <option value="approved"><?php echo e(__(" Aprovado ")); ?></option>
                            <option value="delete"><?php echo e(__("Excluir")); ?></option>
                        </select>
                        <button data-confirm="<?php echo e(__("Você quer apagar?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button"><?php echo e(__('Aplicar')); ?></button>
                    </form>
                <?php endif; ?>
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
                            <th><?php echo e(__('Nome')); ?></th>
                            <th><?php echo e(__('Email')); ?></th>
                            <th><?php echo e(__('Função Solicitada')); ?></th>
                            <th class="date"><?php echo e(__("Data de Solicitação")); ?></th>
                            <th class="date"><?php echo e(__("Data de Aprovação")); ?></th>
                            <th><?php echo e(__('Aprovado por')); ?></th>
                            <th class="status"><?php echo e(__('Status')); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($rows->total() > 0): ?>
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="<?php echo e($row->id); ?>" class="check-item"></td>
                                    <td class="title">
                                        <a href="<?php echo e(route('user.admin.detail',['id'=>@$row->user->id])); ?>"><?php echo e(@$row->user->getDisplayName()); ?></a>
                                    </td>
                                    <td><?php echo e($row->user->email); ?></td>
                                    <td>
                                        <?php $role = $row->role;
                                    if(!empty($role)){
                                        echo e(ucfirst($role->name));
                                    }
                                        ?>
                                    </td>
                                    <td><?php echo e(display_date($row->created_at)); ?></td>
                                    <td><?php echo e($row->approved_time ? display_date($row->approved_time) : ''); ?></td>
                                    <td><?php echo e($row->approvedBy->getDisplayName()); ?></td>
                                    <td class="status"><span class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span></td>
                                    <td>
                                        <?php if($row->status!='approved'): ?>
                                            <a class="btn btn-sm btn-info approve-user" data-id="<?php echo e($row->id); ?>"  href="<?php echo e(route('user.admin.upgradeId',['id' => $row->id])); ?>"><?php echo e(__('Approve')); ?></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8"><?php echo e(__("Sem dados")); ?></td>
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

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {
            $('.approve-user').click(function (e) {
                e.preventDefault();
                if(confirm('Are you sure approve?')){
                    ids = '<input type="hidden" name="ids[]" value="'+$(this).data('id')+'">';
                    form = $('.dungdt-apply-form-btn').closest('form');
                    form.append(ids);
                    form.find('select').val('approved');
                    form.submit();
                }
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/User/Views/admin/upgrade-user.blade.php ENDPATH**/ ?>