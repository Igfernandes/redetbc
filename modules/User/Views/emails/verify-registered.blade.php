<div style="background-color: #ececec;width: 100%;font-family: 'Fira Sans', Helvetica, Arial, sans-serif;">
    <table style="background-color: #fff; width: 550px;margin: 0 auto;">
        <thead>
            <tr>
                <th style="text-align: center;">
                    <a href="{{ url('/') }}" class="bravo-logo">
                        @php $logo_id = setting_item('logo_id'); @endphp
                        @if($logo_id)
                            <?php $logo = get_file_url($logo_id, 'full'); ?>
                            <img src="{{ $logo }}" alt="{{ setting_item('site_title') }}">
                        @endif
                    </a>
                </th>
            </tr>
            <tr>
                <th style="border-bottom: 10px solid #ececec;">
                    <div style="margin: 30px 0 20px;">
                        <span style="font-size: 20px;font-weight: 400;color: #ffaa34;">
                            Olá! tudo bem?
                        </span>
                    </div>
                    <div style="padding: 0 30px;">
                        <p style="font-size: 16px;color:#666;">
                            Sua conta foi criada com sucesso em nossa plataforma.
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
                            <img src="{{ $avatar }}" alt="Avatar" style="width:100px;height:100px;border-radius:50%;object-fit:cover;margin-bottom:15px;">
                        @endif
                        <p style="font-size: 15px; color:#555; line-height: 1.5;">
                            Agora você faz parte da nossa comunidade. Estamos muito felizes em ter você com a gente!
                        </p>
                    </div>

                    <div style="text-align: center;margin: 30px 0 20px;">
                        {!! $buttonVerify !!}
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
