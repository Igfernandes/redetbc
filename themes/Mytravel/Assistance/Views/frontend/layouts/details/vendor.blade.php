@php
$vendor = $row->author;
@endphp

@if(!empty($vendor->id))
<div class="profile-summary mb-2 p-3 border border-color-7">

    <a href="{{route('user.profile',['id'=>$vendor->user_name ?? $vendor->id])}}" target="_blank">
        <div class="row justify-content-center align-items-center">
            <div class="col-3 col-md-5">
                <div class="profile-avatar">
                    @if($avatar = $vendor->getAvatarUrl())
                    <div class="avatar-img avatar-cover" style="
    border: 4px solid #c39c59;
    width: 80px;
    height: 80px;
    padding: 3px;
    border-radius: 100%;
">
                        <img src="{{$avatar}}" alt="perfil do usuário" style="
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 100%;
">
                    </div>
                    @else
                    <span class="avatar-text">{{$vendor->getDisplayName()[0]}}</span>
                    @endif
                </div>
            </div>

            <div class="col-7 px-0">
                <h3 class="display-name" style="
    line-height: normal;
    font-size: 1.1rem;
    font-weight: 500;
    color: #003583;
">
                    {{$vendor->getDisplayName()}}

                    @if($vendor->is_verified)
                    <img data-toggle="tooltip"
                        src="{{asset('icon/ico-vefified-1.svg')}}"
                        title="Verificado">
                    @else
                    <img data-toggle="tooltip"
                        src="{{asset('icon/ico-not-vefified-1.svg')}}"
                        title="Não verificado">
                    @endif
                </h3>

                <div class="text-center mb-1">
                    <span class="role-name badge badge-primary">
                        Ver Perfil
                    </span>
                </div>
            </div>
        </div>
    </a>

    <p class="profile-since mb-0" style="
    text-align: center;
    margin-top: 12px;
">
        Membro desde
        {{ \Carbon\Carbon::parse($vendor->created_at)->locale('pt_BR')->translatedFormat('M Y') }}
    </p>

    {{-- Verificação de Perfil --}}
    @if(empty(setting_item('user_disable_verification_feature')))
    @if(!empty($vendor->verification_fields))
    @php
    $registerVerified = array_filter($vendor->verification_fields,function($item){
    return $item['is_verified'] == 1;
    });
    @endphp

    <div class="text-center">
        <p>
            @if(count($registerVerified) >= 1)
            <img src="{{asset('icon/success.svg')}}">
            <span>Perfil verificado</span>
            @else
            <img src="{{asset('icon/x.svg')}}">
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

        /* Hover effect */
        .social-icon:hover {
            color: #fff;
            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
        }
    </style>
    <div class="social-links">
        <ul class="d-flex justify-content-center p-0 m-0">

            @if($vendor->facebook)
            <li>
                <a href="{{ $vendor->facebook }}" target="_blank" class="social-icon facebook">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            @endif

            @if($vendor->instagram)
            <li>
                <a href="{{ $vendor->instagram }}" target="_blank" class="social-icon instagram">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
            @endif

            @if($vendor->twitter)
            <li>
                <a href="{{ $vendor->twitter }}" target="_blank" class="social-icon twitter">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            @endif

        </ul>
    </div>
    <hr>

    <x-purposes :user="$vendor" />
    @if(!empty($vendor->facebook))
    @php
    $facebookId = null;

    if (!empty($vendor->facebook)) {
    $parsedUrl = parse_url($vendor->facebook);

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
@endif