<?php

namespace Modules\User\Traits\Network;

use Illuminate\Support\Facades\DB;

trait GraphicNetworkReceived
{
    /**
     * 📈 Gera dados para o gráfico de saques do usuário
     */
    public static function getUserWithdrawChartDataReceived($from, $to, $user_id)
    {
        $data = [
            'labels' => [],
            'datasets' => [
                [
                    'label' => __("Saques"),
                    'data' => [],
                    'backgroundColor' => '#42A5F5'
                ]
            ]
        ];

        // 🔹 Reporte diário (30 dias, por exemplo)
        for ($i = strtotime(date('Y-m-d', $from)); $i <= strtotime(date('Y-m-d 23:59:59', $to)); $i += DAY_IN_SECONDS) {
            $data['labels'][] = date('d/m', $i);

            $totalWithdraw = DB::table('bravo_booking_payments')
                ->where('user_id', $user_id)
                ->where('status', 'completed') // ajuste se o status for diferente
                ->whereBetween('created_at', [
                    date('Y-m-d 00:00:00', $i),
                    date('Y-m-d 23:59:59', $i),
                ])
                ->sum('amount'); // ajuste o nome da coluna de valor se necessário

            $data['datasets'][0]['data'][] = (float) $totalWithdraw;
        }

        return $data;
    }
}
