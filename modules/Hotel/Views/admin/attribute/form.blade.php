<div class="form-group">
    <label>{{__("Nome")}}</label>
    <input type="text" value="{{$translation->name}}" placeholder="{{__("Nome do Atributo")}}" name="name" class="form-control">
</div>
@if(is_default_lang())
    <div class="form-group">
        <label>{{__("Ordem de posição")}}</label>
        <input type="number" min="0" value="{{$row->position}}" placeholder="{{__("Ex: 1")}}" name="position" class="form-control">
        <small>
            {{ __("A posição será usada para ordenar a pesquisa na página de filtros. O número maior indica a prioridade.") }}
        </small>
    </div>
    <div class="form-group">
        <label>{{__('Ocultar em detalhes o serviço')}}</label>
        <br>
        <label>
            <input type="checkbox" name="hide_in_single" @if($row->hide_in_single) checked @endif value="1"> {{__("Ativar ocultar")}}
        </label>
    </div>
    <div class="form-group">
        <label>{{__('Ocultar na pesquisa de filtro')}}</label>
        <br>
        <label>
            <input type="checkbox" name="hide_in_filter_search" @if($row->hide_in_filter_search) checked @endif value="1"> {{__("Ativar ocultar")}}
        </label>
    </div>
@endif