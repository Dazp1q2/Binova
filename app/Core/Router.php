<?php

namespace App\Core;

class Router
{
    protected $routes = [];

    public function __construct()
    {
        $this->routes = require __DIR__ . '/../../routes/web.php';
    }

    public function run()
    {
        $uri = $this->getUri();
        foreach ($this->routes as $route => $action) {
            if ($uri == $route) {
                list($controller, $method) = explode('@', $action);
                $controller = 'App\\Controllers\\' . $controller;
                $controller = new $controller();
                $controller->$method();
                return;
            }
        }
        // 404 response if no route matched
        http_response_code(404);
        echo "404 Not Found";
    }

    protected function getUri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }
}
