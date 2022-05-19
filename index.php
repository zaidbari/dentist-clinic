<?php
session_start();

// autoloader
use App\Core\App;
use Bramus\Router\Router;

require __DIR__ . '/vendor/autoload.php';

App::Run(__DIR__);

// create a new router
$router = new Router();
$router->setNamespace('\App\Controllers');

$router->get('/', 'Guest@index');


$router->get('/login', 'Auth@loginView');
$router->get('/signup', 'Auth@create');
$router->post('/user/create', 'Auth@create');
$router->post('/user/login', 'Auth@login');
$router->post('/logout', 'Auth@logout');

$router->run();