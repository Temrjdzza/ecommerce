<?php

class Router
{
    private array $getRoutes = [];
    private array $postRoutes = [];

    // Регистрируем GET маршрут
    public function get(string $uri, callable|string $action): void
    {
        $this->getRoutes[$this->normalize($uri)] = $action;
    }

    // Регистрируем POST маршрут
    public function post(string $uri, callable|string $action): void
    {
        $this->postRoutes[$this->normalize($uri)] = $action;
    }

    // Отправка запроса
    public function dispatch(string $uri, string $method): void
    {
        $uri = $this->normalize($uri);

        $routes = $method === 'POST' ? $this->postRoutes : $this->getRoutes;

        if (!isset($routes[$uri])) {
            http_response_code(404);
            echo "404 Not Found!";
            return;
        }

        $action = $routes[$uri];

        if (is_callable($action)) {
            call_user_func($action);
        } elseif (is_string($action)) {
            // Формат строки: Controller@method
            [$controllerName, $methodName] = explode('@', $action);
            $controllerFile = __DIR__ . '/../Controllers/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                } else {
                    echo "Method $methodName not found in $controllerName";
                }
            } else {
                echo "Controller $controllerName not found";
            }
        }
    }

    // Убираем слэши в начале/конце
    private function normalize(string $uri): string
    {
        $uri = parse_url($uri, PHP_URL_PATH); // убираем GET-параметры
        return rtrim($uri, '/') ?: '/';
    }
}