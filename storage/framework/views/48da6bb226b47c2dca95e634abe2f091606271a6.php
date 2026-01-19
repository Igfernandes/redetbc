<div class="bravo-form-search-all hero-block hero-v1 bg-img-hero-bottom gradient-overlay-half-black-gradient text-center z-index-2">
    <div class="container space-2 space-top-xl-4">
        <div class="row justify-content-center pb-xl-8 py-5 banner-home-page">
            <div class="py-8 py-xl-10 pb-5">
                <h1 class="font-size-60 font-size-xs-30 font-weight-bold"><?php echo e($title ?? ''); ?></h1>
                <p class="font-size-20 font-weight-normal "><?php echo e($sub_title ?? ''); ?></p>
            </div>
        </div>
        <?php if(empty($hide_form_search)): ?>
        <div class="mb-lg-n1">
            <ul class="nav tab-nav flex-nowrap mt-3 tab-nav-shadow justify-content-start <?php if(!empty($single_form_search)): ?> d-none <?php endif; ?>" role="tablist">
                <?php if(!empty($service_types)): ?>
                <?php
                $number = 0;
                // 🌴 Paleta tropical vibrante
                $colors = [
                '#FF7F50', // Coral
                '#FFB347', // Laranja tropical
                '#e3c20f', // Amarelo sol
                '#26c98a', // Verde menta
                '#40E0D0', // Turquesa
                '#1E90FF', // Azul oceano
                '#FF69B4', // Rosa vibrante
                '#ADFF2F', // Verde-limão
                ];
                ?>

                <?php $__currentLoopData = $service_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $allServices = get_bookable_services();
                if (empty($allServices[$service_type])) continue;
                $module = new $allServices[$service_type];

                // 🌈 Seleciona cor com base no índice (loop cíclico)
                $bgColor = $colors[$number % count($colors)];
                ?>

                <li class="nav-item" role="bravo_<?php echo e($service_type); ?>">
                    <a class="nav-link font-weight-medium <?php if($number == 0): ?> active <?php endif; ?> pl-md-5 pl-3"
                        id="bravo_<?php echo e($service_type); ?>-tab" data-toggle="pill"
                        href="#bravo_<?php echo e($service_type); ?>" role="tab"
                        aria-controls="bravo_<?php echo e($service_type); ?>" aria-selected="true">

                        <div class="text-center position-relative align-items-center">
                            <figure
                                style="height: 60px;
                                   width: 60px;
                                   padding-top: 8px;
                                   border: 7px solid #fff;
                                   box-shadow: 1px 1px 5px black;
                                   border-radius: 100%;
                                   background: #003583;
                                   margin: 0 auto;
                                   color: #fff;"
                                class="ie-height-40 d-md-block">
                                <i class="icon <?php echo e($module->getServiceIconFeatured()); ?> font-size-3"></i>
                            </figure>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                <?php echo e(!empty($modelBlock["title_for_".$service_type]) 
                                ? $modelBlock["title_for_".$service_type] 
                                : $module->getModelName()); ?>

                            </span>
                        </div>
                    </a>
                </li>

                <?php $number++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <li class="nav-item" role="bravo_assistances">
                    <a class="nav-link font-weight-medium  pl-md-5 pl-3"
                        id="bravo_assistances-tab"
                        href="/assistance" >

                        <div class="text-center position-relative align-items-center">
                            <figure
                                style="height: 60px;
                                   width: 60px;
                                   padding-top: 8px;
                                   border: 7px solid #fff;
                                   box-shadow: 1px 1px 5px black;
                                   border-radius: 100%;
                                   background: #003583;
                                   margin: 0 auto;
                                   color: #fff;"
                                class="ie-height-40 d-md-block">
                                <i class="icon icofont-briefcase font-size-3"></i>
                            </figure>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                <?php echo e(__('Serviços')); ?>

                            </span>
                        </div>
                    </a>
                </li>

            </ul>

            <div class="tab-content hero-tab-pane">
                <?php if(!empty($service_types)): ?>
                <?php $number = 0; ?>
                <?php $__currentLoopData = $service_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $allServices = get_bookable_services();
                if(empty($allServices[$service_type])) continue;
                ?>
                <div class="tab-pane fade <?php if($number == 0): ?> active show <?php endif; ?>" id="bravo_<?php echo e($service_type); ?>" role="tabpanel" aria-labelledby="bravo_<?php echo e($service_type); ?>-tab">
                    <div class="pt-0 pl-3 pr-3 pb-3 gradient-overlay-half-white-gradient">
                        <div class="card border-0 tab-shadow">
                            <div class="card-body">
                                <?php echo $__env->make(ucfirst($service_type).'::frontend.layouts.search.form-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $number++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Mytravel/Template/Views/frontend/blocks/form-search-all-service/style_3.blade.php ENDPATH**/ ?>