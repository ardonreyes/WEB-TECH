<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Auth::loginPage');
$routes->get('/register', 'Auth::registerPage');
$routes->get('/forget', 'Auth::forgetPage');

$routes->post('/', 'Auth::login');
$routes->post('/register', 'Auth::register');
$routes->post('/forget', 'Auth::forget');