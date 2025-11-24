
<?php $__env->startSection('content'); ?>
<h2 class="title-bar">
    <?php echo e(__("Configurações")); ?>

    <a href="<?php echo e(route('user.change_password')); ?>" class="btn-change-password"><?php echo e(__("Alterar senha")); ?></a>
</h2>
<?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<form action="<?php echo e(route('user.profile.update')); ?>" method="post" class="input-has-icon">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-title">
                <strong><?php echo e(__("Informações Pessoais")); ?></strong>
            </div>
            <?php if($is_vendor_access): ?>
            <div class="form-group">
                <label><?php echo e(__("Razão Social")); ?></label>
                <input type="text" value="<?php echo e(old('business_name',$dataUser->business_name)); ?>" name="business_name" placeholder="<?php echo e(__("Razão Social")); ?>" class="form-control">
                <i class="fa fa-user input-icon"></i>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label><?php echo e(__("Nome de Acesso")); ?> <span class="text-danger">*</span></label>
                <input type="text" required minlength="4" name="user_name" value="<?php echo e(old('user_name',$dataUser->user_name)); ?>" placeholder="<?php echo e(__("Nome de Acesso")); ?>" class="form-control">
                <i class="fa fa-user input-icon"></i>
            </div>
            <div class="form-group">
                <label><?php echo e(__("E-mail")); ?></label>
                <input type="text" name="email" value="<?php echo e(old('email',$dataUser->email)); ?>" placeholder="<?php echo e(__("E-mail")); ?>" class="form-control">
                <i class="fa fa-envelope input-icon"></i>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo e(__("Primeiro Nome")); ?></label>
                        <input type="text" value="<?php echo e(old('first_name',$dataUser->first_name)); ?>" name="first_name" placeholder="<?php echo e(__("Primeiro Nome")); ?>" class="form-control">
                        <i class="fa fa-user input-icon"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo e(__("Sobrenome")); ?></label>
                        <input type="text" value="<?php echo e(old('last_name',$dataUser->last_name)); ?>" name="last_name" placeholder="<?php echo e(__("Sobrenome")); ?>" class="form-control">
                        <i class="fa fa-user input-icon"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- RELIGION -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo e(__("Religião")); ?></label>
                        <select name="religion" class="form-control">
                            <option value=""><?php echo e(__("Select religion")); ?></option>
                            <option value="CATHOLIC" <?php echo e(old('religion', $dataUser->religion ?? '') == 'CATHOLIC' ? 'selected' : ''); ?>>
                                <?php echo e(__("Católico")); ?>

                            </option>
                            <option value="EVANGELICAL" <?php echo e(old('religion', $dataUser->religion ?? '') == 'EVANGELICAL' ? 'selected' : ''); ?>>
                                <?php echo e(__("Evangélico")); ?>

                            </option>
                            <option value="BOTH" <?php echo e(old('religion', $dataUser->religion ?? '') == 'BOTH' ? 'selected' : ''); ?>>
                                <?php echo e(__("Ambos")); ?>

                            </option>
                        </select>
                        <i class="fa fa-church input-icon"></i>
                    </div>
                </div>

                <!-- SEX -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo e(__("Sexo")); ?></label>
                        <select name="sex" class="form-control">
                            <option value=""><?php echo e(__("Selecione o sexo")); ?></option>
                            <option value="MASCULINE" <?php echo e(old('sex', $dataUser->sex ?? '') == 'MASCULINE' ? 'selected' : ''); ?>>
                                <?php echo e(__("Masculino")); ?>

                            </option>
                            <option value="FEMININE" <?php echo e(old('sex', $dataUser->sex ?? '') == 'FEMININE' ? 'selected' : ''); ?>>
                                <?php echo e(__("Femino")); ?>

                            </option>
                        </select>
                        <i class="fa fa-venus-mars input-icon"></i>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label><?php echo e(__("Celular")); ?></label>
                <input type="text" value="<?php echo e(old('phone',$dataUser->phone)); ?>" name="phone" placeholder="<?php echo e(__("Celular")); ?>" class="form-control">
                <i class="fa fa-phone input-icon"></i>
            </div>
            <div class="form-group">
                <label><?php echo e(__("Data de Nascimento")); ?></label>
                <input type="text" value="<?php echo e(old('birthday',$dataUser->birthday? display_date($dataUser->birthday) :'')); ?>" name="birthday" placeholder="<?php echo e(__("Data de Nascimento")); ?>" class="form-control date-picker">
                <i class="fa fa-birthday-cake input-icon"></i>
            </div>
            <div class="form-group">
                <label><?php echo e(__("Sobre Você")); ?></label>
                <textarea name="bio" rows="5" class="form-control"><?php echo e(old('bio',$dataUser->bio)); ?></textarea>
            </div>
            <div class="form-group">
                <label><?php echo e(__("Avatar")); ?></label>
                <div class="upload-btn-wrapper">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                <?php echo e(__("Browse")); ?>… <input type="file">
                            </span>
                        </span>
                        <input type="text" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Carregando...")); ?>" class="form-control text-view" readonly value="<?php echo e(get_file_url( old('avatar_id',$dataUser->avatar_id) ) ?? $dataUser->getAvatarUrl()?? __("No Image")); ?>">
                    </div>
                    <input type="hidden" class="form-control" name="avatar_id" value="<?php echo e(old('avatar_id',$dataUser->avatar_id)?? ""); ?>">
                    <img class="image-demo" src="<?php echo e(get_file_url( old('avatar_id',$dataUser->avatar_id) ) ??  $dataUser->getAvatarUrl() ?? ""); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-title">
                <strong><?php echo e(__("Informações Localização")); ?></strong>
            </div>
            <div class="form-group">
                <label><?php echo e(__("Endereço 1")); ?></label>
                <input type="text" value="<?php echo e(old('address',$dataUser->address)); ?>" name="address" placeholder="<?php echo e(__("Address")); ?>" class="form-control">
                <i class="fa fa-location-arrow input-icon"></i>
            </div>
            <div class="form-group">
                <label><?php echo e(__("Endereço 2")); ?></label>
                <input type="text" value="<?php echo e(old('address2',$dataUser->address2)); ?>" name="address2" placeholder="<?php echo e(__("Address2")); ?>" class="form-control">
                <i class="fa fa-location-arrow input-icon"></i>
            </div>
            <div class="form-group">
                <label><?php echo e(__("Cidade")); ?></label>
                <input type="text" value="<?php echo e(old('city',$dataUser->city)); ?>" name="city" placeholder="<?php echo e(__("Cidade")); ?>" class="form-control">
                <i class="fa fa-street-view input-icon"></i>
            </div>
            <div class="form-group">
                <label><?php echo e(__("Estado")); ?></label>
                <input type="text" value="<?php echo e(old('state',$dataUser->state)); ?>" name="state" placeholder="<?php echo e(__("Estado")); ?>" class="form-control">
                <i class="fa fa-map-signs input-icon"></i>
            </div>
            <div class="form-group">
                <label><?php echo e(__("País")); ?></label>
                <select name="country" class="form-control">
                    <option value=""><?php echo e(__('-- Selecione --')); ?></option>
                    <?php $__currentLoopData = get_country_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if((old('country',$dataUser->country ?? '')) == $id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label><?php echo e(__("CEP")); ?></label>
                <input type="text" value="<?php echo e(old('zip_code',$dataUser->zip_code)); ?>" name="zip_code" placeholder="<?php echo e(__("CEP")); ?>" class="form-control">
                <i class="fa fa-map-pin input-icon"></i>
            </div>

        </div>
        <div class="col-md-12">
            <hr>
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php echo e(__('Salvar alterações')); ?></button>
        </div>
    </div>
</form>
<?php if(!empty(setting_item('user_enable_permanently_delete')) and !is_admin()): ?>
<hr>
<div class="row">
    <div class="col-md-12">
        <h4 class="text-danger">
            <?php echo e(__("Delete account")); ?>

        </h4>
        <div class="mb-4 mt-2">
            <?php echo clean(setting_item_with_lang('user_permanently_delete_content','',__('Your account will be permanently deleted. Once you delete your account, there is no going back. Please be certain.'))); ?>

        </div>
        <a data-toggle="modal" data-target="#permanentlyDeleteAccount" class="btn btn-danger" href=""><?php echo e(__('Delete your account')); ?></a>
    </div>

    <!-- Modal -->
    <div class="modal  fade" id="permanentlyDeleteAccount" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Confirm permanently delete account')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="my-3">
                        <?php echo clean(setting_item_with_lang('user_permanently_delete_content_confirm')); ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Fechar')); ?></button>
                    <a href="<?php echo e(route('user.permanently.delete')); ?>" class="btn btn-danger"><?php echo e(__('Confirm')); ?></a>
                </div>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Base/User/Views/frontend/profile.blade.php ENDPATH**/ ?>