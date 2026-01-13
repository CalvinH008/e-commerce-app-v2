<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/Core/Autoload.php';
require_once __DIR__ . '/../app/Helpers/auth.php';

use App\Core\Router;
use App\Middleware\AuthMiddleware;

$router = new Router();

/*
|--------------------------------------------------------------------------
| PUBLIC / GUEST ROUTES
|--------------------------------------------------------------------------
*/
$router->get('/', 'HomeController@index');

$router->get('/products', 'ProductController@index');
$router->get('/product/detail', 'ProductController@show');

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

$router->get('/cart', 'CartController@index', ['AuthMiddleware']);
$router->post('/cart/add', 'CartController@add', ['AuthMiddleware']);
$router->post('/cart/update', 'CartController@update', ['AuthMiddleware']);
$router->post('/cart/remove', 'CartController@remove', ['AuthMiddleware']);
$router->post('/cart/clear', 'CartController@clear', ['AuthMiddleware']);

$router->get('/checkout', 'CheckoutController@index', ['AuthMiddleware']);
$router->post('/checkout/process', 'CheckoutController@process', ['AuthMiddleware']);

$router->get('/order/detail', 'OrderController@detail', ['AuthMiddleware']);
$router->get('/order/history', 'OrderController@history', ['AuthMiddleware']);
/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Butuh Login + Role Admin)
|--------------------------------------------------------------------------
*/
$router->get('/admin/dashboard', 'AdminController@index', ['AuthMiddleware', 'RoleMiddleware']);

// product management
$router->get('/admin/products', 'AdminController@products', ['AuthMiddleware', 'RoleMiddleware']);
$router->get('/admin/products/create', 'AdminController@createProduct', ['AuthMiddleware', 'RoleMiddleware']);
$router->post('/admin/products/store', 'AdminController@storeProduct', ['AuthMiddleware', 'RoleMiddleware']);
$router->get('/admin/products/edit', 'AdminController@editProduct', ['AuthMiddleware', 'RoleMiddleware']);
$router->post('/admin/products/update', 'AdminController@updateProduct', ['AuthMiddleware', 'RoleMiddleware']);
$router->post('/admin/products/delete', 'AdminController@deleteProduct', ['AuthMiddleware', 'RoleMiddleware']);

// Order management
$router->get('/admin/orders', 'AdminController@orders', ['AuthMiddleware', 'RoleMiddleware']);
$router->get('/admin/orders/detail', 'AdminController@orderDetail', ['AuthMiddleware', 'RoleMiddleware']);
$router->post('/admin/orders/update-status', 'AdminController@updateOrderStatus', ['AuthMiddleware', 'RoleMiddleware']);
$router->post('/admin/payments/update-status', 'AdminController@updatePaymentStatus', ['AuthMiddleware', 'RoleMiddleware']);
/*
|--------------------------------------------------------------------------
| RUN ROUTER
|--------------------------------------------------------------------------
*/

$router->dispatch();
