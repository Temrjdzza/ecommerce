<?php
// Включаем ошибки для отладки (можно убрать в production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Загружаем ядро
require_once __DIR__ . '/app/Core/Router.php';
require_once __DIR__ . '/app/Core/Database.php';
require_once __DIR__ . '/app/Core/Response.php';

// Инициализируем роутер
$router = new Router();

// Подключаем маршруты
require_once __DIR__ . '/app/Routes/api.php';

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
