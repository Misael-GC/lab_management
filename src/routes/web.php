<?php

use App\Controllers\PostController;
use App\Controllers\HomeController;
use App\Controllers\ClientController;
use App\Controllers\ProjectController;
use App\Controllers\SampleController;
use App\Controllers\UserController;



// -- Páginas generales --
$router->get('/', HomeController::class, 'index');


$router->get('/blog',       PostController::class, 'index');
$router->get('/blog/show',  PostController::class, 'show');

$router->get('/clients', ClientController::class, 'index');
$router->get('/clients/create', ClientController::class, 'create');
$router->post('/clients/store', ClientController::class, 'store');


$router->get('/projects', ProjectController::class, 'index');
$router->get('/projects/create', ProjectController::class, 'create');
$router->post('/projects/store', ProjectController::class, 'store');


$router->get('/samples', SampleController::class, 'index');
$router->get('/users', UserController::class, 'index');
