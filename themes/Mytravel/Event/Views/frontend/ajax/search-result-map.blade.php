<div class="bravo-list-item @if(!$rows->count()) not-found @endif">
    @if($rows->count())
        <div class="text-paginate">
            <h2 class="text">
                @if($rows->total() > 1)
                    {{ __(":count eventos encontrados",['count'=>$rows->total()]) }}
                @else
                    {{ __(":count evento encontrado",['count'=>$rows->total()]) }}
                @endif
            </h2>
            <span class="count-string">{{ __("Mostrando :from - :to de :total Eventos",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
        </div>
        <div class="list-item">
            <div class="row">
                @foreach($rows as $row)
                    <div class="col-lg-4 col-md-6">
                        @include('Event::frontend.layouts.search.loop-grid')
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bravo-pagination">
            {{$rows->appends(array_merge(request()->query(),['_ajax'=>1]))->links()}}
        </div>
    @else
        <div class="not-found-box">
            <h3 class="n-title">{{__("Não conseguimos encontrar nenhum evento.")}}</h3>
            <p class="p-desc">{{__("Tente alterar seus critérios de filtro")}}</p>

        </div>
    @endif
</div>