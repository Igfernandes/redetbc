@extends('layouts.user')
@section('content')
<h2 class="title-bar no-border-bottom">
    {{$row->id ? __('Editar: ').$row->title : __('Adicionar novo Serviço')}}
</h2>
@include('admin.message')
@if($row->id)
@include('Language::admin.navigation')
@endif
<div class="lang-content-box">
    <form action="{{route('assistance.vendor.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="form-add-service">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a data-toggle="tab" href="#nav-assistance-content" aria-selected="true" class="active">{{__("1. Conteúdo")}}</a>
                <a data-toggle="tab" href="#nav-assistance-location" aria-selected="false">{{__("2. Localizações")}}</a>
                @if(is_default_lang())
                <a data-toggle="tab" href="#nav-assistance-pricing" aria-selected="false">{{__("3. Preços")}}</a>
                <a data-toggle="tab" href="#nav-assistance-availability" aria-selected="false">{{__("4. Disponibilidade")}}</a>
                <a data-toggle="tab" href="#nav-assistance-attribute" aria-selected="false">{{__("5. Atributos")}}</a>
                <a data-toggle="tab" href="#nav-assistance-ical" aria-selected="false">{{__("6. Ical")}}</a>
                @endif
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-assistance-content">
                    @include('Assistance::admin/assistance/assistance-content')
                    @if(is_default_lang())
                    <div class="form-group">
                        <label>{{__("Imagem de apresentação")}}</label>
                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                    </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="nav-assistance-location">
                    @include('Assistance::admin/assistance/assistance-location',["is_smart_search"=>"1"])
                    @include('Hotel::admin.hotel.surrounding')
                </div>
                @if(is_default_lang())
                <div class="tab-pane fade" id="nav-assistance-pricing">
                    <div class="panel">
                        <div class="panel-title"><strong>{{__('Estado padrão')}}</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="default_state" class="custom-select">
                                            <option value="">{{__('-- Selecione --')}}</option>
                                            <option value="1" @if(old('default_state',$row->default_state ?? 0) == 1) selected @endif>{{__("Sempre disponível")}}</option>
                                            <option value="0" @if(old('default_state',$row->default_state ?? 0) == 0) selected @endif>{{__("Disponível apenas em datas específicas")}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('Assistance::admin/assistance/assistance-pricing')
                </div>

                <div class="tab-pane fade" id="nav-assistance-availability">
                    @include('Assistance::admin/assistance/assistance-availability')
                </div>

                <div class="tab-pane fade" id="nav-assistance-attribute">
                    @include('Assistance::admin/assistance/assistance-attributes')
                </div>

                <div class="tab-pane fade" id="nav-assistance-ical">
                    @include('Assistance::admin/assistance/assistance-ical')
                </div>
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
<script type="text/javascript" src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/condition.js?_ver='.config('app.asset_version')) }}"></script>
{!! App\Helpers\MapEngine::scripts() !!}
<script>
    jQuery(function($) {
        new BravoMapEngine('map_content', {
            fitBounds: true,
            center: [{
                {
                    $row->map_lat ?? setting_item('map_lat_default')
                }
            }, {
                {
                    $row->map_lng ?? setting_item('map_lng_default')
                }
            }],
            zoom: {
                {
                    $row->map_zoom ?? "8"
                }
            },
            ready: function(engineMap) {
                @if($row->map_lat && $row->map_lng)
                engineMap.addMarker([{
                    {
                        $row->map_lat
                    }
                }, {
                    {
                        $row->map_lng
                    }
                }], {
                    icon_options: {}
                });
                @endif

                engineMap.on('click', function(dataLatLng) {
                    engineMap.clearMarkers();
                    engineMap.addMarker(dataLatLng, {
                        icon_options: {}
                    });
                    $("input[name=map_lat]").val(dataLatLng[0]);
                    $("input[name=map_lng]").val(dataLatLng[1]);
                });

                engineMap.on('zoom_changed', function(zoom) {
                    $("input[name=map_zoom]").val(zoom);
                });

                if (bookingCore.map_provider === "gmap") {
                    engineMap.searchBox($('#customPlaceAddress'), function(dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").val(dataLatLng[0]);
                        $("input[name=map_lng]").val(dataLatLng[1]);
                    });
                }

                engineMap.searchBox($('.bravo_searchbox'), function(dataLatLng) {
                    engineMap.clearMarkers();
                    engineMap.addMarker(dataLatLng, {
                        icon_options: {}
                    });
                    $("input[name=map_lat]").val(dataLatLng[0]);
                    $("input[name=map_lng]").val(dataLatLng[1]);
                });
            }
        });
    })
</script>
@endpush