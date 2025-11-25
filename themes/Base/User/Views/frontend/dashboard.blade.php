@extends('layouts.user')
@section('content')
    <h2 class="title-bar no-border-bottom">
        {{__("Painel")}}
    </h2>
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
            var earning_chart_data = {!! json_encode($earning_chart_data) !!};
        </script>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset("libs/chart_js/Chart.min.js") }}"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $(".bravo-user-render-chart").each(function () {
                let ctx = $(this)[0].getContext('2d');
                window.myMixedChartForVendor = new Chart(ctx, {
                    type: 'bar',//line - bar
                    data: earning_chart_data,
                    options: {
                        min:0,
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
                                    labelString: '{{__("Moeda: :currency_main",['currency_main'=>setting_item('currency_main')])}}'
                                },
                                ticks: {
                                    beginAtZero: true,
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem, data) {
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
            $(".bravo-user-chart form select").change(function () {
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
                    '{{__("Últimos 7 Dias")}}': [moment().subtract(6, 'days'), moment()],
                    '{{__("Últimos 30 Dias")}}': [moment().subtract(29, 'days'), moment()],
                    '{{__("Este Mês")}}': [moment().startOf('month'), moment().endOf('month')],
                    '{{__("Mês Passado")}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '{{__("Este Ano")}}': [moment().startOf('year'), moment().endOf('year')],
                    '{{__('Esta Semana')}}': [moment().startOf('week'), end]
                }
            }, cb).on('apply.daterangepicker', function (ev, picker) {
                $.ajax({
                    url: '{{url('user/reloadChart')}}',
                    data: {
                        chart: 'earning',
                        from: picker.startDate.format('YYYY-MM-DD'),
                        to: picker.endDate.format('YYYY-MM-DD'),
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function (res) {
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