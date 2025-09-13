<?php

require_once __DIR__ . '/../Models/Orders.php';

class DashboardController
{

    public function totalProfit(): void
    {
        $period = $_GET['period'] ?? 'month';
        [$currentStart, $prevStart, $prevEnd] = $this->getPeriodDates($period);

        $data = Orders::getTotalProfit($currentStart, $prevStart, $prevEnd);

        $result = [
            'period'         => $period,
            'total_profit'   => number_format($data->total_profit, 2, '.', ''),
            'growth_percent' => number_format($data->growth_percent, 2, '.', ''),
        ];

                    number_format($data->growth_percent, 2, '.', '');

        Response::json($result);
    }

    private function getPeriodDates(string $period): array
    {
        $now = new DateTimeImmutable('now');

        switch ($period) {
            case 'day':
                $currentStart = $now->setTime(0,0)->format('Y-m-d H:i:s');
                $prevStart    = $now->modify('-2 day')->setTime(0,0)->format('Y-m-d H:i:s');
                $prevEnd      = $now->modify('-1 day')->setTime(0,0)->format('Y-m-d H:i:s');
                break;

            case 'week':
                $currentStart = $now->modify('-6 days')->format('Y-m-d 00:00:00');
                $prevStart    = $now->modify('-13 days')->format('Y-m-d 00:00:00');
                $prevEnd      = $now->modify('-6 days')->format('Y-m-d 00:00:00');
                break;

            case 'month':
            default:
                $currentStart = $now->format('Y-m-01 00:00:00');
                $prevStart    = $now->modify('-2 month')->format('Y-m-01 00:00:00');
                $prevEnd      = $now->modify('-1 month')->format('Y-m-01 00:00:00');
                break;
        }

        return [$currentStart, $prevStart, $prevEnd];
    }

    public function ordersList(): void
    {
        // фильтры по дате, если нужны
        $from = $_GET['from'] ?? null;
        $to   = $_GET['to'] ?? null;

        $orders = Orders::getOrdersWithUsersAndProducts($from, $to);

        Response::json($orders);
    }
}
