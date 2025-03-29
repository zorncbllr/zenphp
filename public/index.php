<?php

session_start();

use App\Core\App;

require_once str_replace("\\", "/", __DIR__) . '/../vendor/autoload.php';

$app = new App();
$app->start();
