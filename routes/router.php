<?php
class Router
{
    private $routes = [];

    public function get($route, $callback)
    {
        $this->routes['GET'][$route] = $callback;
    }

    public function post($route, $callback)
    {
        $this->routes['POST'][$route] = $callback;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        foreach ($this->routes[$method] as $route => $callback) {
            if ($uri === $route) {
                if (is_callable($callback)) {
                    call_user_func($callback);
                } else {
                    list($controller, $method) = explode('@', $callback);
                    require_once "app/controllers/$controller.php";
                    $controller = new $controller();
                    $controller->$method();
                }
                return;
            }
        }

        // 404 nếu không khớp route
        require 'app/views/404.php';
        exit();
    }
}
