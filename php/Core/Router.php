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

    if (!class_exists($controller_namespace)) {
      header("Location: " . APP_URL . "error/notFound");
    }

    $controller = new $controller_namespace;

    if (!method_exists($controller, $method)) {
      header("Location: " . APP_URL . "error/notFound");
    }

    if (!isset($params)) {
      call_user_func(array($controller, $method));
    } else {
      call_user_func_array(array($controller, $method), $params);
    }
  }
}
