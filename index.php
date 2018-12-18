<?php 

require 'mvc/utils/autoload.php';
require 'settings.php';

if (DEBUG){
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

use mvc\Router;

session_start();

if (!isset($_SESSION['user_group'])){
    $_SESSION['user_group'] = 'guest';
}

$router = new Router();
$router->run()

?>