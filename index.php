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
$router->post('/users/manage/update/{id}', 'Users@update'); // update user @authorized for 'admin' or 'user' himself only

/**
 * =========================
 * Appointment Management
 * =========================
 **/
$router->get('/appointments', 'Appointments@index'); // Show appointment creation @authorized for 'admin', 'employee' or 'user' himself only

$router->get('/appointments/manage/view/{id}', 'Appointments@show'); // Show appointment @authorized for 'admin', 'doctor', 'employee' or 'user' himself only
$router->get('/appointment/manage/create', 'Appointments@create'); // Show appointment creation @authorized for 'admin', 'employee' or 'user' himself only
$router->post('/appointment/manage/insert', 'Appointments@insert'); // create appointment @authorized for 'admin', 'employee' or 'user' himself only


$router->run();