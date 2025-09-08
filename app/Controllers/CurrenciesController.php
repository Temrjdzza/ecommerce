<?php

class CurrenciesController {

    private function get_crypto_history($crypto_id, $vs_currency, $from_date, $to_date) {
        // Преобразуем даты в UNIX-время
        $from_timestamp = strtotime($from_date);
        $to_timestamp = strtotime($to_date);
        
        // Формируем URL-запрос
        $url = "https://api.coingecko.com/api/v3/coins/{$crypto_id}/market_chart/range?vs_currency={$vs_currency}&from={$from_timestamp}&to={$to_timestamp}";
        
        // Получаем JSON-данные
        $json_data = @file_get_contents($url);
        
        if ($json_data === FALSE) {
            return "Ошибка: не удалось получить данные.";
        }
        
        return $json_data;
    }

    /**
     * Возвращает диапазон дат на основе заданного периода.
     *
     * @param string $sort_by 'day', 'week', или 'month'.
     * @return array Массив из двух элементов: [дата_начала, дата_конца].
     */
    private function get_date_range($sort_by) {
        $end_date = date('Y-m-d H:00');
        
        switch ($sort_by) {
            case 'week':
                $start_date = date('Y-m-d', strtotime('-7 days'));
                break;
            case 'month':
                $start_date = date('Y-m-d', strtotime('-30 days'));
                break;
            case 'day':
            default:
                $start_date = date('Y-m-d H:00', strtotime('-1 day'));
                break;
        }
        
        return [$start_date, $end_date];
    }

    private function convertCrypto($crypto) {
        $result = '';
        if($crypto == 'bts') $result = 'bitcoin';
        if($crypto == 'xrp') $result = 'ripple';
        if($crypto == 'eth') $result = 'ethereum';
        if($crypto == 'zec') $result = 'zcash';

        return $result;
    }
    
    public function getCurrenciesHistory() {
        $currency = 'usd';
        $crypto_id = $_REQUEST['crypto_id'] ?? '';

        if (!in_array($crypto_id, ['bts', 'xrp', 'eth', 'zec'])) {
            Response::error('Выбрана неправильная валюта (bts, xrp, eth, zec)');
        }

        $crypto_id = $this->convertCrypto($crypto_id);
        
        // Получаем параметр сортировки
        $sort_by = $_GET['sort_by'];
        if (!in_array($sort_by, ['week', 'day', 'month'])) {
            Response::error('Выбрана неправильная сортировка (week, day, month)');
        }

        // Определяем диапазон дат
        [$start_date, $end_date] = $this->get_date_range($sort_by);

        $history_json = $this->get_crypto_history($crypto_id, $currency, $start_date, $end_date);

        if (strpos($history_json, 'Ошибка') !== false) {
            Response::error($history_json);
        }

        $history = json_decode($history_json, true);
        
        $temp_history = [];
        if (isset($history['prices']) && is_array($history['prices'])) {
            foreach ($history['prices'] as $price_data) {
                $timestamp_ms = $price_data[0];
                $price = $price_data[1];

                $timestamp_s = (int)($timestamp_ms / 1000);
                
                $format_string = '';
                switch ($sort_by) {
                    case 'month':
                        $format_string = 'Y-m-d';
                        break;
                    case 'week':
                        $format_string = 'Y-m-d';
                        break;
                    case 'day':
                    default:
                        $format_string = 'Y-m-d H:00';
                        break;
                }
                
                $period = date($format_string, $timestamp_s);

                if (!isset($temp_history[$period])) {
                    $temp_history[$period] = [
                        'prices' => [],
                        'timestamp' => $timestamp_s
                    ];
                }
                
                $temp_history[$period]['prices'][] = $price;
            }
        }
        
        $formatted_history = [];
        foreach ($temp_history as $period => $data) {
            $average_price = array_sum($data['prices']) / count($data['prices']);
            
            $display_date_format = 'd.m.Y';
            if ($sort_by === 'day') {
                $display_date_format = 'd.m.Y H:i';
            }

            $display_date = date($display_date_format, $data['timestamp']);

            $rounded_price = number_format($average_price, 2, '.', '');

            $formatted_history[] = [
                'date' => $display_date,
                'price' => $rounded_price,
            ];
        }

        Response::json($formatted_history);
    }
}