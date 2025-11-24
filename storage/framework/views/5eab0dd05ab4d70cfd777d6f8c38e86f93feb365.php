
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(!empty($recovery) ? __('Recuperação') : __("Todos os Hotéis")); ?></h1>
            <div class="title-actions">
                <?php if(empty($recovery)): ?>
                <a href="<?php echo e(route('hotel.admin.create')); ?>" class="btn btn-primary"><?php echo e(__("Adicionar novo hotel")); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                <?php if(!empty($rows)): ?>
                    <form method="post" action="<?php echo e(route('hotel.admin.bulkEdit')); ?>" class="filter-form filter-form-left d-flex justify-content-start">
                        <?php echo e(csrf_field()); ?>

                        <select name="action" class="form-control">
                            <option value=""><?php echo e(__(" Ações em Massa ")); ?></option>
                            <option value="clone"><?php echo e(__(" Duplicar ")); ?></option>
                            <?php if(!empty($recovery)): ?>
                                <option value="recovery"><?php echo e(__(" Recuperar ")); ?></option>
                                <option value="permanently_delete"><?php echo e(__("Excluir permanentemente")); ?></option>
                            <?php else: ?>
                                <option value="publish"><?php echo e(__(" Publicar ")); ?></option>
                                <option value="draft"><?php echo e(__(" Mover para Lixeira ")); ?></option>
                                <option value="pending"><?php echo e(__("Mover para Pendente")); ?></option>
                                <option value="delete"><?php echo e(__("Excluir")); ?></option>
                            <?php endif; ?>

                        </select>
                        <button data-confirm="<?php echo e(__("Você quer apagar?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button"><?php echo e(__('Aplicar')); ?></button>
                    </form>
                <?php endif; ?>
            </div>
            <div class="col-left dropdown">
                <form method="get" action="<?php echo e(!empty($recovery) ? route('hotel.admin.recovery') : route('hotel.admin.index')); ?> " class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <?php if(!empty($rows) and $hotel_manage_others): ?>
                        <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Pesquisar por nome')); ?>" class="form-control">
                        <div class="ml-3 position-relative">
                            <button class="btn btn-secondary dropdown-toggle bc-dropdown-toggle-filter" type="button" id="dropdown_filters">
                                <?php echo e(__("Advanced")); ?>

                            </button>
                            <div class="dropdown-menu px-3 py-3 dropdown-menu-right" aria-labelledby="dropdown_filters">
                                <?php echo $__env->make("Core::admin.global.advanced-filter", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <button class="btn-info btn btn-icon btn_search" type="submit"><?php echo e(__('Procurar')); ?></button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i><?php echo e(__('Encontrado :total itens',['total'=>$rows->total()])); ?></i></p>
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
                            <th width="200px"> <?php echo e(__('Localização')); ?></th>
                            <th width="130px"> <?php echo e(__('Autor')); ?></th>
                            <th width="100px"> <?php echo e(__('Status')); ?></th>
                            <th width="100px"> <?php echo e(__('Avaliações')); ?></th>
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
                                        <?php if($row->is_featured): ?>
                                            <span class="badge badge-primary"><?php echo e(__("Apresentou")); ?></span>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('hotel.admin.edit',['id'=>$row->id])); ?>"><?php echo e($row->title); ?></a>
                                    </td>
                                    <td><?php echo e($row->location->name ?? ''); ?></td>
                                    <td>
                                        <?php if(!empty($row->author)): ?>
                                            <?php echo e($row->author->getDisplayName()); ?>

                                        <?php else: ?>
                                            <?php echo e(__("[Author Deleted]")); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><span class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span></td>
                                    <td>
                                        <a target="_blank" href="<?php echo e(route('review.admin.index',['service_id'=>$row->id])); ?>" class="review-count-approved">
                                            <?php echo e($row->getNumberReviewsInService()); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e(display_date($row->updated_at)); ?></td>
                                    <td>
                                        <?php if(empty($recovery)): ?>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?php echo e(__("Ação")); ?>

                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="<?php echo e(route('hotel.admin.edit',['id'=>$row->id])); ?>"><?php echo e(__("Editar hotel")); ?></a>
                                                    <a class="dropdown-item" href="<?php echo e(route('hotel.admin.room.index',['hotel_id'=>$row->id])); ?>"><?php echo e(__("Gerenciar Quartos")); ?></a>
                                                    <a class="dropdown-item" href="<?php echo e(route('hotel.admin.room.availability.index',['hotel_id'=>$row->id])); ?>"><?php echo e(__("Gerenciar Quartos")); ?></a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7"><?php echo e(__("Nenhum hotel encontrado")); ?></td>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Hotel/Views/admin/index.blade.php ENDPATH**/ ?>