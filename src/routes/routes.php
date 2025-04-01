<?php

use App\Controllers\HomeController;
use App\Core\Router;

$router = new Router();

$router->get('/', [HomeController::class, 'index']);


$router->catchAll(function () {
    return view('404');
});
