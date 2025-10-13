<?php

namespace Modules\User\Traits\Network;

use App\Models\User;

trait GraphicNetwork
{
   public static function getUserNetworkChartData($from, $to, $user_id)
    {
        $data = [
            'labels'   => [],
            'datasets' => [
                [
                    'label'           => __("Membros Diretos"),
                    'data'            => [],
                    'backgroundColor' => '#42A5F5'
                ],
                [
                    'label'           => __("Membros Indiretos"),
                    'data'            => [],
                    'backgroundColor' => '#66BB6A'
                ]
            ]
        ];

        if (($to - $from) / DAY_IN_SECONDS > 90) {
            // 📅 Reporte por Mês
            $year = date("Y", $from);
            for ($month = 1; $month <= 12; $month++) {
                $day_last_month = date("t", strtotime($year . "-" . $month . "-01"));
                $data['labels'][] = date("F", strtotime($year . "-" . $month . "-01"));

                $direct = User::where("owner_id", $user_id)
                    ->whereBetween('created_at', [
                        $year . '-' . $month . '-01 00:00:00',
                        $year . '-' . $month . '-' . $day_last_month . ' 23:59:59'
                    ])
                    ->count();

                $directIds = User::where("owner_id", $user_id)->pluck('id');
                $indirect = User::whereIn("owner_id", $directIds)
                    ->whereBetween('created_at', [
                        $year . '-' . $month . '-01 00:00:00',
                        $year . '-' . $month . '-' . $day_last_month . ' 23:59:59'
                    ])
                    ->count();

                $data['datasets'][0]['data'][] = $direct;
                $data['datasets'][1]['data'][] = $indirect;
            }
        } elseif (($to - $from) <= DAY_IN_SECONDS) {
            // ⏰ Reporte por Hora
            for ($i = strtotime(date('Y-m-d', $from)); $i <= strtotime(date('Y-m-d 23:59:59', $to)); $i += HOUR_IN_SECONDS) {
                $data['labels'][] = date('H:i', $i);

                $direct = User::where("owner_id", $user_id)
                    ->whereBetween('created_at', [
                        date('Y-m-d H:i:s', $i),
                        date('Y-m-d H:i:s', $i + HOUR_IN_SECONDS - 1),
                    ])
                    ->count();

                $directIds = User::where("owner_id", $user_id)->pluck('id');
                $indirect = User::whereIn("owner_id", $directIds)
                    ->whereBetween('created_at', [
                        date('Y-m-d H:i:s', $i),
                        date('Y-m-d H:i:s', $i + HOUR_IN_SECONDS - 1),
                    ])
                    ->count();

                $data['datasets'][0]['data'][] = $direct;
                $data['datasets'][1]['data'][] = $indirect;
            }
        } else {
            // 📊 Reporte por Dia
            for ($i = strtotime(date('Y-m-d', $from)); $i <= strtotime(date('Y-m-d 23:59:59', $to)); $i += DAY_IN_SECONDS) {
                $data['labels'][] = display_date($i);

                $direct = User::where("owner_id", $user_id)
                    ->whereBetween('created_at', [
                        date('Y-m-d 00:00:00', $i),
                        date('Y-m-d 23:59:59', $i),
                    ])
                    ->count();

                $directIds = User::where("owner_id", $user_id)->pluck('id');
                $indirect = User::whereIn("owner_id", $directIds)
                    ->whereBetween('created_at', [
                        date('Y-m-d 00:00:00', $i),
                        date('Y-m-d 23:59:59', $i),
                    ])
                    ->count();

                $data['datasets'][0]['data'][] = $direct;
                $data['datasets'][1]['data'][] = $indirect;
            }
        }

        return $data;
    }
}
