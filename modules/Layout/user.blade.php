<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{$html_class ?? ''}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php($favicon = setting_item('site_favicon'))
    <link rel="icon" type="image/png" href="{{!empty($favicon)?get_file_url($favicon,'full'):url('images/favicon.png')}}" />
    @include('Layout::parts.seo-meta')
    <!-- Developer www.agencianaweb.com.br -->
    <meta http-equiv="Content-Language" content="pt-br">
    <meta name="document-classification" content="Site Institucional">
    <meta name="REVISIT-AGENCIANAWEB" content="1 days">
    <meta name="LANGUAGE" content="Portuguese">
    <meta name="COPYRIGHT" content="www.agencianaweb.com.br">
    <meta name="robots" content="all" />
    <meta name="googlebot" content="all" />
    <meta name="audience" content="all">
    <meta name="copyright" content="Copyright (c) Agencia na Web. Todos os Direitos Reservados.">
    <link href="{{ asset('libs/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/frontend/css/notification.css') }}" rel="newest stylesheet">
    <link href="{{ asset('dist/frontend/css/app.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/daterange/daterangepicker.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/select2/css/select2.min.css") }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel='stylesheet' id='google-font-css-css' href='https://fonts.googleapis.com/css?family=Poppins%3A400%2C500%2C600' type='text/css' media='all' />
    @include('Layout::parts.global-script')
    <script>
        var image_editer = {
            language: '{{ app()->getLocale() }}',
            translations: {
                {
                    {
                        app() - > getLocale()
                    }
                }: {
                    'header.image_editor_title': '{{ __("Editor de Imagem ") }}',
                    'header.toggle_fullscreen': '{{ __("Alternar tela cheia ") }}',
                    'header.close': '{{ __("Fechar ") }}',
                    'header.close_modal': '{{ __("Fechar janela ") }}',
                    'toolbar.download': '{{ __("Salvar Alterações ") }}',
                    'toolbar.save': '{{ __("Salvar ") }}',
                    'toolbar.apply': '{{ __("Aplicar ") }}',
                    'toolbar.saveAsNewImage': '{{ __("Salvar Como Nova Imagem ") }}',
                    'toolbar.cancel': '{{ __("Cancelar ") }}',
                    'toolbar.go_back': '{{ __("Voltar ") }}',
                    'toolbar.adjust': '{{ __("Ajustar ") }}',
                    'toolbar.effects': '{{ __("Efeitos ") }}',
                    'toolbar.filters': '{{ __("Filtros ") }}',
                    'toolbar.orientation': '{{ __("Orientação ") }}',
                    'toolbar.crop': '{{ __("Cortar ") }}',
                    'toolbar.resize': '{{ __("Redimensionar ") }}',
                    'toolbar.watermark': '{{ __("Marca d'água ") }}',
                    'toolbar.focus_point': '{{ __("Ponto de foco ") }}',
                    'toolbar.shapes': '{{ __("Formas ") }}',
                    'toolbar.image': '{{ __("Imagem ") }}',
                    'toolbar.text': '{{ __("Texto ") }}',
                    'adjust.brightness': '{{ __("Brilho ") }}',
                    'adjust.contrast': '{{ __("Contraste ") }}',
                    'adjust.exposure': '{{ __("Exposição ") }}',
                    'adjust.saturation': '{{ __("Saturação ") }}',
                    'orientation.rotate_l': '{{ __("Girar Esquerda ") }}',
                    'orientation.rotate_r': '{{ __("Girar Direita ") }}',
                    'orientation.flip_h': '{{ __("Inverter Horizontalmente ") }}',
                    'orientation.flip_v': '{{ __("Inverter Verticalmente ") }}',
                    'pre_resize.title': '{{ __("Gostaria de reduzir a resolução antes de editar a imagem? ") }}',
                    'pre_resize.keep_original_resolution' : '{{ __("Manter resolução original ") }}',
                    'pre_resize.resize_n_continue': '{{ __("Redimensionar e Continuar ") }}',
                    'footer.reset': '{{ __("Redefinir ") }}',
                    'footer.undo': '{{ __("Desfazer ") }}',
                    'footer.redo': '{{ __("Refazer ") }}',
                    'spinner.label': '{{ __("Processando...") }}',
                    'warning.too_big_resolution': '{{ __("A resolução da imagem é muito alta para a web. Isso pode causar problemas de desempenho no Editor de Imagens.") }}',
              
                    'common.x': '{{ __("x ") }}',
                    'common.y': '{{ __("y ") }}',
                    'common.width': '{{ __("largura ") }}',
                    'common.height': '{{ __("altura ") }}',
                    'common.custom': '{{ __("personalizado ") }}',
                    'common.original': '{{ __("original ") }}',
                    'common.square': '{{ __("quadrado ") }}',
                    'common.opacity': '{{ __("opacidade ") }}',
                    'common.apply_watermark': '{{ __("Aplicar marca d'água ") }}',
                    'common.url': '{{ __("URL ") }}',
                    'common.upload': '{{ __("Enviar ") }}',
                    'common.gallery': '{{ __("Galeria ") }}',
                    'common.text': '{{ __("Texto ") }}',
                }
            }
        };
    </script>
    <link href="{{ asset('dist/frontend/module/user/css/user.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <!-- Styles -->
    @stack('css')
    <style type="text/css">
        .bravo_topbar,
        .bravo_header,
        .bravo_footer {
            display: none;
        }

        html,
        body,
        .bravo_wrap,
        .bravo_user_profile,
        .bravo_user_profile>.container-fluid>.row-eq-height>.col-md-3 {
            min-height: 100vh !important;
        }
    </style>
    {{--Custom Style--}}
    <link href="{{ route('core.style.customCss') }}" rel="stylesheet">
    <link href="{{ asset('libs/carousel-2/owl.carousel.css') }}" rel="stylesheet">
    @if(setting_item_with_lang('enable_rtl'))
    <link href="{{ asset('dist/frontend/css/rtl.css') }}" rel="stylesheet">
    @endif
