@extends('layouts.user')
@section('content')
<div>
    <div class="row align-items-center">
        <div class="col-12 col-md-6">
            <h2 class="title-bar no-border-bottom">
                {{__("Minha Rede")}}
            </h2>
        </div>
        <div class="col-12 col-md-6">
            <div class="text-right">
                <a class="btn btn-success" href="{{route('user.network.wallet')}}">
                    {{__("Solicitar saque")}}
                </a>
            </div>
        </div>
    </div>
</div>
@include('admin.message')
<div class="bravo-user-dashboard">
    <div class="row dashboard-price-info row-eq-height">
        @if(!empty($cards_report))
        @foreach($cards_report as $item)
        <div class="col-lg-3 col-md-3">
            <div class="dashboard-item">
                <div class="wrap-box">
                    <div class="title">
                        {{$item['title']}}
                    </div>
                    <div class="details">
                        <div class="number">
                            {{ $item['amount'] }}
                        </div>
                    </div>
                    <div class="desc"> {{ $item['desc'] }}</div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
<div class="bg-white pt-4 pb-3
 px-3 my-4">
    <div>
        <h6>Membros da sua Rede</h6>
    </div>
    <div class="table-responsive form-group" data-condition="enable_open_hours:is(1)">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Nome') }}</th>
                    <th>{{ __('Comissão') }}</th>
                    <th>{{ __('Iniciado em') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($affiliates as $affiliate)
                <tr>
                    <td>{{ $affiliate['name'] }}</td>
                    <td>{{ $affiliate['amount'] }}</td>
                    <td>{{ $affiliate['started_at'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        {{ __('Nenhum afiliado encontrado') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="bravo-user-link bg-white my-4">
    <div>
        <p>{{__("Copie seu link exclusivo e compartilhe-o com aqueles que você gostaria de convidar para sua rede de afiliados. Acompanhe a atividade deles e gerencie seus ganhos facilmente.")}}</p>
        <div>
            <label for="link" class="bg-info text-white py-1 px-3 rounded-1">{{__('Link de indicação')}}</label>
            <div class="d-flex align-items-center">
                <input id="link" type="text" class="form-control" disabled value="{{url('/?rk='. \App\Helpers\Constants::RELATION_AFFILIATE_PREFIX.Auth::user()->id) }}">
                <button id="btn-link" class="btn btn-info col-2">{{__('Copiar Link')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="bravo-user-chart">
    <div class="chart-title">
        {{__("Estatísticas de Ganho")}}
        <div class="action-control">
            <div id="reportrange">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
        </div>
    </div>
    <canvas class="bravo-user-render-chart"></canvas>
    <script>
        const earning_chart_data = @json($earning_chart_data);
    </script>

    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>{{ __('Histórico de Saques') }}</h4>
        </div>

        @if($withdraws->isEmpty())
        <div class="alert alert-info">
            {{ __('Nenhum saque encontrado.') }}
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">{{ __('Código') }}</th>
                        <th scope="col">{{ __('Valor') }}</th>
                        <th scope="col">{{ __('Moeda') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('Data de Solicitação') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdraws as $withdraw)
                    <tr>
                        <td>{{ $withdraw->code ?? '-' }}</td>
                        <td>R$ {{ number_format($withdraw->amount, 2, ',', '.') }}</td>
                        <td>{{ $withdraw->currency ?? 'BRL' }}</td>
                        <td>
                            @php
                            $statusClass = match($withdraw->status) {
                            'completed' => 'success',
                            'processing' => 'warning',
                            'cancelled', 'rejected' => 'danger',
                            default => 'secondary',
                            };
                            @endphp
                            <span class="badge bg-{{ $statusClass }}">
                                {{ ucfirst($withdraw->status ?? 'Indefinido') }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($withdraw->created_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</div>
@endsection
@push('js')
<script>
    const btn = document.querySelector("#btn-link")
    btn.addEventListener("click", () => {
        const input = document.querySelector("#link")
        const link = input.value;

        // 👉 Copia o texto para a área de transferência
        navigator.clipboard.writeText(link)
            .then(() => {
                btn.textContent = "Link copiado!";
                setTimeout(() => {
                    btn.textContent = "Copiar link";
                }, 1000);
            })
            .catch(() => {
                btn.textContent = "Erro ao copiar!";
                setTimeout(() => {
                    btn.textContent = "Copiar link";
                }, 1000);
            });
    })
</script>
<script type="text/javascript" src="{{ asset("libs/chart_js/Chart.min.js") }}"></script>
<script type="text/javascript">
    jQuery(function($) {
        $(".bravo-user-render-chart").each(function() {
            let ctx = $(this)[0].getContext('2d');
            window.myMixedChartForVendor = new Chart(ctx, {
                type: 'bar', //line - bar
                data: earning_chart_data,
                options: {
                    min: 0,
                    responsive: true,
                    legend: {
                        display: true
                    },
                    scales: {
                        xAxes: [{
                            stacked: true,
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: '{{__("Linha do Tempo")}}'
                            }
                        }],
                        yAxes: [{
                            stacked: true,
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: '{{__("Moeda: :currency_main",["currency_main "=>setting_item("currency_main ")])}}'
                            },
                            ticks: {
                                beginAtZero: true,
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.datasets[tooltipItem.datasetIndex].label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += tooltipItem.yLabel + " ({{setting_item('currency_main')}})";
                                return label;
                            }
                        }
                    }
                }
            });
        });
        $(".bravo-user-chart form select").change(function() {
            $(this).closest("form").submit();
        });

        var start = moment().startOf('week');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            "alwaysShowCalendars": true,
            "opens": "left",
            "showDropdowns": true,
            ranges: {
                '{{__("Hoje")}}': [moment(), moment()],
                '{{__("Ontem")}}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '{{__("Últimos 7 dias")}}': [moment().subtract(6, 'days'), moment()],
                '{{__("Últimos 30 dias")}}': [moment().subtract(29, 'days'), moment()],
                '{{__("Este Mês")}}': [moment().startOf('month'), moment().endOf('month')],
                '{{__("Mês Passado")}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                '{{__("Este Ano")}}': [moment().startOf('year'), moment().endOf('year')],
                '{{__("Esta Semana")}}': [moment().startOf('week'), end]
            }
        }, cb).on('apply.daterangepicker', function(ev, picker) {
            $.ajax({
                url: "{{url(' user / reloadChart ')}}",
                data: {
                    chart: 'earning',
                    from: picker.startDate.format('YYYY-MM-DD'),
                    to: picker.endDate.format('YYYY-MM-DD'),
                },
                dataType: 'json',
                type: 'post',
                success: function(res) {
                    if (res.status) {
                        window.myMixedChartForVendor.data = res.data;
                        window.myMixedChartForVendor.update();
                    }
                }
            })
        });
        cb(start, end);
    });
</script>
@endpush