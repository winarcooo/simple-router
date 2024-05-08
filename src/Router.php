<?php

namespace Winarcooo\SimpleRouter;

use Exception;
class Router implements RouterInterface {
    protected array $routes = [];

    public function add(string $method, string $uri, callable|array $target): void
    {
        $this->routes[$method][$uri] = $target;
    }

    /**
     * @throws Exception
     */
    public function matcher(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        if (isset($this->routes[$requestMethod])) {
            foreach ($this->routes[$requestMethod] as $routeUri => $target) {

                $pattern = preg_replace('/\/:([^\/]+)/', '/(?P<$1>[^/]+)', $routeUri);

                if (preg_match('#^' . $pattern . '$#', $requestUri, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY); // Only keep named subpattern matches

                    if (is_callable($target)) {
                        call_user_func_array($target, $params);
                    }

                    if (is_array($target) && count($target) == 2 && is_string($target[0]) && is_string($target[1])) {
                        [$class, $method] = $target;

                        if (!class_exists($class)) {
                            throw new Exception("class doesn't exist");
                        }

                        if (!method_exists($class, $method)) {
                            throw new Exception("Method doesn't exist");
                        }

                        $instance = new $class();
                        call_user_func_array([$instance, $method], $params);
                    }

                    return;
                }
            }
        }

        throw new Exception('Route not found');
    }

    public function list(): array
    {
        return $this->routes;
    }
}