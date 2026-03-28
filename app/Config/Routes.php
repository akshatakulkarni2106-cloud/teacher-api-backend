<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Handle OPTIONS preflight requests
$routes->options('api/register', static function () {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    exit(0);
});
$routes->options('api/login', static function () {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    exit(0);
});
$routes->options('api/teacher', static function () {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    exit(0);
});
$routes->options('api/teachers', static function () {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    exit(0);
});

// Auth Routes
$routes->post('api/register', 'AuthController::register');
$routes->post('api/login', 'AuthController::login');

// Teacher Routes
$routes->post('api/teacher', 'TeacherController::create');
$routes->get('api/teachers', 'TeacherController::index');
$routes->get('api/users', 'AuthController::index');