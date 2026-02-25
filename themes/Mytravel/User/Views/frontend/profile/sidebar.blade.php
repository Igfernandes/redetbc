<div class="profile-summary mb-2">
    <div class="row justify-content-center align-items-center">
        <div class="col-3 col-md-5 px-0">
            <div class="profile-avatar">
                @if($avatar = $user->getAvatarUrl())
                <div class="avatar-img avatar-cover">
                    <img src="{{$user->getAvatarUrl()}}" alt="perfil do usuário">
                </div>
                @else
                <span class="avatar-text">{{$user->getDisplayName()[0]}}</span>
                @endif
            </div>
        </div>
        <div class="col-7 px-0">
            <h3 class="display-name">{{$user->getDisplayName()}}
                @if($user->is_verified)
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/ico-vefified-1.svg')}}" title="{{__("Verificado")}}" alt="ico-vefified-1">
                @else
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/ico-not-vefified-1.svg')}}" title="{{__("Não verificado")}}" alt="ico-vefified-1">
                @endif
            </h3>
            <div class="text-center mb-1"><span class="role-name  badge badge-primary">{{$user->role_name}}</span></div>
        </div>
    </div>
    <p class="profile-since mb-0">
        Membro desde {{ \Carbon\Carbon::parse($user->created_at)->locale('pt_BR')->translatedFormat('M Y') }}
    </p>
    @if(empty(setting_item('user_disable_verification_feature')))
    @if(!empty($user->verification_fields))
    @php
    $registerVerified = array_filter($user->verification_fields,function($item){
    return $item['is_verified'] == 1;
    } )
    @endphp
    <div class="text-center">
        <p>
            @if(count( $registerVerified) >= 1)
            <img class="left-icon" src="{{asset('icon/success.svg')}}" alt="success">
            <span>Perfil verificado</span>
            @else
            <img src="{{asset('icon/x.svg')}}" alt="success">
            <span>Perfil não verificado</span>
            @endif
        </p>
    </div>
    @endif
    @endif

    <style>
        .social-links ul {
            list-style: none;
            gap: 15px;
        }

        .social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #fff;
            font-size: 18px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        /* Facebook */
        .social-icon.facebook {
            background: #1877F2;
        }

        /* Instagram (gradiente oficial) */
        .social-icon.instagram {
            background: radial-gradient(circle at 30% 107%,
                    #fdf497 0%, #fdf497 5%,
                    #fd5949 45%, #d6249f 60%,
                    #285AEB 90%);
        }

        /* Twitter */
        .social-icon.twitter {
            background: #1DA1F2;
        }

        /* WhatsApp */
        .social-icon.whatsapp {
            background: #25D366;
        }

        /* Hover effect */
        .social-icon:hover {
            color: #fff;
            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
        }
    </style>
    <div class="social-links">
        <ul class="d-flex justify-content-center p-0 m-0">

            @if($user->facebook)
            <li>
                <a href="{{ $user->facebook }}" target="_blank" class="social-icon facebook">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            @endif

            @if($user->instagram)
            <li>
                <a href="{{ $user->instagram }}" target="_blank" class="social-icon instagram">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
            @endif

            @if($user->twitter)
            <li>
                <a href="{{ $user->twitter }}" target="_blank" class="social-icon twitter">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            @endif

            @if($user->whatsapp)
            <li>
                <a href="{{ $user->whatsapp }}" target="_blank" class="social-icon whatsapp">
                    <i class="fa fa-whatsapp"></i>
                </a>
            </li>
            @endif

        </ul>
    </div>

    <hr>
    <div class="text-justify">
        <span class="mb-2 d-block">{{__("Olá, eu sou :name",['name'=>$user->getDisplayName()])}}</span>
        <small class="d-none d-md-block text-justify"><?= $user->bio ?></small>
        <div class="d-md-none text-justify"><?= $user->bio ?></div>
    </div>
    @if($user->hasPermission('dashboard_vendor_access'))
    <hr>
    <ul class="meta-info style2">
        <li class="is_vendor">
            <i class="icon ion-md-ribbon text-warning"></i>
            {{ __('Anfitrião') }}
        </li>

        <li class="is_vendor">
            <i class="icon ion-md-person text-primary"></i>
            {{ __('Sexo:') }}
            {{ $user->sex === "MASCULINE" ? "Masculino" : "Feminino" }}
        </li>

        <li class="is_vendor">
            <i class="icon ion-md-heart text-danger"></i>
            {{ __('Estado Civil:') }}
            {{ $user->civil_status === "SINGLE" ? "Solteiro(a)" : "Casado(a)" }}
        </li>

        <li class="is_vendor">
            <i class="icon ion-md-book text-success"></i>
            {{ __('Religião:') }}
            {{
        $user->religion === "CATHOLIC"
            ? "Católico(a)"
            : ($user->religion === "EVANGELICAL"
                ? "Evangélico(a)"
                : "Católico(a) e Evangélico(a)")
    }}
        </li>

        <li>
            <i class="icon ion-md-pin text-secondary"></i>
            {{ __('Cidade:') }} {{ $user->city }}
        </li>
        <li class="review_count">
            <i class="icon ion-ios-thumbs-up"></i>
            @if($user->review_count <= 1)
                {{__(':count avaliação',['count'=>$user->review_count])}}
                @else
                {{__(':count avaliações',['count'=>$user->review_count])}}
                @endif
                </li>
    </ul>
    @endif
    @if(setting_item('vendor_show_email') or setting_item('vendor_show_phone'))
    <ul class="meta-info style1">
        @if(setting_item('vendor_show_email'))
        <li class="user_email">
            <span class="label">{{__('Email:')}}</span>
            <span class="val">{{$user->email}}</span>
        </li>
        @endif

        @if(setting_item('vendor_show_phone'))
        <li class="user_phone">
            <span class="label">{{__('Telefone:')}}</span>
            <span class="val">{{$user->phone}}</span>
        </li>
        @endif
    </ul>
    @endif
    <hr>
    <x-purposes :user="$user" />

    @if(!empty($user->facebook))
    @php
    $facebookId = null;

    if (!empty($user->facebook)) {
    $parsedUrl = parse_url($user->facebook);

    if (isset($parsedUrl['query'])) {
    parse_str($parsedUrl['query'], $queryParams);
    $facebookId = $queryParams['id'] ?? null;
    }
    }
    @endphp
    <!-- 1️⃣ Div obrigatória do SDK -->
    <div id="fb-root"></div>

    <!-- 2️⃣ Carregar SDK do Facebook -->
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v14.0&appId=354164384987945&autoLogAppEvents=1">
    </script>

    <!-- 3️⃣ Plugin da Página -->
    <div class="fb-page fb_iframe_widget"
        data-href="https://www.facebook.com/{{ $facebookId }}"
        data-show-posts="true" data-width="250" data-height="350"
        data-small-header="false" data-adapt-container-width="true"
        data-hide-cover="false"
        data-show-facepile="true">
    </div>
    @endif
</div>