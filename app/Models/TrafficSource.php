<?php

class TrafficSource
{
    public static function getVisitsBySource(string $date, string $sortBy): array
    {
        // Сопоставление вариантов сортировки с SQL
        $allowedSorts = [
            'report'      => 'total_visits DESC',
            'alphabet'    => 'source ASC',
            'visits_desc' => 'total_visits DESC',
            'visits_asc'  => 'total_visits ASC'
        ];

        $orderBy = $allowedSorts[$sortBy] ?? $allowedSorts['report'];

        $sql = "
            SELECT source, SUM(visits) AS total_visits
            FROM traffic_sources
            WHERE report_date = :date
            GROUP BY source
            ORDER BY $orderBy
        ";

        return Database::query($sql, [':date' => $date]);
    }
}