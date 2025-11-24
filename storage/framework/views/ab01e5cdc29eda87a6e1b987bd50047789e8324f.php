<div class="form-group magic-field" data-id="title" data-type="title">
    <label class="control-label"><?php echo e(__('Título')); ?></label>
    <input type="text" value="<?php echo e($translation->title ?? 'New Post'); ?>" placeholder="News title" name="title" class="form-control">
</div>
<div class="form-group">
    <label class="control-label"><?php echo e(__("Target Religion")); ?></label>
    <select name="religion" class="form-control">
        <option value="">Selecione a religião</option>
        <option value="CATHOLIC" <?php if($row->religion == "CATHOLIC"): ?> selected <?php endif; ?> > <?php echo e(__("Evangélico")); ?></option>
        <option value="EVANGELICAL" <?php if($row->religion == "EVANGELICAL"): ?> selected <?php endif; ?> > <?php echo e(__("Católico")); ?></option>
        <option value="BOTH" <?php if($row->religion == "BOTH"): ?> selected <?php endif; ?> > <?php echo e(__("Ambos")); ?></option>
    </select>
</div>
<div class="form-group magic-field" data-id="content" data-type="content" data-editor="1">
    <label class="control-label"><?php echo e(__('Content')); ?> </label>
    <div class="">
        <textarea name="content" class="d-none has-ckeditor" id="content" cols="30" rows="10"><?php echo e($translation->content); ?></textarea>
    </div>
</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/News/Views/admin/news/form.blade.php ENDPATH**/ ?>