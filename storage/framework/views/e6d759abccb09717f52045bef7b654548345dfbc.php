<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="<?php echo e($html_class ?? ''); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Developer www.agencianaweb.com.br -->
    <meta http-equiv="Content-Language" content="pt-br">
    <meta name="document-classification" content="Site Institucional">
    <meta name="REVISIT-AGENCIANAWEB" content="1 days">
    <meta name="LANGUAGE" content="Portuguese">
    <meta name="COPYRIGHT" content="www.agencianaweb.com.br">
    <meta name="robots" content="all" />
    <meta name="googlebot" content="all" />
    <meta name="audience" content="all">
    <meta name="copyright" content="Copyright (c) Agencia na Web. Todos os Direitos Reservados.">
    <?php event(new \Modules\Layout\Events\LayoutBeginHead()); ?>
    <?php
    $favicon = setting_item('site_favicon');
    ?>
    <?php if($favicon): ?>
    <?php
    $file = (new \Modules\Media\Models\MediaFile())->findById($favicon);
    ?>
    <?php if(!empty($file)): ?>
    <link rel="icon" type="<?php echo e($file['file_type']); ?>" href="<?php echo e(asset('uploads/'.$file['file_path'])); ?>" />
    <?php else: ?>:
    <link rel="icon" type="image/png" href="<?php echo e(url('images/favicon.png')); ?>" />
    <?php endif; ?>
    <?php endif; ?>
    <?php echo $__env->make('Layout::parts.seo-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link href="<?php echo e(asset('libs/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/ionicons/css/ionicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/icofont/icofont.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('themes/mytravel/libs/fancybox/jquery.fancybox.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('themes/mytravel/libs/slick/slick.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('themes/mytravel/libs/custombox/custombox.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('themes/mytravel/dist/frontend/css/notification.css')); ?>" rel="newest stylesheet">
    <link href="<?php echo e(asset('themes/mytravel/dist/frontend/css/app.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/daterange/daterangepicker.css")); ?>">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Rubik:300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('themes/mytravel/libs/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>">
    <link href="<?php echo e(asset('libs/ion_rangeslider/css/ion.rangeSlider.css')); ?>" rel="stylesheet">
    <?php echo \App\Helpers\Assets::css(); ?>

    <?php echo \App\Helpers\Assets::js(); ?>

    <?php echo $__env->make('Layout::parts.global-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Styles -->
    <?php echo $__env->yieldPushContent('css'); ?>
    
    <link href="<?php echo e(route('core.style.customCss')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/carousel-2/owl.carousel.css')); ?>" rel="stylesheet">
    <?php if(setting_item_with_lang('enable_rtl')): ?>
    <link href="<?php echo e(asset('themes/mytravel/dist/frontend/css/rtl.css?_v='.config('app.asset_version'))); ?>" rel="stylesheet">
    <?php endif; ?>
    <?php echo setting_item('head_scripts'); ?>

    <?php echo setting_item_with_lang_raw('head_scripts'); ?>

    <?php event(new \Modules\Layout\Events\LayoutEndHead()); ?>
</head>

<body dir="<?php echo e(setting_item_with_lang('enable_rtl') ? 'rtl' : 'ltr'); ?>" class="frontend-page <?php echo e($body_class ?? ''); ?> <?php if(!empty($is_home) or !empty($header_transparent)): ?> header_transparent <?php endif; ?> <?php if(setting_item_with_lang('enable_rtl')): ?> is-rtl <?php endif; ?> <?php if(is_api()): ?> is_api <?php endif; ?>" >

    <style type="text/css">
        a.gflag {
            vertical-align: middle;
            font-size: 32px;
            padding: 1px 0;
            background-repeat: no-repeat;
            background-image: url(//gtranslate.net/flags/32.png);
        }

        a.gflag img {
            border: 0;
        }

        a.gflag:hover {
            background-image: url(//gtranslate.net/flags/32a.png);
        }

        #goog-gt- {
            display: none !important;
        }

        .goog-te-banner-frame {
            display: none !important;
        }

        .goog-te-menu-value:hover {
            text-decoration: none !important;
        }

        body {
            top: 0 !important;
        }

        #google_translate_element2 {
            display: none !important;
        }

        .VIpgJd-ZVi9od-ORHb-OEVmcd {
            display: none !important;
        }

        #goog-gt-tt {
            display: none !important;
        }

        .VIpgJd-yAWNEb-VIpgJd-fmcmS-sn54Q {
            background-color: transparent !important;
            box-shadow: none !important;
        }
    </style>

    <?php event(new \Modules\Layout\Events\LayoutBeginBody()); ?>
    <?php echo setting_item('body_scripts'); ?>

    <?php echo setting_item_with_lang_raw('body_scripts'); ?>

    <div class="bravo_wrap">

        <?php if(!is_api()): ?>

        <?php echo $__env->make('Layout::parts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php endif; ?>



        <?php echo $__env->yieldContent('content'); ?>



        <?php echo $__env->make('Layout::parts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

    <?php echo setting_item('footer_scripts'); ?>


    <?php echo setting_item_with_lang_raw('footer_scripts'); ?>


    <?php event(new \Modules\Layout\Events\LayoutEndBody()); ?>

    <?php echo $__env->make('demo_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html><?php /**PATH /var/www/html/themes/Mytravel/Layout/app.blade.php ENDPATH**/ ?>