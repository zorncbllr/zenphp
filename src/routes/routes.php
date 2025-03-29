<?php

use App\Controllers\RootController;
use App\Core\Router;
use App\Middlewares\AuthMiddleware;

$router = new Router();

$router
    ->route('/')
    ->middleware(AuthMiddleware::class)
    ->get([RootController::class, 'index'])
    ->post([RootController::class, 'create']);


$router->catchAll(function () {
    return view('404');
});
