<h4>{{__("Você ativou a autenticação de dois fatores")}}</h4>
<div class="mb-4 font-medium text-sm text-green-600">
    {{__("Quando a autenticação de dois fatores está ativada, será solicitado um token seguro e aleatório durante a autenticação. Você pode recuperar este token no aplicativo Google Authenticator do seu celular.")}}
</div>
@if (session('status') == 'two-factor-authentication-enabled')
    <div class="mb-4 font-medium text-sm text-green-600">
        {{__("A autenticação de dois fatores está ativada. Escaneie o seguinte código QR usando o aplicativo autenticador do seu celular.")}}
    </div>
    {!! request()->user()->twoFactorQrCodeSvg() !!}
    <?php
    $codes = (array) request()->user()->recoveryCodes();
    ?>
    @if(!empty($codes))
        <hr>
        <div class="mt-3">
            <p>{{__('Armazene estes códigos de recuperação em um gerenciador de senhas seguro. Eles podem ser usados para recuperar o acesso à sua conta se seu dispositivo de autenticação de dois fatores for perdido.')}}</p>
            <div class="p-3" style="background: #f3f3f3">
                @foreach($codes as $code)
                    <div class="mb-2 font-weight-medium">{{$code}}</div>
                @endforeach
            </div>
        </div>
    @endif
@endif
<hr>
<button class="btn btn-danger btn-xs btn-disable-2fa">{{__("Desativar autenticação de dois fatores")}}</button>