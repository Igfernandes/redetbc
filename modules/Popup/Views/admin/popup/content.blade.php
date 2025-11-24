<div class="panel">
    <div class="panel-title"><strong>{{__("Conteúdo")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label>{{__("Título")}} <span class="text-danger">*</span></label>
            <input type="text" value="{{old('title',$translation->title)}}" required placeholder="{{__("Nome do Popup")}}" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Conteúdo")}}</label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{old('content',$translation->content)}}</textarea>
            </div>
        </div>
    </div>
</div>
