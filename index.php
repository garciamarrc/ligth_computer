<?php

require __DIR__ . '/vendor/autoload.php';

use App\Helpers\Ini;

define('APP_FOLDER', Ini::getVariable('VARS', 'APP_FOLDER'));
define('APP_URL', Ini::getVariable('VARS', 'APP_URL') . APP_FOLDER);

use App\Core\Request;
use App\Core\Router;

Router::run(new Request());