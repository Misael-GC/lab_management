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
$router->get('/samples/create', SampleController::class, 'create');
$router->post('/samples/store', SampleController::class, 'store');
$router->get('/samples/show', SampleController::class, 'show');
$router->get('/samples/edit', SampleController::class, 'edit');
$router->post('/samples/update', SampleController::class, 'update');
$router->get('/samples/delete', SampleController::class, 'delete');
$router->get('/samples/export/excel', SampleController::class, 'exportExcel');
$router->get('/samples/export/pdf', SampleController::class, 'exportPdf');


$router->get('/users', UserController::class, 'index');
