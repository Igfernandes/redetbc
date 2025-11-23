<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Conteúdo do serviço")); ?></strong></div>
    <div class="panel-body">
        <div class="form-group magic-field" data-id="title" data-type="title">
            <label class="control-label"><?php echo e(__("Título")); ?></label>
            <input type="text" value="<?php echo e($translation->title); ?>" placeholder="<?php echo e(__("Título")); ?>" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Religião Alvo")); ?></label>
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
                    <div class="col-md-5"><?php echo e(__('conteúdo')); ?></div>
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
                            <input type="text" name="faqs[<?php echo e($key); ?>][title]" class="form-control" value="<?php echo e($faq['title']); ?>" placeholder="<?php echo e(__('Exemplo: Quando e onde termina a visita guiada?')); ?>">
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
                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="<?php echo e(__('Exemplo: Posso trazer meu animal de estimação?')); ?>">
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
            <label class="control-label"><?php echo e(__("Imagem do banner")); ?></label>
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
<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Informações extras")); ?></strong></div>
    <div class="panel-body">
        <?php if(is_default_lang()): ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo e(__("Convidado")); ?></label>
                    <input type="number" value="<?php echo e($row->max_guest); ?>" placeholder="<?php echo e(__("Exemplo: 3")); ?>" name="max_guest" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo e(__("Cabine")); ?></label>
                    <input type="text" value="<?php echo e($row->cabin); ?>" placeholder="<?php echo e(__("Exemplo: 5")); ?>" name="cabin" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo e(__("Comprimento")); ?></label>
                    <input type="number" value="<?php echo e($row->length); ?>" placeholder="<?php echo e(__("Exemplo: 30m")); ?>" name="length" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo e(__("Velocidade")); ?></label>
                    <input type="number" value="<?php echo e($row->speed); ?>" placeholder="<?php echo e(__("Exemplo: 25km/h")); ?>" name="speed" class="form-control">
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="form-group-item">
            <label class="control-label"><?php echo e(__('Especificações')); ?></label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5"><?php echo e(__("Título")); ?></div>
                    <div class="col-md-5"><?php echo e(__('Conteudo')); ?></div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                <?php if(!empty($translation->specs)): ?>
                <?php if(!is_array($translation->specs)) $translation->faqs = json_decode($translation->specs); ?>
                <?php $__currentLoopData = $translation->specs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item" data-number="<?php echo e($key); ?>">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="specs[<?php echo e($key); ?>][title]" class="form-control" value="<?php echo e($spec['title']); ?>" placeholder="<?php echo e(__('Ex.: Alcance')); ?>">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="specs[<?php echo e($key); ?>][content]" class="form-control" value="<?php echo e($spec['content']); ?>" placeholder="<?php echo e(__('Ex: 6000km')); ?>">
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
                            <input type="text" __name__="specs[__number__][title]" class="form-control" placeholder="<?php echo e(__('Ex.: Alcance')); ?>">
                        </div>
                        <div class="col-md-6">
                            <input type="text" __name__="specs[__number__][content]" class="form-control" value="" placeholder="<?php echo e(__('Ex: 6000km')); ?>">
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label><?php echo e(__("Política de Cancelamento")); ?></label>
            <textarea name="cancel_policy" class="form-control" rows="5" placeholder="<?php echo e(__("Reembolso total até 4 dias antes do evento..")); ?>"><?php echo e($translation->cancel_policy); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo e(__("Termos e informações adicionais")); ?></label>
            <textarea name="terms_information" class="d-none has-ckeditor" rows="10" placeholder="<?php echo e(__("Apenas para fins sanitários. Embora haja um banheiro e um chuveiro em funcionamento, desativamos o chuveiro e o vaso sanitário é de uso limitado (apenas urina... desculpe o detalhe gráfico!))...")); ?>"><?php echo e($translation->terms_information); ?></textarea>
        </div>
        <?php echo $__env->make('Assistance::admin/assistance/include-exclude', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Assistance/Views/admin/assistance/content.blade.php ENDPATH**/ ?>