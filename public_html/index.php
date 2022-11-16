<?php

require __DIR__ . '/../vendor/autoload.php';

include __DIR__ . '/../php/Helpers/View.php';

use App\Core\Request;
use App\Core\Router;

Router::run(new Request());