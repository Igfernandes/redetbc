<div class="form-group">
    <div class="row align-items-center">

        <label class="col-md-4 col-form-label" style="word-break: break-all;">{{$field['name_'.app()->getLocale()] ?? $field['name'] ?? $field['id']}}

            @if(!empty($field['required']))
            <span class="text-danger">*</span>
            @endif
            :
        </label>
        <div class="col-md-{{$value_col_size ?? 4}} btn-upload-private-wrap">
            <div class="private-file-lists mb-2">
                @php ($old = json_decode($field['data'],true))
                @if(!empty($old))
                <input type="hidden" accept=".png,.jpg,.jpge" name="verify_data_{{$field['id']}}" value="{{($field['data'])}}">
                <a target="_blank" href="{{route('media.private.view',['path'=>$old['path'] ?? '','v'=>uniqid()])}}" class="file-item">{{__("Visualizar documento")}} &nbsp;&nbsp;<i class="fa fa-download"></i></a>

                @endif
            </div>
            @if(empty($only_show_data))
            <div class="file-group">
                <div class="not_loading">
                    <span class="btn btn-primary btn-sm "><i class="fa fa-upload"></i>&nbsp;&nbsp; {{__('Selecione o arquivo')}}
                        <input class="btn-upload-private-file" data-name="verify_data_{{$field['id']}}" data-multiple="" type="file">
                    </span>
                </div>
                <div class="is_loading">
                    <span class="btn btn-primary btn-sm px-4">
                        <i class="fa fa-spinner fa-spin"></i> {{__('Carregando...')}}
                    </span>
                </div>
            </div>
            @else
            @if(empty($field['data']))
            <div><strong>{{__('N/A')}}</strong></div>
            @endif
            @if(!empty($field['is_verified']))
            <span class="badge badge-success"><i>{{__("Verificado")}}</i></span>
            @else
            <span class="badge badge-secondary"><i>{{__("Não verificado")}}</i></span>
            @endif
            @endif
        </div>
    </div>
</div>