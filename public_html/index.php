<?php

require __DIR__ . '/../vendor/autoload.php';

$controller = $_GET['controller'];
$action = $_GET['action'];
$id = $_GET['id'];

$controller_name = ucfirst($controller) . "Controller";

$ctrl = new $controller_name;

$ctrl->$action();
