<div class="form-group">
    <div class="row align-items-center">
        <label class="col-md-3 text-right col-form-label">
            <?php echo e($field['name_'.app()->getLocale()] ?? $field['name'] ?? $field['id']); ?>

            <?php if(!empty($field['required'])): ?>
            <span class="text-danger">*</span>
            <?php endif; ?>
            :
        </label>
        <div class="col-md-<?php echo e($value_col_size ?? 4); ?>">
            <?php if(empty($only_show_data)): ?>
            <select class="form-control" name="verify_data_<?php echo e($field['id']); ?>">
                <?php $__currentLoopData = $field['options'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue => $optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($optionValue); ?>"
                    <?php echo e($field['data'] == $optionValue ? 'selected' : ''); ?>>
                    <?php echo e(__($optionLabel)); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php else: ?>
            <div>
                <strong>
                    <?php echo e($field['options'][$field['data']] ?? $field['data'] ?? __('N/A')); ?>

                </strong>
            </div>
            <?php if(!empty($field['is_verified'])): ?>
            <a class="badge badge-success" href="#" onclick="return false"><i><?php echo e(__("Verificado")); ?></i></a>
            <?php else: ?>
            <span class="badge badge-secondary"><i><?php echo e(__("Não verificado")); ?></i></span>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Base/User/Views/frontend/verification/fields/select.blade.php ENDPATH**/ ?>