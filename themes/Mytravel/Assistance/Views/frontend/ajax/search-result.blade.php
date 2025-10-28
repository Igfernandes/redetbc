<div class="list-item">
    <div class="row">
        @if($rows->total() > 0)
            @foreach($rows as $row)
                <div class="col-lg-4 col-md-6">
                    @include('Assistance::frontend.layouts.search.loop-grid')
                </div>
            @endforeach
        @else
            <div class="col-lg-12">
                {{__("Service not found")}}
            </div>
        @endif
    </div>
</div>
<div class="bravo-pagination">
    @if($rows->total() > 0)
        <div class="text-center text-md-left font-size-14 mb-3 text-lh-1">{{ __("Mostrando :from - :to of :total services",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</div>
    @endif
    {{$rows->appends(request()->query())->links()}}
</div>
