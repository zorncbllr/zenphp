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

    function boot(array $argv)
    {
        $this->database = new Database();
        $this->manager = $this->database->getManager();

        array_shift($argv);

        switch ($argv[0]) {
            case 'migrate':
                $this->migrate();
                break;
            case 'generate':
                $this->generate($argv);
                break;
            case '-g':
                $this->generate($argv);
                break;
        }
    }

    function generate(array $argv)
    {
        if (!$argv[2]) {
            return;
        }

        switch ($argv[1]) {
            case 'controller':
                $this->createController($argv[2]);
                break;
            case 'model':
                $this->createModel($argv[2]);
                break;
            case 'middleware':
                $this->createMiddleware($argv[2]);
                break;
        }
    }

    function createMiddleware(string $middleware)
    {
        $middleware = ucfirst($middleware) . "Middleware";
        $path = parseDir(__DIR__) . "/../../middlewares/$middleware.php";

        file_put_contents(
            $path,
            "<?php

namespace App\Middlewares;

use App\Core\Middleware;
use App\Core\Request;

class $middleware extends Middleware
{
    function callable(Request \$request, callable \$next)
    {
        echo '$middleware';

        return \$next();
    }
}
"
        );
    }

    function createController(string $controller)
    {
        $controller = ucfirst($controller) . "Controller";
        $path = parseDir(__DIR__) . "/../../controllers/$controller.php";

        file_put_contents(
            $path,
            "<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class $controller extends Controller
{
    function index(Request \$request)
    {
        echo \"$controller\";
    }
}
            "
        );
    }

    function createModel(string $model)
    {
        $model = ucfirst($model);
        $path = parseDir(__DIR__) . "/../../models/$model.php";

        file_put_contents(
            $path,
            "<?php

namespace App\Models;

use App\Core\Model;
use Illuminate\Database\Schema\Blueprint;

class $model extends Model
{
    function schema(Blueprint &\$table)
    {
        \$table->id();
        \$table->timestamps();
    }

    protected \$fillable = [];
}
"
        );
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
