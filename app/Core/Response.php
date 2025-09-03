<?php

class Response
{
    /**
     * Отправка JSON-ответа
     *
     * @param mixed $data Данные для отправки
     * @param int $status HTTP-статус (по умолчанию 200)
     */
    public static function json($data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Перенаправление на другой URL
     *
     * @param string $url URL для редиректа
     * @param int $status HTTP-статус редиректа (по умолчанию 302)
     */
    public static function redirect(string $url, int $status = 302): void
    {
        http_response_code($status);
        header('Location: ' . $url);
        exit;
    }

    /**
     * Отправка обычного текстового ответа
     *
     * @param string $message Сообщение
     * @param int $status HTTP-статус (по умолчанию 200)
     */
    public static function text(string $message, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: text/plain');
        echo $message;
        exit;
    }

    /**
     * Отправка ошибки в JSON-формате
     *
     * @param string $message Сообщение об ошибке
     * @param int $status HTTP-статус ошибки (по умолчанию 400)
     */
    public static function error(string $message, int $status = 400): void
    {
        self::json(['error' => $message], $status);
    }
}
