<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__("Página de Busca")); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Configurar a página de busca do seu site')); ?></p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong><?php echo e(__("Opções Gerais")); ?></strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label><?php echo e(__("Título da Página")); ?></label>
                    <div class="form-controls">
                        <input type="text" name="hotel_page_search_title" value="<?php echo e(setting_item_with_lang('hotel_page_search_title',request()->query('lang'))); ?>" class="form-control">
                    </div>
                </div>

                <?php if(is_default_lang()): ?>
                <div class="form-group">
                    <label><?php echo e(__("Banner da Página")); ?></label>
                    <div class="form-controls form-group-image">
                        <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('hotel_page_search_banner',$settings['hotel_page_search_banner'] ?? ""); ?>

                    </div>
                </div>

                <div class="form-group">
                    <label><?php echo e(__("Layout da Busca")); ?></label>
                    <div class="form-controls">
                        <select name="hotel_layout_search" class="form-control">
                            <?php $__currentLoopData = config('hotel.layouts',['normal'=>__("Layout Normal"),'map'=>__("Layout com Mapa")]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>)
                                <option value="<?php echo e($id); ?>" <?php echo e(setting_item('hotel_layout_search','normal') == $id ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <?php do_action(\Modules\Hotel\Hook::HOTEL_SETTING_AFTER_LAYOUT_SEARCH) ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Estilo de Busca por Localização")); ?></label>
                            <div class="form-controls">
                                <select name="hotel_location_search_style" class="form-control">
                                    <option <?php echo e(($settings['hotel_location_search_style'] ?? '') == 'normal' ? 'selected' : ''); ?> value="normal"><?php echo e(__("Normal")); ?></option>
                                    <option <?php echo e(($settings['hotel_location_search_style'] ?? '') == 'autocomplete' ? 'selected' : ''); ?> value="autocomplete"><?php echo e(__('Autocomplete das Localizações')); ?></option>
                                    <option <?php echo e(($settings['hotel_location_search_style'] ?? '') == 'autocompletePlace' ? 'selected' : ''); ?> value="autocompletePlace"><?php echo e(__('Autocomplete do Google Places')); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo e(__("Limite de itens por página")); ?></label>
                            <div class="form-controls">
                                <input type="number" min="1" name="hotel_page_limit_item" placeholder="<?php echo e(__('Padrão: 9')); ?>" value="<?php echo e(setting_item_with_lang('hotel_page_limit_item',request()->query('lang'), 9)); ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" data-condition="hotel_location_search_style:is(autocompletePlace)">
                        <label><?php echo e(__("Opções de Raio de Busca")); ?></label>
                        <div class="input-group mb-3">
                            <input type="number" name="hotel_location_radius_value" min="0" value="<?php echo e(setting_item('hotel_location_radius_value',1)); ?>" class="form-control">
                            <div class="input-group-append">
                                <select name="hotel_location_radius_type">
                                    <option <?php echo e((setting_item('hotel_location_radius_type') ?? '') == 3959 ? 'selected' : ''); ?> value="3959"><?php echo e(__('Milhas')); ?></option>
                                    <option <?php echo e((setting_item('hotel_location_radius_type') ?? '') == 6371 ? 'selected' : ''); ?> value="6371"><?php echo e(__('Km')); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Layout dos Itens na Busca")); ?></label>
                            <div class="form-controls">
                                <select name="hotel_layout_item_search" class="form-control">
                                    <option value="list" <?php echo e(($settings['hotel_layout_item_search'] ?? '') == 'list' ? 'selected' : ''); ?>><?php echo e(__('Lista')); ?></option>
                                    <option value="grid" <?php echo e(($settings['hotel_layout_item_search'] ?? '') == 'grid' ? 'selected' : ''); ?>><?php echo e(__("Grade")); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" data-condition="hotel_layout_item_search:is(list)">
                            <label><?php echo e(__("Quais atributos exibir na listagem?")); ?></label>
                            <div class="form-controls">
                                <?php
                                $attribute = !empty($settings['hotel_attribute_show_in_listing_page'])
                                    ? \Modules\Core\Models\Attributes::find($settings['hotel_attribute_show_in_listing_page'])
                                    : false;
                                \App\Helpers\AdminForm::select2('hotel_attribute_show_in_listing_page', [
                                    'configs' => [
                                        'ajax' => [
                                            'url'      => route('hotel.admin.attribute.getForSelect2'),
                                            'dataType' => 'json'
                                        ]
                                    ]
                                ],
                                !empty($attribute->id) ? [$attribute->id, $attribute->name] : false
                                )
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><?php echo e(__("Opções do Mapa")); ?></label>
                    <div class="form-controls">
                        <select name="hotel_layout_map_option" class="form-control">
                            <option <?php echo e((setting_item_with_lang('hotel_layout_map_option',request()->query('lang')) ?? '') == 'map_left' ? 'selected' : ''); ?> value="map_left"><?php echo e(__('Mapa à Esquerda')); ?></option>
                            <option <?php echo e((setting_item_with_lang('hotel_layout_map_option',request()->query('lang')) ?? '') == 'map_right' ? 'selected' : ''); ?> value="map_right"><?php echo e(__("Mapa à Direita")); ?></option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label><?php echo e(__("Latitude Padrão do Mapa")); ?></label>
                        <div class="form-controls">
                            <input type="text" name="hotel_map_lat_default" value="<?php echo e($settings['hotel_map_lat_default'] ?? ''); ?>" class="form-control" placeholder="21.030513">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label><?php echo e(__("Longitude Padrão do Mapa")); ?></label>
                        <div class="form-controls">
                            <input type="text" name="hotel_map_lng_default" value="<?php echo e($settings['hotel_map_lng_default'] ?? ''); ?>" class="form-control" placeholder="105.840565">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label><?php echo e(__("Zoom Padrão do Mapa")); ?></label>
                        <div class="form-controls">
                            <input type="text" name="hotel_map_zoom_default" value="<?php echo e($settings['hotel_map_zoom_default'] ?? ''); ?>" class="form-control" placeholder="13">
                        </div>
                    </div>

                    <div class="col-md-12 mt-1">
                        <i><?php echo e(__('Pegue latitude e longitude aqui:')); ?>

                            <a href="https://www.latlong.net" target="_blank">https://www.latlong.net</a>
                        </i>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label><?php echo e(__("Ícone do Marcador no Mapa")); ?></label>
                    <div class="form-controls form-group-image">
                        <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('hotel_icon_marker_map',$settings['hotel_icon_marker_map'] ?? ""); ?>

                    </div>
                </div>

                <?php do_action(\Modules\Hotel\Hook::HOTEL_SETTING_AFTER_MAP) ?>
                <?php endif; ?>
            </div>
        </div>

        <?php echo $__env->make('Hotel::admin.settings.form-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('Hotel::admin.settings.map-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="panel">
            <div class="panel-title"><strong><?php echo e(__("Opções de SEO")); ?></strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#seo_1"><?php echo e(__("Opções Gerais")); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_2"><?php echo e(__("Compartilhamento no Facebook")); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_3"><?php echo e(__("Compartilhamento no Twitter")); ?></a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="seo_1">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Título SEO")); ?></label>
                                <input type="text" name="hotel_page_list_seo_title" class="form-control" placeholder="<?php echo e(__("Digite o título...")); ?>" value="<?php echo e(setting_item_with_lang('hotel_page_list_seo_title',request()->query('lang'))); ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Descrição SEO")); ?></label>
                                <input type="text" name="hotel_page_list_seo_desc" class="form-control" placeholder="<?php echo e(__("Digite a descrição...")); ?>" value="<?php echo e(setting_item_with_lang('hotel_page_list_seo_desc',request()->query('lang'))); ?>">
                            </div>

                            <?php if(is_default_lang()): ?>
                            <div class="form-group form-group-image">
                                <label class="control-label"><?php echo e(__("Imagem de Destaque")); ?></label>
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('hotel_page_list_seo_image', $settings['hotel_page_list_seo_image'] ?? "" ); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <?php
                        $seo_share = json_decode(setting_item_with_lang('hotel_page_list_seo_share',request()->query('lang'),'[]'),true);
                        ?>

                        <div class="tab-pane" id="seo_2">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Título para Facebook")); ?></label>
                                <input type="text" name="hotel_page_list_seo_share[facebook][title]" class="form-control" placeholder="<?php echo e(__("Digite o título...")); ?>" value="<?php echo e($seo_share['facebook']['title'] ?? ""); ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Descrição para Facebook")); ?></label>
                                <input type="text" name="hotel_page_list_seo_share[facebook][desc]" class="form-control" placeholder="<?php echo e(__("Digite a descrição...")); ?>" value="<?php echo e($seo_share['facebook']['desc'] ?? ""); ?>">
                            </div>

                            <?php if(is_default_lang()): ?>
                            <div class="form-group form-group-image">
                                <label class="control-label"><?php echo e(__("Imagem para Facebook")); ?></label>
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('hotel_page_list_seo_share[facebook][image]',$seo_share['facebook']['image'] ?? "" ); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="tab-pane" id="seo_3">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Título para Twitter")); ?></label>
                                <input type="text" name="hotel_page_list_seo_share[twitter][title]" class="form-control" placeholder="<?php echo e(__("Digite o título...")); ?>" value="<?php echo e($seo_share['twitter']['title'] ?? ""); ?>">
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Descrição para Twitter")); ?></label>
                                <input type="text" name="hotel_page_list_seo_share[twitter][desc]" class="form-control" placeholder="<?php echo e(__("Digite a descrição...")); ?>" value="<?php echo e($seo_share['twitter']['desc'] ?? ""); ?>">
                            </div>

                            <?php if(is_default_lang()): ?>
                            <div class="form-group form-group-image">
                                <label class="control-label"><?php echo e(__("Imagem para Twitter")); ?></label>
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('hotel_page_list_seo_share[twitter][image]', $seo_share['twitter']['image'] ?? "" ); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php if(is_default_lang()): ?>
<hr>

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__("Opções de Avaliações")); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Configurar avaliações dos hotéis')); ?></p>
    </div>

    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                <div class="form-group">
                    <label><?php echo e(__("Ativar sistema de avaliações?")); ?></label>
                    <div class="form-controls">
                        <label>
                            <input type="checkbox" name="hotel_enable_review" value="1" <?php if(!empty($settings['hotel_enable_review'])): ?> checked <?php endif; ?> />
                            <?php echo e(__("Sim, ativar")); ?>

                        </label>
                        <br>
                        <small class="form-text text-muted"><?php echo e(__("Ative para permitir avaliações dos hotéis")); ?></small>
                    </div>
                </div>

                <div class="form-group" data-condition="hotel_enable_review:is(1)">
                    <label><?php echo e(__("O cliente precisa reservar antes de avaliar?")); ?></label>
                    <div class="form-controls">
                        <label>
                            <input type="checkbox" name="hotel_enable_review_after_booking" value="1" <?php if(!empty($settings['hotel_enable_review_after_booking'])): ?> checked <?php endif; ?> />
                            <?php echo e(__("Sim")); ?>

                        </label>
                        <br>
                        <small class="form-text text-muted"><?php echo e(__("ON: avaliar somente após reserva — OFF: avaliar sem reserva")); ?></small>
                    </div>
                </div>

                <div class="form-group" data-condition="hotel_enable_review:is(1),hotel_enable_review_after_booking:is(1)">
                    <label><?php echo e(__("Permitir avaliação após qual status de reserva?")); ?></label>
                    <div class="form-controls">
                        <?php
                        $status = config('booking.statuses');
                        $settings_status = !empty($settings['hotel_allow_review_after_making_completed_booking'])
                            ? json_decode($settings['hotel_allow_review_after_making_completed_booking'])
                            : [];
                        ?>

                        <div class="row">
                            <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4">
                                    <label>
                                        <input type="checkbox" name="hotel_allow_review_after_making_completed_booking[]" value="<?php echo e($item); ?>" <?php if(in_array($item,$settings_status)): ?> checked <?php endif; ?>>
                                        <?php echo e(booking_status_to_text($item)); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <small class="form-text text-muted"><?php echo e(__("Selecione os status permitidos")); ?></small>
                        <small class="form-text text-muted"><?php echo e(__("Deixe em branco para permitir em todos os status")); ?></small>
                    </div>
                </div>

                <div class="form-group" data-condition="hotel_enable_review:is(1)">
                    <label><?php echo e(__("Avaliações precisam ser aprovadas?")); ?></label>
                    <div class="form-controls">
                        <label>
                            <input type="checkbox" name="hotel_review_approved" value="1" <?php if(!empty($settings['hotel_review_approved'])): ?> checked <?php endif; ?> />
                            <?php echo e(__("Sim")); ?>

                        </label>
                        <br>
                        <small class="form-text text-muted"><?php echo e(__("ON: admin precisa aprovar — OFF: aprovar automaticamente")); ?></small>
                    </div>
                </div>

                <div class="form-group" data-condition="hotel_enable_review:is(1)">
                    <label><?php echo e(__("Quantidade de avaliações por página")); ?></label>
                    <div class="form-controls">
                        <input type="number" class="form-control" name="hotel_review_number_per_page" value="<?php echo e($settings['hotel_review_number_per_page'] ?? 5); ?>">
                        <small class="form-text text-muted"><?php echo e(__("Paginação das avaliações")); ?></small>
                    </div>
                </div>

                <div class="form-group" data-condition="hotel_enable_review:is(1)">
                    <label><?php echo e(__("Critérios de avaliação")); ?></label>
                    <div class="form-controls">
                        <div class="form-group-item">
                            <div class="g-items-header">
                                <div class="row">
                                    <div class="col-md-5"><?php echo e(__("Título")); ?></div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>

                            <div class="g-items">
                                <?php if(!empty($settings['hotel_review_stats'])) {
                                    $social_share = json_decode($settings['hotel_review_stats']);
                                ?>
                                <?php $__currentLoopData = $social_share; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item" data-number="<?php echo e($key); ?>">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input type="text" name="hotel_review_stats[<?php echo e($key); ?>][title]" class="form-control" value="<?php echo e($item->title); ?>" placeholder="<?php echo e(__('Ex: Serviço')); ?>">
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-danger btn-sm btn-remove-item">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php } ?>
                            </div>

                            <div class="text-right">
                                <span class="btn btn-info btn-sm btn-add-item">
                                    <i class="icon ion-ios-add-circle-outline"></i>
                                    <?php echo e(__('Adicionar item')); ?>

                                </span>
                            </div>

                            <div class="g-more hide">
                                <div class="item" data-number="__number__">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input type="text" __name__="hotel_review_stats[__number__][title]" class="form-control" placeholder="<?php echo e(__('Ex: Serviço')); ?>">
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-danger btn-sm btn-remove-item">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(is_default_lang()): ?>
<hr>

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__("Taxas do Comprador")); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Configurar taxas adicionais para reservas de hotel')); ?></p>
    </div>

    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                <div class="form-group-item">
                    <label class="control-label"><?php echo e(__('Taxas do Comprador')); ?></label>

                    <div class="g-items-header">
                        <div class="row">
                            <div class="col-md-5"><?php echo e(__("Nome")); ?></div>
                            <div class="col-md-3"><?php echo e(__("Preço")); ?></div>
                            <div class="col-md-3"><?php echo e(__('Tipo')); ?></div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <div class="g-items">
                        <?php $languages = \Modules\Language\Models\Language::getActive(); ?>

                        <?php if(!empty($settings['hotel_booking_buyer_fees'])): ?>
                            <?php $hotel_booking_buyer_fees = json_decode($settings['hotel_booking_buyer_fees'],true); ?>

                            <?php $__currentLoopData = $hotel_booking_buyer_fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$buyer_fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item" data-number="<?php echo e($key); ?>">
                                <div class="row">

                                    <div class="col-md-5">
                                        <?php if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale')): ?>

                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : "" ?>

                                            <div class="g-lang">
                                                <div class="title-lang"><?php echo e($language->name); ?></div>

                                                <input type="text" name="hotel_booking_buyer_fees[<?php echo e($key); ?>][name<?php echo e($key_lang); ?>]" class="form-control" value="<?php echo e($buyer_fee['name'.$key_lang] ?? ''); ?>" placeholder="<?php echo e(__('Nome da taxa')); ?>">

                                                <input type="text" name="hotel_booking_buyer_fees[<?php echo e($key); ?>][desc<?php echo e($key_lang); ?>]" class="form-control" value="<?php echo e($buyer_fee['desc'.$key_lang] ?? ''); ?>" placeholder="<?php echo e(__('Descrição da taxa')); ?>">
                                            </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php else: ?>

                                            <input type="text" name="hotel_booking_buyer_fees[<?php echo e($key); ?>][name]" class="form-control" value="<?php echo e($buyer_fee['name'] ?? ''); ?>" placeholder="<?php echo e(__('Nome da taxa')); ?>">
                                            <input type="text" name="hotel_booking_buyer_fees[<?php echo e($key); ?>][desc]" class="form-control" value="<?php echo e($buyer_fee['desc'] ?? ''); ?>" placeholder="<?php echo e(__('Descrição da taxa')); ?>">

                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="number" min="0" step="0.1" name="hotel_booking_buyer_fees[<?php echo e($key); ?>][price]" class="form-control" value="<?php echo e($buyer_fee['price']); ?>">
                                        
                                        <select name="hotel_booking_buyer_fees[<?php echo e($key); ?>][type]" class="form-control mt-1">
                                            <option value="fixed" <?php echo e(($buyer_fee['type'] ?? '') === 'fixed' ? 'selected' : ''); ?>><?php echo e(__('Fixo')); ?></option>
                                            <option value="percent" <?php echo e(($buyer_fee['type'] ?? '') === 'percent' ? 'selected' : ''); ?>><?php echo e(__('Percentual')); ?></option>
                                        </select>
                                    </div>

                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </div>

                    <div class="text-right">
                        <span class="btn btn-info btn-sm btn-add-item">
                            <i class="icon ion-ios-add-circle-outline"></i>
                            <?php echo e(__('Adicionar taxa')); ?>

                        </span>
                    </div>

                    <div class="g-more hide">
                        <div class="item" data-number="__number__">
                            <div class="row">

                                <div class="col-md-5">
                                    <input type="text" __name__="hotel_booking_buyer_fees[__number__][name]" class="form-control" placeholder="<?php echo e(__('Nome da taxa')); ?>">
                                    <input type="text" __name__="hotel_booking_buyer_fees[__number__][desc]" class="form-control" placeholder="<?php echo e(__('Descrição da taxa')); ?>">
                                </div>

                                <div class="col-md-3">
                                    <input type="number" min="0" step="0.1" __name__="hotel_booking_buyer_fees[__number__][price]" class="form-control">

                                    <select __name__="hotel_booking_buyer_fees[__number__][type]" class="form-control mt-1">
                                        <option value="fixed"><?php echo e(__('Fixo')); ?></option>
                                        <option value="percent"><?php echo e(__('Percentual')); ?></option>
                                    </select>
                                </div>

                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div> <!-- group-item -->

            </div>
        </div>
    </div>

</div>
<?php endif; ?>
<?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Hotel/Views/admin/settings/hotel.blade.php ENDPATH**/ ?>