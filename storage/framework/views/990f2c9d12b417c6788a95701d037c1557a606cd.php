<?php
$userAuthData = Auth::user();

$menus = [
    'dashboard'       => [
        'url'        => route("vendor.dashboard"),
        'title'      => __("Painel"),
        'icon'       => 'fa fa-home',
        'permission' => 'dashboard_vendor_access',
        'position'   => 10,
        'is_verified' => 0
    ],
    'booking-history' => [
        'url'      => route("user.booking_history"),
        'title'    => __("Histórico de Reservas"),
        'icon'     => 'fa fa-clock-o',
        'position' => 20,
        'is_verified' => 1
    ],
    "wishlist" => [
        'url'   => route("user.wishList.index"),
        'title' => __("Lista de Desejos"),
        'icon'  => 'fa fa-heart-o',
        'position' => 21,
        'is_verified' => 1
    ],
    'network' => [
        'url'      => route("user.network"),
        'title'    => __("Minha Rede"),
        'icon'     => 'fa fa-sitemap',
        'position' => 22,
        'is_verified' => 1,
        'is_affiliate' => 1
    ],
    'upgrade' => [
        'url'      => route("user.upgrade"),
        'title'    => __("Plano de Upgrade"),
        'icon'     => 'fa fa-sitemap',
        'position' => 22,
        'is_verified' => 1
    ],
    'verify'         => [
        'url'      => route("user.verification.index"),
        'title'    => __("Verificação"),
        'icon'     => 'fa fa-id-card-o',
        'position' => 22,
        'is_verified' => 0
    ],
];

// Modules
$custom_modules = \Modules\ServiceProvider::getActivatedModules();
if (!empty($custom_modules)) {
    foreach ($custom_modules as $module) {
        $moduleClass = $module['class'];
        if (class_exists($moduleClass)) {
            $menuConfig = call_user_func([$moduleClass, 'getUserMenu']);
            if (!empty($menuConfig)) {
                $menus = array_merge($menus, $menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass, 'getUserSubMenu']);
            if (!empty($menuSubMenu)) {
                foreach ($menuSubMenu as $k => $submenu) {
                    $submenu['id'] = $submenu['id'] ?? '_' . $k;
                    if (!empty($submenu['parent']) and isset($menus[$submenu['parent']])) {
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}


// Plugins Menu
$plugins_modules = \Plugins\ServiceProvider::getModules();
if (!empty($plugins_modules)) {
    foreach ($plugins_modules as $module) {
        $moduleClass = "\\Plugins\\" . ucfirst($module) . "\\ModuleProvider";
        if (class_exists($moduleClass)) {
            $menuConfig = call_user_func([$moduleClass, 'getUserMenu']);
            if (!empty($menuConfig)) {
                $menus = array_merge($menus, $menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass, 'getUserSubMenu']);
            if (!empty($menuSubMenu)) {
                foreach ($menuSubMenu as $k => $submenu) {
                    $submenu['id'] = $submenu['id'] ?? '_' . $k;
                    if (!empty($submenu['parent']) and isset($menus[$submenu['parent']])) {
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

// Custom Menu
$custom_modules = \Custom\ServiceProvider::getModules();
if (!empty($custom_modules)) {
    foreach ($custom_modules as $module) {
        $moduleClass = "\\Custom\\" . ucfirst($module) . "\\ModuleProvider";
        if (class_exists($moduleClass)) {
            $menuConfig = call_user_func([$moduleClass, 'getUserMenu']);
            if (!empty($menuConfig)) {
                $menus = array_merge($menus, $menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass, 'getUserSubMenu']);
            if (!empty($menuSubMenu)) {
                foreach ($menuSubMenu as $k => $submenu) {
                    $submenu['id'] = $submenu['id'] ?? '_' . $k;
                    if (!empty($submenu['parent']) and isset($menus[$submenu['parent']])) {
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

$currentUrl = url(Illuminate\Support\Facades\Route::current()->uri());
if (!empty($menus))
    $menus = array_values(\Illuminate\Support\Arr::sort($menus, function ($value) {
        return $value['position'] ?? 100;
    }));
foreach ($menus as $k => $menuItem) {
    if (!empty($menuItem['permission']) and !Auth::user()->hasPermission($menuItem['permission'])) {
        unset($menus[$k]);
        continue;
    }

    if (!$userAuthData->is_verified && strstr($menuItem['url'], 'verification') === false) {
        if (!isset($menuItem['is_verified']) || $menuItem['is_verified'] !== 0) {
            unset($menus[$k]);
            continue;
        }
    }

    if (isset($menuItem['is_affiliate']) && $userAuthData->is_affiliate != $menuItem['is_affiliate']) {
        unset($menus[$k]);
        continue;
    }

    $menus[$k]['class'] = $currentUrl == url($menuItem['url']) ? 'active' : '';
    if (!empty($menuItem['children'])) {
        $menus[$k]['class'] .= ' has-children';
        foreach ($menuItem['children'] as $k2 => $menuItem2) {
            if (!empty($menuItem2['permission']) and !Auth::user()->hasPermission($menuItem2['permission'])) {
                unset($menus[$k]['children'][$k2]);
                continue;
            }
            $menus[$k]['children'][$k2]['class'] = $currentUrl == url($menuItem2['url']) ? 'active active_child' : '';
        }
    }
}

?><script src="/libs/jquery-3.6.3.min.js"></script>
<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="<?php echo e($menuItem['class']); ?>" position="<?php echo e($menuItem['position'] ?? ""); ?>">
    <a href="<?php echo e(url($menuItem['url'])); ?>">
        <?php if(!empty($menuItem['icon'])): ?>
        <span class="icon text-center"><i class="<?php echo e($menuItem['icon']); ?>"></i></span>
        <?php endif; ?>
        <?php echo clean($menuItem['title']); ?>

    </a>
    <?php if(!empty($menuItem['children'])): ?>
    <i class="caret"></i>
    <?php endif; ?>
    <?php if(!empty($menuItem['children'])): ?>
    <ul class="children">
        <?php $__currentLoopData = $menuItem['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="<?php echo e($menuItem2['class']); ?>"><a href="<?php echo e(url($menuItem2['url'])); ?>">
                <?php if(!empty($menuItem2['icon'])): ?>
                <i class="<?php echo e($menuItem2['icon']); ?>"></i>
                <?php endif; ?>
                <?php echo clean($menuItem2['title']); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php endif; ?>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script>
    $(".sidebar-user .g-menu ul li").on("click", function(e) {
        e.preventDefault();
        $(this).closest("li").toggleClass("active");
    });
    $(".sidebar-user").each(function() {
        var h_profile = $(this).find(".user-profile").height();
        var h1_main = $(window).height();
        $(this)
            .find(".g-menu")
            .css("max-height", h1_main - h_profile - 15);
    });
</script><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\themes/Mytravel/Layout/parts/authmenu.blade.php ENDPATH**/ ?>