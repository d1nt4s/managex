<?php

namespace myfrm;

class Router
{

  protected $routes = [];
  protected $uri;
  protected $method;

  public function __construct()
  {
    $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
    $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
  }

  public function match()
  {
    $matches = false;
    foreach ($this->routes as $route) {
      if (($route['uri'] === $this->uri) && (in_array($this->method, $route['method']))) {
        
        require CONTROLLERS . "/{$route['controller']}";
        $matches = true;
        break;
      }
    }
    if (!$matches) {
      abort();
    }
  }

  public function add($uri, $controller, $method)
  {
    if (is_array($method)) {
      $method = array_map('strtoupper', $method); // для каждого элемента массива выполняется функция strtoupper(), можно использовать свою функцию
    } else {
      $method = [$method]; // обернем $method (в данном случае строка) в массив
    }
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method,
    ];
    return $this;
  }

  public function get($uri, $controller)
  {
    return $this->add($uri, $controller, 'GET');
  }

  public function post($uri, $controller)
  {
    return $this->add($uri, $controller, 'POST');
  }

  public function delete($uri, $controller)
  {
    return $this->add($uri, $controller, 'DELETE');
  }
}