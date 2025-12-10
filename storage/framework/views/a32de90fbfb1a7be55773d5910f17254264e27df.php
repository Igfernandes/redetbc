<div class="form-group">
    <div class="row align-items-center">

        <label class="col-md-4 col-form-label" style="word-break: break-all;"><?php echo e($field['name_'.app()->getLocale()] ?? $field['name'] ?? $field['id']); ?>


            <?php if(!empty($field['required'])): ?>
            <span class="text-danger">*</span>
            <?php endif; ?>
            :
        </label>
        <div class="col-md-<?php echo e($value_col_size ?? 4); ?> btn-upload-private-wrap">
            <div class="private-file-lists mb-2">
                <?php ($old = json_decode($field['data'],true)); ?>
                <?php if(!empty($old)): ?>
                <input type="hidden" accept=".png,.jpg,.jpge" name="verify_data_<?php echo e($field['id']); ?>" value="<?php echo e(($field['data'])); ?>">
                <a target="_blank" href="<?php echo e(route('media.private.view',['path'=>$old['path'] ?? '','v'=>uniqid()])); ?>" class="file-item"><?php echo e(__("Visualizar documento")); ?> &nbsp;&nbsp;<i class="fa fa-download"></i></a>

                <?php endif; ?>
            </div>
            <?php if(empty($only_show_data)): ?>
            <div class="file-group">
                <div class="not_loading">
                    <span class="btn btn-primary btn-sm "><i class="fa fa-upload"></i>&nbsp;&nbsp; <?php echo e(__('Selecione o arquivo')); ?>

                        <input class="btn-upload-private-file" data-name="verify_data_<?php echo e($field['id']); ?>" data-multiple="" type="file">
                    </span>
                </div>
                <div class="is_loading">
                    <span class="btn btn-primary btn-sm px-4">
                        <i class="fa fa-spinner fa-spin"></i> <?php echo e(__('Carregando...')); ?>

                    </span>
                </div>
            </div>
            <?php else: ?>
            <?php if(empty($field['data'])): ?>
            <div><strong><?php echo e(__('N/A')); ?></strong></div>
            <?php endif; ?>
            <?php if(!empty($field['is_verified'])): ?>
            <span class="badge badge-success"><i><?php echo e(__("Verificado")); ?></i></span>
            <?php else: ?>
            <span class="badge badge-secondary"><i><?php echo e(__("Não verificado")); ?></i></span>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Base/User/Views/frontend/verification/fields/upload-image.blade.php ENDPATH**/ ?>