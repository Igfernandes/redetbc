<div class="form-group">
    <label><?php echo e(__("Nome")); ?></label>
    <input type="text" value="<?php echo e($translation->name); ?>" placeholder="<?php echo e(__("Nome do Atributo")); ?>" name="name" class="form-control">
</div>
<?php if(is_default_lang()): ?>
    <div class="form-group">
        <label><?php echo e(__("Ordem da posição")); ?></label>
        <input type="number" min="0" value="<?php echo e($row->position); ?>" placeholder="<?php echo e(__("Ex: 1")); ?>" name="position" class="form-control">
        <small>
            <?php echo e(__("A posição será usada para ordenar na página de pesquisa de filtros. O número maior tem prioridade")); ?>

        </small>
    </div>
    <div class="form-group">
        <label><?php echo e(__('Ocultar no detalhe do serviço')); ?></label>
        <br>
        <label>
            <input type="checkbox" name="hide_in_single" <?php if($row->hide_in_single): ?> checked <?php endif; ?> value="1"> <?php echo e(__("Ativar ocultar")); ?>

        </label>
    </div>
    <div class="form-group">
        <label><?php echo e(__('Ocultar na pesquisa de filtro')); ?></label>
        <br>
        <label>
            <input type="checkbox" name="hide_in_filter_search" <?php if($row->hide_in_filter_search): ?> checked <?php endif; ?> value="1"> <?php echo e(__("Ativar ocultar")); ?>

        </label>
    </div>
<?php endif; ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Tour/Views/admin/attribute/form.blade.php ENDPATH**/ ?>