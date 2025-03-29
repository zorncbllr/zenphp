<?php

namespace App\Core;

use AllowDynamicProperties;

#[AllowDynamicProperties]
class Request
{
    public string $uri, $method;
    public Param $param;
    public Body $body;

    function __construct()
    {
        $this->loadFormData();

        $uri = str_replace("/index.php", "", $_SERVER['PHP_SELF']);

        $this->uri = empty($uri) ? "/" : $uri;
        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->param = new Param();
        $this->body = new Body();

        $this->loadBodyData();
    }

    private function loadFormData()
    {
        foreach ($_REQUEST as $key => $value) {
            $this->$key = htmlspecialchars($value);
        }
    }

    private function loadBodyData()
    {
        $data = (array) json_decode(
            file_get_contents("php://input")
        );

        foreach ($data as $key => $value) {
            $this->body->$key = htmlspecialchars($value);
        }
    }
}

#[AllowDynamicProperties]
class Param {}

#[AllowDynamicProperties]
class Body {}
