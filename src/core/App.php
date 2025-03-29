<?php

namespace App\Core;

class App
{
    function start()
    {
        require_once parseDir(__DIR__) . '/../routes/routes.php';
    }
}
