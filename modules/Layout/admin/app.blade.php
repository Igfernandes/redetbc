<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $page_title ?? 'Dashboard'}} - Administrador da Plataforma</title>
    @php
    $favicon = setting_item('site_favicon');
    @endphp
    @if($favicon)
    @php
    $file = (new \Modules\Media\Models\MediaFile())->findById($favicon);
    @endphp
    @if(!empty($file))
    <link rel="icon" type="{{$file['file_type']}}" href="{{asset('uploads/'.$file['file_path'])}}" />
    @else
    <link rel="icon" type="image/png" href="{{url('images/favicon.png')}}" />
    @endif
    @endif
    <meta name="robots" content="noindex, nofollow" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
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
    <!-- Styles -->
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/flags/css/flag-icon.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('libs/daterange/daterangepicker.css')}}" />
    <link href="{{ asset('themes/admin/libs/bootstrap-4.6.2-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/admin/libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/admin/css/app.css') }}" rel="stylesheet">
    {!! \App\Helpers\Assets::css() !!}
    {!! \App\Helpers\Assets::js() !!}
    @include('Layout::admin.parts.global-script')
    <script src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    @stack('css')
</head>

<body class="{{($enable_multi_lang ?? '') ? 'enable_multi_lang' : '' }} @if(setting_item('site_enable_multi_lang')) site_enable_multi_lang @endif" >
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

    <div id="app">
        <div class="main-header d-flex">
            @include('Layout::admin.parts.header')
        </div>
        <div class="main-sidebar">
            @include('Layout::admin.parts.sidebar')
        </div>
        <div class="main-content">
            @include('Layout::admin.parts.bc')
            @yield('content')
            <footer class="main-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 copy-right">
                            {{date('Y')}} &copy; Plataforma de Reservas Booking Pro <div style="display:none;"><a href="https://www.agencianaweb.com.br">Agencia na Web</a></div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right footer-links d-none d-sm-block">
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <div class="backdrop-sidebar-mobile"></div>
    </div>
    @include('Media::browser')
    @include('Pro::admin.upgrade-modal')
    <!-- Scripts -->
    {!! \App\Helpers\Assets::css(true) !!}
    <script src="{{ asset('libs/pusher.min.js') }}"></script>
    <script src="{{ asset('dist/admin/js/manifest.js?_ver='.config('app.asset_version')) }}"></script>
    <script src="{{ asset('libs/jquery-3.6.3.min.js?_ver='.config('app.asset_version')) }}"></script>
    <script src="{{ asset('themes/admin/libs/bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js?_ver='.config('app.asset_version')) }}"></script>
    <script src="{{ asset('dist/admin/js/vendor.js?_ver='.config('app.asset_version')) }}"></script>
    <script src="{{ asset('libs/filerobot-image-editor/filerobot-image-editor.min.js?_ver='.config('app.asset_version')) }}"></script>
    <script src="{{ asset('dist/admin/js/app.js?_ver='.config('app.asset_version')) }}"></script>
    <script src="{{ asset('libs/vue/vue'.(!env('APP_DEBUG') ? '.min':'').'.js') }}"></script>
    <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('libs/bootbox/bootbox.min.js') }}"></script>
    <script src="{{url('libs/daterange/moment.min.js')}}"></script>
    <script src="{{url('libs/daterange/daterangepicker.min.js?_ver='.config('app.asset_version'))}}"></script>
    {!! \App\Helpers\Assets::js(true) !!}
    @stack('js')
    @php do_action('ADMIN_JS_STACK') @endphp
</body>

</html>