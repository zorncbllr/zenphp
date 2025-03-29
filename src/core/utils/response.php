<?php

function view(string $view, array $data = [])
{
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
