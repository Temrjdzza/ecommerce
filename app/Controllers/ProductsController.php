<?php

require_once __DIR__ . '/../Models/Product.php';


class ProductsController
{
    public function bestSellingProducts(): void
    {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $data = Product::getBestSelling($page, 5);

        Response::json($data);
    }
}
