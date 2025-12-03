

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__('Todos Usuários')); ?></h1>
            <div class="title-actions">
                <a href="<?php echo e(route('user.admin.create')); ?>" class="btn btn-primary"><?php echo e(__('Adicionar novo usuário')); ?></a>
                <a class="btn btn-warning btn-icon" href="<?php echo e(route("user.admin.export")); ?>" target="_blank" title="<?php echo e(__("Exportar em excel")); ?>">
                    <i class="icon ion-md-cloud-download"></i> <?php echo e(__("Exportar em excel")); ?>

                </a>
            </div>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                <?php if(!empty($rows)): ?>
                    <form method="post" action="<?php echo e(route('user.admin.bulkEdit')); ?>" class="filter-form filter-form-left d-flex justify-content-start">
                        <?php echo e(csrf_field()); ?>

                        <select name="action" class="form-control">
                            <option value=""><?php echo e(__("Ações em Massa")); ?></option>
                            <option value="delete"><?php echo e(__("Excluir")); ?></option>
                        </select>
                        <button data-confirm="<?php echo e(__("Você quer apagar?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button"><?php echo e(__('Aplicar')); ?></button>
                    </form>
                <?php endif; ?>
            </div>
            <div class="col-left">
                <form method="get" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <select class="form-control" name="role">
                        <option value=""><?php echo e(__('-- Selecione --')); ?></option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->name); ?>" <?php if(Request()->role == $role->name): ?> selected <?php endif; ?> ><?php echo e(ucfirst($role->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Pesquisar por nome')); ?>" class="form-control">
                    <button class="btn-info btn btn-icon btn_search" type="submit"><?php echo e(__('Buscar Usuário')); ?></button>
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
                            <th><?php echo e(__('Nome')); ?></th>
                            <th><?php echo e(__('Email')); ?></th>
                            <th><?php echo e(__('Crédito')); ?></th>
                            <th><?php echo e(__('Telefone')); ?></th>
                            <th><?php echo e(__('Função')); ?></th>
                            <th class="date"><?php echo e(__('Data')); ?></th>

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="<?php echo e($row->id); ?>" class="check-item"></td>
                                <td class="title">
                                    <a href="<?php echo e(route('user.admin.detail',['id'=>$row->id])); ?>"><?php echo e($row->getDisplayName()); ?></a>
                                </td>
                                <td><?php echo e($row->email); ?>

                                    <?php if($row->email_verified_at): ?>
                                        <i class="fa fa-check-circle text-success" title="<?php echo e(__("Verificado")); ?>"></i>
                                    <?php else: ?>
                                        <i class="fa fa-info-circle text-warning" title="<?php echo e(__("Não verificado")); ?>"></i>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($row->balance); ?></td>
                                <td><?php echo e($row->phone); ?></td>
                                <td>
                                    <?php echo e($row->role->name ?? ''); ?>

                                </td>
                                <td><?php echo e(display_date($row->created_at)); ?></td>
                                
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-th"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"  href="<?php echo e(route('user.admin.detail',['id'=>$row->id])); ?>"><i class="fa fa-edit"></i> <?php echo e(__('Editar')); ?></a>
                                            <?php if(!$row->hasVerifiedEmail()): ?>
                                                <a class="dropdown-item"  href="<?php echo e(route('user.admin.verifyEmail',$row)); ?>"><i class="fa fa-edit"></i> <?php echo e(__('Verificar e-mail')); ?></a>
                                                <?php else: ?>
                                                <a class="dropdown-item"  href="#" ><i class="fa fa-check"></i> <?php echo e(__('E-mail verificado')); ?></a>
                                            <?php endif; ?>
                                            <a class="dropdown-item" href="<?php echo e(route('user.admin.password',['id'=>$row->id])); ?>"><i class="fa fa-lock"></i> <?php echo e(__('Alterar Senha')); ?></a>
                                            <a href="<?php echo e(route('user.admin.wallet.addCredit',['id'=>$row->id])); ?>" class="dropdown-item"><i class="fa fa-plus"></i> <?php echo e(__("Adicionar crédito")); ?></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    </div>
                </form>
                <?php echo e($rows->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/User/Views/admin/index.blade.php ENDPATH**/ ?>