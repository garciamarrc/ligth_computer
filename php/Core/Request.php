<?php

namespace App\Core;

class Request
{
  private string $controller;
  private string $method;
  private $params;

  public function __construct()
  {
    if (isset($_GET['url'])) {
      $route = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
      $route = explode('/', $route);
      $route = array_filter($route);

      $this->controller = ucfirst(strtolower(array_shift($route)));
      $this->method = strtolower(array_shift($route));
      $this->params = $route;

      if (!$this->controller) $this->controller = 'Home';
      if (!$this->method) $this->method = 'index';
    } else {
      $this->controller = 'Home';
      $this->method = 'index';
    }
  }

  public function getController()
  {
    return $this->controller;
  }

  public function getMethod()
  {
    return $this->method;
  }

  public function getParams()
  {
    return $this->params;
  }
}
