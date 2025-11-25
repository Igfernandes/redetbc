<form action="{{url('/user/two-factor-authentication')}}" id="bc-form-enable-2fa" method="post">
    @csrf

    <h4>{{__("Você não ativou a autenticação de dois fatores")}}</h4>

    <div class="mb-3"><button class="btn btn-warning">{{__("Ativar agora")}}</button></div>
    <p>{{__('A autenticação de dois fatores adiciona uma camada adicional de segurança à sua conta, exigindo mais do que apenas uma senha para entrar')}}</p>
</form>