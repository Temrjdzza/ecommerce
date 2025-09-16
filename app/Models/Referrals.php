<?php

class Referrals {

    public static function getReferrals(string $date): array
    {
        $sql = "
            SELECT 
            channel,
            clicks,
            ROUND(clicks / SUM(clicks) OVER() * 100, 2) AS percentage
            FROM property_referrals
            WHERE report_date = :date
            ORDER BY clicks DESC;
        ";

        return Database::query($sql, [':date' => $date]);
    }
}