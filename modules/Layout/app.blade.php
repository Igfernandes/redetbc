<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{$html_class ?? ''}}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@php event(new \Modules\Layout\Events\LayoutBeginHead()); @endphp
@include('Layout::parts.favicon')
<!-- Developer www.agencianaweb.com.br -->
<meta http-equiv="Content-Language" content="pt-br">
<meta name="document-classification" content="Site Institucional">
<meta name="REVISIT-AGENCIANAWEB" content="1 days">
<meta name="LANGUAGE" content="Portuguese">
<meta name="COPYRIGHT" content="www.agencianaweb.com.br">
<meta name="robots" content="all"/>
<meta name="googlebot" content="all"/>
<meta name="audience" content="all">
<meta name="copyright" content="Copyright (c) Agencia na Web. Todos os Direitos Reservados.">
@include('Layout::parts.seo-meta')
<link href="{{ asset('libs/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('libs/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('libs/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('libs/icofont/icofont.min.css') }}" rel="stylesheet">
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('dist/frontend/css/notification.css') }}" rel="newest stylesheet">
<link href="{{ asset('dist/frontend/css/app.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset("libs/daterange/daterangepicker.css") }}" >
<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link rel='stylesheet' id='google-font-css-css'  href='https://fonts.googleapis.com/css?family=Poppins%3A300%2C400%2C500%2C600&display=swap' type='text/css' media='all' />
@if(setting_item('enable_cookie_consent'))
<link rel="stylesheet" href="{{asset('libs/cookie-consent/cookieconsent.css')}}" media="print" onload="this.media='all'">
@endif
{!! \App\Helpers\Assets::css() !!}
{!! \App\Helpers\Assets::js() !!}
@include('Layout::parts.global-script')
<!-- Styles -->
@stack('css')
{{--Custom Style--}}
<link href="{{ route('core.style.customCss') }}" rel="stylesheet">
<link href="{{ asset('libs/carousel-2/owl.carousel.css') }}" rel="stylesheet">
@if(setting_item_with_lang('enable_rtl'))
<link href="{{ asset('dist/frontend/css/rtl.css') }}" rel="stylesheet">
@endif
@if(!is_demo_mode())
{!! setting_item('head_scripts') !!}
{!! setting_item_with_lang_raw('head_scripts') !!}
@endif
</head>
<body class="frontend-page {{ !empty($row->header_style) ? "header-".$row->header_style : "header-normal" }} {{$body_class ?? ''}} @if(setting_item_with_lang('enable_rtl')) is-rtl @endif @if(is_api()) is_api @endif"  onload="doGTranslate('en|pt')">

<style type="text/css">
a.gflag {vertical-align:middle;font-size:32px;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/32.png);}
a.gflag img {border:0;}
a.gflag:hover {background-image:url(//gtranslate.net/flags/32a.png);}
#goog-gt- {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
body {top:0 !important;}
#google_translate_element2 {display:none!important;}
.VIpgJd-ZVi9od-ORHb-OEVmcd {display:none!important;}
#goog-gt-tt {display:none!important;}
.VIpgJd-yAWNEb-VIpgJd-fmcmS-sn54Q {background-color:transparent !important;box-shadow:none !important;}
</style>
<div id="google_translate_element2"></div>
<script type="text/javascript">
function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'en',autoDisplay: false}, 'google_translate_element2');}
</script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
<script type="text/javascript">
/* <![CDATA[ */
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
/* ]]> */

function translatePage() {
  $("#app").attr("translate", "no");
  doGTranslate('en|pt');
}
</script>
    @if(!is_demo_mode())
        {!! setting_item('body_scripts') !!}
        {!! setting_item_with_lang_raw('body_scripts') !!}
    @endif
    <div class="bravo_wrap">
        @if(!is_api())
            @include('Layout::parts.topbar')
            @include('Layout::parts.header')
        @endif
        @yield('content')
        @include('Layout::parts.footer')
    </div>
<div style="display:none;"><a href="https://www.agencianaweb.com.br">Agencia na Web</a></div>
    @if(!is_demo_mode())
        {!! setting_item('footer_scripts') !!}
        {!! setting_item_with_lang_raw('footer_scripts') !!}
    @endif
    @include('demo_script')
</body>
</html>