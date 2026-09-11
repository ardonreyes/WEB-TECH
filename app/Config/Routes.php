<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

# Auth Section
$routes->get('/', 'Auth::loginPage');
$routes->get('/register', 'Auth::registerPage');
$routes->get('/forget', 'Auth::forgetPage');

# Dashboard Section
$routes->get('/home', 'Dashboard::home');
$routes->get('/about', 'Dashboard::about');
$routes->get('/customers', 'Dashboard::customers');
$routes->get('/users', 'Dashboard::users');