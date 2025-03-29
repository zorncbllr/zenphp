<?php

namespace App\Middlewares;

use App\Core\Middleware;
use App\Core\Request;

class AuthMiddleware extends Middleware
{
    function callable(Request $request, callable $next)
    {
        echo 'AuthMiddleware';

        return $next();
    }
}
