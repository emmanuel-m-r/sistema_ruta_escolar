<?php

    use App\Controllers\EstudianteController;
    use App\Controllers\HomeController;
    use App\Controllers\LoginController;
    use App\Controllers\RegistroController;
    use App\Controllers\AuxiliarController;

    $router->get('/', [
        HomeController::class,
        'index'
    ]);

    $router->get('/estudiantes', [
        EstudianteController::class,
        'presentacion'
    ]);

    $router->get('/login', [
    LoginController::class,
    'inicio_login'
    ]);

    $router->post('/login',[
    LoginController::class,
    'autenticate'
    ]);

    // Ruta para cerrar sesión

    $router->post('/logout',[
        LoginController::class,
        'logout'
    ]);

    $router->get('/auxiliar/registro', [
    AuxiliarController::class,
    'registro'
    ]);

    $router->post('/auxiliar/registro', [
    AuxiliarController::class,
    'registrar'
    ]);

?>
