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
$routes->get('/', 'Dashboard::home');
$routes->get('/about', 'Dashboard::about');
$routes->get('/customers', 'Dashboard::customers');
$routes->get('/users', 'Dashboard::users');

# Dashboard Forms

$routes->get('/customers/add', 'Dashboard::customerAdd');
$routes->post('/customers/add', 'DashboardService::insertCustomerData');

$routes->get('/customers/edit/(:num)', 'Dashboard::customerEdit/$1');
$routes->post('/customers/edit/(:num)', 'DashboardService::updateCustomerData/$1');

$routes->get('/users/edit/(:num)', 'Dashboard::userEdit/$1');
$routes->post('/users/edit/(:num)', 'DashboardService::updateUserData/$1');

$routes->get('/users/add', 'Dashboard::userAdd');
$routes->post('/users/add', 'DashboardService::insertUserData');

$routes->post('/customers/delete/(:num)', 'DashboardService::deleteCustomerData/$1');
$routes->post('/users/delete/(:num)', 'DashboardService::deleteUserData/$1');