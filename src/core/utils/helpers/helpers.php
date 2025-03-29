<?php

function parseDir(string $dir): string
{
    return str_replace("\\", "/", $dir);
}

function dump(mixed $variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}
