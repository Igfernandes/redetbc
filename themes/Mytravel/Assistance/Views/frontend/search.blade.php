@extends('layouts.app')
@push('css')
    <link href="{{ asset('themes/mytravel/dist/frontend/module/assistance/css/assistance.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("themes/mytravel/libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
@endpush
@section('content')
    <div class="bravo_search_assistance mt-7">
        <div class="container">
            @include('Assistance::frontend.layouts.search.list-item')
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('js/filter.js?_ver='.config('app.asset_version')) }}"></script>
    <script type="text/javascript" src="{{ asset("themes/mytravel/libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset('themes/mytravel/module/assistance/js/assistance.js?_ver='.config('app.asset_version')) }}"></script>
@endpush
