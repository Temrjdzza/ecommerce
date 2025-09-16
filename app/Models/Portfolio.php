<?php

class Portfolio {

    public static function getPortfolio($user_id, $limit, $offset) {
        $sql = "
            SELECT id, crypto_id, amount
            FROM portfolios
            WHERE user_id = :user_id
            LIMIT :limit OFFSET :offset
        ";

        return Database::query($sql, [
            ':user_id' => $user_id,
            ':limit'   => $limit,
            ':offset'  => $offset
        ]);
    }

    public static function countUserPortfolios($user_id) {
        $sql = "
            SELECT COUNT(*) AS total
            FROM portfolios
            WHERE user_id = :user_id
        ";
        $result = Database::query($sql, [':user_id' => $user_id]);
        return $result[0]['total'] ?? 0;
    }
}