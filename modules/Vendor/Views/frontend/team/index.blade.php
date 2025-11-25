@extends('layouts.user')

@section('content')

    <h2 class="title-bar">
        {{__("Equipes de Fornecedores")}}
    </h2>
    @include('admin.message')

    <p>{{__('Como autor, você pode adicionar outros usuários à sua equipe. As pessoas em sua equipe poderão gerenciar seus serviços.')}}</p>
    <hr>
    <form method="post" action="{{route('vendor.team.add')}}">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <label class="font-weight-bold">{{__("Adicionar alguém à sua equipe:")}}</label>
                <input type="email" value="{{old('email')}}" name="email" required class="form-control" placeholder="{{__("E-mail")}}" aria-label="{{__("E-mail")}}" aria-describedby="button-addon2">
            </div>
            <div class="col-md-3">
                <label class="font-weight-bold">{{__("Permissões")}}</label>
                @foreach(get_bookable_services() as $service_id=>$service)
                    <div><label ><input @if(in_array($service_id,old('permissions',[]))) checked @endif type="checkbox" name="permissions[]" value="{{$service_id}}">{{$service::getModelName()}}</label></div>
                @endforeach
            </div>
        </div>
        <button class="btn btn-success"><i class="fa fa-plus"></i> {{__("Adicionar")}}</button>
    </form>

    <hr>
    <h4>{{__("Usuários na sua equipe")}}</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-booking-history">
            <thead>
            <tr>
                <th width="2%">{{__("#")}}</th>
                <th>{{__("Nome de Exibição")}}</th>
                <th>{{__("Email")}}</th>
                <th>{{__("Permissões")}}</th>
                <th>{{__("Status")}}</th>
                <th>{{__("Ações")}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $vendorTeam)
                <tr>
                    <td>#{{$vendorTeam->member->id ?? ''}}</td>
                    <th>{{$vendorTeam->member->display_name ?? ''}}</th>
                    <td>
                        {{$vendorTeam->member->email?? ''}}
                    </td>
                    <td>{{implode(', ',$vendorTeam->permissions)}}</td>
                    <td><span class="badge badge-{{$vendorTeam->status_badge}}">{{$vendorTeam->status_text}}</span></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                {{__("Ações")}}
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('vendor.team.edit',['vendorTeam'=>$vendorTeam])}}">{{__("Editar")}}</a>
                                @if($vendorTeam->status == Modules\Vendor\Models\VendorTeam::STATUS_PENDING)
                                    <a class="dropdown-item" href="{{route('vendor.team.re-send-request',['vendorTeam'=>$vendorTeam])}}">{{__("Enviar e-mail")}}</a>
                                @endif
                                <a class="dropdown-item" href="{{URL::signedRoute('vendor.team.delete',['vendorTeam'=>$vendorTeam->id])}}">{{__("Excluir")}}</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection