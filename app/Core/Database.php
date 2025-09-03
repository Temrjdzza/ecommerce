<?php

class Database
{
    private static ?PDO $instance = null;

    // Метод для получения подключения
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            // Читаем настройки из config/database.php
            $config = require __DIR__ . '/../config/database.php';

            $host = $config['host'];
            $db   = $config['database'];
            $user = $config['username'];
            $pass = $config['password'];
            $charset = $config['charset'] ?? 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            try {
                self::$instance = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$instance;
    }

    //метод для выполнения SELECT запроса
    public static function query(string $sql, array $params = []): array
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    // метод для выполнения INSERT/UPDATE/DELETE
    public static function execute(string $sql, array $params = []): bool
    {
        $stmt = self::getInstance()->prepare($sql);
        return $stmt->execute($params);
    }
}
