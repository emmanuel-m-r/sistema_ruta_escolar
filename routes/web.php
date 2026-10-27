    <?php

    use App\Controllers\EstudianteController;
    use App\Controllers\HomeController;
    use App\Controllers\LoginController;
    use App\Controllers\RegistroController;


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

    $router->get('/registro',[
    RegistroController::class,
    'registro'
    ]);

    $router->post('/registro',[
        RegistroController::class,
        'registrar'
    ]);

?>
