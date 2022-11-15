<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Request;
use App\Core\Router;

Router::run(new Request());