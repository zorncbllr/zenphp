<?php

use App\Controllers\HomeController;
use App\Core\Router;

$router = new Router();

$router->get('/', [HomeController::class, 'index']);

$router->get('/test', function () {
    return view('test');
});

$router->catchAll(function () {
    return view('404');
});
