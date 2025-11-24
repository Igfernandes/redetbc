

<?php $__env->startSection('content'); ?>
<h2 class="title-bar no-border-bottom">
    <?php echo e(__("Minhas Reservas")); ?>

</h2>

<?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="booking-history-manager">
    <div class="tabbable">
        <?php if($bookings->count() > 0): ?>
        <div class="tab-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-booking-history align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="3%"><?php echo e(__("Tipo")); ?></th>
                            <th><?php echo e(__("Serviço")); ?></th>
                            <th><?php echo e(__("Período")); ?></th>
                            <th><?php echo e(__("Status")); ?></th>
                            <th><?php echo e(__("Criado em")); ?></th>
                            <th width="100px"><?php echo e(__("Ações")); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            
                            <td class="booking-history-type text-center">
                                <?php if($service = $booking->service): ?>
                                <i class="<?php echo e($service->getServiceIconFeatured()); ?> fs-5"></i>
                                <?php endif; ?>
                                <small class="d-block text-muted"><?php echo e(ucfirst($booking->object_model ?? 'hotel')); ?></small>
                            </td>

                            
                            <td>
                                <?php if($service): ?>
                                <a href="<?php echo e($service->getDetailUrl()); ?>" target="_blank" class="fw-semibold">
                                    <?php echo e($service->title ?? 'Serviço'); ?>

                                </a>
                                <div class="small text-muted"><?php echo e($service->address ?? ''); ?></div>
                                <?php else: ?>
                                <span class="text-muted fst-italic"><?php echo e(__("[Serviço removido]")); ?></span>
                                <?php endif; ?>
                            </td>

                            
                            <td>
                                <div>
                                    <i class="icofont-calendar"></i>
                                    <?php echo e(\Carbon\Carbon::parse($booking->start_date)->format('d/m/Y')); ?>

                                    <span class="text-muted">até</span>
                                    <?php echo e(\Carbon\Carbon::parse($booking->end_date)->format('d/m/Y')); ?>

                                </div>
                            </td>

                            
                            <td>
                                <span class="badge bg-<?php echo e($booking->status == 'draft' ? 'warning' : 'success'); ?>">
                                    <?php echo e(ucfirst($booking->status == 'draft' ? 'Pendente' : 'Finalizada')); ?>

                                </span>
                            </td>

                            
                            <td><?php echo e(display_datetime($booking->created_at)); ?></td>

                            
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-info text-white dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <?php echo e(__("Ações")); ?>

                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end bg-white">
                                        <li>
                                            <a class="dropdown-item" href="<?php echo e(route('user.booking_history.request', ['bk' => $booking->id])); ?>">
                                                <i class="icofont-eye"></i> &nbsp; <?php echo e(__("Visualizar")); ?>

                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo e(route('user.chat', ['bk' => $booking->id])); ?>">
                                                <i class="icofont-eye"></i> &nbsp; <?php echo e(__("Conversar")); ?>

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else: ?>
        <div class="alert alert-info my-4">
            <?php echo e(__("Nenhuma reserva encontrada.")); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Base/User/Views/frontend/booking/overview.blade.php ENDPATH**/ ?>