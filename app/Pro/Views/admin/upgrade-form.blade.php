<div class="row justify-content-center">
    <div class="col-md-6">
        <img style="max-width: 100%" src="{{asset('images/pro/pro-preview.png')}}" alt="">
    </div>
    <div class="col-md-6">
        <div class="py-3 pr-3 h-100">
            <form method="post" action="{{route('pro.buy')}}" class="h-100 d-flex flex-column"> 
                @csrf
                <h5 class="mb-3">Faça o upgrade para o PRO e tenha acesso ilimitado a todos os nossos recursos, incluindo:</h5>
                <div class="mb-5">
                    <div class="mb-1">
                        <i class="fa fa-check text-success"></i>
                        Novo template moderno
                    </div>
                    <div class="mb-1">
                        <i class="fa fa-check text-success"></i>
                        Plugin de Central de Suporte
                    </div>
                    <div class="mb-1">
                        <i class="fa fa-check text-success"></i>
                        Mais gateways de pagamento
                    </div>
                    <div class="mb-1">
                        ... novos recursos chegando em breve
                    </div>
                </div>
                <button class="btn btn-info btn-block btn-md mb-3">
                    <img width="32px" class="mr-3" src="{{asset('/images/premium.png')}}" alt="Upgrade">
                    <strong>{{__("Atualize por :price", ['price' => '$'.config('pro.price_yearly')])}}</strong>
                </button>
                <p class="text-center">
                    <i>* Após a compra, você poderá baixar a versão PRO</i>
                </p>
            </form>
        </div>
    </div>
</div>
