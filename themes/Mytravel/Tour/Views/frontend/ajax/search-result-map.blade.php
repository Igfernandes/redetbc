<div class="bravo-list-item @if(!$rows->count()) not-found @endif">
    @if($rows->count())
        <div class="text-paginate">
            <h2 class="text">
                @if($rows->total() > 1)
                    {{ __(":count de Passeios encontrados",['count'=>$rows->total()]) }}
                @else
                    {{ __(":count de Passeio encontrado",['count'=>$rows->total()]) }}
                @endif
            </h2>
            <span class="count-string">{{ __("Mostrando :from - :to de :total Passeios",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
        </div>
        <div class="list-item">
            <div class="row">
                @foreach($rows as $row)
                    <div class="col-md-6 col-xl-4 mb-3 mb-md-4 pb-1">
                        @include('Tour::frontend.layouts.search.loop-grid')
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bravo-pagination">
            {{$rows->appends(array_merge(request()->query(),['_ajax'=>1]))->links()}}
        </div>
    @else
        <div class="not-found-box">
            <h3 class="n-title">{{__("Não conseguimos encontrar nenhuma excursão.")}}</h3>
            <p class="p-desc">{{__("Tente alterar seus critérios de filtro.")}}</p>
        </div>
    @endif
</div>
