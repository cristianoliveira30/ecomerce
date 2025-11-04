<?php

class Router
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // remove o prefixo /public se existir
        $uri = str_replace('/public', '', $uri);

        $callback = $this->routes[$method][$uri] ?? null;

        if (!$callback) {
            $this->renderView('not-found', ['title' => 'Página não encontrada']);
            return;
        }

        if (is_callable($callback)) {
            echo call_user_func($callback);
        } elseif (is_string($callback)) {
            // exemplo: "HomeController@index"
            [$controller, $method] = explode('@', $callback);
            $controllerPath = __DIR__ . '/../Controllers/' . $controller . '.php';

            if (!file_exists($controllerPath)) {
                $this->renderView('not-found', ['title' => 'Controller não encontrado']);
                return;
            }

            require_once $controllerPath;
            $controllerInstance = new $controller();
            echo call_user_func([$controllerInstance, $method]);
        }
    }

    public function renderView($view, $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        include __DIR__ . '/../Views/layouts/header.php';
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "<p>⚠️ View <strong>{$view}</strong> não encontrada.</p>";
        }
        include __DIR__ . '/../Views/layouts/footer.php';
    }
}
