@extends('layouts.user')
@section('content')
    <h2 class="title-bar no-border-bottom">
        {{$row->id ? __('Editar: ').$row->title : __('Adicionar novo hotel')}}

        @if($row->id)
            <div class="title-action">
                <a class="btn btn-info" href="{{route('hotel.vendor.room.index',['hotel_id'=>$row->id])}}">
                    <i class="fa fa-hand-o-right"></i> {{__("Gerenciar Quartos")}}
                </a>
                <a href="{{route('hotel.vendor.room.availability.index',['hotel_id'=>$row->id])}}" class="btn btn-warning">
                    <i class="fa fa-calendar"></i> {{__("Disponibilidade dos Quartos")}}
                </a>
            </div>
        @endif
    </h2>

    @include('admin.message')

    @if($row->id)
        @include('Language::admin.navigation')
    @endif

    <div class="lang-content-box">
        <form action="{{route('hotel.vendor.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
            @csrf

            <div class="form-add-service">

                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a data-toggle="tab" href="#nav-tour-content" aria-selected="true" class="active">{{__("1. Conteúdo")}}</a>
                    <a data-toggle="tab" href="#nav-tour-location" aria-selected="false">{{__("2. Localização")}}</a>

                    @if(is_default_lang())
                        <a data-toggle="tab" href="#nav-tour-pricing" aria-selected="false">{{__("3. Preços")}}</a>
                        <a data-toggle="tab" href="#nav-attribute" aria-selected="false">{{__("4. Atributos")}}</a>
                        {{-- <a data-toggle="tab" href="#nav-ical" aria-selected="false">{{__("5. Ical")}}</a> --}}
                    @endif
                </div>

                <div class="tab-content" id="nav-tabContent">

                    {{-- A BA CONTEÚDO --}}
                    <div class="tab-pane fade show active" id="nav-tour-content">
                        @include('Hotel::admin/hotel/content')

                        @if(is_default_lang())
                            <div class="form-group">
                                <label>{{__("Imagem de Apresentação")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                            </div>
                        @endif
                    </div>

                    {{-- A BA LOCALIZAÇÃO --}}
                    <div class="tab-pane fade" id="nav-tour-location">
                        @include('Hotel::admin/hotel/location',["is_smart_search"=>"1"])
                        @include('Hotel::admin.hotel.surrounding')
                    </div>

                    {{-- A BA PREÇOS --}}
                    @if(is_default_lang())
                        <div class="tab-pane fade" id="nav-tour-pricing">
                            @include('Hotel::admin/hotel/pricing')
                        </div>

                        {{-- A BA ATRIBUTOS --}}
                        <div class="tab-pane fade" id="nav-attribute">
                            @include('Hotel::admin/hotel/attributes')
                        </div>

                        {{-- 
                        <div class="tab-pane fade" id="nav-ical">
                            @include('Hotel::admin/hotel/ical')
                        </div>
                        --}}
                    @endif

                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-save"></i> {{__('Salvar alterações')}}
                </button>
            </div>

        </form>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/condition.js?_ver='.config('app.asset_version')) }}"></script>
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {

            new BravoMapEngine('map_content', {
                fitBounds: true,
                center: [{{$row->map_lat ?? setting_item('map_lat_default')}}, {{$row->map_lng ?? setting_item('map_lng_default')}}],
                zoom: {{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {

                    @if($row->map_lat && $row->map_lng)
                        engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], { icon_options: {} });
                    @endif

                    engineMap.on('click', function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, { icon_options: {} });

                        $("input[name=map_lat]").val(dataLatLng[0]);
                        $("input[name=map_lng]").val(dataLatLng[1]);
                    });

                    engineMap.on('zoom_changed', function (zoom) {
                        $("input[name=map_zoom]").val(zoom);
                    });

                    // Campo de busca - Google Maps
                    if (bookingCore.map_provider === "gmap") {
                        engineMap.searchBox($('#customPlaceAddress'), function (dataLatLng) {
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, { icon_options: {} });

                            $("input[name=map_lat]").val(dataLatLng[0]);
                            $("input[name=map_lng]").val(dataLatLng[1]);
                        });
                    }

                    // Campo de busca geral
                    engineMap.searchBox($('.bravo_searchbox'), function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, { icon_options: {} });

                        $("input[name=map_lat]").val(dataLatLng[0]);
                        $("input[name=map_lng]").val(dataLatLng[1]);
                    });

                }
            });

        })
    </script>
@endpush
