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


/**
 * =========================
 * Public routes
 * =========================
 **/
$router->get('/', 'Guest@index');


/**
 * =========================
 * Authentication routes
 * =========================
 **/
$router->get('/login', 'Auth@loginView');
$router->get('/signup', 'Auth@signupView');
$router->get('/logout', 'Auth@logout');
$router->post('/user/create', 'Auth@create');
$router->post('/user/login', 'Auth@login');


/**
 * =========================
 * Private routes
 * =========================
 **/
$router->get('/dashboard', 'Dashboard@index');

/**
 * =========================
 * User Management
 * =========================
 **/

$router->get('/users/manage/delete/{id}', 'Users@delete'); // delete user @authorized for 'admin' only
$router->get('/users/manage/show/{id}', 'Users@show'); // show user @authorized for 'admin' only
$router->get('/users/manage/edit/{id}', 'Users@edit'); // edit user @authorized for 'admin' or 'user' himself only
$router->post('/users/manage/update/{id}', 'Users@update'); // update user @authorized for 'admin' or 'user' himself only


$router->run();