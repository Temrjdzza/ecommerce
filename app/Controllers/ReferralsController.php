<?php

require_once __DIR__ . '/../Models/Referrals.php';

class ReferralsController {

    public function referrals(): void
    {
        // Получаем параметры
        $date   = $_GET['date'] ?? date('Y-m-d');

        $data = Referrals::getReferrals($date);   

        Response::json($data);
    }
}