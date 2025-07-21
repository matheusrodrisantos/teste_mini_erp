<?php

require  './vendor/autoload.php';

session_start();

use App\Router\Router;

$router = new Router();
$router->dispatch();
