<?php

namespace App\Models;

use App\Core\Model;
use Illuminate\Database\Schema\Blueprint;

class User extends Model
{
    function schema(Blueprint &$table)
    {
        $table->id();
        $table->string('fullname');
        $table->string('email');
        $table->string('password');
        $table->timestamps();
    }

    protected $fillable = ['name', 'email', 'password'];
}
