<?php

namespace App\Core;

interface HttpMethods
{
    function get(string $route, callable | array ...$resolver);
    function post(string $route, callable | array ...$resolver);
    function patch(string $route, callable | array ...$resolver);
    function put(string $route, callable | array ...$resolver);
    function delete(string $route, callable | array ...$resolver);
}

class Router implements HttpMethods
{
    protected Request $request;
    protected array $middlewares = [];

    public function __construct()
    {
        $this->request = new Request();
    }

    private function requestHandler(string $route, string $method, callable | array ...$resolver)
    {
        $requestPaths = explode('/', $this->request->uri);
        array_shift($requestPaths);

        $routePaths = explode('/', $route);
        array_shift($routePaths);

        if (sizeof($requestPaths) !== sizeof($routePaths)) {
            return;
        }

        $pattern = '/{\w+}/';
        $match = null;

        preg_match($pattern, $route, $match);

        if (str_contains($route, $match[0])) {

            $tempPath = [];

            foreach ($routePaths as $i => $path) {
                preg_match($pattern, $path, $match);

                if ($match[0]) {
                    preg_match('/\w+/', $match[0], $match);

                    $key = $match[0];

                    $this->request->param->$key = htmlspecialchars($requestPaths[$i]);

                    array_push($tempPath, $requestPaths[$i]);

                    continue;
                }

                if ($path !== $requestPaths[$i]) return;

                array_push($tempPath, $path);
            }

            $route = '/' . implode('/', $tempPath);
        }

        if (
            $this->request->uri == $route &&
            $this->request->method == $method
        ) {
            foreach ($resolver as $res) {
                if (is_callable($res)) {
                    call_user_func($res, $this->request);
                    continue;
                }

                $handler = new $res[0]();

                if ($handler instanceof Middleware) {
                    $valid = $handler->callable(
                        $this->request,
                        fn() => true
                    );

                    if ($valid) continue;

                    break;
                }

                if ($handler instanceof Controller) {
                    (new Controller())->call($res, $this->request);
                }
            }

            exit();
        }
    }

    function catchAll(callable | array $resolver)
    {
        if (is_array($resolver)) {
            call_user_func_array([...$resolver], []);
            return;
        }

        call_user_func($resolver, [$this->request]);
    }

    function route(string $route)
    {
        return new Route($route, $this);
    }

    function get(string $route, callable|array ...$resolver)
    {
        $this->requestHandler($route, 'GET', ...$resolver);
    }

    function post(string $route, callable|array ...$resolver)
    {
        $this->requestHandler($route, 'POST', ...$resolver);
    }

    function patch(string $route, callable|array ...$resolver)
    {
        $this->requestHandler($route, 'PATCH', ...$resolver);
    }

    function put(string $route, callable|array ...$resolver)
    {
        $this->requestHandler($route, 'PUT', ...$resolver);
    }

    function delete(string $route, callable|array ...$resolver)
    {
        $this->requestHandler($route, 'DELETE', ...$resolver);
    }
}
