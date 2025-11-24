@if(is_default_lang())
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Preço")}} <span class="text-danger">*</span></label>
                <input type="number" required value="{{$row->price}}" min="1" placeholder="{{__("Preço")}}" name="price" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Número do Quarto")}} <span class="text-danger">*</span></label>
                <input type="number" required value="{{$row->number ?? 1}}" min="1" max="100" placeholder="{{__("Number")}}" name="number" class="form-control">
            </div>
        </div>
    </div>
    <hr>
    @if(is_default_lang())
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="control-label">{{__("Requisitos de estadia mínima de um dia")}}</label>
                    <input type="number" name="min_day_stays" class="form-control" value="{{$row->min_day_stays}}" placeholder="{{__("Ex: 2")}}">
                    <i>{{ __("Deixe em branco se você não precisa definir a opção de estadia mínima") }}</i>
                </div>
            </div>
        </div>
        <hr>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Número de camas")}} </label>
                <input type="number"  value="{{$row->beds ?? 1}}" min="1" max="10" placeholder="{{__("Number")}}" name="beds" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Tamanho do Quarto")}} </label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="size" value="{{$row->size ?? 0}}" placeholder="{{__("Room size")}}" >
                    <div class="input-group-append">
                        <span class="input-group-text" >{!! size_unit_format() !!}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Maximo de Adultos")}} </label>
                <input type="number" min="1"  value="{{$row->adults ?? 1}}"  name="adults" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Maximo de Crianças")}} </label>
                <input type="number" min="0"  value="{{$row->children ?? 0}}"  name="children" class="form-control">
            </div>
        </div>
    </div>
    <hr>
@endif