<?php

require_once __DIR__ . '/../Models/TrafficSource.php';

class TrafficSourceController
{
    public function traffic(): void
    {
        // Получаем параметры
        $sortBy = $_GET['sort_by'] ?? 'report';
        $date   = $_GET['date'] ?? date('Y-m-d');

        $data = TrafficSource::getVisitsBySource($date, $sortBy);

        // Вычисляем общую сумму визитов
        $total_visits = array_sum(array_column($data, 'total_visits'));

        // Вычисляем проценты для каждого источника и добавляем их в массив
        foreach ($data as &$item) {
            $percentage = ($item['total_visits'] / $total_visits) * 100;
            $item['percentage'] = number_format($percentage, 2, '.', '');
        }

        Response::json($data);
    }
}