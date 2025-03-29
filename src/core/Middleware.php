<?php

namespace App\Core;

abstract class Middleware
{
    abstract function callable(Request $request, callable $next);
}
