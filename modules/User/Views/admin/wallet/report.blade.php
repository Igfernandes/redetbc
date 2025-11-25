@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('Relatório de Compra de Crédito')}}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between">
            <div class="col-left">
                @if(!empty($rows))
                    <form method="post" action="{{route('user.admin.wallet.reportBulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__("Ações em Massa")}}</option>
                            <option value="completed">{{__("Marcar como concluído")}}</option>
                        </select>
                        <button data-confirm="{{__("Você quer apagar?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Aplicar')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">
                <form method="get" action="" class="filter-form filter-form-right d-flex justify-content-end">
                    <select name="status" class="form-control">
                        <option value="">{{__("-- Status --")}}</option>
                        <option @if(request()->query('status') == 'fail') selected @endif value="fail">{{__("Falhou")}}</option>
                        <option @if(request()->query('status') == 'processing') selected @endif value="processing">{{__("Processando")}}</option>
                        <option @if(request()->query('status') == 'completed') selected @endif value="completed">{{__("Concluído")}}</option>
                    </select>
                    @csrf
                        <?php
                        $user = !empty(Request()->user_id) ? App\User::find(Request()->user_id) : false;
                        \App\Helpers\AdminForm::select2('user_id', [
                            'configs' => [
                                'ajax'        => [
                                    'url'      => route('user.admin.getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'allowClear'  => true,
                                'placeholder' => __('-- Usuário --')
                            ]
                        ], !empty($user->id) ? [
                            $user->id,
                            $user->name_or_email . ' (#' . $user->id . ')'
                        ] : false)
                        ?>
                    <button class="btn-info btn btn-icon" type="submit">{{__('Filtrar')}}</button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i>{{__('Encontrado :total itens',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="panel booking-history-manager">
            <div class="panel-title">{{__('Registros de compra')}}</div>
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <table class="table table-hover bravo-list-item">
                        <thead>
                        <tr>
                            <th width="80px"><input type="checkbox" class="check-all"></th>
                            <th>{{__('Cliente')}}</th>

                            <th width="80px">{{__('Quantia')}}</th>
                            <th width="80px">{{__('Crédito')}}</th>
                            <th width="80px">{{__('Status')}}</th>
                            <th width="150px">{{__('Método de Pagamento')}}</th>
                            <th width="120px">{{__('Criado em')}}</th>
                            <th width="80px">{{__('Ações')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                <td><input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}">
                                    #{{$row->id}}</td>
                                <td>
                                    @if($row->user)
                                        <a href="">{{$row->user->display_name}}</a>
                                    @endif
                                </td>
                                <td>{{format_money_main($row->amount)}}</td>
                                <td>{{$row->getMeta('credit')}}</td>
                                <td>
                                    <span class="label label-{{$row->status}}">{{$row->statusName}}</span>
                                </td>
                                <td>
                                    {{$row->gatewayObj ? $row->gatewayObj->getDisplayName() : ''}}
                                </td>
                                <td>{{display_datetime($row->updated_at)}}</td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            {{$rows->links()}}
        </div>
    </div>
@endsection