<?php

use App\Core\Router;
use App\Controllers\EstudianteController;
use App\Controllers\HomeController;

//$router = new Router();

$router->get('/', [
    HomeController::class,
    'index'
]);

$router->get('/estudiantes', [
    EstudianteController::class,
    'presentacion'
]);

$router->post('/prueba-post',[
    HomeController::class,
    'index'
]);