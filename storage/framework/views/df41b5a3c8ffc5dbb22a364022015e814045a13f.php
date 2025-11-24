<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Preços")); ?></strong></div>
    <div class="panel-body">
        <?php if(is_default_lang()): ?>
            <h3 class="panel-body-title"><?php echo e(__("Preço do Passeio")); ?></h3>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo e(__("Preço")); ?></label>
                        <input type="text" name="price" class="form-control" value="<?php echo e(old('price',$row->price)); ?>" placeholder="<?php echo e(__("Preço do Passeio")); ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo e(__("Preço com Desconto")); ?></label>
                        <input type="text" name="sale_price" class="form-control" value="<?php echo e(old('sale_price',$row->sale_price)); ?>" placeholder="<?php echo e(__("Preço com Desconto")); ?>">
                    </div>
                </div>
                <div class="col-lg-12">
                    <span>
                        <?php echo e(__("Se o preço regular for menor que o preço com desconto, será exibido apenas o preço regular.")); ?>

                    </span>
                </div>
            </div>
            <hr>
        <?php endif; ?>

        <?php if(is_default_lang()): ?>
            <h3 class="panel-body-title"><?php echo e(__('Tipos de Pessoa')); ?></h3>
            <div class="form-group">
                <label><input type="checkbox" name="enable_person_types" <?php if(!empty($row->meta->enable_person_types)): ?> checked <?php endif; ?> value="1"> <?php echo e(__('Ativar Tipos de Pessoa')); ?>

                </label>
            </div>

            <div class="form-group-item" data-condition="enable_person_types:is(1)">
                <label class="control-label"><?php echo e(__('Tipos de Pessoa')); ?></label>
                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-5"><?php echo e(__("Tipo de Pessoa")); ?></div>
                        <div class="col-md-2"><?php echo e(__('mín')); ?></div>
                        <div class="col-md-2"><?php echo e(__('máx')); ?></div>
                        <div class="col-md-2"><?php echo e(__('Preço')); ?></div>
                        <div class="col-md-1"></div>
                    </div>
                </div>

                <div class="g-items">
                    <?php  $languages = \Modules\Language\Models\Language::getActive();  ?>
                    <?php if(!empty($person_types = old('person_types',$row->meta->person_types ?? ""))): ?>
                        <?php $__currentLoopData = $person_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$person_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item" data-number="<?php echo e($key); ?>">
                                <div class="row">
                                    <div class="col-md-5">
                                        <?php if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale')): ?>
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : "" ?>
                                                <div class="g-lang">
                                                    <div class="title-lang"><?php echo e($language->name); ?></div>
                                                    <input type="text" name="person_types[<?php echo e($key); ?>][name<?php echo e($key_lang); ?>]" class="form-control" value="<?php echo e($person_type['name'.$key_lang] ?? ''); ?>" placeholder="<?php echo e(__('Ex: Adultos')); ?>">
                                                    <input type="text" name="person_types[<?php echo e($key); ?>][desc<?php echo e($key_lang); ?>]" class="form-control" value="<?php echo e($person_type['desc'.$key_lang] ?? ''); ?>" placeholder="<?php echo e(__('Descrição')); ?>">
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <input type="text" name="person_types[<?php echo e($key); ?>][name]" class="form-control" value="<?php echo e($person_type['name'] ?? ''); ?>" placeholder="<?php echo e(__('Ex: Adultos')); ?>">
                                            <input type="text" name="person_types[<?php echo e($key); ?>][desc]" class="form-control" value="<?php echo e($person_type['desc'] ?? ''); ?>" placeholder="<?php echo e(__('Descrição')); ?>">
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-2">
                                        <input type="number" min="0" name="person_types[<?php echo e($key); ?>][min]" class="form-control" value="<?php echo e($person_type['min'] ?? 0); ?>" placeholder="<?php echo e(__("Mínimo por reserva")); ?>">
                                    </div>

                                    <div class="col-md-2">
                                        <input type="number" min="0" name="person_types[<?php echo e($key); ?>][max]" class="form-control" value="<?php echo e($person_type['max'] ?? 0); ?>" placeholder="<?php echo e(__("Máximo por reserva")); ?>">
                                    </div>

                                    <div class="col-md-2">
                                        <input type="text" min="0" name="person_types[<?php echo e($key); ?>][price]" class="form-control" value="<?php echo e($person_type['price'] ?? 0); ?>" placeholder="<?php echo e(__("por 1 unidade")); ?>">
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
                                <?php if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale')): ?>
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $key = setting_item('site_locale') != $language->locale ? "_".$language->locale : "" ?>
                                        <div class="g-lang">
                                            <div class="title-lang"><?php echo e($language->name); ?></div>
                                            <input type="text" __name__="person_types[__number__][name<?php echo e($key); ?>]" class="form-control" placeholder="<?php echo e(__('Ex: Adultos')); ?>">
                                            <input type="text" __name__="person_types[__number__][desc<?php echo e($key); ?>]" class="form-control" placeholder="<?php echo e(__('Descrição')); ?>">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <input type="text" __name__="person_types[__number__][name]" class="form-control" placeholder="<?php echo e(__('Ex: Adultos')); ?>">
                                    <input type="text" __name__="person_types[__number__][desc]" class="form-control" placeholder="<?php echo e(__('Descrição')); ?>">
                                <?php endif; ?>
                            </div>

                            <div class="col-md-2">
                                <input type="number" min="0" __name__="person_types[__number__][min]" class="form-control" placeholder="<?php echo e(__("Mínimo por reserva")); ?>">
                            </div>

                            <div class="col-md-2">
                                <input type="number" min="0" __name__="person_types[__number__][max]" class="form-control" placeholder="<?php echo e(__("Máximo por reserva")); ?>">
                            </div>

                            <div class="col-md-2">
                                <input type="text" min="0" __name__="person_types[__number__][price]" class="form-control" placeholder="<?php echo e(__("por 1 unidade")); ?>">
                            </div>

                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- EXTRA PRICE -->
        <?php if(is_default_lang()): ?>
            <hr>
            <h3 class="panel-body-title"><?php echo e(__('Preço Extra')); ?></h3>

            <div class="form-group">
                <label><input type="checkbox" name="enable_extra_price" <?php if(!empty($row->meta->enable_extra_price)): ?> checked <?php endif; ?> value="1"> <?php echo e(__('Ativar preço extra')); ?></label>
            </div>

            <div class="form-group-item" data-condition="enable_extra_price:is(1)">
                <label class="control-label"><?php echo e(__('Preço Extra')); ?></label>

                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-5"><?php echo e(__("Nome")); ?></div>
                        <div class="col-md-3"><?php echo e(__('Preço')); ?></div>
                        <div class="col-md-3"><?php echo e(__('Tipo')); ?></div>
                        <div class="col-md-1"></div>
                    </div>
                </div>

                <div class="g-items">
                    <?php if(!empty($extra_prices = old('extra_price',$row->meta->extra_price ?? ""))): ?>
                        <?php $__currentLoopData = $extra_prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$extra_price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item" data-number="<?php echo e($key); ?>">
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" name="extra_price[<?php echo e($key); ?>][name]" class="form-control" value="<?php echo e($extra_price['name'] ?? ''); ?>" placeholder="<?php echo e(__('Nome do preço extra')); ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" min="0" name="extra_price[<?php echo e($key); ?>][price]" class="form-control" value="<?php echo e($extra_price['price']); ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <select name="extra_price[<?php echo e($key); ?>][type]" class="form-control">
                                            <option <?php if($extra_price['type'] == 'one_time'): ?> selected <?php endif; ?> value="one_time"><?php echo e(__("Único")); ?></option>
                                            <option <?php if($extra_price['type'] == 'per_hour'): ?> selected <?php endif; ?> value="per_hour"><?php echo e(__("Por hora")); ?></option>
                                            <option <?php if($extra_price['type'] == 'per_day'): ?> selected <?php endif; ?> value="per_day"><?php echo e(__("Por dia")); ?></option>
                                        </select>

                                        <label>
                                            <input type="checkbox" min="0" name="extra_price[<?php echo e($key); ?>][per_person]" value="on" <?php if($extra_price['per_person'] ?? ''): ?> checked <?php endif; ?>>
                                            <?php echo e(__("Preço por pessoa")); ?>

                                        </label>
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
                                <input type="text" __name__="extra_price[__number__][name]" class="form-control" placeholder="<?php echo e(__('Nome do preço extra')); ?>">
                            </div>

                            <div class="col-md-3">
                                <input type="text" min="0" __name__="extra_price[__number__][price]" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <select __name__="extra_price[__number__][type]" class="form-control">
                                    <option value="one_time"><?php echo e(__("Único")); ?></option>
                                    <option value="per_hour"><?php echo e(__("Por hora")); ?></option>
                                    <option value="per_day"><?php echo e(__("Por dia")); ?></option>
                                </select>

                                <label>
                                    <input type="checkbox" __name__="extra_price[__number__][per_person]" value="on">
                                    <?php echo e(__("Preço por pessoa")); ?>

                                </label>
                            </div>

                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php endif; ?>

        <!-- DESCONTO POR NÚMERO DE PESSOAS -->
        <?php if(is_default_lang()): ?>
            <hr>
            <h3 class="panel-body-title"><?php echo e(__('Desconto por quantidade de pessoas')); ?></h3>

            <div class="form-group-item">
                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-4"><?php echo e(__("Nº de pessoas")); ?></div>
                        <div class="col-md-3"><?php echo e(__('Desconto')); ?></div>
                        <div class="col-md-3"><?php echo e(__('Tipo')); ?></div>
                        <div class="col-md-1"></div>
                    </div>
                </div>

                <div class="g-items">
                    <?php if(!empty($discount_by_people = old('discount_by_people',$row->meta->discount_by_people ?? ""))): ?>
                        <?php $__currentLoopData = $discount_by_people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item" data-number="<?php echo e($key); ?>">
                                <div class="row">

                                    <div class="col-md-2">
                                        <input type="number" min="0" name="discount_by_people[<?php echo e($key); ?>][from]" class="form-control" value="<?php echo e($item['from']); ?>" placeholder="<?php echo e(__('De')); ?>">
                                    </div>

                                    <div class="col-md-2">
                                        <input type="number" min="0" name="discount_by_people[<?php echo e($key); ?>][to]" class="form-control" value="<?php echo e($item['to']); ?>" placeholder="<?php echo e(__('Até')); ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="number" min="0" name="discount_by_people[<?php echo e($key); ?>][amount]" class="form-control" value="<?php echo e($item['amount']); ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <select name="discount_by_people[<?php echo e($key); ?>][type]" class="form-control">
                                            <option <?php if($item['type'] == 'fixed'): ?> selected <?php endif; ?> value="fixed"><?php echo e(__("Fixo")); ?></option>
                                            <option <?php if($item['type'] == 'percent'): ?> selected <?php endif; ?> value="percent"><?php echo e(__("Percentual (%)")); ?></option>
                                        </select>
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

                            <div class="col-md-2">
                                <input type="number" min="0" __name__="discount_by_people[__number__][from]" class="form-control" placeholder="<?php echo e(__('De')); ?>">
                            </div>

                            <div class="col-md-2">
                                <input type="number" min="0" __name__="discount_by_people[__number__][to]" class="form-control" placeholder="<?php echo e(__('Até')); ?>">
                            </div>

                            <div class="col-md-3">
                                <input type="number" min="0" __name__="discount_by_people[__number__][amount]" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <select __name__="discount_by_people[__number__][type]" class="form-control">
                                    <option value="fixed"><?php echo e(__("Fixo")); ?></option>
                                    <option value="percent"><?php echo e(__("Percentual (%)")); ?></option>
                                </select>
                            </div>

                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        <?php endif; ?>

        <!-- SERVICE FEE -->
        <?php if(is_default_lang() and (!empty(setting_item("tour_allow_vendor_can_add_service_fee")) or is_admin())): ?>
            <hr>
            <h3 class="panel-body-title"><?php echo e(__('Taxas de Serviço')); ?></h3>

            <div class="form-group">
                <label><input type="checkbox" name="enable_service_fee" <?php if(!empty($row->enable_service_fee)): ?> checked <?php endif; ?> value="1"> <?php echo e(__('Ativar taxa de serviço')); ?></label>
            </div>

            <div class="form-group-item" data-condition="enable_service_fee:is(1)">
                <label class="control-label"><?php echo e(__('Taxas do comprador')); ?></label>

                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-5"><?php echo e(__("Nome")); ?></div>
                        <div class="col-md-3"><?php echo e(__('Preço')); ?></div>
                        <div class="col-md-3"><?php echo e(__('Tipo')); ?></div>
                        <div class="col-md-1"></div>
                    </div>
                </div>

                <div class="g-items">

                    <?php if(!empty($service_fee = old('service_fee',$row->service_fee))): ?>
                        <?php $__currentLoopData = $service_fee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item" data-number="<?php echo e($key); ?>">
                                <div class="row">

                                    <div class="col-md-5">
                                        <input type="text" name="service_fee[<?php echo e($key); ?>][name]" class="form-control" value="<?php echo e($item['name'] ?? ''); ?>" placeholder="<?php echo e(__('Nome da taxa')); ?>">
                                        <input type="text" name="service_fee[<?php echo e($key); ?>][desc]" class="form-control" value="<?php echo e($item['desc'] ?? ''); ?>" placeholder="<?php echo e(__('Descrição da taxa')); ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="number" min="0" step="0.1" name="service_fee[<?php echo e($key); ?>][price]" class="form-control" value="<?php echo e($item['price'] ?? ""); ?>">
                                        <select name="service_fee[<?php echo e($key); ?>][unit]" class="form-control">
                                            <option <?php if(($item['unit'] ?? "") == 'fixed'): ?> selected <?php endif; ?> value="fixed"><?php echo e(__("Fixo")); ?></option>
                                            <option <?php if(($item['unit'] ?? "") == 'percent'): ?> selected <?php endif; ?> value="percent"><?php echo e(__("Percentual")); ?></option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" name="service_fee[<?php echo e($key); ?>][per_person]" value="on" <?php if($item['per_person'] ?? ''): ?> checked <?php endif; ?>>
                                            <?php echo e(__("Preço por pessoa")); ?>

                                        </label>
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
                                <input type="text" __name__="service_fee[__number__][name]" class="form-control" placeholder="<?php echo e(__('Nome da taxa')); ?>">
                                <input type="text" __name__="service_fee[__number__][desc]" class="form-control" placeholder="<?php echo e(__('Descrição da taxa')); ?>">
                            </div>

                            <div class="col-md-3">
                                <input type="number" min="0" step="0.1" __name__="service_fee[__number__][price]" class="form-control">
                                <select __name__="service_fee[__number__][unit]" class="form-control">
                                    <option value="fixed"><?php echo e(__("Fixo")); ?></option>
                                    <option value="percent"><?php echo e(__("Percentual")); ?></option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" __name__="service_fee[__number__][per_person]" value="on">
                                    <?php echo e(__("Preço por pessoa")); ?>

                                </label>
                            </div>

                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        <?php endif; ?>

    </div>
</div>
<?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Tour/Views/admin/tour/pricing.blade.php ENDPATH**/ ?>