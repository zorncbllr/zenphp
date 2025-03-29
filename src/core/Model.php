<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Schema\Blueprint;

abstract class Model extends EloquentModel
{
    abstract function schema(Blueprint &$table);
}
