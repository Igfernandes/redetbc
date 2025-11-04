<div class="panel">
    <div class="panel-title"><strong>{{__("Conteúdo do serviço")}}</strong></div>
    <div class="panel-body">
        <div class="form-group magic-field" data-id="title" data-type="title">
            <label class="control-label">{{__("Título")}}</label>
            <input type="text" value="{{$translation->title}}" placeholder="{{__("Título")}}" name="title" class="form-control">
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
        <div class="form-group magic-field" data-id="content" data-type="content">
            <label class="control-label">{{__("Conteúdo")}}</label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" id="content" cols="30" rows="10">{{$translation->content}}</textarea>
            </div>
        </div>
        @if(is_default_lang())
        <div class="form-group">
            <label class="control-label">{{__("Youtube Video")}}</label>
            <input type="text" name="video" class="form-control" value="{{$row->video}}" placeholder="{{__("Youtube link video")}}">
        </div>
        @endif
        <div class="form-group-item">
            <label class="control-label">{{__('FAQs')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("Título")}}</div>
                    <div class="col-md-5">{{__('conteúdo')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($translation->faqs))
                @php if(!is_array($translation->faqs)) $translation->faqs = json_decode($translation->faqs); @endphp
                @foreach($translation->faqs as $key=>$faq)
                <div class="item" data-number="{{$key}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="faqs[{{$key}}][title]" class="form-control" value="{{$faq['title']}}" placeholder="{{__('Exemplo: Quando e onde termina a visita guiada?')}}">
                        </div>
                        <div class="col-md-6">
                            <textarea name="faqs[{{$key}}][content]" class="form-control" placeholder="...">{{$faq['content']}}</textarea>
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
                        <div class="col-md-5">
                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="{{__('Exemplo: Posso trazer meu animal de estimação?')}}">
                        </div>
                        <div class="col-md-6">
                            <textarea __name__="faqs[__number__][content]" class="form-control" placeholder=""></textarea>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(is_default_lang())
        <div class="form-group">
            <label class="control-label">{{__("Imagem do banner")}}</label>
            <div class="form-group-image">
                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Galeria")}}</label>
            {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
        </div>
        @endif
    </div>
</div>
<div class="panel">
    <div class="panel-title"><strong>{{__("Informações extras")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{__("Convidado")}}</label>
                    <input type="number" value="{{$row->max_guest}}" placeholder="{{__("Exemplo: 3")}}" name="max_guest" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{__("Cabine")}}</label>
                    <input type="text" value="{{$row->cabin}}" placeholder="{{__("Exemplo: 5")}}" name="cabin" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{__("Comprimento")}}</label>
                    <input type="number" value="{{$row->length}}" placeholder="{{__("Exemplo: 30m")}}" name="length" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{__("Velocidade")}}</label>
                    <input type="number" value="{{$row->speed}}" placeholder="{{__("Exemplo: 25km/h")}}" name="speed" class="form-control">
                </div>
            </div>
        </div>
        @endif
        <div class="form-group-item">
            <label class="control-label">{{__('Especificações')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("Título")}}</div>
                    <div class="col-md-5">{{__('Conteudo')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($translation->specs))
                @php if(!is_array($translation->specs)) $translation->faqs = json_decode($translation->specs); @endphp
                @foreach($translation->specs as $key=>$spec)
                <div class="item" data-number="{{$key}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="specs[{{$key}}][title]" class="form-control" value="{{$spec['title']}}" placeholder="{{__('Ex.: Alcance')}}">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="specs[{{$key}}][content]" class="form-control" value="{{$spec['content']}}" placeholder="{{__('Ex: 6000km')}}">
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
                        <div class="col-md-5">
                            <input type="text" __name__="specs[__number__][title]" class="form-control" placeholder="{{__('Ex.: Alcance')}}">
                        </div>
                        <div class="col-md-6">
                            <input type="text" __name__="specs[__number__][content]" class="form-control" value="" placeholder="{{__('Ex: 6000km')}}">
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{__("Política de Cancelamento")}}</label>
            <textarea name="cancel_policy" class="form-control" rows="5" placeholder="{{ __("Reembolso total até 4 dias antes do evento..") }}">{{$translation->cancel_policy}}</textarea>
        </div>
        <div class="form-group">
            <label>{{__("Termos e informações adicionais")}}</label>
            <textarea name="terms_information" class="d-none has-ckeditor" rows="10" placeholder="{{ __("Apenas para fins sanitários. Embora haja um banheiro e um chuveiro em funcionamento, desativamos o chuveiro e o vaso sanitário é de uso limitado (apenas urina... desculpe o detalhe gráfico!))...") }}">{{$translation->terms_information}}</textarea>
        </div>
        @include('Assistance::admin/assistance/include-exclude')
    </div>
</div>