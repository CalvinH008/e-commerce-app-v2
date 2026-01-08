<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/Core/Autoload.php';

use App\Core\Router;

$router = new Router();

/*
|--------------------------------------------------------------------------
| PUBLIC / GUEST ROUTES
|--------------------------------------------------------------------------
*/
$router->get('/', 'HomeController@index');

$router->get('/register', 'AuthController@registerForm', ['GuestMiddleware']);
$router->post('/register', 'AuthController@register', ['GuestMiddleware']);

$router->get('/login', 'AuthController@loginForm', ['GuestMiddleware']);
$router->post('/login', 'AuthController@login', ['GuestMiddleware']);

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
$router->get('/dashboard', 'HomeController@index', ['AuthMiddleware']);
$router->get('/logout', 'AuthController@logout', ['AuthMiddleware']);

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Butuh Login + Role Admin)
|--------------------------------------------------------------------------
*/
$router->get('/admin/dashboard', 'AdminController@index', ['AuthMiddleware', 'RoleMiddleware']);
$router->get('/admin/products', 'AdminController@products', ['AuthMiddleware', 'RoleMiddleware']);
/*
|--------------------------------------------------------------------------
| RUN ROUTER
|--------------------------------------------------------------------------
*/
$router->dispatch();
