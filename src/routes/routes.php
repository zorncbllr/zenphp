<?php

use App\Controllers\RootController;
use App\Core\Router;

$router = new Router();

$router
    ->route('/')
    ->get([RootController::class, 'index'])
    ->post([RootController::class, 'create']);


$router->catchAll(function () {
    return view('404');
});
