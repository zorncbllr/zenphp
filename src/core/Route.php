<?php

namespace App\Core;

class Route
{
    public string $path;
    protected Router $router;
    protected array $middlewares;

    function __construct(string $path, Router $router)
    {
        $this->router = $router;
        $this->path = $path;
        $this->middlewares = [];
    }

    function middleware(string ...$middleware): Route
    {
        foreach ($middleware as $md) {
            array_push($this->middlewares, [$md]);
        }

        return $this;
    }

    function get(callable | array ...$resolver)
    {
        $this->router->get($this->path, ...$this->middlewares, ...$resolver);
        return $this;
    }

    function post(callable | array ...$resolver)
    {
        $this->router->post($this->path, ...$this->middlewares, ...$resolver);
        return $this;
    }

    function patch(callable | array ...$resolver)
    {
        $this->router->patch($this->path, $this->middlewares, ...$resolver);
        return $this;
    }

    function put(callable | array ...$resolver)
    {
        $this->router->put($this->path, $this->middlewares, ...$resolver);
        return $this;
    }

    function delete(callable | array ...$resolver)
    {
        $this->router->delete($this->path, $this->middlewares, ...$resolver);
        return $this;
    }
}
