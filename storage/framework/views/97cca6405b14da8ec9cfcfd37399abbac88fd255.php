
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("Todas as Avaliações")); ?></h1>
        </div>

        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                <?php if(!empty($rows)): ?>
                    <form method="post" action="<?php echo e(route('review.admin.bulkEdit')); ?>" class="filter-form filter-form-left d-flex justify-content-start">
                        <?php echo e(csrf_field()); ?>

                        <select name="action" class="form-control">
                            <option value=""><?php echo e(__("Ações em Massa")); ?></option>
                            <option value="approved"><?php echo e(__("Aprovado")); ?></option>
                            <option value="pending"><?php echo e(__("Pendente")); ?></option>
                            <option value="spam"><?php echo e(__("Spam")); ?></option>
                            <option value="trash"><?php echo e(__("Mover para Lixeira")); ?></option>
                            <option value="delete"><?php echo e(__("Excluir")); ?></option>
                        </select>
                        <button data-confirm="<?php echo e(__('Você quer apagar?')); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button"><?php echo e(__('Aplicar')); ?></button>
                    </form>
                <?php endif; ?>
            </div>

            <div class="col-left">
                <form method="post" action="<?php echo e(route('review.admin.index')); ?> " class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <?php echo csrf_field(); ?>
                    <?php if(!empty($rows)): ?>
                        <?php
                        $user = !empty(Request()->customer_id) ? App\User::find(Request()->customer_id) : false;
                        \App\Helpers\AdminForm::select2('customer_id', [
                            'configs' => [
                                'ajax'        => [
                                    'url' => route('user.admin.getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'allowClear'  => true,
                                'placeholder' => __('-- Cliente --')
                            ]
                        ], !empty($user->id) ? [
                            $user->id,
                            $user->name_or_email . ' (#' . $user->id . ')'
                        ] : false)
                        ?>
                    <?php endif; ?>

                    <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Pesquisar por título')); ?>" class="form-control">
                    <button class="btn-info btn btn-icon btn_search" type="submit"><?php echo e(__('Procurar')); ?></button>
                </form>
            </div>
        </div>

        <div class="text-right">
            <div class="header-status-control">
                <a href="<?php echo e(route('review.admin.index')); ?>"><?php echo e(__("Todas as Avaliações")); ?>

                    <span>(<?php echo e(\Modules\Review\Models\Review::countReviewByStatus()); ?>)</span> </a> -

                <a href="<?php echo e(route('review.admin.index',['status'=>'approved'])); ?>"><?php echo e(__("Aprovadas")); ?>

                    <span>(<?php echo e(\Modules\Review\Models\Review::countReviewByStatus("approved")); ?>)</span></a> -

                <a href="<?php echo e(route('review.admin.index',['status'=>'pending'])); ?>"><?php echo e(__("Pendentes")); ?>

                    <span>(<?php echo e(\Modules\Review\Models\Review::countReviewByStatus("pending")); ?>)</span></a> -

                <a href="<?php echo e(route('review.admin.index',['status'=>'spam'])); ?>"><?php echo e(__("Spam")); ?>

                    <span>(<?php echo e(\Modules\Review\Models\Review::countReviewByStatus("spam")); ?>)</span></a> -

                <a href="<?php echo e(route('review.admin.index',['status'=>'trash'])); ?>"><?php echo e(__("Lixeira")); ?>

                    <span>(<?php echo e(\Modules\Review\Models\Review::countReviewByStatus("trash")); ?>)</span></a>
            </div>

            <p><i><?php echo e(__('Encontrado :total itens',['total'=>$rows->total()])); ?></i></p>
        </div>

        <div class="panel">
            <div class="panel-body">
                <form class="bravo-form-item">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="60px"><input type="checkbox" class="check-all"></th>
                                <th width="150px"><?php echo e(__('Autor')); ?></th>
                                <th><?php echo e(__('Conteúdo da Avaliação')); ?></th>
                                <th width="250px"><?php echo e(__('Em Resposta a')); ?></th>
                                <th width="80px"><?php echo e(__('Serviço')); ?></th>
                                <th width="100px"><?php echo e(__('Status')); ?></th>
                                <th width="140px"><?php echo e(__('Enviado em')); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if($rows->total() > 0): ?>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $service = $row->getService ?>
                                    <tr class="<?php echo e($row->status); ?>">
                                        <td><input type="checkbox" name="ids[]" class="check-item" value="<?php echo e($row->id); ?>"></td>

                                        <td>
                                            <?php if(!empty($metaUser =  $row->author)): ?>
                                                <a href="<?php echo e(route('review.admin.index',['customer_id'=>$metaUser->id])); ?>">
                                                    <?php echo e($metaUser->email ?? 'Email'); ?>

                                                </a>

                                                <p>
                                                    <a href="<?php echo e(route('review.admin.index',['s'=>$row->author_ip])); ?>">
                                                        <?php echo e($row->author_ip); ?>

                                                    </a>
                                                </p>

                                            <?php else: ?>
                                                <?php echo e(__("[Autor Excluído]")); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <strong><?php echo e($row->title); ?></strong>
                                            <p><?php echo e($row->content); ?></p>

                                            <?php if(!empty($metaReviews = $row->getReviewMetaPicture())): ?>
                                                <?php $listImages = json_decode($metaReviews->val, true); ?>
                                                <div class="review_list_photos d-flex mt-3">
                                                    <?php $__currentLoopData = $listImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oneImages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $imagesData = json_decode($oneImages, true); ?>
                                                        <div class="review_upload_item"
                                                             style="background-image: url(<?php echo e(@$imagesData['download']); ?>);
                                                             background-repeat: no-repeat;
                                                             background-size: cover;
                                                             background-position: center;
                                                             height: 100px;width: 100px;margin-right: 10px;">
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if($row->rate_number): ?>
                                                <ul class="review-star left">
                                                    <?php for( $i = 0 ; $i < 5 ; $i++ ): ?>
                                                        <?php if($i < $row->rate_number): ?>
                                                            <li><i class="fa fa-star"></i></li>
                                                        <?php else: ?>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </ul>
                                            <?php endif; ?>

                                            <?php if(!empty($service) and !empty($allReviewStats = $service->getReviewStats())): ?>
                                                <?php if(!empty($metaReviews = $row->getReviewMeta())): ?>
                                                    <a class="btn-show-info-review right" data-toggle="collapse" href="#review-<?php echo e($row->id); ?>">
                                                        <?php echo e(__("Mais informações")); ?>

                                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </a>

                                                    <div class="collapse" id="review-<?php echo e($row->id); ?>">
                                                        <div class="review-items">
                                                            <div class="row">

                                                                <?php $__currentLoopData = $metaReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metaReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(in_array($metaReview->name , $allReviewStats)): ?>
                                                                        <div class="item col-md-12">
                                                                            <label style="margin-right: 15px;"><?php echo e($metaReview->name); ?></label>

                                                                            <ul class="review-star">
                                                                                <?php for( $i = 0 ; $i < 5 ; $i++ ): ?>
                                                                                    <?php if($i < $metaReview->val): ?>
                                                                                        <li><i class="fa fa-star"></i></li>
                                                                                    <?php else: ?>
                                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                                    <?php endif; ?>
                                                                                <?php endfor; ?>
                                                                            </ul>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if(!empty($service)): ?>
                                                <a href="<?php echo e(route('review.admin.index',['service_id'=>$service->id,'object_model'=>$service->type])); ?>">
                                                    <?php echo e($service->title); ?>

                                                </a>

                                                <p>
                                                    <a target="_blank" href="<?php echo e($service->getDetailUrl()); ?>">
                                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                        <?php echo e(__("Visualizar :name",["name"=>$service->getModelName() ])); ?>

                                                    </a>
                                                </p>
                                            <?php else: ?>
                                                <?php echo e(__("[Excluído]")); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if(!empty($service)): ?>
                                                <a href="<?php echo e(route('review.admin.index',['service'=>$service->getModelName()])); ?>"
                                                   class="badge badge-dark">
                                                    <?php echo e($service->getModelName()); ?>

                                                </a>
                                            <?php else: ?>
                                                <?php echo e(__("[Excluído]")); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a href="<?php echo e(route('review.admin.index',['status'=>$row->status])); ?>"
                                               class="badge badge-<?php echo e($row->status); ?>">
                                                <?php echo e($row->status); ?>

                                            </a>
                                        </td>

                                        <td><?php echo e(display_datetime($row->updated_at)); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6"><?php echo e(__("Sem dados")); ?></td>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Review/Views/admin/index.blade.php ENDPATH**/ ?>