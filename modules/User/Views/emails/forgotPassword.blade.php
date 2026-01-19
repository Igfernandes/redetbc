
<div style="background-color: #ececec;width: 100%;font-family: 'Fira Sans', Helvetica, Arial, sans-serif;">
    <table style="background-color: #fff; width: 550px;margin: 0 auto;">
        <thead>
            <tr>
                <th style="text-align: center;">
                    <div style="text-align: center;padding: 30px 0;">
                        <a href="{{ url('/') }}">
                            @php
                                $logo_id = setting_item("logo_id");
                                if(!empty($row->custom_logo)){
                                    $logo_id = $row->custom_logo;
                                }
                            @endphp
                            @if($logo_id)
                                <?php $logo = get_file_url($logo_id, 'full'); ?>
                                <img src="{{ asset($logo) }}" alt="{{ setting_item('site_title') }}">
                            @endif
                        </a>
                    </div>
                </th>
            </tr>

            <tr>
                <th style="border-bottom: 10px solid #ececec;">
                    <div style="margin: 30px 0 20px;">
                        <span style="font-size: 20px;font-weight: 400;color: #ffaa34;">
                            {{ __('Recuperação de senha 🔐') }}
                        </span>
                    </div>

                    <div style="padding: 0 30px 20px;">
                        <p style="font-size: 16px;color:#666;">
                            {{ __('Recebemos uma solicitação para redefinir sua senha.') }}
                        </p>
                    </div>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="padding: 30px;border-bottom: 10px solid #ececec;">

                    <div style="text-align: center;">
                        <p style="font-size: 15px; color:#555; line-height: 1.6;">
                            {{ __('Para criar uma nova senha, clique no botão abaixo:') }}
                        </p>
                    </div>

                    <div style="text-align: center;margin: 30px 0;">
                        <a
                            href="{{ $resetUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            style="background: #50a6fb;color: #fff;text-decoration: none;padding: 16px 34px;border-radius: 10px;display: inline-block;"
                        >
                            {{ __('Redefinir minha senha →') }}
                        </a>
                    </div>

                    <div style="margin-top: 30px;">
                        <p style="font-size: 14px;color:#666;line-height:1.5;">
                            {{ __('Se o botão não funcionar, utilize o token abaixo:') }}
                        </p>

                        <div style="background:#f5f5f5;padding:15px;border-radius:8px;text-align:center;font-size:16px;font-weight:bold;color:#333;">
                            {{ $token }}
                        </div>
                    </div>

                    <div style="margin-top: 30px;">
                        <p style="font-size: 13px;color:#999;line-height:1.5;">
                            {{ __('Se você não solicitou a redefinição de senha, ignore este email.') }}
                        </p>
                    </div>

                </td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td style="padding: 30px 0;border-bottom: 10px solid #ececec;">
                    <div style="text-align: center;">
                        <a href="{{ url('/') }}">
                            @if($logo_id)
                                <img src="{{ asset($logo) }}" alt="{{ setting_item('site_title') }}">
                            @endif
                        </a>
                    </div>

                    <div style="text-align: center;margin-top: 40px;border-top: 4px solid #ececec;padding-top: 35px;">
                        <a style="color: #0076ff;margin: 0 15px;" href="{{ url('/login') }}" target="_blank">
                            {{ __('Acessar minha conta') }}
                        </a>
                        <a style="color: #0076ff;margin: 0 15px;" href="{{ url('/') }}" target="_blank">
                            {{ __('Ir para o site') }}
                        </a>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="padding: 30px;text-align: center;color: gray;">
                    <p style="margin: 10px 0 5px;">
                        {{ __('Este é um email automático, não responda.') }}
                    </p>
                    <span>{{ __('© ') . date('Y') . ' ' . setting_item('site_title') }}</span>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
