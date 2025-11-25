<div class="item-list">
    <div class="row">
        <div class="col-md-3">
            @if($row->is_featured == "1")
                <div class="featured">
                    {{__("Apresentado")}}
                </div>
            @endif
            <div class="thumb-image">
                <a href="{{$row->getDetailUrl()}}" target="_blank">
                    @if($row->image_url)
                        <img src="{{$row->image_url}}" class="img-responsive" alt="">
                    @endif
                </a>
                <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                    <i class="fa fa-heart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="item-title">
                <a href="{{$row->getDetailUrl()}}" target="_blank">
                    {{$row->title}}
                </a>
            </div>
            <div class="location">
                @if(!empty($row->location->name))
                    <i class="icofont-paper-plane"></i>
                    {{__("Localização")}}: {{$row->location->name ?? ''}}
                @endif
            </div>
            <div class="location">
                <i class="icofont-money"></i>
                {{__("Preço por hora")}}: <span class="price">{{ format_money($row->price_per_hour) }}</span> -
                {{__("Preço por dia")}}: <span class="price">{{ format_money($row->price_per_day) }}</span>
            </div>
            <div class="location">
                <i class="icofont-ui-settings"></i>
                {{__("Status")}}: <span class="badge badge-{{ $row->status }}">{{ $row->status_text }}</span>
            </div>
            <div class="location">
                <i class="icofont-wall-clock"></i>
                {{__("Última atualização")}}: {{ display_datetime($row->updated_at ?? $row->created_at) }}
            </div>
            <div class="control-action">
                <a href="{{$row->getDetailUrl()}}" target="_blank" class="btn btn-info">{{__("Visualizar")}}</a>
                @if(!empty($recovery))
                    <a href="{{ route("assistance.vendor.restore",[$row->id]) }}" class="btn btn-recovery btn-primary" data-confirm="{{__("Você quer recuperar?")}}">{{__("Recuperação")}}</a>
                    @if(Auth::user()->hasPermission('assistance_delete'))
                        <a href="{{ route("assistance.vendor.delete",['id'=>$row->id,'permanently_delete'=>1]) }}" class="btn btn-danger" data-confirm="{{__("Você quer deletar permanentemente?")}}">{{__("Excluir")}}</a>
                    @endif
                @else
                    @if(Auth::user()->hasPermission('assistance_update'))
                        <a href="{{ route("assistance.vendor.edit",[$row->id]) }}" class="btn btn-warning">{{__("Editar")}}</a>
                    @endif
                    @if(Auth::user()->hasPermission('assistance_delete'))
                        <a href="{{ route("assistance.vendor.delete",[$row->id]) }}" class="btn btn-danger" data-confirm="{{__("Você quer deletar?")}}">{{__("Excluir")}}</a>
                    @endif
                    @if($row->status == 'publish')
                        <a href="{{ route("assistance.vendor.bulk_edit",[$row->id,'action' => "make-hide"]) }}" class="btn btn-secondary">{{__("Faça esconder")}}</a>
                    @endif
                    @if($row->status == 'draft')
                        <a href="{{ route("assistance.vendor.bulk_edit",[$row->id,'action' => "make-publish"]) }}" class="btn btn-success">{{__("Faça a publicação")}}</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>