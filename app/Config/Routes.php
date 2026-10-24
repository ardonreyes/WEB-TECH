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

# Dashboard Views
$routes->get('/', 'Auth::loginPage');
$routes->post('/login', 'AuthService::login');

$routes->get('/home', 'Dashboard::home');
$routes->get('/about', 'Dashboard::about');

$routes->get('/customers', 'Dashboard::customers');
$routes->post('/customers/delete/(:num)', 'DashboardService::deleteCustomerData/$1');

$routes->get('/users', 'Dashboard::users');
$routes->post('/users/delete/(:num)', 'DashboardService::deleteUserData/$1');

$routes->get('/logout', 'AuthService::logout');

# Dashboard Forms
$routes->post('/customers/add', 'DashboardService::insertCustomerData');
$routes->post('/customers/edit/(:num)', 'DashboardService::updateCustomerData/$1');
$routes->post('/users/edit/(:num)', 'DashboardService::updateUserData/$1');
$routes->post('/users/add', 'DashboardService::insertUserData');