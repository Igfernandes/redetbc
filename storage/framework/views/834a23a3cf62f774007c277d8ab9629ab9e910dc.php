<?php
if(is_default_lang()){
    $meta_seo = $row->getSeoMeta();
}else{
    $meta_seo = $translation->getSeoMeta(request()->query('lang'));
}
$seo_share = $meta_seo['seo_share'] ?? false;
$desc = $meta_seo['seo_desc'] ?? $meta_seo['service_desc'] ?? '';
?>
<div class="panel">
    <div class="panel-title d-flex justify-content-between align-items-center py-2"><strong><?php echo e(__("Mecanismo de busca")); ?></strong>
        <a href="#" data-toggle="modal" data-target="#seo_config" class="btn btn-sm btn-link"><?php echo e(__("Editarar")); ?></a>
    </div>
    <div class="panel-body">
        <div class="seo-preview max-w-650">
            <div class="d-flex align-items-center mb-2">
                <div class="seo-favicon w-28 h-28 mr-2 d-flex align-items-center justify-content-center">
                    <?php
                        $favicon = setting_item('site_favicon');
                    ?>
                    <?php if($favicon): ?>
                        <?php
                            $file = (new \Modules\Media\Models\MediaFile())->findById($favicon);
                        ?>
                        <?php if(!empty($file)): ?>
                            <img rel="icon" class="w-18 h-18" type="<?php echo e($file['file_type']); ?>" src="<?php echo e(asset('uploads/'.$file['file_path'])); ?>" />
                        <?php else: ?>
                            :
                            <img rel="icon" class="w-18 h-18" type="image/png" src="<?php echo e(url('images/favicon.png')); ?>" />
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div>
                    <div class="seo-site-name text-14"><?php echo e(setting_item_with_lang('site_title',request('lang'))); ?></div>
                    <div class="seo-url text-12"><?php echo e($meta_seo['full_url'] ?? url('/')); ?></div>
                </div>
            </div>
            <div>
                <div class="seo-title text-20 mb-2">
                    <span class="val"><?php echo e($meta_seo['seo_title'] ?? $row->title ?? $row->name); ?></span>
                </div>
                <div class="seo-desc text-14"><?php echo e($desc); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="seo_config">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(__("Mecanismo de pesquisa")); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php if(!is_default_lang()): ?> d-none <?php endif; ?> ">
                            <label class="control-label">
                                <?php echo e(__("Permitir que mecanismos de busca mostrem este serviço nos resultados de pesquisa?")); ?>

                            </label>
                            <select name="seo_index" class="form-control">
                                <option
                                    value="1"
                                    <?php if(isset($meta_seo['seo_index']) and $meta_seo['seo_index'] == 1): ?> selected <?php endif; ?>><?php echo e(__("Sim")); ?></option>
                                <option
                                    value="0" <?php if(isset($meta_seo['seo_index']) and $meta_seo['seo_index'] == 0): ?> selected <?php endif; ?>><?php echo e(__("Não")); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs mb-2" data-condition="seo_index:is(1)">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#seo_1"><?php echo e(__("Opções Gerais")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#seo_2"><?php echo e(__("Compartilhar Facebook")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#seo_3"><?php echo e(__("Compartilhar Twitter")); ?></a>
                    </li>
                </ul>
                <div class="tab-content" data-condition="seo_index:is(1)">
                    <div class="tab-pane active" id="seo_1">
                        <div class="form-group">
                            <label class="control-label"><?php echo e(__("Título SEO")); ?></label>
                            <input
                                type="text"
                                name="seo_title"
                                class="form-control"
                                placeholder="<?php echo e($row->title ?? $row->name ?? __("Deixe em branco para usar o título do serviço")); ?>"
                                value="<?php echo e($meta_seo['seo_title'] ?? ""); ?>"
                            >
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?php echo e(__("Descrição de SEO")); ?></label>
                            <textarea
                                name="seo_desc" rows="3" class="form-control" placeholder="<?php echo e($desc ?? __("Insira a descrição...")); ?>"
                            ><?php echo e($meta_seo['seo_desc'] ?? ""); ?></textarea>
                        </div>
                        <?php if(is_default_lang()): ?>
                            <div class="form-group form-group-image">
                                <label class="control-label"><?php echo e(__("Imagem em destaque")); ?></label>
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('seo_image', $meta_seo['seo_image'] ?? "" ); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane" id="seo_2">
                        <div class="form-group">
                            <label class="control-label"><?php echo e(__("Título do Facebook")); ?></label>
                            <input
                                type="text"
                                name="seo_share[facebook][title]"
                                class="form-control"
                                placeholder="<?php echo e($row->title ?? $row->name ?? __("Insira o título...")); ?>"
                                value="<?php echo e($seo_share['facebook']['title'] ?? ""); ?>"
                            >
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?php echo e(__("Descrição do Facebook")); ?></label>
                            <textarea
                                name="seo_share[facebook][desc]"
                                rows="3"
                                class="form-control"
                                placeholder="<?php echo e($row->short_desc ?? __("Insira a descrição...")); ?>"
                            ><?php echo e($seo_share['facebook']['desc'] ?? ""); ?></textarea>
                        </div>
                        <?php if(is_default_lang()): ?>
                            <div class="form-group form-group-image">
                                <label class="control-label"><?php echo e(__("Imagem do Facebook")); ?></label>
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('seo_share[facebook][image]',$seo_share['facebook']['image'] ?? "" ); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane" id="seo_3">
                        <div class="form-group">
                            <label class="control-label"><?php echo e(__("Título do Twitter")); ?></label>
                            <input
                                type="text"
                                name="seo_share[twitter][title]"
                                class="form-control"
                                placeholder="<?php echo e($row->title ?? $row->name ?? __("Enter title...")); ?>"
                                value="<?php echo e($seo_share['twitter']['title'] ?? ""); ?>"
                            >
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?php echo e(__("Descrição do Twitter")); ?></label>
                            <textarea
                                name="seo_share[twitter][desc]"
                                rows="3"
                                class="form-control"
                                placeholder="<?php echo e($row->short_desc ?? __("Insira a descrição...")); ?>"
                            ><?php echo e($seo_share['twitter']['desc'] ?? ""); ?></textarea>
                        </div>
                        <?php if(is_default_lang()): ?>
                            <div class="form-group form-group-image">
                                <label class="control-label"><?php echo e(__("Imagem do Twitter")); ?></label>
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('seo_share[twitter][image]', $seo_share['twitter']['image'] ?? "" ); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary"><?php echo e(__("Aplicar")); ?></button>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('js'); ?>
    <script>
        $('#seo_config').on('hide.bs.modal', function() {
            const form = $(this);
            const preview = $('.seo-preview');
            const title = form.find('[name=seo_desc]').val();
            if (title) {
                preview.find('.seo-title .val').html(title);
            }
            const desc = form.find('[name=seo_desc]').val();
            if (desc) {
                preview.find('.seo-desc').html(desc);
            }
        });
    </script>

<?php $__env->stopPush(); ?>
<?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Core/Views/admin/seo-meta/seo-meta.blade.php ENDPATH**/ ?>