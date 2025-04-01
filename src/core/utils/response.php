<?php

use App\Core\Blade;

function view(string $view, array $data = [])
{
    header("Content-Type: text/html");

    $blade = new Blade();

    echo $blade->run($view, $data);
}


function redirect(string $route)
{
    header("Location: $route");
    exit();
}

function json(mixed $value)
{
    header("Content-Type: application/json");

    echo json_encode($value);
    exit();
}

function importComponent(string $component, string $parent = "/views")
{
    $path = parseDir(__DIR__) . '/../../views';

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path)
    );

    foreach ($iterator as $file) {
        if ($file->isFile()) {
            if (
                str_contains($file->getPathname(), $parent) &&
                str_contains($file->getPathname(), $component)
            ) {
                return file_get_contents($file->getPathname());
            }
        }
    }
}

function component(string $component, array $props = [], string $parent = "/views")
{
    $path = parseDir(__DIR__) . '/../../views';


    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path)
    );

    function render($props, $file)
    {
        extract($props);
        require $file;
    }

    foreach ($iterator as $file) {
        if ($file->isFile()) {
            if (
                str_contains($file->getPathname(), $parent) &&
                str_contains($file->getPathname(), $component)
            ) {
                render($props, $file->getPathname());
                return;
            }
        }
    }
}
