<div class="form-group">
    <div class="row align-items-center">
        <label class="col-md-3 text-right col-form-label">
            {{$field['name_'.app()->getLocale()] ?? $field['name'] ?? $field['id']}}
            @if(!empty($field['required']))
            <span class="text-danger">*</span>
            @endif
            :
        </label>
        <div class="col-md-{{$value_col_size ?? 4}}">
            @if(empty($only_show_data))
            <select class="form-control" name="verify_data_{{$field['id']}}">
                @foreach($field['options'] ?? [] as $optionValue => $optionLabel)
                <option value="{{$optionValue}}"
                    {{$field['data'] == $optionValue ? 'selected' : ''}}>
                    {{$optionLabel}}
                </option>
                @endforeach
            </select>
            @else
            <div>
                <strong>
                    {{$field['options'][$field['data']] ?? $field['data'] ?? __('N/A')}}
                </strong>
            </div>
            @if(!empty($field['is_verified']))
            <a class="badge badge-success" href="#" onclick="return false"><i>{{__("Verificado")}}</i></a>
            @else
            <span class="badge badge-secondary"><i>{{__("Não verificado")}}</i></span>
            @endif
            @endif
        </div>
    </div>
</div>