<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Auth Section
// $routes->get('/', 'Auth::loginPage');
// $routes->post('/', 'Auth:login');

// $routes->get('/register', 'Auth::registerPage');
// $routes->post('/', 'Auth:register');

// $routes->get('/forget', 'Auth::forgetPage');
// $routes->post('/', 'Auth:forget');

# Dashboard Section
$routes->get('/home', 'Dashboard::home');
$routes->get('/about', 'Dashboard::about');
$routes->get('/customers', 'Dashboard::customers');
$routes->get('/users', 'Dashboard::users');

