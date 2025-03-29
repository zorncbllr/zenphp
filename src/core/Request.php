<?php

namespace App\Core;

use AllowDynamicProperties;

#[AllowDynamicProperties]
class Request
{
    public string $uri, $method;
    public Param $param;

    function __construct()
    {
        $this->loadFormData();
        $uri = str_replace("/index.php", "", $_SERVER['PHP_SELF']);
        $this->uri = empty($uri) ? "/" : $uri;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->param = new Param();
    }

    private function loadFormData()
    {
        foreach ($_REQUEST as $key => $value) {
            $this->$key = htmlspecialchars($value);
        }
    }
}

#[AllowDynamicProperties]
class Param {}
