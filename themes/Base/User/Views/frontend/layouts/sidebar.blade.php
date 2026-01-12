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
        'title'    => __("Rede"),
        'icon'     => 'fa fa-sitemap',
        'position' => 22,
        'is_verified' => 1,
        'is_affiliate' => 1
    ],
    'upgrade' => [
        'url'      => route("user.upgrade"),
        'title'    => __("Meu Plano"),
        'icon'     => 'fa fa-sitemap',
        'position' => 22,
        'is_verified' => 0,
        'is_affiliate' => 1
    ],
    'profile'         => [
        'url'      => route("user.profile.index"),
        'title'    => __("Meu Perfil"),
        'icon'     => 'fa fa-cogs',
        'position' => 22,
        'is_verified' => 0
    ],
    'verify'         => [
        'url'      => route("user.verification.index"),
        'title'    => __("Verificação"),
        'icon'     => 'fa fa-id-card-o',
        'position' => 22,
        'is_verified' => 0
    ],
    'password'        => [
        'url'      => route("user.change_password"),
        'title'    => __("Alterar Senha"),
        'icon'     => 'fa fa-lock',
        'position' => 100,
        'is_verified' => 0
    ],
    'admin'           => [
        'url'        => route('admin.index'),
        'title'      => __("Painel de Administração"),
        'icon'       => 'icon ion-ios-ribbon',
        'permission' => 'dashboard_access',
        'position'   => 110,
        'is_verified' => 1
    ]
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
<div class="sidebar-user">
    <div class="bravo-close-menu-user text-right py-2 mx-2"><i class="icofont-scroll-left"></i></div>
    <div class="bg-theme pt-1 px-2 px-md-3" style="padding-bottom: 10rem;">
        <div class="user-profile-avatar bg-theme pt-0 mb-0 mt-3">
            <div>
                <p class="bg-theme mb-0">Oi, {{$userAuthData->getDisplayName()}}!</p>
            </div>
        </div>
        <div class="user-profile-plan ">
            @if( !Auth::user()->role_id < 2 && $userAuthData->role->code == "customer")
                <a href=" {{ route('user.upgrade')}}">{{ __("Seja um Anfitrião") }}</a>
                @endif
        </div>
        <div class="sidebar-menu">
            <ul class="main-menu">
                @foreach($menus as $menuItem)
                <li class="{{$menuItem['class']}}" position="{{$menuItem['position'] ?? ""}}">
                    <a href="{{ url($menuItem['url']) }}">
                        @if(!empty($menuItem['icon']))
                        <span class="icon text-center"><i class="{{$menuItem['icon']}}"></i></span>
                        @endif
                        {!! clean($menuItem['title']) !!}
                    </a>
                    @if(!empty($menuItem['children']))
                    <i class="caret"></i>
                    @endif
                    @if(!empty($menuItem['children']))
                    <ul class="children">
                        @foreach($menuItem['children'] as $menuItem2)
                        <li class="{{$menuItem2['class']}}"><a href="{{ url($menuItem2['url']) }}">
                                @if(!empty($menuItem2['icon']))
                                <i class="{{$menuItem2['icon']}}"></i>
                                @endif
                                {!! clean($menuItem2['title']) !!}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        <div>
            <div class="g-menu">

                <ul class="main-menu menu-generated">
                    <li class=" depth-0"><a target="" href="/">Início</a></li>
                    <li class=" depth-0"><a>Acomodações <i class="caret fa fa-angle-down"></i></a>
                        <ul class="children-menu menu-dropdown">
                            <li class=" depth-1"><a target="" href="/page/home-hotel">Hotéis</a></li>
                            <li class=" depth-1"><a target="" href="http://localhost:8000/page/home-space">Espaços</a></li>
                        </ul>
                    </li>
                    <li class=" depth-0"><a>Passeios <i class="caret fa fa-angle-down"></i></a>
                        <ul class="children-menu menu-dropdown">
                            <li class=" depth-1"><a target="" href="/tour?cat_id[]=11">espaçois com Fé</a></li>
                            <li class=" depth-1"><a target="" href="/tour?cat_id[]=10">Terapia Natural e Descanso</a></li>
                            <li class=" depth-1"><a target="" href="/tour?cat_id[]=9">Cultura Cristã</a></li>
                            <li class=" depth-1"><a target="" href="/tour?cat_id[]=6">História e Fé</a></li>
                            <li class=" depth-1"><a target="" href="/tour?cat_id[]=5">Consagração</a></li>
                            <li class=" depth-1"><a target="" href="/tour?cat_id[]=4">Passeio pela Cidade</a></li>
                            <li class=" depth-1"><a target="" href="/tour?cat_id[]=3">Escorted tour</a></li>
                            <li class=" depth-1"><a target="" href="/tour?cat_id[]=2">Esporte</a></li>
                            <li class=" depth-1"><a target="" href="/tour?cat_id[]=1">Motivacional</a></li>
                        </ul>
                    </li>
                    <!-- <li class=" depth-0"><a target="" href="/page/eventos">Eventos</a></li> -->
                    <li class=" depth-0"><a target="" href="/page/noticias">Notícias</a></li>
                </ul>
            </div>
        </div>
        <div class="logout">
            <form id="logout-form-vendor" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-vendor').submit();"><i class="fa fa-sign-out"></i> {{__("Sair")}}
            </a>
        </div>
        <div class="logout">
            <a href="{{url('/')}}" style="color: #1ABC9C"><i class="fa fa-long-arrow-left"></i> {{__("Voltar para o Início")}}</a>
        </div>
    </div>
</div>
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
</script>