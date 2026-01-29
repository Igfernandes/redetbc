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
                        <span style="font-size: 20px;font-weight: 600;color: #333;">
                            Prezado(a) Viajante,
                        </span>
                    </div>

                    <div style="padding: 0 30px;">
                        <p style="font-size: 16px;color:#666;line-height:1.6;">
                            Seja bem-vindo(a) ao <strong>Clube TBC</strong>.
                        </p>
                    </div>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="padding: 30px;border-bottom: 10px solid #ececec;">
                    <p style="font-size: 15px; color:#555; line-height: 1.6;">
                        Nosso objetivo é oferecer uma experiência segura, transparente e confiável para todos os nossos membros.
                        Por isso, gostaríamos de reforçar algumas orientações importantes relacionadas a pagamentos e reservas
                        dentro da nossa plataforma.
                    </p>

                    <div style="margin-top: 25px;">
                        <h3 style="font-size: 16px;color:#333;margin-bottom:10px;">
                            1. Pagamentos somente ao anfitrião cadastrado
                        </h3>
                        <p style="font-size: 14px;color:#555;line-height:1.6;">
                            O pagamento da hospedagem ou de qualquer serviço deve ser realizado exclusivamente para a conta
                            bancária ou chave Pix que esteja em nome do titular do cadastro do anfitrião na plataforma.
                        </p>
                        <p style="font-size: 14px;color:#555;line-height:1.6;">
                            Não efetue pagamentos para contas de terceiros ou pessoas diferentes do anfitrião responsável
                            pela oferta anunciada.
                        </p>
                    </div>

                    <div style="margin-top: 20px;">
                        <h3 style="font-size: 16px;color:#333;margin-bottom:10px;">
                            2. Evite pagamentos 100% adiantados
                        </h3>
                        <p style="font-size: 14px;color:#555;line-height:1.6;">
                            Por segurança, o Clube TBC não recomenda que o viajante realize o pagamento integral antecipado
                            da reserva. Sempre que possível, priorize acordos que envolvam sinal ou pagamento parcial,
                            conforme combinado diretamente com o anfitrião.
                        </p>
                    </div>

                    <div style="margin-top: 20px;">
                        <h3 style="font-size: 16px;color:#333;margin-bottom:10px;">
                            3. Atenção a solicitações fora da plataforma
                        </h3>
                        <p style="font-size: 14px;color:#555;line-height:1.6;">
                            Desconfie de qualquer pedido de pagamento feito por meios não informados no cadastro do anfitrião
                            ou com urgência incomum. Em caso de dúvida, entre em contato com nosso suporte antes de concluir
                            qualquer transação.
                        </p>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="padding: 30px;border-bottom: 10px solid #ececec;">
                    <p style="font-size: 15px;color:#555;line-height:1.6;text-align:center;">
                        Essas medidas visam proteger você contra fraudes e garantir uma experiência tranquila e segura
                        dentro do <strong>Clube TBC</strong>.
                    </p>

                    <p style="font-size: 15px;color:#555;line-height:1.6;text-align:center;margin-top:15px;">
                        Estamos à disposição para qualquer esclarecimento adicional.
                    </p>

                    <p style="font-size: 15px;color:#333;line-height:1.6;text-align:center;margin-top:25px;">
                        Atenciosamente,<br>
                        <strong>Clube TBC</strong><br>
                        Suporte e Relacionamento
                    </p>
                </td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td style="padding: 30px;text-align: center;color: gray;">
                    <p style="margin: 10px 0 5px;">
                        O maior portal nacional de aluguel de temporada do Brasil.
                    </p>
                    <span>
                        Servindo milhões de viajantes e anunciantes desde 2025.
                    </span>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
