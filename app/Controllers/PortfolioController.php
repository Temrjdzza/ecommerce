<?php

require_once __DIR__ . '/../Models/Portfolio.php';

class PortfolioController
{
    function getUserId(): int
    {
        $user_id = $_GET['user_id'] ?? 1;
        if (!$user_id) {
            Response::error("Не указан user_id");
        }
        return (int)$user_id;
    }

    function loadPortfolio(int $user_id): array
    {
        $portfolios = Portfolio::getPortfolio($user_id);
        if (!$portfolios) {
            Response::json([]);
        }
        return $portfolios;
    }

    function fetchCoinPrices(array $crypto_ids, string $currency = 'usd'): array
    {
        $id_string = implode(',', $crypto_ids);
        $url = "https://api.coingecko.com/api/v3/simple/price?ids={$id_string}&vs_currencies={$currency}&include_24hr_change=true";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Таймаут 5 секунд
        $json_data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code !== 200 || $json_data === FALSE) {
            Response::error("Не удалось получить данные с CoinGecko API. Код: {$http_code}");
        }

        $price_data = json_decode($json_data, true);
        return $price_data;
    }

    function formatPortfolioData(array $portfolios, array $price_data, string $currency = 'usd'): array
    {
        $result = [];
        foreach ($portfolios as $portfolio) {
            $crypto_id = $portfolio['crypto_id'];

            $price = $price_data[$crypto_id][$currency] ?? 0;
            $change = $price_data[$crypto_id]["{$currency}_24h_change"] ?? 0;
            $total_balance = $price * $portfolio['amount'];

            $result[] = [
                'Name' => $crypto_id,
                'price' => number_format($price, 2, '.', ''),
                'change_24h' => number_format($change, 2, '.', ''),
                'total_balance' => number_format($total_balance, 2, '.', ''),
                'TotalCoin' => $portfolio['amount'],
            ];
        }
        return $result;
    }

    function sortPortfolio(array $data): array
    {
        $sortBy = $_GET['sort_by'] ?? null;
        $order = strtolower($_GET['order'] ?? 'asc');
        $allowedSortFields = ['Name', 'price', 'change_24h', 'total_balance', 'TotalCoin'];

        if ($sortBy && in_array($sortBy, $allowedSortFields)) {
            usort($data, function ($a, $b) use ($sortBy, $order) {
                $valueA = $a[$sortBy];
                $valueB = $b[$sortBy];

                if ($sortBy === 'Name') {
                    $cmp = strcmp($valueA, $valueB);
                } else {
                    $cmp = $valueA <=> $valueB;
                }

                return ($order === 'desc') ? -$cmp : $cmp;
            });
        }
        return $data;
    }

    public function getPortfolio()
    {
        // 1. Получение и валидация user_id, номера страницы и лимита
        $user_id = $this->getUserId();
        $page = $_GET['page'] ?? 1;
        $limit = 5; // Устанавливаем лимит 5 элементов на страницу
        $offset = ($page - 1) * $limit;

        // 2. Получение общего количества записей
        $total_records = Portfolio::countUserPortfolios($user_id);
        if ($total_records == 0) {
            Response::json([
                'page' => (int)$page,
                'per_page' => $limit,
                'total_items' => 0,
                'total_pages' => 0,
                'items' => []
            ]);
        }

        // 3. Загрузка портфолио для текущей страницы
        $portfolios = Portfolio::getPortfolio($user_id, $limit, $offset);

        // 4. Получение цен с CoinGecko API
        $crypto_ids = array_column($portfolios, 'crypto_id');
        $price_data = $this->fetchCoinPrices($crypto_ids);
        
        // 5. Форматирование данных
        $formatted_data = $this->formatPortfolioData($portfolios, $price_data);
        $sorted_data = $this->sortPortfolio($formatted_data);

        // 6. Формирование данных для пагинации
        $total_pages = ceil($total_records / $limit);

        // 7. Отправка ответа клиенту в требуемом формате
        Response::json([
            'page' => (int)$page,
            'per_page' => $limit,
            'total_items' => (int)$total_records,
            'total_pages' => (int)$total_pages,
            'items' => $sorted_data
        ]);
    }
}
