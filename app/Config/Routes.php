<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Authentication (public)
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attempt', ['filter' => 'throttle:5']);
$routes->post('logout', 'AuthController::logout');

// Everything else requires a signed-in user
$routes->group('', ['filter' => 'auth'], static function (RouteCollection $routes): void {
    $routes->get('/', 'Home::index');

    // Alternatives (participants)
    $routes->get('alternatives', 'AlternativeController::index');
    $routes->get('alternatives/create', 'AlternativeController::create');
    $routes->post('alternatives', 'AlternativeController::store');
    $routes->get('alternatives/(:num)/edit', 'AlternativeController::edit/$1');
    $routes->post('alternatives/(:num)/update', 'AlternativeController::update/$1');
    $routes->post('alternatives/(:num)/delete', 'AlternativeController::delete/$1');

    // Criteria
    $routes->get('criteria', 'CriteriaController::index');
    $routes->get('criteria/create', 'CriteriaController::create');
    $routes->post('criteria', 'CriteriaController::store');
    $routes->get('criteria/(:num)/edit', 'CriteriaController::edit/$1');
    $routes->post('criteria/(:num)/update', 'CriteriaController::update/$1');
    $routes->post('criteria/(:num)/delete', 'CriteriaController::delete/$1');

    // Decision matrix (keyed by alternative id)
    $routes->get('matrix', 'MatrixController::index');
    $routes->get('matrix/create', 'MatrixController::create');
    $routes->post('matrix', 'MatrixController::store');
    $routes->get('matrix/(:num)/edit', 'MatrixController::edit/$1');
    $routes->post('matrix/(:num)/update', 'MatrixController::update/$1');
    $routes->post('matrix/(:num)/delete', 'MatrixController::delete/$1');

    // MOORA calculation results
    $routes->get('results/normalization', 'Home::normalization');
    $routes->get('results/weighted', 'Home::weightedNormalization');
    $routes->get('results/optimization', 'Home::optimization');
    $routes->get('results/decision', 'Home::decision');
});
