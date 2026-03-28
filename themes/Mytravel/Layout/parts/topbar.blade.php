@php
$isVerification = null !== auth()->user() ? is_admin() ?? auth()->user()->is_verification : false;
@endphp
<div class="bravo_topbar u-header__hide-content u-header__topbar u-header__topbar-lg border-bottom @if(!empty($is_home)|| !empty($header_transparent))border-color-white @else  border-color-8 @endif">
    <div class="{{$container_class ?? 'container'}}">
        <div class="d-flex align-items-center">
            <div class="list-inline u-header__topbar-nav-divider mb-0 topbar_left_text font-size-14 @if(!empty($is_home)|| !empty($header_transparent)) @else  list-inline-dark @endif">
                {!! setting_item_with_lang("topbar_left_text") !!}
            </div>
            <div class="ml-auto d-flex align-items-center">
                @if(!empty($phone_contact = setting_item("Celular_contact")))
                <div class="d-flex align-items-center  px-3" style="color:#003583;">
                    <i class="flaticon-phone-call mr-2 ml-1 font-size-18"></i>
                    <span class="d-inline-block font-size-14 mr-1">{{ $phone_contact }}</span>
                </div>
                @endif
                @include('Core::frontend.currency-switcher')
                @include('Layout::parts.notification')
                <div class="position-relative px-3 u-header__login-form dropdown-connector-xl u-header__topbar-divider">
                    @if(!Auth::id() || null === Auth::user())
                    <a href="javascript:;" class="d-flex align-items-center  py-3"
                        data-toggle="modal" data-target="#login">
                        <i class="flaticon-user mr-2 ml-1 font-size-18"></i>
                        <span class="d-inline-block font-size-14 mr-1">{{ __("Conecte-se ou cadastra-se") }}</span>
                    </a>
                    @else
                    <div class="d-flex align-items-center  py-3 dropdown">
                        <i class="flaticon-user mr-2 ml-1 font-size-18"></i>
                        <span class="d-inline-block font-size-14 mr-1 dropdown-nav-link" data-toggle="dropdown">
                            {{__("Oi, :name",['name'=>Auth::user()->getDisplayName()])}}

                        </span>

                        <ul class="dropdown-menu dropdown-menu-user text-left dropdown">
                            @if(is_vendor() && $isVerification)
                            <li class=""><a href="{{route('vendor.dashboard')}}" class=""><i class="icon ion-md-analytics"></i> {{__("Fornecedor Dashboard")}}</a></li>
                            @endif
                            <li class="@if(is_vendor())  @endif">
                                <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("Meu perfil")}}</a>
                            </li>
                            <li class="@if(is_vendor())  @endif">
                                <a href="{{route('user.verification.index')}}"><i class="fa fa-id-card-o"></i> {{__("Verificação")}}</a>
                            </li>
                            @if(auth()->user()->is_verified && auth()->user()->user_plan->isValid() === 1)
                            <li class=""><a href="{{route('user.network')}}"><i class="fa fa-globe"></i> {{__("Minha Rede")}}</a></li>
                            <li class=""><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Histórico de Reservas")}}</a></li>
                            <li class=""><a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("Chat")}}</a></li>
                            <li class=""><a href="{{route('user.plan')}}"><i class="fa fa-list-alt"></i> {{__("Meu plano")}}</a></li>
                            @endif
                            <li class=""><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Alterar senha")}}</a></li>
                            @if(is_admin())
                            <li class=""><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Painel de administração")}}</a></li>
                            @endif


                            <li class="">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__("Sair")}}</a>
                            </li>
                        </ul>
                        <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>