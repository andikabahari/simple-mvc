<?php

define('BASE_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH.'app'.DIRECTORY_SEPARATOR);
define('MODEL_PATH', APP_PATH.'Models'.DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', APP_PATH.'Controllers'.DIRECTORY_SEPARATOR);
define('VIEW_PATH', APP_PATH.'Views'.DIRECTORY_SEPARATOR);

require_once APP_PATH.'DB.php';
require_once APP_PATH.'Route.php';
require_once APP_PATH.'config.php';

$route = new Route($config);

$route->get('/', ['BaseController' => 'home']);
$route->get('/home', ['BaseController' => 'home']);
$route->get('/contact', ['BaseController' => 'contact']);

// print_r($route);
// print_r($route->getRoutes);
// print_r($route->postRoutes);

$route->route();
