@extends('layouts.user')
@section('content')
    <h2 class="title-bar">
        {{!empty($recovery) ?__('Recuperação de Hotéis') : __("Gerenciar Hotéis")}}
        @if(Auth::user()->hasPermission('hotel_create') && empty($recovery))
            <a href="{{ route("hotel.vendor.create") }}" class="btn-change-password">{{__("Adicionar Hotel")}}</a>
        @endif
    </h2>
    @include('admin.message')
    @if($rows->total() > 0)
        <div class="bravo-list-item">
            <div class="bravo-pagination">
                <span class="count-string">{{ __("Mostrando :from - :to de :total Hotéis",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
                {{$rows->appends(request()->query())->links()}}
            </div>
            <div class="list-item">
                <div class="row">
                    @foreach($rows as $row)
                        <div class="col-md-12">
                            @include('Hotel::frontend.vendorHotel.loop-list')
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bravo-pagination">
                <span class="count-string">{{ __("Mostrando :from - :to de :total Hotéis",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    @else
        {{__("Nenhum Hotel")}}
    @endif
@endsection