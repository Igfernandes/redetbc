<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="<?php echo e($html_class ?? ''); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php ($favicon = setting_item('site_favicon')); ?>
    <link rel="icon" type="image/png" href="<?php echo e(!empty($favicon)?get_file_url($favicon,'full'):url('images/favicon.png')); ?>" />
    <?php echo $__env->make('Layout::parts.seo-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    <link href="<?php echo e(asset('libs/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/ionicons/css/ionicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/icofont/icofont.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('dist/frontend/css/notification.css')); ?>" rel="newest stylesheet">
    <link href="<?php echo e(asset('dist/frontend/css/app.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/daterange/daterangepicker.css")); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/select2/css/select2.min.css")); ?>">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel='stylesheet' id='google-font-css-css' href='https://fonts.googleapis.com/css?family=Poppins%3A400%2C500%2C600' type='text/css' media='all' />
    <?php echo $__env->make('Layout::parts.global-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        var image_editer = {
            language: '<?php echo e(app()->getLocale()); ?>',
            translations: {
                {
                    {
                        app() - > getLocale()
                    }
                }: {
                    'header.image_editor_title': '<?php echo e(__("Editor de Imagem ")); ?>',
                    'header.toggle_fullscreen': '<?php echo e(__("Alternar tela cheia ")); ?>',
                    'header.close': '<?php echo e(__("Fechar ")); ?>',
                    'header.close_modal': '<?php echo e(__("Fechar janela ")); ?>',
                    'toolbar.download': '<?php echo e(__("Salvar Alterações ")); ?>',
                    'toolbar.save': '<?php echo e(__("Salvar ")); ?>',
                    'toolbar.apply': '<?php echo e(__("Aplicar ")); ?>',
                    'toolbar.saveAsNewImage': '<?php echo e(__("Salvar Como Nova Imagem ")); ?>',
                    'toolbar.cancel': '<?php echo e(__("Cancelar ")); ?>',
                    'toolbar.go_back': '<?php echo e(__("Voltar ")); ?>',
                    'toolbar.adjust': '<?php echo e(__("Ajustar ")); ?>',
                    'toolbar.effects': '<?php echo e(__("Efeitos ")); ?>',
                    'toolbar.filters': '<?php echo e(__("Filtros ")); ?>',
                    'toolbar.orientation': '<?php echo e(__("Orientação ")); ?>',
                    'toolbar.crop': '<?php echo e(__("Cortar ")); ?>',
                    'toolbar.resize': '<?php echo e(__("Redimensionar ")); ?>',
                    'toolbar.watermark': '<?php echo e(__("Marca d'água ")); ?>',
                    'toolbar.focus_point': '<?php echo e(__("Ponto de foco ")); ?>',
                    'toolbar.shapes': '<?php echo e(__("Formas ")); ?>',
                    'toolbar.image': '<?php echo e(__("Imagem ")); ?>',
                    'toolbar.text': '<?php echo e(__("Texto ")); ?>',
                    'adjust.brightness': '<?php echo e(__("Brilho ")); ?>',
                    'adjust.contrast': '<?php echo e(__("Contraste ")); ?>',
                    'adjust.exposure': '<?php echo e(__("Exposição ")); ?>',
                    'adjust.saturation': '<?php echo e(__("Saturação ")); ?>',
                    'orientation.rotate_l': '<?php echo e(__("Girar Esquerda ")); ?>',
                    'orientation.rotate_r': '<?php echo e(__("Girar Direita ")); ?>',
                    'orientation.flip_h': '<?php echo e(__("Inverter Horizontalmente ")); ?>',
                    'orientation.flip_v': '<?php echo e(__("Inverter Verticalmente ")); ?>',
                    'pre_resize.title': '<?php echo e(__("Gostaria de reduzir a resolução antes de editar a imagem? ")); ?>',
                    'pre_resize.keep_original_resolution' : '<?php echo e(__("Manter resolução original ")); ?>',
                    'pre_resize.resize_n_continue': '<?php echo e(__("Redimensionar e Continuar ")); ?>',
                    'footer.reset': '<?php echo e(__("Redefinir ")); ?>',
                    'footer.undo': '<?php echo e(__("Desfazer ")); ?>',
                    'footer.redo': '<?php echo e(__("Refazer ")); ?>',
                    'spinner.label': '<?php echo e(__("Processando...")); ?>',
                    'warning.too_big_resolution': '<?php echo e(__("A resolução da imagem é muito alta para a web. Isso pode causar problemas de desempenho no Editor de Imagens.")); ?>',
              
                    'common.x': '<?php echo e(__("x ")); ?>',
                    'common.y': '<?php echo e(__("y ")); ?>',
                    'common.width': '<?php echo e(__("largura ")); ?>',
                    'common.height': '<?php echo e(__("altura ")); ?>',
                    'common.custom': '<?php echo e(__("personalizado ")); ?>',
                    'common.original': '<?php echo e(__("original ")); ?>',
                    'common.square': '<?php echo e(__("quadrado ")); ?>',
                    'common.opacity': '<?php echo e(__("opacidade ")); ?>',
                    'common.apply_watermark': '<?php echo e(__("Aplicar marca d'água ")); ?>',
                    'common.url': '<?php echo e(__("URL ")); ?>',
                    'common.upload': '<?php echo e(__("Enviar ")); ?>',
                    'common.gallery': '<?php echo e(__("Galeria ")); ?>',
                    'common.text': '<?php echo e(__("Texto ")); ?>',
                }
            }
        };
    </script>
    <link href="<?php echo e(asset('dist/frontend/module/user/css/user.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
    <!-- Styles -->
    <?php echo $__env->yieldPushContent('css'); ?>
    <style type="text/css">
        .bravo_topbar,
        .bravo_header,
        .bravo_footer {
            display: none;
        }

        html,
        body,
        .bravo_wrap,
        .bravo_user_profile,
        .bravo_user_profile>.container-fluid>.row-eq-height>.col-md-3 {
            min-height: 100vh !important;
        }
    </style>
    
    <link href="<?php echo e(route('core.style.customCss')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/carousel-2/owl.carousel.css')); ?>" rel="stylesheet">
    <?php if(setting_item_with_lang('enable_rtl')): ?>
    <link href="<?php echo e(asset('dist/frontend/css/rtl.css')); ?>" rel="stylesheet">
    <?php endif; ?>
</head>

<body class="user-page <?php echo e($body_class ?? ''); ?> <?php if(setting_item_with_lang('enable_rtl')): ?> is-rtl <?php endif; ?>" >

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

    <?php if(!is_demo_mode()): ?>
    <?php echo setting_item('body_scripts'); ?>

    <?php endif; ?>
    <div class="bravo_wrap">
        <?php echo $__env->make('Layout::parts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('Layout::parts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="bravo_user_profile">
            <div class="container-fluid">
                <div class="row row-eq-height">
                    <div class="col-md-3">
                        <?php echo $__env->make('User::frontend.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-9">
                        <div class="user-form-settings">
                            <?php echo $__env->make('Layout::parts.user-bc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('Layout::parts.footer',['is_user_page'=>1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div style="display:none;"><a href="https://www.agencianaweb.com.br">Agencia na Web</a></div>
    <script src="<?php echo e(asset('libs/filerobot-image-editor/filerobot-image-editor.min.js?_ver='.config('app.asset_version'))); ?>"></script>
    <?php if(!is_demo_mode()): ?>
    <?php echo setting_item('footer_scripts'); ?>

    <?php endif; ?>
</body>

</html>
<?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Layout/user.blade.php ENDPATH**/ ?>