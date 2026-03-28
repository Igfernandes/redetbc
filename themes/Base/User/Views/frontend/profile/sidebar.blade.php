<div class="profile-summary mb-2">

    {{-- Header --}}
    <div class="row justify-content-center align-items-center">
        <div class="col-4 col-md-5 px-0 text-center">
            <div class="profile-avatar">
                @if($avatar = $user->getAvatarUrl())
                <div class="avatar-img avatar-cover">
                    <img src="{{ $avatar }}" alt="Perfil de {{ $user->getDisplayName() }}">
                </div>
                @else
                <span class="avatar-text">
                    {{ strtoupper($user->getDisplayName()[0]) }}
                </span>
                @endif
            </div>
        </div>

        <div class="col-8 px-0">
            <h3 class="display-name mb-1">
                {{ $user->getDisplayName() }}

                @if($user->is_verified)
                <img src="{{ asset('icon/ico-vefified-1.svg') }}"
                    title="Verificado"
                    alt="Verificado">
                @else
                <img src="{{ asset('icon/ico-not-vefified-1.svg') }}"
                    title="Não verificado"
                    alt="Não verificado">
                @endif
            </h3>

            <span class="badge badge-primary">
                {{ $user->role_name }}
            </span>
        </div>
    </div>

    {{-- Membro desde --}}
    <p class="profile-since mb-1">
        Membro desde {{ $user->created_at->locale('pt_BR')->translatedFormat('M Y') }}
    </p>

    {{-- Verificação --}}
    @if(empty(setting_item('user_disable_verification_feature')) && !empty($user->verification_fields))
    @php
    $registerVerified = collect($user->verification_fields)
    ->where('is_verified', 1);
    @endphp

    <div class="text-center mb-2">
        @if($registerVerified->count() >= 1)
        <img src="{{ asset('icon/success.svg') }}" alt="Verificado">
        <span>Perfil verificado</span>
        @else
        <img src="{{ asset('icon/x.svg') }}" alt="Não verificado">
        <span>Perfil não verificado</span>
        @endif
    </div>
    @endif

    <div>
        <ul class="d-flex ">
            <li>
                @if($user->facebook)
                <a href="{{ $user->facebook }}" target="_blank" class="mr-2">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li>
                @endif
                @if($user->instagram)
                <a href="{{ $user->instagram }}" target="_blank" class="mr-2">
                    <i class="fa fa-instagram"></i>
                </a>
                @endif
            </li>
            <li>
                @if($user->twitter)
                <a href="{{ $user->twitter }}" target="_blank" class="mr-2">
                    <i class="fa fa-twitter"></i>
                </a>
                @endif
            </li>
            <li>
                @if($user->whatsapp)
                <a href="{{ $user->whatsapp }}" target="_blank" class="mr-2">
                    <i class="fa fa-whatsapp"></i>
                </a>
                @endif
            </li>
        </ul>
    </div>

    <hr>

    {{-- Bio --}}
    <div class="text-justify mb-3">
        <strong>{{ __("Olá, eu sou :name", ['name'=>$user->getDisplayName()]) }}</strong>
        <div class="mt-1">
            {!! nl2br(e($user->bio)) !!}
        </div>
    </div>

    {{-- Anfitrião --}}
    @if($user->hasPermission('dashboard_vendor_access'))
    <hr>
    <ul class="meta-info style2">
        <li class="is_vendor">
            <i class="icon ion-ios-ribbon"></i>
            {{ __('Anfitrião') }}
        </li>
        <li class="review_count">
            <i class="icon ion-ios-thumbs-up"></i>
            {{ $user->review_count }}
            {{ $user->review_count <= 1 ? 'avaliação' : 'avaliações' }}
        </li>
    </ul>
    @endif

    {{-- Contato --}}
    @if(setting_item('vendor_show_email') || setting_item('vendor_show_phone'))
    <ul class="meta-info style1">
        @if(setting_item('vendor_show_email'))
        <li>
            <strong>Email:</strong> {{ $user->email }}
        </li>
        @endif
        @if(setting_item('vendor_show_phone'))
        <li>
            <strong>Telefone:</strong> {{ $user->phone }}
        </li>
        @endif
    </ul>
    @endif

    <hr>

    {{-- Ícones de Finalidades --}}
    <div>
        <h5 style="font-size: 1rem; color: #033480;">
            <strong>Meus ícones de Afinidade</strong>
        </h5>
        <small><strong>Convivência e Regras</strong></small>
    </div>

    @php
    $userPurposes = !empty($user->purposes) ? explode(',', $user->purposes) : [];
    $authPurposes = auth()->check() && auth()->user()->purposes
    ? explode(',', auth()->user()->purposes)
    : [];
    @endphp

    <ul class="list-unstyled row mb-4 p-0">
        @foreach($userPurposes as $purpose)
        @if(empty($purpose) || !config("icons.$purpose")) @continue @endif

        @php
        $isMatch = in_array($purpose, $authPurposes);
        @endphp

        <li class="col-6 col-md-6 px-1 mb-2 position-relative">
            <div class="d-flex align-items-center p-2 bg-white shadow-sm"
                style="border:2px solid {{ $isMatch ? '#ebd07d' : '#dcdcdc' }};
                            border-radius:12px;">

                <span style="font-size:1.4rem;" class="mr-2">
                    {!! config("icons.$purpose") !!}
                </span>

                <small style="font-weight:600;">
                    {{ $purpose }}
                </small>
            </div>

            @if($isMatch)
            <span style="position:absolute; top:-6px; right:10px;
                                 background:#ebd07d;
                                 font-size:10px;
                                 padding:2px 6px;
                                 border-radius:4px;">
                Afinidade
            </span>
            @endif
        </li>
        @endforeach
    </ul>
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