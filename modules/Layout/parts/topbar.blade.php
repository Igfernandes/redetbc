@($isVerification = auth()->user()->is_verification == 1)

<div class="bravo_topbar">
    <div class="container">
        <div class="content">
            <div class="topbar-left">

                {!! clean(setting_item_with_lang("topbar_left_text")) !!}


            </div>
            <div class="topbar-right">
                <ul class="topbar-items">
                    @include('Core::frontend.currency-switcher')
                    @if(!Auth::check())
                    <li class="login-item">
                        <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Conectar')}}</a>
                    </li>
                    @if(is_enable_registration())
                    <li class="signup-item">
                        <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Registrar')}}</a>
                    </li>
                    @endif
                    @else
                    @include('Layout::parts.notification')
                    <li class="login-item dropdown">
                        <a href="#" data-toggle="dropdown" class="login">{{__("Oi, :name",['name'=>Auth::user()->getDisplayName()])}}
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-user text-left">
                            @if(is_vendor() && $isVerification)
                            <li class="menu-hr"><a href="{{route('vendor.dashboard')}}" class="menu-hr"><i class="icon ion-md-analytics"></i> {{__("Fornecedor Dashboard")}}</a></li>
                            @endif
                            <li class="@if(is_vendor()) menu-hr @endif">
                                {{$isVerification}}
                                <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("Meu perfil")}}</a>
                            </li>
                            @if(setting_item('inbox_enable') && $isVerification)
                            <li class="menu-hr">
                                <a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("Reservas")}}
                                    @if($count = auth()->user()->unseen_message_count)
                                    <span class="badge badge-danger">{{$count}}</span>
                                    @endif
                                </a>
                            </li>
                            @endif

                            <li class="menu-hr"><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Histórico de Reservas")}}</a></li>
                            <li class="menu-hr"><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Alterar senha")}}</a></li>

                            @if(Auth::user()->is_verified === 1)
                             <li class="menu-hr"><a href="{{route('user.plan')}}"><i class="fa fa-list-alt"></i> {{__("Meu plano")}}</a></li>
                            @endif

                            @if(isPro())
                            <li class="menu-hr">
                                <a href="{{route('support.index')}}">
                                    <i class="fa fa-list-alt"></i> {{__("Centro de Suporte")}}</a>
                            </li>
                            @endif

                            @if(is_admin())
                            <li class="menu-hr"><a href="{{route('admin.index')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a></li>
                            @endif
                            <li class="menu-hr">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Sair')}}</a>
                            </li>
                        </ul>
                        <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>