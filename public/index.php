<?php

use base\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require dirname(__DIR__) . '/config/config.php';
require CORE . '/funcs.php';
// require CORE . '/classes/Router.php';

$router = new Router();
require CONFIG . '/routes.php';
$router->match();