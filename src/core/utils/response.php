<?php

function view(string $view, array $data = [])
{
    header("Content-Type: text/html");

    $path = parseDir(__DIR__) . "/../../views/$view.view.php";

    if (!file_exists($path)) {
        throw new Exception("Could not locate view template \"$view.view.php\"", 73044);
    }

    extract($data);
    require $path;
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
