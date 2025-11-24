<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Conteúdo")); ?></strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label><?php echo e(__("Título")); ?> <span class="text-danger">*</span></label>
            <input type="text" value="<?php echo e(old('title',$translation->title)); ?>" required placeholder="<?php echo e(__("Nome do Popup")); ?>" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Conteúdo")); ?></label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e(old('content',$translation->content)); ?></textarea>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Popup/Views/admin/popup/content.blade.php ENDPATH**/ ?>