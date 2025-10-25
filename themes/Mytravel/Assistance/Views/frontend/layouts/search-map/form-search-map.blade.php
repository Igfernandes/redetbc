<form action="{{url( app_get_locale(false,false,'/').config('assistance.assistance_route_prefix') )}}" class="form bravo_form d-flex justify-content-start" method="get" onsubmit="return false;">
    <input type="hidden" name="_layout" value="{{$layout ?? ''}}">
    @php $assistance_map_search_fields = setting_item_array('assistance_map_search_fields');

    $assistance_map_search_fields = array_values(\Illuminate\Support\Arr::sort($assistance_map_search_fields, function ($value) {
        return $value['position'] ?? 0;
    }));

    @endphp
    @if(!empty($assistance_map_search_fields))
        @foreach($assistance_map_search_fields as $field)
            @switch($field['field'])
                @case ('location')
                    @include('Assistance::frontend.layouts.search-map.fields.location')
                @break
                @case ('attr')
                    @include('Assistance::frontend.layouts.search-map.fields.attr')
                @break
                @case ('date')
                    @include('Assistance::frontend.layouts.search-map.fields.date')
                @break
                @case ('price')
                    @include('Assistance::frontend.layouts.search-map.fields.price')
                @break
                @case ('advance')
                    <div class="filter-item filter-simple advance-filters">
                        <div class="form-group">
                            <span class="filter-title toggle-advance-filter" data-target="#advance_filters">{{__('More filters')}} <i class="fa fa-angle-down"></i></span>
                        </div>
                    </div>
                @break

            @endswitch
        @endforeach
    @endif



</form>
