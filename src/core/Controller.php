<?php

namespace App\Core;

class Controller
{
    function call(array $resolver, Request $request)
    {
        call_user_func_array(
            [new $resolver[0], $resolver[1]],
            [$request]
        );
    }
}
