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
| REGISTER ROUTES
|--------------------------------------------------------------------------
*/

$router->get('/', 'HomeController@index');

$router->middleware(['AuthMiddleware']);
$router->get('/dashboard', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| RUN ROUTER
|--------------------------------------------------------------------------
*/

$router->dispatch();
