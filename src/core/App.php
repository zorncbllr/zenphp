<?php

namespace App\Core;

class App
{
    function start()
    {
        $database = new Database();

        require_once parseDir(__DIR__) . '/../routes/routes.php';
    }
}
