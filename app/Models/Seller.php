<?php
class Seller
{
    public static function getTopSellers(int $page = 1, int $perPage = 5): array
    {
        $offset = ($page - 1) * $perPage;

        // --- получаем список продавцов ---
        $sql = "
            SELECT id, name, rating, total_sales
            FROM sellers
            ORDER BY total_sales DESC
            LIMIT :limit OFFSET :offset
        ";

        $items = Database::query ($sql, [
            ':limit' => $perPage,
            ':offset'=> $offset
        ]);

        // --- считаем общее количество ---
        $res   = Database::query("SELECT COUNT(*) AS cnt FROM sellers");
        $total = isset($res[0]['cnt']) ? (int)$res[0]['cnt'] : 0;

        $pages = ceil($total / $perPage);

        return [
            'page'        => $page,
            'per_page'    => $perPage,
            'total_items' => $total,
            'total_pages' => $pages,
            'items'       => $items,
        ];
    }
}
