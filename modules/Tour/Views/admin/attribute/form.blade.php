<div class="form-group">
    <label>{{__("Nome")}}</label>
    <input type="text" value="{{$translation->name}}" placeholder="{{__("Nome do Atributo")}}" name="name" class="form-control">
</div>
@if(is_default_lang())
    <div class="form-group">
        <label>{{__("Ordem da posição")}}</label>
        <input type="number" min="0" value="{{$row->position}}" placeholder="{{__("Ex: 1")}}" name="position" class="form-control">
        <small>
            {{ __("A posição será usada para ordenar na página de pesquisa de filtros. O número maior tem prioridade") }}
        </small>
    </div>
    <div class="form-group">
        <label>{{__('Ocultar no detalhe do serviço')}}</label>
        <br>
        <label>
            <input type="checkbox" name="hide_in_single" @if($row->hide_in_single) checked @endif value="1"> {{__("Enable hide")}}
        </label>
    </div>
    <div class="form-group">
        <label>{{__('Ocultar na pesquisa de filtro')}}</label>
        <br>
        <label>
            <input type="checkbox" name="hide_in_filter_search" @if($row->hide_in_filter_search) checked @endif value="1"> {{__("Enable hide")}}
        </label>
    </div>
@endif