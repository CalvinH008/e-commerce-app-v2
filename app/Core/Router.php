<?php

namespace App\Core;

class Router{
    protected array $routes = [
        'GET' => [],
        'POST' => []
    ];
    protected string $basePath = '/e-commerce-app/public';
    protected array $middlewares = [];

    public function middleware(array $middlewares){
        $this->middlewares = $middlewares;
    }

    public function get(string $uri, string $action){
        $this->routes['GET'][$this->normalize($uri)] = $action;
    }

    public function post(string $uri, string $action){
        $this->routes['POST'][$this->normalize($uri)] = $action;
    }

    public function dispatch(){
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if(strpos($uri, $this->basePath) === 0){
            $uri = substr($uri, strlen($this->basePath));
        }
        
        $uri = $this->normalize($uri);

        if(!isset($this->routes[$method][$uri])){
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        foreach($this->middlewares as $middleware){
            $class = "App\\Middleware\\$middleware";

            if(!class_exists($class)){
                die("Middleware $class tidak ditemukan  ");
            }
            (new $class)->handle();
        }

        [$controller, $methodName] = explode('@', $this->routes[$method][$uri]);

        $controllerClass = "App\\Controllers\\$controller";

        if(!class_exists($controllerClass)){
            die("Class $controllerClass tidak ada");
        }

        $instance = new $controllerClass;

        if(!method_exists($instance, $methodName)){
            die("Method $methodName tidak ada di controller $controller");
        }

        $instance->$methodName();
    }

    protected function normalize(string $uri): string{
        return rtrim($uri, '/')?: '/';
    }
}