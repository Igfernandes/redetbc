<?php
if(is_default_lang()){
    $meta_seo = $row->getSeoMeta();
}else{
    $meta_seo = $translation->getSeoMeta(request()->query('lang'));
}
$seo_share = $meta_seo['seo_share'] ?? false;
$desc = $meta_seo['seo_desc'] ?? $meta_seo['service_desc'] ?? '';
?>
<div class="panel">
    <div class="panel-title d-flex justify-content-between align-items-center py-2"><strong>{{__("Mecanismo de busca")}}</strong>
        <a href="#" data-toggle="modal" data-target="#seo_config" class="btn btn-sm btn-link">{{__("Editarar")}}</a>
    </div>
    <div class="panel-body">
        <div class="seo-preview max-w-650">
            <div class="d-flex align-items-center mb-2">
                <div class="seo-favicon w-28 h-28 mr-2 d-flex align-items-center justify-content-center">
                    @php
                        $favicon = setting_item('site_favicon');
                    @endphp
                    @if($favicon)
                        @php
                            $file = (new \Modules\Media\Models\MediaFile())->findById($favicon);
                        @endphp
                        @if(!empty($file))
                            <img rel="icon" class="w-18 h-18" type="{{$file['file_type']}}" src="{{asset('uploads/'.$file['file_path'])}}" />
                        @else
                            :
                            <img rel="icon" class="w-18 h-18" type="image/png" src="{{url('images/favicon.png')}}" />
                        @endif
                    @endif
                </div>
                <div>
                    <div class="seo-site-name text-14">{{setting_item_with_lang('site_title',request('lang'))}}</div>
                    <div class="seo-url text-12">{{$meta_seo['full_url'] ?? url('/')}}</div>
                </div>
            </div>
            <div>
                <div class="seo-title text-20 mb-2">
                    <span class="val">{{$meta_seo['seo_title'] ?? $row->title ?? $row->name}}</span>
                </div>
                <div class="seo-desc text-14">{{$desc}}</div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="seo_config">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__("Mecanismo de pesquisa")}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if(!is_default_lang()) d-none @endif ">
                            <label class="control-label">
                                {{__("Permitir que mecanismos de busca mostrem este serviço nos resultados de pesquisa?")}}
                            </label>
                            <select name="seo_index" class="form-control">
                                <option
                                    value="1"
                                    @if(isset($meta_seo['seo_index']) and $meta_seo['seo_index'] == 1) selected @endif>{{__("Sim")}}</option>
                                <option
                                    value="0" @if(isset($meta_seo['seo_index']) and $meta_seo['seo_index'] == 0) selected @endif>{{__("Não")}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs mb-2" data-condition="seo_index:is(1)">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#seo_1">{{__("Opções Gerais")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#seo_2">{{__("Compartilhar Facebook")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#seo_3">{{__("Compartilhar Twitter")}}</a>
                    </li>
                </ul>
                <div class="tab-content" data-condition="seo_index:is(1)">
                    <div class="tab-pane active" id="seo_1">
                        <div class="form-group">
                            <label class="control-label">{{__("Título SEO")}}</label>
                            <input
                                type="text"
                                name="seo_title"
                                class="form-control"
                                placeholder="{{ $row->title ?? $row->name ?? __("Deixe em branco para usar o título do serviço")}}"
                                value="{{ $meta_seo['seo_title'] ?? ""}}"
                            >
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{__("Descrição de SEO")}}</label>
                            <textarea
                                name="seo_desc" rows="3" class="form-control" placeholder="{{$desc ?? __("Insira a descrição...")}}"
                            >{{$meta_seo['seo_desc'] ?? ""}}</textarea>
                        </div>
                        @if(is_default_lang())
                            <div class="form-group form-group-image">
                                <label class="control-label">{{__("Imagem em destaque")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('seo_image', $meta_seo['seo_image'] ?? "" ) !!}
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane" id="seo_2">
                        <div class="form-group">
                            <label class="control-label">{{__("Título do Facebook")}}</label>
                            <input
                                type="text"
                                name="seo_share[facebook][title]"
                                class="form-control"
                                placeholder="{{ $row->title ?? $row->name ?? __("Insira o título...")}}"
                                value="{{$seo_share['facebook']['title'] ?? "" }}"
                            >
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{__("Descrição do Facebook")}}</label>
                            <textarea
                                name="seo_share[facebook][desc]"
                                rows="3"
                                class="form-control"
                                placeholder="{{$row->short_desc ?? __("Insira a descrição...")}}"
                            >{{$seo_share['facebook']['desc'] ?? "" }}</textarea>
                        </div>
                        @if(is_default_lang())
                            <div class="form-group form-group-image">
                                <label class="control-label">{{__("Imagem do Facebook")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('seo_share[facebook][image]',$seo_share['facebook']['image'] ?? "" ) !!}
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane" id="seo_3">
                        <div class="form-group">
                            <label class="control-label">{{__("Título do Twitter")}}</label>
                            <input
                                type="text"
                                name="seo_share[twitter][title]"
                                class="form-control"
                                placeholder="{{ $row->title ?? $row->name ?? __("Enter title...")}}"
                                value="{{$seo_share['twitter']['title'] ?? "" }}"
                            >
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{__("Descrição do Twitter")}}</label>
                            <textarea
                                name="seo_share[twitter][desc]"
                                rows="3"
                                class="form-control"
                                placeholder="{{$row->short_desc ?? __("Insira a descrição...")}}"
                            >{{$seo_share['twitter']['desc'] ?? "" }}</textarea>
                        </div>
                        @if(is_default_lang())
                            <div class="form-group form-group-image">
                                <label class="control-label">{{__("Imagem do Twitter")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('seo_share[twitter][image]', $seo_share['twitter']['image'] ?? "" ) !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">{{__("Aplicar")}}</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $('#seo_config').on('hide.bs.modal', function() {
            const form = $(this);
            const preview = $('.seo-preview');
            const title = form.find('[name=seo_desc]').val();
            if (title) {
                preview.find('.seo-title .val').html(title);
            }
            const desc = form.find('[name=seo_desc]').val();
            if (desc) {
                preview.find('.seo-desc').html(desc);
            }
        });
    </script>

@endpush
