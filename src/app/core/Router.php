<?php

declare (strict_types=1);

namespace App\core;

use App\exceptions\RouteNotFoundException;

class Router
{
    private $routes = [];

    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register("GET", $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register("POST", $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    /**
     * @throws RouteNotFoundException
     */
    public function resolve(string $requestURI, string $requestMethod)
    {
        $route = explode('?', $requestURI)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$controller, $method] = $action;

            if (class_exists($controller)) {
                $controller = new $controller();

                if (method_exists($controller, $method)) {
                    return call_user_func_array([$controller, $method], []);
                }
            }
        }
    }
}