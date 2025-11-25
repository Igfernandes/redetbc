<div class="bravo-list-item @if(!$rows->count()) not-found @endif">
    @if($rows->count())
        <div class="text-paginate">
            <h2 class="text">
                @if($rows->total() > 1)
                    {{ __(":count hotéis encontrados",['count'=>$rows->total()]) }}
                @else
                    {{ __(":count hotel encontrado",['count'=>$rows->total()]) }}
                @endif
            </h2>
            <span class="count-string">{{ __("Mostrando :from - :to de :total Hotéis",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
        </div>
        <div class="list-item">
            <div class="row">
                @foreach($rows as $row)
                    <div class="col-lg-4 col-md-6">
                        @include('Hotel::frontend.layouts.search.loop-grid')
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bravo-pagination">
            {{$rows->appends(request()->except(['_ajax']))->links()}}
        </div>
    @else
        <div class="not-found-box">
            <h3 class="n-title">{{__("Não conseguimos encontrar nenhum hotel.")}}</h3>
            <p class="p-desc">{{__("Tente mudar seus critérios de filtro")}}</p>

        </div>
    @endif
</div>