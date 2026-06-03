<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->group('api', function($routes) {
    $routes->options('(:any)', 'Home::index');

    $routes->resource('vocab', ['controller' => 'VocabController']);
    
});