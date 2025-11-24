<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Conteúdo do Passeio")); ?></strong></div>
    <div class="panel-body">
        <div class="form-group magic-field" data-id="title" data-type="title">
            <label class="control-label"><?php echo e(__("Título")); ?></label>
            <input type="text" value="<?php echo e(old('title',$translation->title)); ?>" placeholder="<?php echo e(__("Título")); ?>" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Religião Alvo")); ?></label>
            <select name="religion" class="form-control">
                <option value="">Selecione a religião</option>
                <option value="CATHOLIC" <?php if($row->religion == "CATHOLIC"): ?> selected <?php endif; ?> > <?php echo e(__("Católico")); ?></option>
                <option value="EVANGELICAL" <?php if($row->religion == "EVANGELICAL"): ?> selected <?php endif; ?> > <?php echo e(__("Evangélico")); ?></option>
                <option value="BOTH" <?php if($row->religion == "BOTH"): ?> selected <?php endif; ?> > <?php echo e(__("Ambos")); ?></option>
            </select>
        </div>
        <div class="form-group magic-field" data-id="content" data-type="content">
            <label class="control-label"><?php echo e(__("Conteúdo")); ?></label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" id="content" cols="30" rows="10"><?php echo e(old('content',$translation->content)); ?></textarea>
            </div>
        </div>
        <div class="form-group d-none">
            <label class="control-label"><?php echo e(__("Descrição")); ?></label>
            <div class="">
                <textarea name="short_desc" class="form-control" cols="30" rows="4"><?php echo e(old('short_desc',$translation->short_desc)); ?></textarea>
            </div>
        </div>
        <?php if(is_default_lang()): ?>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Categoria")); ?></label>
            <div class="">
                <select name="category_id" class="form-control">
                    <option value=""><?php echo e(__("-- Selecione --")); ?></option>
                    <?php
                    $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
                        foreach ($categories as $category) {
                            $selected = '';
                            if ($row->category_id == $category->id)
                                $selected = 'selected';
                            printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                            $traverse($category->children, $prefix . '-');
                        }
                    };
                    $traverse($tour_category);
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Vídeo do Youtube")); ?></label>
            <input type="text" name="video" class="form-control" value="<?php echo e(old('video',$row->video)); ?>" placeholder="<?php echo e(__("Link do vídeo no Youtube")); ?>">
        </div>

        <?php if(is_default_lang()): ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Reservas antecipadas mínimas")); ?></label>
                    <input type="number" name="min_day_before_booking" class="form-control" value="<?php echo e(old('min_day_before_booking', $row->min_day_before_booking)); ?>" placeholder="<?php echo e(__("Ex: 3")); ?>">
                    <i><?php echo e(__("Deixe em branco se não precisar usar a opção de dia mínimo.")); ?></i>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Duração")); ?></label>
                    <div class="input-group mb-3">
                        <input type="text" name="duration" class="form-control" value="<?php echo e(old('duration',$row->duration)); ?>" placeholder="<?php echo e(__("Duração")); ?>" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2"><?php echo e(__('horas')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Passeio - Mínimo de Pessoas")); ?></label>
                    <input type="text" name="min_people" class="form-control" value="<?php echo e(old('min_people',$row->min_people)); ?>" placeholder="<?php echo e(__("Passeio - Mínimo de Pessoas")); ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Passeio - Máximo de Pessoas")); ?></label>
                    <input type="text" name="max_people" class="form-control" value="<?php echo e(old('max_people',$row->max_people)); ?>" placeholder="<?php echo e(__("Passeio - Máximo de Pessoas")); ?>">
                </div>
            </div>
        </div>

        <?php endif; ?>
        <?php do_action(\Modules\Tour\Hook::FORM_AFTER_MAX_PEOPLE, $row) ?>
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
                <?php if(!is_array($translation->faqs)) $translation->faqs = json_decode(old('faqs',$translation->faqs)); ?>
                <?php $__currentLoopData = $translation->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item" data-number="<?php echo e($key); ?>">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="faqs[<?php echo e($key); ?>][title]" class="form-control" value="<?php echo e($faq['title']); ?>" placeholder="<?php echo e(__('Ex: Quando e onde o passeio termina?')); ?>">
                        </div>
                        <div class="col-md-6">
                            <textarea name="faqs[<?php echo e($key); ?>][content]" class="form-control full-h" placeholder="..."><?php echo e($faq['content']); ?></textarea>
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
                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="<?php echo e(__('Ex: Quando e onde o passeio termina?')); ?>">
                        </div>
                        <div class="col-md-6">
                            <textarea __name__="faqs[__number__][content]" class="form-control full-h" placeholder="..."></textarea>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make('Tour::admin/tour/include-exclude', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('Tour::admin/tour/itinerary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if(is_default_lang()): ?>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Imagem do Banner")); ?></label>
            <div class="form-group-image">
                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',old('banner_image_id',$row->banner_image_id)); ?>

            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Galeria")); ?></label>
            <?php echo \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',old('gallery',$row->gallery)); ?>

        </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Tour/Views/admin/tour/tour-content.blade.php ENDPATH**/ ?>