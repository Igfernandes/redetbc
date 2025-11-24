<div class="form-group">
    <label><?php echo e(__("Nome")); ?></label>
    <input type="text" value="<?php echo e($translation->name); ?>" placeholder="<?php echo e(__('Nome da categoria')); ?>" name="name" class="form-control">
</div>

<?php if(is_default_lang()): ?>
    <div class="form-group">
        <label><?php echo e(__("Classe do icone")); ?></label>
        <input type="text" value="<?php echo e($row->icon_class); ?>"  name="icon_class" class="form-control">
    </div>
    <div class="form-group d-none">
        <label><?php echo e(__("Parent")); ?></label>
        <select name="parent_id" class="form-control">
            <option value=""><?php echo e(__("-- Selecione --")); ?></option>
            <?php
            $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
                foreach ($categories as $category) {
                    if ($category->id == $row->id) {
                        continue;
                    }
                    $selected = '';
                    if ($row->parent_id == $category->id)
                        $selected = 'selected';
                    printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                    $traverse($category->children, $prefix . '-');
                }
            };
            $traverse($parents);
            ?>
        </select>
    </div>
<?php endif; ?>

    
    
        
    
<?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Location/Views/admin/category/form.blade.php ENDPATH**/ ?>