<?php

use App\Core\Router;
use App\Controllers\EstudianteController;
use App\Controllers\HomeController;
use App\Controllers\AuxiliarController;

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

$router->get('/auxiliar/registro', [
    AuxiliarController::class,
    'registro'
    ]);

    $router->post('/auxiliar/registro', [
    AuxiliarController::class,
    'registrar'
    ]);
