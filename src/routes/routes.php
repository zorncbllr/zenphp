<?php

use App\Controllers\RootController;
use App\Core\Router;

$router = new Router();

$router->get('/', [RootController::class, 'index']);


$router->catchAll(function () {
    return view('404');
});
