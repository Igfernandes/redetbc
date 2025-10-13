@extends('layouts.user')

@section('content')
<div>
    <div class="row align-items-center">
        <div class="col-12 col-md-6">
            <h2 class="title-bar no-border-bottom">
                {{ __("Carteira") }}
            </h2>
        </div>
    </div>
</div>
@include('admin.message')


{{-- 🏦 FORMULÁRIO DE CONTA BANCÁRIA --}}
<form action="{{ route('user.network.wallet.save') }}" method="POST" class="bravo-form">
    @csrf
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-title mb-3">
                <strong>{{ __("Informações Bancárias para Saques") }}</strong>
            </div>
        </div>
        <div class="col-12 col-md-6 text-right">
            <a href="{{route('user.network.wallet.request')}}" class="btn btn-success">
                {{ __("Solicitar Saque") }}
            </a>
        </div>
    </div>
    <div class="form-group">
        <label>{{ __("Nome do Titular") }} <span class="text-danger">*</span></label>
        <input type="text" name="owner_name" value="{{ old('owner_name', $withdrawAccount->owner_name ?? '') }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>{{ __("CPF ou CNPJ") }} <span class="text-danger">*</span></label>
        <input type="text" name="document" value="{{ old('document', $withdrawAccount->document ?? '') }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>{{ __("Data de Nascimento") }}</label>
        <input type="date" name="owner_birthdate" value="{{ old('owner_birthdate', $withdrawAccount->owner_birthdate ?? '') }}" class="form-control">
    </div>

    <div class="form-group">
        <label>{{ __("Banco") }}</label>
        <input type="text" name="bank_name" value="{{ old('bank_name', $withdrawAccount->bank_name ?? '') }}" class="form-control" placeholder="{{ __('Ex: Itaú, Bradesco, Nubank...') }}">
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __("Agência") }}</label>
                <input type="text" name="agency" value="{{ old('agency', $withdrawAccount->agency ?? '') }}" class="form-control">
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label>{{ __("Conta") }}</label>
                <input type="text" name="account" value="{{ old('account', $withdrawAccount->account ?? '') }}" class="form-control">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __("Dígito") }}</label>
                <input type="text" name="account_digit" value="{{ old('account_digit', $withdrawAccount->account_digit ?? '') }}" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>{{ __("Tipo da Conta") }}</label>
        <select name="bank_account_type" class="form-control">
            <option value="CONTA_CORRENTE" {{ old('bank_account_type', $withdrawAccount->bank_account_type ?? '') == 'CONTA_CORRENTE' ? 'selected' : '' }}>
                {{ __("Conta Corrente") }}
            </option>
            <option value="CONTA_POUPANCA" {{ old('bank_account_type', $withdrawAccount->bank_account_type ?? '') == 'CONTA_POUPANCA' ? 'selected' : '' }}>
                {{ __("Conta Poupança") }}
            </option>
        </select>
    </div>

    <div class="form-group">
        <label>{{ __("Tipo de Transferência") }}</label>
        <select name="operation_type" class="form-control">
            <option value="PIX" {{ old('operation_type', $withdrawAccount->operation_type ?? '') == 'PIX' ? 'selected' : '' }}>
                {{ __("Pix") }}
            </option>
            <option value="TED" {{ old('operation_type', $withdrawAccount->operation_type ?? '') == 'TED' ? 'selected' : '' }}>
                {{ __("TED") }}
            </option>
        </select>
    </div>

    <div class="form-group">
        <label>{{ __("Chave Pix (opcional)") }}</label>
        <input type="text" name="pix_address_key" value="{{ old('pix_address_key', $withdrawAccount->pix_address_key ?? '') }}" class="form-control" placeholder="{{ __('CPF, e-mail, telefone ou EVP') }}">
    </div>

    <div class="form-group">
        <label>{{ __("Tipo da Chave Pix") }}</label>
        <select name="pix_address_key_type" class="form-control">
            <option value="">{{ __('Selecione') }}</option>
            @foreach(['CPF','CNPJ','EMAIL','PHONE','EVP'] as $key)
            <option value="{{ $key }}" {{ old('pix_address_key_type', $withdrawAccount->pix_address_key_type ?? '') == $key ? 'selected' : '' }}>
                {{ __($key) }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>{{ __("Descrição (opcional)") }}</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $withdrawAccount->description ?? '') }}</textarea>
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> &nbsp; {{ __("Salvar Dados Bancários") }}
        </button>
    </div>
</form>

<div class="bravo-user-chart mt-5">
    <div class="chart-title">
        {{ __("Estatísticas de Saques") }}
        <div class="action-control">
            <div id="reportrange">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
        </div>
    </div>
    <canvas class="bravo-user-render-chart"></canvas>
</div>
<script>
    const earning_chart_data = @json($earning_chart_data);
</script>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('libs/chart_js/Chart.min.js') }}"></script>
<script type="text/javascript">
    jQuery(function($) {
        let ctx = $(".bravo-user-render-chart")[0].getContext('2d');
        window.withdrawChart = new Chart(ctx, {
            type: 'bar',
            data: earning_chart_data,
            options: {
                responsive: true,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '{{ __("Dias do Mês") }}'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '{{ __("Valor (R$)") }}'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Filtro de datas
        var start = moment().startOf('month');
        var end = moment().endOf('month');

        function cb(start, end) {
            $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            alwaysShowCalendars: true,
            opens: "left",
            showDropdowns: true,
            ranges: {
                '{{ __("Este Mês") }}': [moment().startOf('month'), moment().endOf('month')],
                '{{ __("Últimos 30 Dias") }}': [moment().subtract(29, 'days'), moment()],
                '{{ __("Este Ano") }}': [moment().startOf('year'), moment().endOf('year')],
            }
        }, cb).on('apply.daterangepicker', function(ev, picker) {
            $.ajax({
                url: "{{ url('user/reloadChart') }}",
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    from: picker.startDate.format('YYYY-MM-DD'),
                    to: picker.endDate.format('YYYY-MM-DD')
                },
                success: function(res) {
                    if (res.status) {
                        window.withdrawChart.data = res.data;
                        window.withdrawChart.update();
                    }
                }
            });
        });

        cb(start, end);
    });
</script>
@endpush