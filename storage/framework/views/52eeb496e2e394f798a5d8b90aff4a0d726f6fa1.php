<script>
    var bookingCore = {
        url: '<?php echo e(url('/')); ?>',
        admin_url: '<?php echo e(route('admin.index')); ?>',
        map_provider: '<?php echo e(setting_item('map_provider')); ?>',
        map_gmap_key: '<?php echo e(setting_item('map_gmap_key')); ?>',
        csrf: '<?php echo e(csrf_token()); ?>',
        date_format: '<?php echo e(get_moment_date_format()); ?>',
        markAsRead: '<?php echo e(route('core.admin.notification.markAsRead')); ?>',
        markAllAsRead: '<?php echo e(route('core.admin.notification.markAllAsRead')); ?>',
        loadNotify: '<?php echo e(route('core.admin.notification.loadNotify')); ?>',
        pusher_api_key: '<?php echo e(setting_item("pusher_api_key")); ?>',
        pusher_cluster: '<?php echo e(setting_item("pusher_cluster")); ?>',
        isAdmin: <?php echo e(is_admin() ? 1 : 0); ?>,
        currentUser: <?php echo e((int)Auth::id()); ?>,
        media: {
            groups: <?php echo json_encode(config('bc.media.groups')); ?>

        },
        language: '<?php echo e(app()->getLocale()); ?>',
    };

    var i18n = {
        warning: "Aviso",
        success: "Sucesso",
        confirm_delete: "Você quer apagar?",
        confirm_recovery: "Você quer restaurar?",
        confirm: "Confirmar",
        cancel: "Cancelar",
        custom_range: "Intervalo personalizado",
        apply: "Aplicar"
    };

    var daterangepickerLocale = {
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "De",
        "toLabel": "Até",
        "customRangeLabel": "Personalizado",
        "weekLabel": "S",
        "first_day_of_week": <?php echo e(setting_item("site_first_day_of_the_weekin_calendar","1")); ?>,
        "daysOfWeek": [
            "Dom",
            "Seg",
            "Ter",
            "Qua",
            "Qui",
            "Sex",
            "Sáb"
        ],
        "monthNames": [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
        ]
    };

    var image_editer = {
        language: '<?php echo e(app()->getLocale()); ?>',
        translations: {
            <?php echo e(app()->getLocale()); ?>: {
                'header.image_editor_title': 'Editor de Imagem',
                'header.toggle_fullscreen': 'Alternar tela cheia',
                'header.close': 'Fechar',
                'header.close_modal': 'Fechar janela',
                'toolbar.download': 'Salvar alteração',
                'toolbar.save': 'Salvar',
                'toolbar.apply': 'Aplicar',
                'toolbar.saveAsNewImage': 'Salvar como nova imagem',
                'toolbar.cancel': 'Cancelar',
                'toolbar.go_back': 'Voltar',
                'toolbar.adjust': 'Ajustar',
                'toolbar.effects': 'Efeitos',
                'toolbar.filters': 'Filtros',
                'toolbar.orientation': 'Orientação',
                'toolbar.crop': 'Cortar',
                'toolbar.resize': 'Redimensionar',
                'toolbar.watermark': 'Marca d’água',
                'toolbar.focus_point': 'Ponto de foco',
                'toolbar.shapes': 'Formas',
                'toolbar.image': 'Imagem',
                'toolbar.text': 'Texto',
                'adjust.brightness': 'Brilho',
                'adjust.contrast': 'Contraste',
                'adjust.exposure': 'Exposição',
                'adjust.saturation': 'Saturação',
                'orientation.rotate_l': 'Girar à esquerda',
                'orientation.rotate_r': 'Girar à direita',
                'orientation.flip_h': 'Inverter horizontalmente',
                'orientation.flip_v': 'Inverter verticalmente',
                'pre_resize.title': 'Gostaria de reduzir a resolução antes de editar a imagem?',
                'pre_resize.keep_original_resolution': 'Manter resolução original',
                'pre_resize.resize_n_continue': 'Redimensionar e continuar',
                'footer.reset': 'Redefinir',
                'footer.undo': 'Desfazer',
                'footer.redo': 'Refazer',
                'spinner.label': 'Processando...',
                'warning.too_big_resolution': 'A resolução da imagem é muito alta para a web. Isso pode causar problemas de desempenho no Editor de Imagens.',
                'common.x': 'x',
                'common.y': 'y',
                'common.width': 'largura',
                'common.height': 'altura',
                'common.custom': 'personalizado',
                'common.original': 'original',
                'common.square': 'quadrado',
                'common.opacity': 'Opacidade',
                'common.apply_watermark': 'Aplicar marca d’água',
                'common.url': 'URL',
                'common.upload': 'Enviar',
                'common.gallery': 'Galeria',
                'common.text': 'Texto'
            }
        }
    };
</script>
<?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Layout/admin/parts/global-script.blade.php ENDPATH**/ ?>