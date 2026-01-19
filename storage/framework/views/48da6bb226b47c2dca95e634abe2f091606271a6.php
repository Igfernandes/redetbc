<div class="bravo-form-search-all hero-block hero-v1 bg-img-hero-bottom text-center z-index-2">
    <div class="container space-2 space-top-xl-4">
        <div class="row justify-content-center pb-xl-8 py-5 banner-home-page">
            <div class="py-8 py-xl-10 pb-5">
                <h1 class="font-size-60 font-size-xs-30 font-weight-bold"><?php echo e($title ?? ''); ?></h1>
                <p class="font-size-20 font-weight-normal "><?php echo e($sub_title ?? ''); ?></p>
            </div>
        </div>
        <div class=" mb-lg-n1">
            <ul class="nav nav-list flex-nowrap tab-nav-shadow  <?php if(!empty($single_form_search)): ?> d-none <?php endif; ?>" role="tablist">
                <li class="nav-item" role="bravo_hotel">
                    <a class="font-weight-medium"
                        id="bravo_hotel-tab"
                        href="/page/hotel">
                        <div class="text-center position-relative align-items-center">
                            <div
                                class="nav-icon ie-height-40 d-md-block">
                                <img style="width: 100%;height:100%; border-radius: 100%;" src="<?php echo e(asset('images/icons/features/hotels-icon.png')); ?>" alt="">
                            </div>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                <?php echo e(__('Hotéis')); ?>

                            </span>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="bravo_space">
                    <a class="font-weight-medium"
                        id="bravo_space-tab"
                        href="/page/space">

                        <div class="text-center position-relative align-items-center">
                            <div
                                class="nav-icon ie-height-40 d-md-block">
                                <img style="width: 100%;height:100%; border-radius: 100%;"
                                    src="<?php echo e(asset('images/icons/features/spaces-icon.png')); ?>" alt="">
                            </div>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                <?php echo e(__('Espaços')); ?>

                            </span>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="bravo_tour">
                    <a class="font-weight-medium"
                        id="bravo_tour-tab"
                        href="/page/tour">

                        <div class="text-center position-relative align-items-center">
                            <div
                                class="nav-icon ie-height-40 d-md-block">
                                <img style="width: 100%;height:100%; border-radius: 100%;"
                                    src="<?php echo e(asset('images/icons/features/tours-icon.png')); ?>" alt="">
                            </div>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                <?php echo e(__('Passeios')); ?>

                            </span>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="bravo_assistances">
                    <a class="font-weight-medium"
                        id="bravo_assistances-tab"
                        href="/page/service">

                        <div class="text-center position-relative align-items-center">
                            <div
                                class="nav-icon ie-height-40 d-md-block">
                                <img style="width: 100%;height:100%; border-radius: 100%;"
                                    src="<?php echo e(asset('images/icons/features/services-icon.png')); ?>" alt="">
                            </div>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                <?php echo e(__('Serviços')); ?>

                            </span>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="bravo_blog">
                    <a class="font-weight-medium"
                        id="bravo_blog-tab"
                        href="/page/blog">

                        <div class="text-center position-relative align-items-center">
                            <div
                                class="nav-icon ie-height-40 d-md-block">
                                <img style="width: 100%;height:100%; border-radius: 100%;"
                                    src="<?php echo e(asset('images/icons/features/blogs-icon.png')); ?>" alt="">
                            </div>

                            <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">
                                <?php echo e(__('Blogs')); ?>

                            </span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Mytravel/Template/Views/frontend/blocks/form-search-all-service/style_3.blade.php ENDPATH**/ ?>