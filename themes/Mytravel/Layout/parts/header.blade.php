<style>
    .js-header-fix-moment {
        box-shadow: 1px 1px 4px #dddddd;
    }

    .js-header-fix-moment .filter-key span {
        color: black;
    }

    .js-header-fix-moment .filter-key i {
        color: #003583;
    }


    .bravo_wrap .subscribe-plan .content {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ffa636;
        font-weight: 500;
        padding: 10px;
    }

    @media (max-width: 768px) {
        .bravo_wrap .subscribe-plan .content {
            display: block;
        }
    }

    .bravo_wrap .subscribe-plan .content p {
        display: inline;
        color: #fff;
        margin: 0;
    }

    @media (max-width: 768px) {
        .bravo_wrap .subscribe-plan .content p {
            width: 100%;
        }
    }

    .bravo_wrap .subscribe-plan .content a {
        text-decoration: underline;
        margin-left: 4px;
    }

    @media (max-width: 768px) {
        .bravo_wrap .subscribe-plan .content a {
            display: inline;
        }
    }

    @media (max-width: 768px) {
        .bravo_wrap .bravo_topbar {
            display: none;
        }
    }

    .menu-main-mobile::-webkit-scrollbar {
        width: 10px;
        /* largura da barra vertical */
        height: 10px;
        /* altura da barra horizontal */
    }

    .menu-main-mobile::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* fundo da barra */
        border-radius: 4px;
    }

    .menu-main-mobile::-webkit-scrollbar-thumb {
        background-color: #1a2b48;
        /* cor da barra de rolagem */
        border-radius: 4px;
        border: 2px solid #f1f1f1;
        /* espaço entre thumb e track */
    }

    .menu-main-mobile::-webkit-scrollbar-thumb {
        background-color: #16203a;
        /* cor ao passar o mouse */
    }

    /* Para Firefox */
    .menu-main-mobile {
        scrollbar-width: thin;
        /* "thin" ou "auto" */
        scrollbar-color: #1a2b48 #f1f1f1;
        /* thumb e track */
    }

    .menu-main-content {
        position: relative;
    }

    .menu-main-content .arrows .arrow {
        transform: rotate(90deg);
        color: #1a2b48;
        text-shadow: 0 0 BLACK;
        font-size: 1.2rem;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 55px;
        height: 28px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #2196F3;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<?php
$religion = null;

if (isset($_GET['religion'])) {
    session(['FILTER_RELIGION' => $_GET['religion']]);
    $religion = session('FILTER_RELIGION');
}
?>
<header id="header"
    class="@if(!empty($is_home) or !empty($header_transparent))

            u-header u-header--abs-top u-header--white-nav-links-xl u-header--bg-transparent u-header--show-hide border-bottom border-xl-bottom-0 border-color-white

        @else

            header-white u-header u-header--dark-nav-links-xl u-header--show-hide-xl u-header--static-xl border-bottom

        @endif"

    data-header-fix-moment="500" data-header-fix-effect="slide">
    @if(Auth::user() == null || !Auth::user()->user_plan)
    <div class="subscribe-plan">
        <div class="content">
            @if(Auth::user() && !Auth::user()->user_plan)
            <p>
                {{ __("Junte-se ao clube: escolha seu plano e tenha acesso completo.") }}
            </p> &nbsp;
            @else
            <p>
                {{ __("Viaje com 0 taxas. Seja Membro.") }}
            </p> &nbsp;
            @endif

            @if(Auth::user() == null)
            <a data-target="#register" data-toggle="modal">{{ __("Cadastre-se Agora") }}</a>
            @else
            <a href="/plan">{{ __("Escolha seu plano") }}</a>
            @endif
        </div>
    </div>
    @endif

    @if(hasUpgradePlanRequest() && !Route::is('user.upgrade_vendor_plans'))
    <div class="upgrade-plan ">
        <div class="content d-flex justify-content-center text-center py-2 bg-warning">
            <p class="mb-0">
                {{ __("Sua solicitação de atualização de plano foi aprovada.") }}
            </p> &nbsp;&nbsp;
            <a href="{{route('user.upgrade_vendor_plans')}}">{{ __("Complete a atualização do plano") }}</a>
        </div>
    </div>
    @endif

    <div class="u-header__section u-header__shadow-on-show-hide">

        @include('Layout::parts.topbar')

        <div class="bravo_header">

            <div class="{{$container_class ?? 'container'}}">

                <div class="content">

                    <div class="header-left">

                        <div class="box-content d-flex  align-items-center " style="cursor: pointer;">
                            <div class="col-12 col-lg-6 d-flex justify-content-between">
                                <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo navbar-brand u-header__navbar-brand-default u-header__navbar-brand-center u-header__navbar-brand-text-white mr-0 mr-xl-5">

                                    @if($logo_id = setting_item("logo_id"))

                                    <?php $logo = get_file_url($logo_id, 'full') ?>

                                    <img src="{{$logo}}" alt="{{setting_item("site_title")}}">

                                    @endif

                                </a>
                                <a class="bravo-logo navbar-brand u-header__navbar-brand u-header__navbar-brand-center u-header__navbar-brand-on-scroll" href="{{url(app_get_locale(false,'/'))}}">

                                    @if($logo_id = setting_item("logo_id_2"))

                                    <?php $logo = get_file_url($logo_id, 'full') ?>

                                    <img src="{{$logo}}" alt="{{setting_item("site_title")}}">

                                    @endif


                                </a>
                                <button class="bravo-more-menu">

                                    <i class="fa fa-bars"></i>

                                </button>
                            </div>


                            <div class="filter-key d-flex  ml-2 mt-3 mt-md-0" style="align-items: center;">
                                <a class="mb-2" href="./?religion=CATHOLIC">
                                    <span class="text" @if($religion==="CATHOLIC" ) style="color: #ffa636;" @endif>
                                        <strong> {{ __('Católico') }}</strong>
                                    </span>
                                </a>
                                <label class="switch mx-2">
                                    <input type="checkbox" {{ $religion==="EVANGELIC" ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                                <a class="mb-2" href="./?religion=EVANGELIC">
                                    <span class="text" @if($religion==="EVANGELIC" ) style="color: #ffa636;" @endif>
                                        <strong>{{ __('Evangélico') }}</strong>
                                    </span>
                                </a>
                                <script>
                                    const switcher = document.querySelector('.switch input');
                                    switcher.addEventListener('change', function() {
                                        if (this.checked) {
                                            window.location.href = './?religion=EVANGELIC';
                                        } else {
                                            window.location.href = './?religion=CATHOLIC';
                                        }
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="bravo-menu">

                            <?php generate_menu('primary') ?>

                        </div>

                    </div>

                    <div class="header-right">

                        @if(!empty($header_right_menu))

                        <ul class="topbar-items">

                            @include('Core::frontend.currency-switcher')

                            @if(!Auth::id())

                            <li class="login-item">

                                <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Conectar-se')}}</a>

                            </li>

                            <li class="signup-item">

                                <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Cadastrar-se')}}</a>

                            </li>

                            @else

                            <li class="login-item dropdown">

                                <a href="#" data-toggle="dropdown" class="is_login">

                                    @if($avatar_url = Auth::user()->getAvatarUrl())

                                    <img class="avatar" src="{{$avatar_url}}" alt="{{ Auth::user()->getDisplayName()}}">

                                    @else

                                    <span class="avatar-text">{{ucfirst( Auth::user()->getDisplayName()[0])}}</span>

                                    @endif

                                    {{__("Oi, :Name",['name'=>Auth::user()->getDisplayName()])}}

                                    <i class="fa fa-angle-down"></i>

                                </a>

                                <ul data-menu="navbar" class="dropdown-menu text-left">

                                    @if(Auth::user()->hasPermission('dashboard_vendor_access'))

                                    <li><a href="{{route('vendor.dashboard')}}"><i class="icon ion-md-analytics"></i> {{__("Painel do Fornecedor")}}</a></li>

                                    @endif

                                    <li class="@if(Auth::user()->hasPermission('dashboard_vendor_access')) menu-hr @endif">

                                        <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("Meu perfil")}}</a>

                                    </li>

                                    @if(setting_item('inbox_enable'))

                                    <li class="menu-hr"><a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("Reservas")}}</a></li>

                                    @endif

                                    <li class="menu-hr"><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Histórico de Reservas")}}</a></li>

                                    <li class="menu-hr"><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Alterar senha")}}</a></li>

                                    @if(Auth::user()->hasPermission('dashboard_access'))

                                    <li class="menu-hr"><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Painel do Administrador")}}</a></li>


                                    @endif

                                    <li class="menu-hr">

                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{__("Sair")}}</a>

                                    </li>

                                </ul>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                    {{ csrf_field() }}

                                </form>

                            </li>

                            @endif

                        </ul>

                        @endif



                    </div>

                </div>

            </div>

            <div class="bravo-menu-mobile" style="display:none;">

                <div class="user-profile">

                    <div class="b-close"><i class="icofont-scroll-left"></i></div>

                    <div class="avatar"></div>


                    <div class="menu-main-content">
                        <div class="arrows">
                            <span class="arrow">
                                < </span>
                                    <span> ></span>
                        </div>
                        <ul class="menu-main-mobile" style="overflow: scroll;height: 46vh;">

                            @if(!Auth::id() || Auth::user() === null )

                            <li>

                                <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Entrar')}}</a>

                            </li>

                            <li>

                                <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Cadastrar-se')}}</a>

                            </li>

                            @else

                            <li>

                                <a href="{{route('user.profile.index')}}">

                                    </i> {{__("Oi, :Name",['name'=>Auth::user()->getDisplayName()])}}

                                </a>

                            </li>

                            <li style="margin-top: 2rem;">

                                <a href="{{route('user.profile.index')}}">
                                    <i class="icon ion-md-construct"></i> {{__("Meu perfil")}}
                                </a>
                            </li>
                            <li>
                                <a href="/user/verification">
                                    <span class="icon text-center"><i class="fa fa-id-card-o"></i></span>
                                    Minhas Verificações
                                </a>
                            </li>
                            <li>
                                <a href="/user/plan">
                                    <span class="icon text-center"><i class="fa fa-list-alt"></i></span>
                                    Meu Plano
                                </a>
                            </li>
                            <li>
                                <a href="/user/network">
                                    <span class="icon text-center"><i class="fa fa-sitemap"></i></span>
                                    Minha Rede
                                </a>
                            </li>

                            <li>
                                <a href="/user/booking-history">
                                    <span class="icon text-center"><i class="fa fa-clock-o"></i></span>
                                    Minhas Reservas
                                </a>
                            </li>
                            <li>
                                <a href="/user/chat">
                                    <span class="icon text-center"><i class="fa fa-comments"></i></span>
                                    Minhas Mensagens
                                </a>
                            </li>

                            @include('Layout::parts.authmenu')
                            @if(Auth::user()->hasPermission('dashboard_vendor_access'))

                            <li>

                                <a href="{{route('vendor.dashboard')}}">

                                    <i class="icon ion-md-analytics"></i> {{__("Painel do Fornecedor")}}

                                </a>

                            </li>

                            @endif

                            @if(Auth::user()->hasPermission('dashboard_access'))

                            <li>

                                <a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Painel do Administrador")}}</a>

                            </li>

                            @endif

                            <li style="margin-top: 2rem;">

                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">

                                    <i class="fa fa-sign-out"></i> {{__("Sair")}}

                                </a>

                                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">

                                    {{ csrf_field() }}

                                </form>

                            </li>



                            @endif

                        </ul>
                    </div>

                    <ul class="multi-lang">

                        @include('Core::frontend.currency-switcher-dropdown')

                    </ul>

                </div>

                <div class="g-menu">

                    <?php generate_menu('primary') ?>

                </div>

            </div>

        </div>

    </div>

</header>