<?php

namespace App\Core\Cli;

use App\Core\Database;
use DirectoryIterator;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

class Kernel
{
    protected Database $database;
    protected Manager $manager;

    function boot($argv)
    {
        $this->database = new Database();
        $this->manager = $this->database->getManager();

        array_shift($argv);

        if ($argv[0] == "migrate") {
            return $this->migrate();
        }
    }

    function migrate()
    {
        $dir = parseDir(__DIR__) . '/../../models';

        $iterator = new DirectoryIterator($dir);

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $model = strtolower($file->getBasename('.php'));

                $this->manager->schema()->dropIfExists("{$model}s");

                $this->manager->schema()->create(
                    "{$model}s",
                    function (Blueprint $table) use ($model) {
                        echo "Running migrations for " . ucfirst($model) . "...\n";

                        $modelClass = "App\\Models\\" . ucfirst($model);

                        (new $modelClass())->schema($table);

                        echo "Created table for " . ucfirst($model) . ".\n";
                    }
                );
            }
        }
    }
}
