<div class="form-group">
    <label>{{__("Nome do Quarto")}} <span class="text-danger">*</span></label>
    <input type="text" required value="{!! clean($translation->title) !!}" placeholder="{{__("Nome do Quarto")}}" name="title" class="form-control">
</div>
<div class="form-group d-none">
    <label>{{__("Descrição do Quarto")}}</label>
    <textarea name="content" cols="30" rows="5" class="form-control">{{$translation->content}}</textarea>
</div>
@if(is_default_lang())
    <div class="form-group">
        <label >{{__('Imagem em destaque')}} </label>
        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
    </div>

    <div class="form-group">
        <label >{{__('Galeria')}}</label>
        {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
    </div>
    <hr>
@endif