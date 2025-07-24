<?php

declare(strict_types=1);

/*
    this file is part of th
*/

namespace App;

class Router
{
    private array $routes = [];
    private array $numberConstraints = [];
    private $fallbackHandler = null;

    private function add(string $method, string $uri, array|string|callable $controller): void
    {
        $uri = trim($uri, '/');
        $paramNames = [];

        // Convert URI like /jobs/{id} to regex
        $regex = preg_replace_callback('/\{(\w+)\}/', function ($matches) use (&$paramNames) {
            $paramNames[] = $matches[1];
            return '([^/]+)';
        }, $uri);

        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'controller' => $controller,
            'regex' => '#^' . $regex . '$#',
            'params' => $paramNames
        ];
    }

    public function get(string $uri, array|string|callable $controller)
    {
        $this->add('GET', $uri, $controller);
        return $this;
    }

    public function whereNumber(string ...$paramNames): static
    {
        foreach ($paramNames as $name) {
            $this->numberConstraints[$name] = true;
        }
        return $this;
    }

    public function post(string $uri, array|string|callable $controller): void
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

    public function fallback(callable $handler): void
    {
        $this->fallbackHandler = $handler;
    }

    public function view(string $uri, string $view, mixed $data = []): void
    {
        if ($_SERVER['REQUEST_URI'] !== $uri) {
            return;
        }

        $viewPath = __DIR__ . "/../resources/views/{$view}.blade.php";

        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo "View '{$view}.blade.php' not found.";
            exit;
        }

        if (is_array($data)) {
            extract($data);
        }

        require $viewPath;
        exit;
    }

    public function route(string $uri, string $method): mixed
    {
        $uri = trim($uri, '/');
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['regex'], $uri, $matches)) 
            {
                array_shift($matches); // Remove the full match from the beginning of the matches array

                $params = array_combine($route['params'], $matches) ?: [];

                // Validate numeric constraints
                foreach ($params as $key => $value) 
                {
                    if (isset($this->numberConstraints[$key]) && !is_numeric($value)) 
                    {
                        http_response_code(404);
                        echo "404 Not Found";
                        throw new \InvalidArgumentException("Route parameter '{$key}' must be a number. Got: '{$value}'");
                        exit;
                    }
                }

                if (is_array($route['controller']))
                {
                    [$class, $action] = $route['controller'];

                    if (class_exists($class) && method_exists($class, $action)) 
                    {
                        return (new $class)->$action(...array_values($params));
                    }

                    throw new \Exception("Controller or method not found: $class@$action");
                }

                if (is_callable($route['controller']))
                {
                    return call_user_func_array($route['controller'], array_values($params));
                }

                if (is_string($route['controller']))
                {
                    return view($route['controller'], $params);
                }
            }
        }

        if ($this->fallbackHandler) {
            call_user_func($this->fallbackHandler);
        } 
        else
        {
            echo "404 Not Found";
        }

        http_response_code(404);
        exit;
    }
}
