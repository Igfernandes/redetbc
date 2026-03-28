<div class="form-group magic-field" data-id="title" data-type="title">
    <label class="control-label">{{ __('Título')}}</label>
    <input type="text" value="{{ $translation->title ?? 'New Post' }}" placeholder="News title" name="title" class="form-control">
</div>
<div class="form-group">
    <label class="control-label">{{__("Religião Alvo")}}</label>
    <select name="religion" class="form-control">
        <option value="">Selecione a religião</option>
        <option value="CATHOLIC" @if($row->religion == "CATHOLIC") selected @endif > {{__("Evangélico")}}</option>
        <option value="EVANGELICAL" @if($row->religion == "EVANGELICAL") selected @endif > {{__("Católico")}}</option>
        <option value="BOTH" @if($row->religion == "BOTH") selected @endif > {{__("Ambos")}}</option>
    </select>
</div>
<div class="form-group magic-field" data-id="content" data-type="content" data-editor="1">
    <label class="control-label">{{ __('Conteúdo')}} </label>
    <div class="">
        <textarea name="content" class="d-none has-ckeditor" id="content" cols="30" rows="10">{{$translation->content}}</textarea>
    </div>
</div>