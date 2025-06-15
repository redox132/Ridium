<?php

declare(strict_types = 1);

namespace App;

class Router
{
    private array $routes = [];

    public function get(string $uri, array|string $controller): void
    {
        $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, array|string $controller): void
    {
        $this->add('POST', $uri, $controller);
    }
    
    public function put(string $uri, array|string $controller): void
    {
        $this->add('PUT', $uri, $controller);
    }

    public function delete(string $uri, array|string $controller): void
    {
        $this->add('DELETE', $uri, $controller);
    }

    public function patch(string $uri, array|string $controller): void
    {
        $this->add('PATCH', $uri, $controller);
    }
   

    private function add(string $method, string $uri, array|string $controller): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => trim($uri, '/'),
            'controller' => $controller,
        ];
    }

    public function route(string $uri, string $method): mixed
    {
        $uri = trim($uri, '/');
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                if (is_array($route['controller'])) {
                    [$class, $action] = $route['controller']; 

                    if (class_exists($class) && method_exists($class, $action)) {
                        return (new $class)->$action();
                    }

                    throw new \Exception("Controller or method not found: $class@$action");
                }

                if (is_string($route['controller'])) {
                    return view($route['controller']);
                }
            }
        }

        // Optional: Default 404 behavior
        http_response_code(404);
        echo "404 Not Found";
        exit;
    }
}
