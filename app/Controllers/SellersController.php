<?php

require_once __DIR__ . '/../Models/Seller.php';

class SellersController
{
    public function topSellers(): void
    {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

        $data = Seller::getTopSellers($page, 5);

        Response::json($data);
    }
}
