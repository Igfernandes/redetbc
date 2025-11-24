@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Gerenciador de Quartos")}}</h1>
            <div class="title-actions">
                <a href="{{route('hotel.admin.room.availability.index',['hotel_id'=>$hotel->id])}}" class="btn btn-warning btn-xs"><i class="fa fa-calendar"></i> {{__("Disponibilidade de Quartos")}}</a>
                <a href="{{route('hotel.admin.edit',['id'=>$hotel->id])}}" class="btn btn-info btn-xs"><i class="fa fa-hand-o-right"></i> {{__("Voltar para o hotel")}}</a>
            </div>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-4">
                <form novalidate class="needs-validation" action="{{route('hotel.admin.room.store',['hotel_id'=>$hotel->id,'id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
                    <div class="panel">
                        <div class="panel-title"><strong>{{__("Adicionar Quarto")}}</strong></div>
                        <div class="panel-body">
                            @csrf
                            @include('Hotel::admin.room.form')
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> {{__("Adicionar Quarto")}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        @if(!empty($rows))
                            <form method="post" action="{{route('hotel.admin.room.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                                {{csrf_field()}}
                                <select name="action" class="form-control">
                                    <option value="">{{__(" Ações em Massa ")}}</option>
                                    <option value="publish">{{__(" Publicar ")}}</option>
                                    <option value="draft">{{__(" Mover para Lixeira ")}}</option>
                                    <option value="pending">{{__("Mover para Pendente")}}</option>
                                    {{--<option value="clone">{{__(" Duplicar ")}}</option>--}}
                                    <option value="delete">{{__("Excluir")}}</option>
                                </select>
                                <button data-confirm="{{__("Você quer apagar?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Aplicar')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-right">
                        <p><i>{{__('Encontrado :total itens',['total'=>$rows->total()])}}</i></p>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th width="45px"><input type="checkbox" class="check-all"></th>
                                        <th> {{ __('Nome do Quarto')}}</th>
                                        <th width="100px"> {{ __('Número')}}</th>
                                        <th width="100px"> {{ __('Preço')}}</th>
                                        <th width="100px"> {{ __('Status')}}</th>
                                        <th width="100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($rows->total() > 0)
                                        @foreach($rows as $row)
                                            <tr class="{{$row->status}}">
                                                <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                                </td>
                                                <td class="title">
                                                    <a href="{{route('hotel.admin.room.edit',['hotel_id'=>$hotel->id,'id'=>$row->id])}}">{{$row->title}}</a>
                                                </td>
                                                <td>{{$row->number}}</td>
                                                <td>{{format_money($row->price)}}</td>
                                                <td><span class="badge badge-{{ $row->status }}">{{ $row->status }}</span></td>
                                                <td>
                                                    <a href="{{route('hotel.admin.room.edit',['id'=>$row->id,'hotel_id'=>$hotel->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Editar')}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">{{__("Nenhum quarto encontrado")}}</td>
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
        </div>
    </div>
@endsection