</head>

<body class="user-page {{$body_class ?? ''}} @if(setting_item_with_lang('enable_rtl')) is-rtl @endif" >

    <style type="text/css">
        a.gflag {
            vertical-align: middle;
            font-size: 32px;
            padding: 1px 0;
            background-repeat: no-repeat;
            background-image: url(//gtranslate.net/flags/32.png);
        }

        a.gflag img {
            border: 0;
        }

        a.gflag:hover {
            background-image: url(//gtranslate.net/flags/32a.png);
        }

        #goog-gt- {
            display: none !important;
        }

        .goog-te-banner-frame {
            display: none !important;
        }

        .goog-te-menu-value:hover {
            text-decoration: none !important;
        }

        body {
            top: 0 !important;
        }

        #google_translate_element2 {
            display: none !important;
        }

        .VIpgJd-ZVi9od-ORHb-OEVmcd {
            display: none !important;
        }

        #goog-gt-tt {
            display: none !important;
        }

        .VIpgJd-yAWNEb-VIpgJd-fmcmS-sn54Q {
            background-color: transparent !important;
            box-shadow: none !important;
        }
    </style>

    @if(!is_demo_mode())
    {!! setting_item('body_scripts') !!}
    @endif
    <div class="bravo_wrap">
        @include('Layout::parts.topbar')
        @include('Layout::parts.header')

        <div class="bravo_user_profile">
            <div class="container-fluid">
                <div class="row row-eq-height">
                    <div class="col-md-3 px-0">
                        @include('User::frontend.layouts.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="user-form-settings">
                            @include('Layout::parts.user-bc')
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Layout::parts.footer',['is_user_page'=>1])
    </div>
    <div style="display:none;"><a href="https://www.agencianaweb.com.br">Agencia na Web</a></div>
    <script src="{{ asset('libs/filerobot-image-editor/filerobot-image-editor.min.js?_ver='.config('app.asset_version')) }}"></script>
    @if(!is_demo_mode())
    {!! setting_item('footer_scripts') !!}
    @endif
</body>

</html>
