<div style="background-color: #ececec;width: 100%;font-family: 'Fira Sans', Helvetica, Arial, sans-serif;">
    <table style="background-color: #fff; width: 550px;margin: 0 auto;">
        <thead>
            <tr>
                <th style="text-align: center;">
                    <div style="text-align: center;">
                        <a href="{{ url('/') }}">
                            @php
                                $logo_id = setting_item("logo_id");
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
                        <span style="font-size: 20px;font-weight: 400;color: #dc3545;">
                            {{ __('Olá :name', ['name' => $client->name]) }}
                        </span>
                    </div>
                    <div style="padding: 0 30px;">
                        <h1>
                            <strong>{{ __('Sua solicitação foi recusada') }}</strong>
                        </h1>
                    </div>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="padding: 35px;border-bottom: 10px solid #ececec;">
                    <p style="font-size: 1.1rem;">
                        {{ __('Infelizmente o anunciante :vendor não pôde aceitar sua solicitação.', [
                            'vendor' => $vendor->name
                        ]) }}
                    </p>

                    <p style="font-size: 1.1rem;">
                        {{ __('Você pode continuar buscando outros imóveis na plataforma.') }}
                    </p>
                </td>
            </tr>

            <tr>
                <td style="text-align: center;border-bottom: 10px solid #ececec;padding: 35px 0;">
                    <a style="background: #50a6fb;color: #fff;text-decoration: none;padding: 16px 34px;border-radius: 10px;display: inline-block;"
                       href="{{ url('/') }}"
                       target="_blank">
                        {{ __('Buscar outros imóveis →') }}
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
