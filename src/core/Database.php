<?php

namespace App\Core;

use DirectoryIterator;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

class Database
{
    protected Manager $manager;

    function __construct()
    {
        $this->manager = new Manager();

        $this->manager->addConnection([
            'driver' => 'mysql',
            'host' => $_ENV['DATABASE_HOST'],
            'port' => $_ENV['DATABASE_PORT'],
            'database' => $_ENV['DATABASE_NAME'],
            'username' => $_ENV['DATABASE_USER'],
            'password' => $_ENV['DATABASE_PASSWORD'],
            'charset' => 'utf8mb4',
            'prefix' => ''
        ]);

        $this->manager->setAsGlobal();
        $this->manager->bootEloquent();
    }

    function getManager(): Manager
    {
        return $this->manager;
    }
}
