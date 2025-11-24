@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{!empty($recovery) ? __('Recuperação') : __("Todos os Eventos")}}</h1>
            <div class="title-actions">
                @if(empty($recovery))
                <a href="{{route('event.admin.create')}}" class="btn btn-primary">{{__("Adicionar novo evento")}}</a>
                @endif
            </div>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                    <form method="post" action="{{route('event.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__("Ações em Massa")}}</option>

                            @if(!empty($recovery))
                                <option value="recovery">{{__("Restaurar")}}</option>
                                <option value="permanently_delete">{{__("Excluir permanentemente")}}</option>
                            @else
                                <option value="publish">{{__("Publicar")}}</option>
                                <option value="draft">{{__("Mover para Lixeira")}}</option>
                                <option value="pending">{{__("Mover para Pendente")}}</option>
                                <option value="clone">{{__("Clonar")}}</option>
                                <option value="delete">{{__("Excluir")}}</option>
                            @endif
                        </select>
                        <button data-confirm="{{__('Você quer apagar?')}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Aplicar')}}</button>
                    </form>
                @endif
            </div>

            <div class="col-left dropdown">
                <form method="get" action="{{ !empty($recovery) ? route('event.admin.recovery') : route('event.admin.index')}}" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    @if(!empty($rows) and $event_manage_others)
                        <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Pesquisar por nome')}}" class="form-control">
                        <div class="ml-3 position-relative">
                            <button class="btn btn-secondary dropdown-toggle bc-dropdown-toggle-filter" type="button" id="dropdown_filters">
                                {{ __("Avançado") }}
                            </button>
                            <div class="dropdown-menu px-3 py-3 dropdown-menu-right" aria-labelledby="dropdown_filters">
                                @include("Core::admin.global.advanced-filter")
                            </div>
                        </div>
                    @endif
                    <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Procurar')}}</button>
                </form>
            </div>
        </div>

        <div class="text-right">
            <p><i>{{__('Encontrados :total itens',['total'=>$rows->total()])}}</i></p>
        </div>

        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="60px"><input type="checkbox" class="check-all"></th>
                            <th>{{ __('Nome')}}</th>
                            <th width="200px">{{ __('Localização')}}</th>
                            <th width="130px">{{ __('Autor')}}</th>
                            <th width="100px">{{ __('Status')}}</th>
                            <th width="100px">{{ __('Avaliações')}}</th>
                            <th width="100px">{{ __('Data')}}</th>
                            <th width="100px"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($rows->total() > 0)
                            @foreach($rows as $row)
                                <tr class="{{$row->status}}">
                                    <td>
                                        <input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                    </td>
                                    <td class="title">
                                        @if($row->is_featured)
                                            <span class="badge badge-primary">{{ __("Destaque") }}</span>
                                        @endif
                                        <a href="{{route('event.admin.edit',['id'=>$row->id])}}">{{$row->title}}</a>
                                    </td>
                                    <td>{{$row->location->name ?? ''}}</td>
                                    <td>
                                        @if(!empty($row->author))
                                            {{$row->author->getDisplayName()}}
                                        @else
                                            {{__("[Autor Excluído]")}}
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                    </td>

                                    <td>
                                        <a target="_blank" href="{{ route('review.admin.index',['service_id'=>$row->id]) }}" class="review-count-approved">
                                            {{ $row->getNumberReviewsInService() }}
                                        </a>
                                    </td>

                                    <td>{{ display_date($row->updated_at)}}</td>

                                    <td>
                                        @if(empty($recovery))
                                            <a href="{{route('event.admin.edit',['id'=>$row->id])}}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i> {{__('Editar')}}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">{{__("Nenhum evento encontrado")}}</td>
                            </tr>
                        @endif
                        </tbody>

                    </table>
                    </div>
                </form>

                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
