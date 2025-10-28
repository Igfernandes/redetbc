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
                            <img src="{{$logo}}" alt="{{ setting_item('site_title') }}">
                            @endif
                        </a>
                    </div>
                </th>
            </tr>
            <tr>
                <th style="border-bottom: 10px solid #ececec;">
                    <div style="margin: 30px 0 20px;">
                        <span style="font-size: 20px;font-weight: 400;color: #ffaa34;">
                            {{ __('Olá! tudo bem?') }}
                        </span>
                    </div>
                    <div style="padding: 0 30px;">
                        <h1><strong>{{ __('Você recebeu uma resposta sobre o imóvel em :immobile', ['immobile' => $immobile['name']]) }}</strong></h1>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>

            @if(isset($booking['id']))
            <tr>
                <td style="text-align: center;border-bottom: 10px solid #ececec;padding: 35px 0;">
                    <div>
                        <h2>{{ __('Quer responder?') }}</h2>
                        <a href="{{ url('/user/chat?bk=' . $booking['id']) }}" target="_blank" rel="noopener noreferrer">
                            {{ __('Enviar Mensagem para o anunciante') }}
                        </a>
                    </div>
                </td>
            </tr>
            @endif
            <tr>
                <td style="padding: 30px;border-bottom: 10px solid #ececec;">
                    <div>
                        <span style="font-size: 1.4rem;"><strong>{{ __('O imóvel consultado') }}</strong></span>
                        <a style="border: 1px solid #9d9c9c;float: right;font-size: .8rem;text-decoration: none;color: black;padding: 5px 10px;border-radius: 17px;" href="{{ url('/hotel/'.$immobile['id']) }}" target="_blank" rel="noopener noreferrer">
                            {{ __('Ver imóvel >') }}
                        </a>
                    </div>
                    <div style="margin: 15px 0;">
                        <a href="{{ url('/hotel/'.$immobile['id']) }}" target="_blank" rel="noopener noreferrer">
                            @if(!empty($immobile['image']['file_path']))
                            <img src="{{ asset('uploads/'.$immobile['image']['file_path']) }}" alt="{{ __('Imagem do imóvel') }}">
                            @endif
                            <p></p>
                        </a>
                    </div>
                    <div>
                        <p style="font-size: 1.3rem;"><strong>{{ $booking['start_date'] }} até {{ $booking['end_date'] }}</strong></p>
                        <p>{{ $booking['guest'] }} {{ Str::plural(__('hóspede'), $booking['guest']) }}</p>
                    </div>
                    <div style="text-align: center;margin: 30px 0 20px;">
                        <a style="background: #50a6fb;color: #ffff;text-decoration: none;padding: 16px 34px;border-radius: 10px;display: inline-block;" href="{{ url('/hotel/'.$immobile['id']) }}" target="_blank" rel="noopener noreferrer">
                            {{ __('Ver imóvel →') }}
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 10px solid #ececec;padding: 50px 0;text-align: center;">
                    <p style="font-size: 1.2rem;color: gray;margin-bottom: 20px;">{{ __('Veja a conversa inteira no site do') }} <span>{{ __('RedeTBC') }}</span></p>
                    <div>
                        <a style="background: #50a6fb;color: #ffff;text-decoration: none;padding: 16px 20px;border-radius: 10px;display: inline-block;" href="{{ url('/user/chat?bk='.$booking['id']) }}" target="_blank" rel="noopener noreferrer">
                            {{ __('Ver conversa →') }}
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
                        <p style="color: gray;font-size: 1.1rem;line-height: 1.5;">
                            {{ __('No nosso') }}
                            <a href="https://instagram.com/sua_conta" target="_blank">
                                Instagram
                            </a> e
                            <a href="https://facebook.com/sua_conta" target="_blank">
                                Facebook
                            </a>, {{ __('postamos diariamente sugestões de imóveis sensacionais.') }} <br><br>
                            {{ __('No') }}
                            <a href="{{ url('') }}" target="_blank" rel="noopener noreferrer">
                                {{ __('Blog do TemporadaLivre') }}
                            </a>, {{ __('escrevemos muito sobre vários destinos do Brasil e do Mundo, bem como sobre o mercado de Aluguel de Temporada.') }}
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
                            <img src="{{$logo}}" alt="{{ setting_item('site_title') }}">
                            @endif
                        </a>
                    </div>
                    <div style="text-align: center;margin-top: 40px;border-top: 4px solid #ececec;padding-top: 35px;">
                        <a style="color: #0076ff;margin: 0 15px;" href="{{ url('/?action=register') }}" target="_blank" rel="noopener noreferrer">
                            {{ __('Sua Área do Viajante') }}
                        </a>
                        <a style="color: #0076ff;margin: 0 15px;" href="{{ url('page/noticias') }}" target="_blank" rel="noopener noreferrer">
                            {{ __('Dicas para viajantes') }}
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 30px;text-align: center;color: gray;">
                    <p style="margin: 10px 0 5px;">{{ __('O maior portal nacional de aluguel de temporada do Brasil.') }}</p>
                    <span>{{ __('Servindo milhões de viajantes e anunciantes desde 2025.') }}</span>
                    <div>
                        <!-- SVGs mantidos como estão -->
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>