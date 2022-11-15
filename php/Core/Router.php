<?php

namespace App\Core;

class Router
{
  public static function run(Request $request)
  {
    $controller = $request->getController() . 'Controller';
    $method = $request->getMethod();
    $arg = $request->getArg();

    $controller_namespace = "App\\Controllers\\" . $controller;
    $controller = new $controller_namespace;

    if (!isset($arg)) {
      call_user_func($controller, $method);
    } else {
      call_user_func_array(array($controller, $method), $arg);
    }
  }
}
