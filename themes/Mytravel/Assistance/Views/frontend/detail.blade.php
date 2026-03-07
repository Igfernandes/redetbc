@extends('layouts.app')
@push('css')
    <link href="{{ asset('/themes/mytravel/dist/frontend/module/assistance/css/assistance.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/fotorama/fotorama.css") }}"/>
@endpush
@section('content')
    <div class="bravo_detail_assistance">
        @include('Assistance::frontend.layouts.details.assistance-banner')
        <div class="bravo_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-9">
                        @php $review_score = $row->review_data @endphp
                        @include('Assistance::frontend.layouts.details.assistance-detail')
                        @include('Assistance::frontend.layouts.details.assistance-review')
                    </div>
                    <div class="col-md-12 col-lg-3">
                        @include('Assistance::frontend.layouts.details.assistance-form-book')
                        @include('Assistance::frontend.layouts.details.open-hours')
                        @include('Assistance::frontend.layouts.details.vendor')
                        @include('Booking::frontend/booking/booking-why-book-us')
                    </div>
                </div>
                <div class="row end_assistance_sticky">
                    <div class="col-md-12">
                        @include('Assistance::frontend.layouts.details.assistance-related')
                    </div>
                </div>
            </div>
        </div>
      <div class="bravo-more-book-mobile py-3 border-top bg-white shadow-sm fixed-bottom">
    <div class="container">
        <div class="row align-items-center">

            {{-- LEFT --}}
            <div class="col-7">
                
                {{-- PRICE --}}
                    <div class="g-price mb-2">
                        <small class="text-muted d-block">{{ __("De") }}</small>

                        <div class="h5 mb-0 font-weight-bold">
                            @if($row->display_sale_price)
                                <span class="text-muted mr-2" style="text-decoration: line-through;">
                                    {{ $row->display_sale_price }}
                                </span>

                                <span class="text-muted mx-1">
                                    {{ __("Por") }}
                                </span>
                            @endif

                            <span class="text-primary">
                                {{ $row->display_price }}
                            </span>
                        </div>
                    </div>

                {{-- REVIEW --}}
                @if(setting_item('assistance_enable_review'))
                    @php
                        $reviewData = $row->getScoreReview();
                        $score_total = $reviewData['score_total'] ?? 0;
                        $percent = $score_total * 20; // 5 estrelas = 100%
                    @endphp

                    <div class="service-review d-flex align-items-center assistance-review-{{$score_total}}">
                        
                        <div class="list-star position-relative mr-2">
                            
                            {{-- Estrelas base --}}
                            <ul class="booking-item-rating-stars list-inline m-0 text-muted">
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                            </ul>

                            {{-- Estrelas ativas --}}
                            <div class="booking-item-rating-stars-active position-absolute top-0 left-0 overflow-hidden"
                                 style="width: {{ $percent }}%;">
                                <ul class="booking-item-rating-stars list-inline m-0 text-warning">
                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                </ul>
                            </div>
                        </div>

                        <span class="review small text-muted">
                            {{ $reviewData['total_review'] }}
                            {{ $reviewData['total_review'] > 1 ? __('Avaliações') : __('Avaliação') }}
                        </span>

                    </div>
                @endif

            </div>

            {{-- RIGHT --}}
            <div class="col-5">
                @if($row->getBookingEnquiryType() === "book")
                    <a href="/assistance/booking/{{ $row->id }}"
                       class="btn btn-primary btn-block font-weight-bold">
                        {{ __("Reserve agora") }}
                    </a>
                @else
                    <button class="btn btn-primary btn-block font-weight-bold"
                            data-toggle="modal"
                            data-target="#enquiry_form_modal">
                        {{ __("Contate-nos agora") }}
                    </button>
                @endif
            </div>

        </div>
    </div>
</div>
    </div>
@endsection

@push('js')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {
            "use strict"
            @if($row->map_lat && $row->map_lng)
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [{{$row->map_lat}}, {{$row->map_lng}}],
                zoom:{{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {
                    engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], {
                        icon_options: {
                            iconUrl:"{{get_file_url(setting_item("assistance_icon_marker_map"),'full') ?? url('images/icons/png/pin.png') }}"
                        }
                    });
                }
            });
            @endif
        })
    </script>
    <script>
        var bravo_booking_data = {!! json_encode($booking_data) !!}
            var bravo_booking_i18n = {
            no_date_select:'{{__("Por favor, selecione a data de Início")}}',
            no_guest_select:'{{__("Por favor, selecione pelo menos um hóspede")}}',
            load_dates_url:'{{route("assistance.vendor.availability.loadDates")}}',
            name_required:'{{ __("Nome é obrigatório") }}',
            email_required:'{{ __("Email é obrigatório") }}',
        };
    </script>
    <script type="text/javascript" src="{{ asset("libs/fotorama/fotorama.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/sticky/jquery.sticky.js") }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/mytravel/module/assistance/js/single-assistance.js?_ver='.config('app.asset_version')) }}"></script>
@endpush