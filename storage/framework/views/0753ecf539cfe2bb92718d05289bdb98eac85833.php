<script>
    var bookingCore = {
        url:'<?php echo e(url( app_get_locale() )); ?>',
        url_root:'<?php echo e(url('')); ?>',
        admin_url:'<?php echo e(route('admin.index')); ?>',
        booking_decimals:<?php echo e((int)get_current_currency('currency_no_decimal',2)); ?>,
        thousand_separator:'<?php echo e(get_current_currency('currency_thousand')); ?>',
        decimal_separator:'<?php echo e(get_current_currency('currency_decimal')); ?>',
        currency_position:'<?php echo e(get_current_currency('currency_format')); ?>',
        currency_symbol:'<?php echo e(currency_symbol()); ?>',
        currency_rate:'<?php echo e(get_current_currency('rate',1)); ?>',
        date_format:'<?php echo e(get_moment_date_format()); ?>',
        map_provider:'<?php echo e(setting_item('map_provider')); ?>',
        map_gmap_key:'<?php echo e(setting_item('map_gmap_key')); ?>',
        map_options:{
            map_lat_default:'<?php echo e(setting_item('map_lat_default')); ?>',
            map_lng_default:'<?php echo e(setting_item('map_lng_default')); ?>',
            map_clustering: <?php echo e(setting_item('map_clustering') ? 'true' : 'false'); ?>,
            map_fit_bounds: <?php echo e(setting_item('map_fit_bounds') ? 'true': 'false'); ?>,
        },
        routes:{
            login:'<?php echo e(route('login')); ?>',
            register:'<?php echo e(route('auth.register')); ?>',
            checkout:'<?php echo e(is_api() ? route('api.booking.doCheckout') : route('booking.doCheckout')); ?>'
        },
        currentUser: <?php echo e((int)Auth::id()); ?>,
        isAdmin : <?php echo e(is_admin() ? 1 : 0); ?>,
        rtl: <?php echo e(setting_item_with_lang('enable_rtl') ? "true" : "false"); ?>,
        markAsRead:'<?php echo e(route('core.notification.markAsRead')); ?>',
        markAllAsRead:'<?php echo e(route('core.notification.markAllAsRead')); ?>',
        loadNotify : '<?php echo e(route('core.notification.loadNotify')); ?>',
        pusher_api_key : '<?php echo e(setting_item("pusher_api_key")); ?>',
        pusher_cluster : '<?php echo e(setting_item("pusher_cluster")); ?>',
        language: '<?php echo e(app()->getLocale()); ?>',
        module:{}
    };

    <?php if(auth()->user()): ?>
        bookingCore.media = {
            groups:<?php echo json_encode(config('bc.media.groups')); ?>

        }
    <?php endif; ?>

    <?php $__currentLoopData = get_bookable_services(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($class::isEnable()): ?>
            bookingCore.module.<?php echo e($id); ?> = '<?php echo e(route($id.'.search')); ?>';
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    var i18n = {
        warning:"Aviso",
        success:"Sucesso",
        confirm_delete:"Você quer apagar?",
        confirm:"Confirmar",
        cancel:"Cancelar"
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

    window.currentUrl = '<?php echo e(request()->url()); ?>';
</script>
<?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Layout/parts/global-script.blade.php ENDPATH**/ ?>