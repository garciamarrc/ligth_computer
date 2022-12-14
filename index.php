<?php

require __DIR__ . '/vendor/autoload.php';

use App\Helpers\Ini;

define('APP_FOLDER', Ini::getVariable('VARS', 'APP_FOLDER'));
define('APP_URL', Ini::getVariable('VARS', 'APP_URL') . APP_FOLDER);
define('APP_NAME', 'Ligth Computer');

use App\Core\Request;
use App\Core\Router;

try {
    Router::run(new Request());
} catch (\Throwable $th) {
    header("Location: " . APP_URL . "error/internalError");
}