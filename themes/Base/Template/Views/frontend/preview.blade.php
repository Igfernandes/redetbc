@extends('Layout::app')
@section('content')
    <div class="page-template-content">
        <div id="live-preview" v-cloak>
            <live-preview-item
                :items="items"
                id="ROOT"
                v-if="items.ROOT"
                :selected-block-id="selectedBlockId"
            ></live-preview-item>
            <div class="no-items-box" v-if="items.ROOT.nodes.length == 0">
                <div class="icon-wrap">
                    <i class="icon fa fa-magic fa-5x"></i>
                </div>
                <div>
                    <h3>{{__("Não há nenhuma camada ainda!")}}</h3>
                    <p>{{__("Clique no botão abaixo para começar a adicionar uma camada")}}</p>
                </div>
                <div>
                    <button class="btn btn-success " @click="showAddLayer">{{__("Adicionar camada")}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link
        rel="stylesheet"
        href="{{asset('dist/frontend/module/template/preview/css/live-preview.css?_v='.config('app.asset_version'))}}"
    />
@endpush
@push('js')
    <script>
        var current_template_items = {!! json_encode($translation->content_live_json) !!};
        var template_id = {{$row->id ?? 0}};
        var current_menu_lang = '{{request()->query('lang',app()->getLocale())}}';
        var preview_routes = {
            preview: '{{route('template.admin.live.preview')}}'
        }
    </script>
    <script
        src="{{asset('dist/frontend/module/template/preview/js/preview.js?_v='.config('app.asset_version'))}}"></script>
@endpush