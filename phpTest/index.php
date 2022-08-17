<?php 



//FRONT CONTROLLER

// 1 General settings
ini_set('display_errors', 1);
error_reporting(E_ALL);


// 2 Include system file
define('ROOT', dirname(__FILE__));
require_once(ROOT.'\components\Router.php');


// 4 Call Router
$router = new Router;
$router->run(); 