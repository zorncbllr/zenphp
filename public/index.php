<?php

session_start();

use App\Core\App;
use Dotenv\Dotenv;

require_once str_replace("\\", "/", __DIR__) . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(parseDir(__DIR__) . '/../');
$dotenv->load();

$app = new App();
$app->start();
