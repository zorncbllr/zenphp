<?php

namespace App\Core;

use eftec\bladeone\BladeOne;

class Blade extends BladeOne
{
    public function __construct()
    {
        $views = parseDir(__DIR__) . '/../views';
        $cache = parseDir(__DIR__) . '/../cache';

        if (!is_dir($views)) {
            mkdir($views);
        }

        if (!is_dir($cache)) {
            mkdir($cache);
        }

        parent::__construct($views, $cache, BladeOne::MODE_AUTO);
    }
}
