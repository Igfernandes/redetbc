<div style="background-color: #ececec;width: 100%;font-family: 'Fira Sans', Helvetica, Arial, sans-serif;">
    <table style="background-color: #fff; width: 550px;margin: 0 auto;">
        <thead>
            <tr>
                <th style="text-align: center;">
                    <div style="text-align: center;">
                        <a href="{{ url('/') }}" class="bravo-logo">
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
                            {{ __('Parabéns! 🎉') }}
                        </span>
                    </div>

                    <div style="padding: 0 30px;">
                        <p style="font-size: 16px;color:#666;">
                            {{ __('O seu plano está ativo!') }}
                        </p>
                    </div>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="padding: 30px;border-bottom: 10px solid #ececec;">

                    <div style="text-align: center;">
                        @if(!empty($avatar))
                            <img src="{{ asset($avatar) }}" alt="Avatar" style="width:100px;height:100px;border-radius:50%;object-fit:cover;margin-bottom:15px;">
                        @endif

                        <p style="font-size: 15px; color:#555; line-height: 1.5;">
                            {{ __('Parabéns! O seu plano está ativo e você já pode aproveitar todos os benefícios da plataforma.') }}
                        </p>
                    </div>

                    <div style="text-align: center;margin: 30px 0 20px;">
                        <a style="background: #50a6fb;color: #fff;text-decoration: none;padding: 16px 34px;border-radius: 10px;display: inline-block;"
                            href="{{ url('/user/dashboard') }}" target="_blank" rel="noopener noreferrer">
                            {{ __('Acessar meu painel →') }}
                        </a>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="padding: 30px;border-bottom: 10px solid #ececec;">
                    <div>
                        <h1 style="text-align: center;font-weight: 800;">{{ __('Acompanhe o RedeTBC') }}</h1>
                    </div>

                    <div style="margin: 21px 0;">
                        <p style="color: gray;font-size: 1.1rem;line-height: 1.5; text-align:center;">
                            {{ __('Siga nossas redes sociais para novidades, dicas e conteúdos exclusivos!') }} <br><br>
                            <a href="https://instagram.com/sua_conta" target="_blank">Instagram</a> •
                            <a href="https://facebook.com/sua_conta" target="_blank">Facebook</a>
                        </p>
                    </div>
                </td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td style="padding: 30px 0;border-bottom: 10px solid #ececec;">
                    <div style="text-align: center;">
                        <a href="{{ url('/') }}" class="bravo-logo">
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

                    <div style="text-align: center;margin-top: 40px;border-top: 4px solid #ececec;padding-top: 35px;">
                        <a style="color: #0076ff;margin: 0 15px;" href="{{ url('/user/dashboard') }}" target="_blank" rel="noopener noreferrer">
                            {{ __('Acessar minha conta') }}
                        </a>
                        <a style="color: #0076ff;margin: 0 15px;" href="{{ url('page/noticias') }}" target="_blank" rel="noopener noreferrer">
                            {{ __('Novidades e dicas') }}
                        </a>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="padding: 30px;text-align: center;color: gray;">
                    <p style="margin: 10px 0 5px;">{{ __('O maior portal nacional de aluguel de temporada do Brasil.') }}</p>
                    <span>{{ __('Servindo milhões de Membros e anunciantes desde 2025.') }}</span>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
