<?php

class Orders
{
    private static string $table            = 'orders';
    private static string $id_field         = 'id';
    private static string $user_id_field    = 'user_id';
    private static string $product_id_field = 'product_id';
    private static string $quantity_field   = 'quantity';
    private static string $total_price_field= 'total_price';
    private static string $created_at_field = 'created_at';

    public ?float $total_profit    = null;
    public ?float $growth_percent  = null;

    public function __construct(array $data = [])
    {
        if (isset($data['total_profit'])) {
            $this->total_profit = (float)$data['total_profit'];
        }
        if (isset($data['growth_percent'])) {
            $this->growth_percent = (float)$data['growth_percent'];
        }
    }

    /**
     * Возвращает прибыль и процент роста за выбранный период.
     *
     * @param string $currentStart начало текущего периода
     * @param string $prevStart    начало предыдущего периода
     * @param string $prevEnd      конец предыдущего периода
     * @return self|null
     */
    public static function getTotalProfit(string $currentStart, string $prevStart, string $prevEnd): ?self
    {
        $table          = self::$table;
        $priceField     = self::$total_price_field;
        $createdField   = self::$created_at_field;

        $sql = "
            SELECT 
                curr.total_profit AS total_profit,
                CASE
                    WHEN prev.total_profit > 0
                        THEN ((curr.total_profit - prev.total_profit) / prev.total_profit * 100)
                    ELSE 0
                END AS growth_percent
            FROM
                (SELECT COALESCE(SUM($priceField),0) AS total_profit
                   FROM $table
                  WHERE $createdField >= :current_start
                ) AS curr,
                (SELECT COALESCE(SUM($priceField),0) AS total_profit
                   FROM $table
                  WHERE $createdField >= :prev_start
                    AND $createdField < :prev_end
                ) AS prev
        ";

        $result = Database::query($sql, [
            ':current_start' => $currentStart,
            ':prev_start'    => $prevStart,
            ':prev_end'      => $prevEnd,
        ]);

        return !empty($result) ? new self($result[0]) : null;
    }

    public static function getOrdersWithUsersAndProducts(string $from = null, string $to = null): array
    {
        $sql = "
            SELECT
              o.id          AS order_id,
              u.name        AS user_name,
              p.name        AS product_name,
              o.quantity,
              o.total_price,
              o.created_at
            FROM orders o
            LEFT JOIN users u   ON o.user_id   = u.id
            LEFT JOIN products p ON o.product_id = p.id
        ";

        $params = [];
        if ($from && $to) {
            $sql .= " WHERE o.created_at BETWEEN :from AND :to";
            $params = [':from' => $from, ':to' => $to];
        }

        $sql .= " ORDER BY o.created_at DESC";

        return Database::query($sql, $params);

        
    }
}
