@extends('Email::layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            <h3 class="email-headline"><strong>{{__('Olá :name',['name'=>$enquiry->name])}}</strong></h3>
            <p>{{__('Você recebeu uma resposta do fornecedor. ')}}</p>
            <?php $service = $enquiry->service; ?>
            @if(!empty($service))
                <p><strong>{{__("Serviço:")}}</strong> <a href="{{$service->getDetailUrl()}}">{{$service->title}}</a></p>
                <p><strong>{{__("Sua observação:")}}</strong> {{$enquiry->note}}</p>
            @endif
            <p>{{__('Aqui está a mensagem do fornecedor:')}}</p>
            <p>{!! clean($enquiry_reply->content) !!}</p>
        </div>
    </div>
@endsection