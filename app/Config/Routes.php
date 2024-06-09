<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoanController::index');
$routes->post('/', 'LoanController::store');
$routes->post('/(:num)', 'LoanController::update/$1');
$routes->delete('(:num)', 'LoanController::destroy/$1');
