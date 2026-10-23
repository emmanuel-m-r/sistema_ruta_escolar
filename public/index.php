<?php
// "importamos" clase Router
use App\Core\Router;

require_once __DIR__ . '/../bootstrap/app.php';

$router = new Router();

require_once __DIR__ . '/../routes/web.php';

$variable = ($_SERVER['REQUEST_URI']);



$router->dispatch(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);
