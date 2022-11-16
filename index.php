<?php

require __DIR__ . '/vendor/autoload.php';

define('APP_URL', 'http://localhost/ligth_agency/');

use App\Core\Request;
use App\Core\Router;

Router::run(new Request());