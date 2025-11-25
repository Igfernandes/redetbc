<input type="hidden" name="mytravel_save_extra" value="1">
<div class="form-group-item">
    <label class="control-label">{{__('Etiqueta')}}</label>
    <div class="g-items-header">
        <div class="row">
            <div class="col-md-5">{{__("Título")}}</div>
            <div class="col-md-5">{{__('Cor')}}</div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <div class="g-items">
        @if(!empty($translation->badge_tags))
            @foreach($translation->badge_tags as $key=>$item)
                <div class="item" data-number="{{$key}}">
                    <div class="row">
                        <div class="col-md-7">
                            <input type="text" name="badge_tags[{{$key}}][title]" class="form-control" value="{{$item['title']}}" placeholder="{{__('Ex: serviço VIP')}}">
                        </div>
                        <div class="col-md-4">
                            <select name="badge_tags[{{$key}}][color]" class="form-control">
                                <option @if($item['color'] == "brown") selected @endif value="brown">{{ __("Marrom") }}</option>
                                <option @if($item['color'] == "maroon") selected @endif value="maroon">{{ __("Bordô") }}</option>
                                <option @if($item['color'] == "green") selected @endif value="green">{{ __("Verde") }}</option>
                                <option @if($item['color'] == "danger") selected @endif value="danger">{{ __("Perigo") }}</option>
                                <option @if($item['color'] == "warning") selected @endif value="warning">{{ __("Aviso") }}</option>
                                <option @if($item['color'] == "info") selected @endif value="info">{{ __("Informação") }}</option>
                                <option @if($item['color'] == "success") selected @endif value="success">{{ __("Sucesso") }}</option>
                                <option @if($item['color'] == "dark") selected @endif value="dark">{{ __("Escuro") }}</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="text-right">
        <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Adicionar item')}}</span>
    </div>
    <div class="g-more hide">
        <div class="item" data-number="__number__">
            <div class="row">
                <div class="col-md-7">
                    <input type="text" __name__="badge_tags[__number__][title]" class="form-control" placeholder="{{__('Ex: Serviço VIP')}}">
                </div>
                <div class="col-md-4">
                    <select __name__="badge_tags[__number__][color]" class="form-control">
                        <option value="brown">{{ __("Marrom") }}</option>
                        <option value="maroon">{{ __("Bordô") }}</option>
                        <option value="green">{{ __("Verde") }}</option>
                        <option value="danger">{{ __("Perigo") }}</option>
                        <option value="warning">{{ __("Aviso") }}</option>
                        <option value="info">{{ __("Informação") }}</option>
                        <option value="success">{{ __("Sucesso") }}</option>
                        <option value="dark">{{ __("Escuro") }}</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>