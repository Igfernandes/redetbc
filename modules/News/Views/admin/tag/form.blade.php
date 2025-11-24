<div class="form-group">
    <label>{{ __('Nome')}}</label>
    <input type="text" value="{{$translation->name}}" placeholder=" {{ __('Nome da tag')}}" name="name" class="form-control">
</div>
@if(is_default_lang())
<div class="form-group">
    <label>{{ __('Slug')}}</label>
    <input type="text" value="{{$row->slug}}" placeholder=" {{ __('Slug da tag')}}" name="slug" class="form-control">
</div>
@endif
{{--<div class="form-group">--}}
    {{--<label class="control-label">{{ __('Descrição')}}</label>--}}
    {{--<textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>--}}
{{--</div>--}}