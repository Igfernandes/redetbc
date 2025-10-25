<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no" class="{{ $html_class ?? '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    @php
    $favicon = setting_item('site_favicon');
    $file = $favicon ? (new \Modules\Media\Models\MediaFile())->findById($favicon) : null;
    @endphp
    @if(!empty($file))
    <link rel="icon" type="{{ $file['file_type'] }}" href="{{ asset('uploads/'.$file['file_path']) }}" />
    @else
    <link rel="icon" type="image/png" href="{{ url('images/favicon.png') }}" />
    @endif

    {{-- SEO Meta --}}
    @include('Layout::parts.seo-meta')

    {{-- SEO + Conteúdo --}}
    <meta http-equiv="Content-Language" content="{{ app()->getLocale() }}">
    <meta name="document-classification" content="Site Institucional">
    <meta name="robots" content="all">
    <meta name="googlebot" content="all">
    <meta name="audience" content="all">
    <meta name="copyright" content="Copyright (c) Agencia na Web. Todos os Direitos Reservados.">
    <meta name="google" content="notranslate">

    {{-- hreflang SEO --}}
    <link rel="alternate" hreflang="pt-BR" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}">

    {{-- CSS Base --}}
    <link href="{{ asset('libs/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/frontend/css/app.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/daterange/daterangepicker.css") }}">
    <link href="{{ asset('libs/carousel-2/owl.carousel.css') }}" rel="stylesheet">
    @if(setting_item_with_lang('enable_rtl'))
    <link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
    @endif

    {{-- Custom Style --}}
    @stack('css')
    <link href="{{ route('core.style.customCss') }}" rel="stylesheet">

    {{-- Google Fonts --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600">

    {{-- Global Scripts --}}
    @include('Layout::parts.global-script')

    {{-- Google Translate - versão limpa --}}
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'pt,en,es',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" async></script>

    <style>
        /* Oculta apenas o banner, mantendo conformidade */
        .goog-te-banner-frame.skiptranslate,
        #goog-gt-tt {
            display: none !important;
        }

        body {
            top: 0 !important;
        }

        .goog-te-gadget {
            font-size: 0;
        }

        .VIpgJd-ZVi9od-l4eHX-hSRGPd {
            display: none !important;
        }
    </style>

</head>

<body class="{{ $body_class ?? '' }}">
    {{-- Botão ou seletor manual de idioma --}}
    <div id="google_translate_element" style="display:none;"></div>
    <script>
        function setLanguage(lang) {
            const combo = document.querySelector(".goog-te-combo");
            if (combo) {
                combo.value = lang;
                combo.dispatchEvent(new Event("change"));
            }
        }
        // Exemplo: definir o idioma inicial automaticamente
        document.addEventListener('DOMContentLoaded', function() {
            const userLang = navigator.language || navigator.userLanguage;
            if (userLang.startsWith('pt')) setLanguage('pt');
        });
    </script>

    <div class="bravo_wrap">
        @yield('content')
    </div>

    {{-- Lazy Load --}}
    <script src="{{ asset('libs/lazy-load/intersection-observer.js') }}"></script>
    <script async src="{{ asset('libs/lazy-load/lazyload.min.js') }}"></script>
    <script>
        window.lazyLoadOptions = {
            elements_selector: ".lazy"
        };
        window.addEventListener('LazyLoad::Initialized', e => window.lazyLoadInstance = e.detail.instance, false);
    </script>

    {{-- JS Base --}}
    <script src="{{ asset('libs/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('libs/vue/vue' . (!env('APP_DEBUG') ? '.min' : '') . '.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @if(Auth::id())
    <script src="{{ asset('module/media/js/browser.js') }}"></script>
    @endif

    <script src="{{ asset('libs/carousel-2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('libs/daterange/moment.min.js') }}"></script>
    <script src="{{ asset('libs/daterange/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script>
        function setLanguage(lang) {
            const combo = document.querySelector(".goog-te-combo");
            if (combo) {
                combo.value = lang;
                combo.dispatchEvent(new Event("change"));
                localStorage.setItem('user_lang', lang);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const saved = localStorage.getItem('user_lang');
            if (saved) {
                const interval = setInterval(() => {
                    const combo = document.querySelector(".goog-te-combo");
                    if (combo) {
                        combo.value = saved;
                        combo.dispatchEvent(new Event("change"));
                        clearInterval(interval);
                    }
                }, 300);
            }
        });
    </script>

    @stack('js')
    @php \App\Helpers\ReCaptchaEngine::scripts() @endphp
</body>

</html>