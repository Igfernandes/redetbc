<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Conteúdo do espaço")); ?></strong></div>
    <div class="panel-body">
        <div class="form-group magic-field" data-id="title" data-type="title">
            <label class="control-label"><?php echo e(__("Título")); ?></label>
            <input type="text" value="<?php echo e($translation->title); ?>" placeholder="<?php echo e(__("Título")); ?>" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Religião")); ?></label>
            <select name="religion" class="form-control">
                <option value="">Selecione a religião</option>
                <option value="CATHOLIC" <?php if($row->religion == "CATHOLIC"): ?> selected <?php endif; ?> > <?php echo e(__("Evangélico")); ?></option>
                <option value="EVANGELICAL" <?php if($row->religion == "EVANGELICAL"): ?> selected <?php endif; ?> > <?php echo e(__("Católico")); ?></option>
                <option value="BOTH" <?php if($row->religion == "BOTH"): ?> selected <?php endif; ?> > <?php echo e(__("Ambos")); ?></option>
            </select>
        </div>
        <div class="form-group magic-field" data-id="content" data-type="content">
            <label class="control-label"><?php echo e(__("Conteúdo")); ?></label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" id="content" cols="30" rows="10"><?php echo e($translation->content); ?></textarea>
            </div>
        </div>
        <?php if(is_default_lang()): ?>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Youtube Video")); ?></label>
            <input type="text" name="video" class="form-control" value="<?php echo e($row->video); ?>" placeholder="<?php echo e(__("Youtube link video")); ?>">
        </div>
        <?php endif; ?>
        <div class="form-group-item">
            <label class="control-label"><?php echo e(__('FAQs')); ?></label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5"><?php echo e(__("Título")); ?></div>
                    <div class="col-md-5"><?php echo e(__('Conteúdo')); ?></div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                <?php if(!empty($translation->faqs)): ?>
                <?php if(!is_array($translation->faqs)) $translation->faqs = json_decode($translation->faqs); ?>
                <?php $__currentLoopData = $translation->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item" data-number="<?php echo e($key); ?>">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="faqs[<?php echo e($key); ?>][title]" class="form-control" value="<?php echo e($faq['title']); ?>" placeholder="<?php echo e(__('Eg: When and where does the tour end?')); ?>">
                        </div>
                        <div class="col-md-6">
                            <textarea name="faqs[<?php echo e($key); ?>][content]" class="form-control" placeholder="..."><?php echo e($faq['content']); ?></textarea>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="text-right">
                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Adicionar item')); ?></span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="<?php echo e(__('Eg: Can I bring my pet?')); ?>">
                        </div>
                        <div class="col-md-6">
                            <textarea __name__="faqs[__number__][content]" class="form-control" placeholder=""></textarea>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(is_default_lang()): ?>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Imagem do Banner")); ?></label>
            <div class="form-group-image">
                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id); ?>

            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Galeria")); ?></label>
            <?php echo \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php if(is_default_lang()): ?>
<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Informações Extras")); ?></strong></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__("No. Cama")); ?></label>
                    <input type="number" value="<?php echo e($row->bed); ?>" placeholder="<?php echo e(__("Exemplo: 3")); ?>" name="bed" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__("No. Banheiro")); ?></label>
                    <input type="number" value="<?php echo e($row->bathroom); ?>" placeholder="<?php echo e(__("Exemplo: 5")); ?>" name="bathroom" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo e(__("Área")); ?></label>
                    <input type="number" value="<?php echo e($row->square); ?>" placeholder="<?php echo e(__("Exemplo: 100")); ?>" name="square" class="form-control">
                </div>
            </div>
        </div>
        <?php if(is_default_lang()): ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Reserva mínima antecipada")); ?></label>
                    <input type="number" name="min_day_before_booking" class="form-control" value="<?php echo e($row->min_day_before_booking); ?>" placeholder="<?php echo e(__("Ex: 3")); ?>">
                    <i><?php echo e(__("Deixe em branco se não precisar usar a opção de dia mínimo.")); ?></i>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Requisitos mínimos de estadia")); ?></label>
                    <input type="number" name="min_day_stays" class="form-control" value="<?php echo e($row->min_day_stays); ?>" placeholder="<?php echo e(__("Ex: 2")); ?>">
                    <i><?php echo e(__("Deixe em branco se não precisar usar a opção de estadia mínima.")); ?></i>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Space/Views/admin/space/content.blade.php ENDPATH**/ ?>