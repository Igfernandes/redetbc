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
                        <span style="font-size: 20px;font-weight: 400;color: #28a745;">
                            {{ __('Olá :name', ['name' => $client->name]) }}
                        </span>
                    </div>
                    <div style="padding: 0 30px;">
                        <h1>
                            <strong>{{ __('Sua solicitação foi aceita 🎉') }}</strong>
                        </h1>
                    </div>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="padding: 35px;border-bottom: 10px solid #ececec;">
                    <p style="font-size: 1.1rem;">
                        {{ __('O anunciante :vendor confirmou sua solicitação.', [
                            'vendor' => $vendor->name
                        ]) }}
                    </p>

                    <p style="font-size: 1.1rem;">
                        {{ __('Agora você já pode conversar pelo chat.') }}
                    </p>
                </td>
            </tr>

            <tr>
                <td style="text-align: center;border-bottom: 10px solid #ececec;padding: 35px 0;">
                    <h2>{{ __('Ir para a conversa') }}</h2>

                    <a style="background: #50a6fb;color: #fff;text-decoration: none;padding: 16px 34px;border-radius: 10px;display: inline-block;"
                        href="{{ url('/user/chat?bk='.$booking->id) }}"
                        target="_blank">
                        {{ __('Ver conversa →') }}
                    </a>
                </td>
            </tr>

            <tr>
                <td style="text-align: center;border-bottom: 10px solid #ececec;padding: 35px 0;">
                    <div>
                        <p style="margin: 10px 0;">{{ $vendor->name }}</p>
                        <span style="color: gray;font-size: 1.2rem;">
                            {{ $vendor->phone }}
                        </span>
                        <span style="color: gray;font-size: 1.2rem;">
                            {{ $vendor->email }}
                        </span>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="padding: 30px;border-bottom: 10px solid #ececec;">
                    <div>
                        <p style="font-size: 1.3rem;">
                            <strong>
                                {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}
                                até
                                {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}
                            </strong>
                        </p>

                        <p>
                            {{ $booking->guest }}
                            {{ Str::plural(__('hóspede'), $booking->guest) }}
                        </p>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="border-bottom: 10px solid #ececec;padding: 50px 0;text-align: center;">
                    <p style="font-size: 1.2rem;color: gray;margin-bottom: 20px;">
                        {{ __('Veja a conversa inteira no site') }}
                    </p>

                    <a style="background: #50a6fb;color: #fff;text-decoration: none;padding: 16px 20px;border-radius: 10px;display: inline-block;"
                        href="{{ url('/user/chat?bk='.$booking->id) }}"
                        target="_blank">
                        {{ __('Ver conversa →') }}
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>