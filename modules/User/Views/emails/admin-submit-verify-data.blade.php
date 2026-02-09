<div style="background-color: #ececec;width: 100%;font-family: 'Fira Sans', Helvetica, Arial, sans-serif;">
    <table style="background-color: #fff; width: 550px;margin: 0 auto;">
        <thead>
            <tr>
                <th style="text-align: center;padding: 25px 0;">
                    <a href="{{ url('/') }}">
                        @php
                        $logo_id = setting_item("logo_id");
                        @endphp
                        @if($logo_id)
                        <?php $logo = get_file_url($logo_id, 'full'); ?>
                        <img src="{{ asset($logo) }}" alt="{{ setting_item('site_title') }}" style="max-height:60px;">
                        @endif
                    </a>
                </th>
            </tr>

            <tr>
                <th style="border-bottom: 10px solid #ececec;">
                    <div style="margin: 30px 0 15px;">
                        <span style="font-size: 20px;font-weight: 500;color: #ffaa34;">
                            {{ __("Olá :name", ['name' => $user->business_name ? $user->business_name : $user->first_name]) }}
                        </span>
                    </div>

                    <div style="padding: 0 30px 25px;">
                        <p style="font-size: 16px;color:#666;line-height:1.6;">
                            {{ __('Você está recebendo este e-mail porque seus dados de verificação de fornecedor foram atualizados em nossa plataforma.') }}
                        </p>
                    </div>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="padding: 30px;border-bottom: 10px solid #ececec;">
                    <p style="font-size: 16px;font-weight: 600;color:#333;margin-bottom:15px;">
                        {{ __('Status dos dados enviados:') }}
                    </p>

                    <ul style="padding-left: 18px;color:#555;font-size:15px;line-height:1.6;">
                        @if(!empty($user->verification_fields))
                        @foreach($user->verification_fields as $field)
                        <li style="margin-bottom:8px;">
                            <strong>{{ $field['name'] }}:</strong>
                            <span
                                @if(!empty($field['is_verified']))
                                style="color:#2e7d32;"
                                @else
                                style="color:#c62828;"
                                @endif>
                                {{ !empty($field['is_verified']) ? __('Verificado') : __('Não verificado') }}
                            </span>
                        </li>
                        @endforeach
                        @endif
                    </ul>

                    <div style="text-align: center;margin: 30px 0 10px;">
                        <a
                            href="{{ route('user.verification.index') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            style="background: #50a6fb;color: #fff;text-decoration: none;padding: 14px 32px;border-radius: 8px;display: inline-block;font-size:15px;">
                            {{ __('Ver dados de verificação') }}
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td style="padding: 30px;text-align: center;color: gray;">
                    <p style="margin: 10px 0 5px;">
                        {{ __('Atenciosamente,') }}<br>
                        <strong>{{ setting_item('site_title') }}</strong>
                    </p>
                    <span style="font-size:13px;">
                        {{ __('Este é um e-mail automático. Caso tenha dúvidas, acesse sua conta para mais informações.') }}
                    </span>
                </td>
            </tr>
        </tfoot>
    </table>
</div>