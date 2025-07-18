<?php 

use FastRoute\RouteCollector;

/** @var RouteCollector $r */

$r->addRoute(
    httpMethod: 'GET', 
    route: '/', 
    handler: 'HomeController@index'
);


$r->addRoute(
    httpMethod: 'GET', 
    route: '/product', 
    handler: 'ProductController@index'
);

$r->addRoute(
    httpMethod: 'POST', 
    route: '/product', 
    handler: 'ProductController@store'
);