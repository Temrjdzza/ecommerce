<?php

class Product
{
    public static function getBestSelling(int $page = 1, int $perPage = 5): array
    {
        $offset = ($page - 1) * $perPage;

        $sql = "
            SELECT id, name, total_sold, price, stock
            FROM products
            ORDER BY total_sold DESC
            LIMIT :limit OFFSET :offset
        ";

        $items = Database::query ($sql, [
            ':limit' => $perPage,
            ':offset'=> $offset
        ]);

        // чтобы знать общее количество страниц:
        $result = Database::query("SELECT COUNT(*) FROM products");
        $total  = isset($result[0]["COUNT(*)"]) ? (int)$result[0]["COUNT(*)"] : 0;

        $pages = ceil((int)$total / $perPage);

        return [
            'page'        => $page,
            'per_page'    => $perPage,
            'total_items' => (int) $total,
            'total_pages' => $pages,
            'items'       => $items,
        ];
    }
}