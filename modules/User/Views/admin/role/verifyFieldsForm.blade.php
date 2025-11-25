@if(empty($row['id']))
<div class="form-group">
    <label>{{__("ID do Campo")}} <span class="text-danger">*</span></label>
    <input type="text" value="{{$row['id'] ?? ''}}" placeholder="{{__("ID do Campo")}}" name="id" class="form-control" required>
    <i>{{__('Deve ser único. Aceita apenas letras, números, traço e sublinhado, sem espaço')}}</i>
    <div class="invalid-feedback">
        {{__('Por favor, insira o ID do campo e certifique-se de que é único')}}
    </div>
</div>
@else
    <input type="hidden" name="id" value="{{$row['id']}}">
@endif
@php  $languages = \Modules\Language\Models\Language::getActive(); @endphp
<div class="form-group form-group-item">
    <label>{{__("Nome do Campo")}} <span class="text-danger">*</span></label>
    <div class="border p-2 rounded">
        @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
            @foreach($languages as $language)
                @php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""  @endphp
                <div class="g-lang">
                    <div class="title-lang">{{$language->name}}</div>
                    <input type="text" value="{{$row['name'.$key_lang] ?? ''}}" placeholder="" name="name{{$key_lang}}" class="form-control" required>
                </div>
            @endforeach
        @else
            <input type="text" value="{{$row['name'] ?? ''}}" placeholder="" name="name" class="form-control" required>
        @endif
    </div>
    <div class="invalid-feedback">
        {{__('Por favor, insira o nome do campo')}}
    </div>
</div>
<div class="form-group">
    <label>{{__("Tipo")}} <span class="text-danger">*</span></label>
    <select class="custom-select" name="type" required>
        <option value="text">{{__("Texto")}}</option>
        <option {{($row['type'] ?? '') == 'phone' ? 'selected':''}} value="phone">{{__("Celular")}}</option>
        <option {{($row['type'] ?? '') == 'number' ? 'selected':''}} value="number">{{__("Número")}}</option>
        <option {{($row['type'] ?? '') == 'file' ? 'selected':''}} value="file">{{__("Anexo de arquivo")}}</option>
        <option {{($row['type'] ?? '') == 'multi_files' ? 'selected':''}} value="multi_files">{{__("Anexos múltiplos de arquivos")}}</option>
    </select>
    <div class="invalid-feedback">
        {{__('Por favor, insira o tipo de campo')}}
    </div>
</div>
<div class="form-group">
    <label>{{__("Para Funções?")}} <span class="text-danger">*</span></label>
    <div class=" terms-scrollable">
        @foreach($roles as $role)
            <div>
                <label >
                     <input type="checkbox" name="roles[]" value="{{$role->id}}" @if(!empty($row['roles'] ?? []) and in_array($role->id,$row['roles'] ?? [])) checked @endif />{{ucfirst($role->name)}}
                </label>
            </div>
        @endforeach
    </div>
    <div class="invalid-feedback">
        {{__('Porfavor selecione pelo menos uma função')}}
    </div>
</div>
<div class="form-group">
    <label>{{__("É Obrigatório?")}}</label>
    <select class="custom-select" name="required">
        <option value="">{{__("Não")}}</option>
        <option {{($row['required'] ?? '') == 1 ? 'selected':''}} value="1">{{__("Sim")}}</option>
    </select>
</div>
<div class="form-group">
    <label>{{__("Ordem")}}</label>
    <input type="text" value="{{$row['order'] ?? 0}}" placeholder="" name="order" class="form-control">
</div>
<div class="form-group">
    <label>{{__("Código do Ícone")}}</label>
    <input type="text" value="{{$row['icon'] ?? ''}}" placeholder="{{__("Ex: fa fa-phone")}}" name="icon" class="form-control">
</div>