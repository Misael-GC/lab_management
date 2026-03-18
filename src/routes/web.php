<?php

use App\Controllers\PostController;
use App\Controllers\HomeController;
use App\Controllers\ClientController;
use App\Controllers\ProjectController;
use App\Controllers\SampleController;
use App\Controllers\UserController;


/**
 * Rutas Web del Blog
 * Formato: $router->METHOD('uri', Controlador::class, 'método')
 */

// -- Páginas generales --
$router->get('/', HomeController::class, 'index');

// -- Blog Posts --
$router->get('/blog',       PostController::class, 'index');
$router->get('/blog/show',  PostController::class, 'show');

$router->get('/clients', ClientController::class, 'index');
$router->get('/projects', ProjectController::class, 'index');
$router->get('/samples', SampleController::class, 'index');
$router->get('/users', UserController::class, 'index');



// -- Futuras rutas (comentadas hasta que existan los controladores) --
// $router->get('/about',   PageController::class, 'about');
// $router->post('/contact', ContactController::class, 'send');