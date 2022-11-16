<?php

namespace App\Core;

class Router
{
  public static function run(Request $request)
  {
    $controller = $request->getController() . 'Controller';
    $method = $request->getMethod();
    $params = $request->getParams();

    $controller_namespace = "App\\Controllers\\" . $controller;
    $controller = new $controller_namespace;

    if (!isset($params)) {
      call_user_func(array($controller, $method));
    } else {
      call_user_func_array(array($controller, $method), $params);
    }
  }
}
