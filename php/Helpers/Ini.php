<?php

namespace App\Helpers;

class Ini
{
    public static function getVariable(string $menu, string $variable)
    {
        $config_file = __DIR__ . '/../../install/config.ini';
        $config = parse_ini_file($config_file, true);

        $space = $config[$menu];
        return $space[$variable];
    }
}
