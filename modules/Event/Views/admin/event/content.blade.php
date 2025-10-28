<div class="panel">
    <div class="panel-title"><strong>{{__("Conteúdo do Evento")}}</strong></div>
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
            <label class="control-label">{{__("Vídeo do YouTube")}}</label>
            <input type="text" name="video" class="form-control" value="{{$row->video}}" placeholder="{{__("Link de vídeo do Youtube")}}">
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">{{__("Hora de início")}}</label>
                    <input type="text" name="start_time" class="form-control" value="{{$row->start_time}}" placeholder="{{__("Ex: 15:00")}}">
                    <small>
                        {{ __("Formato de entrada de tempo, ex: 15:00") }}
                    </small>
                </div>
            </div>
            <div class="col-lg-6 @if( $row->getBookingType()== " ticket") d-none @endif">
                <div class="form-group">
                    <label class="control-label">{{__("Hora de término")}}</label>
                    <input type="text" name="end_time" class="form-control" value="{{$row->end_time}}" placeholder="{{__("Ex: 21:00")}}">
                    <small>
                        {{ __("Formato de entrada de hora, ex: 21:00") }}
                    </small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    @if( $row->getBookingType()== "ticket")
                    <label class="control-label">{{__("Duração (hora)")}}</label>
                    @else
                    <label class="control-label">{{__("Duração")}}</label>
                    @endif
                    <input type="number" name="duration" class="form-control" value="{{$row->duration}}" placeholder="{{__("Ex: 3")}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group @if( $row->getBookingType()== " ticket") d-none @endif">
                    <label class="control-label">{{__("Unidade de duração")}}</label>
                    <select name="duration_unit" class="form-control">
                        <option value="hour" @if($row->duration_unit == "hour") selected @endif > {{__("Hora")}}</option>
                        <option value="minute" @if($row->duration_unit == "minute") selected @endif > {{__("Minuto")}}</option>
                    </select>
                </div>
            </div>
        </div>
        @endif
        <div class="form-group-item">
            <label class="control-label">{{__('FAQs')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("Título")}}</div>
                    <div class="col-md-5">{{__('Conteúdo')}}</div>
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
                            <input type="text" name="faqs[{{$key}}][title]" class="form-control" value="{{$faq['title']}}" placeholder="{{__('Por exemplo: Quando e onde termina o passeio?')}}">
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
                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="{{__('Ex: Posso levar meu animal de estimação?')}}">
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