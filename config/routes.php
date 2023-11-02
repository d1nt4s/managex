<?php 

/** @var $router */

$router->get('', 'index.php');
$router->post('pomodoro', 'pomodoro.php');
$router->post('timetable', 'timetable.php');
$router->post('timenetto', 'timenetto/timenetto.php');
