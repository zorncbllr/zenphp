<?php

namespace App\Middlewares;

use App\Core\Middleware;
use App\Core\Request;

class Auth extends Middleware
{
    function callable(Request $request, callable $next)
    {
        echo 'auth middleware';

        return $next();
    }
}
