<?php

namespace App\Core;

use AllowDynamicProperties;

#[AllowDynamicProperties]
class Request
{
    public string $uri, $method;
    public $param;

    function __construct()
    {
        $this->loadFormData();
        $this->uri = $_SERVER['REQUEST_URI'];
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
