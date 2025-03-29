<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager;

class Database
{
    protected Manager $manager;

    function __construct()
    {
        $this->manager->addConnection([
            'driver' => 'mysql',
            'host' => $_ENV['DATABASE_HOST'],
            'port' => $_ENV['DATABASE_PORT'],
            'database' => $_ENV['DATABASE_NAME'],
            'username' => $_ENV['DATABASE_USER'],
            'password' => $_ENV['DATABASE_PASSWORD'],
            'charset' => 'utf8mb4',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]);

        $this->manager->setAsGlobal();
        $this->manager->bootEloquent();
    }
}
