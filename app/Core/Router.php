<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    
    public function get(string $path, array $action): void
    {
        $path = $this->normalizePath($path);

        $this->routes['GET'][$path] = $action;
    }

    public function post(string $path, array $action):void
    {
        $path = $this->normalizePath($path);

        $this->routes['POST'][$path]=$action;
    }


        public function dispatch(string $uri, string $method): void
    {
         // 1. Obtenemos la ruta de la URL, sin los parámetros de consulta.
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';
        
        // 2. Eliminar el directorio base de XAMPP (ej: /mi_proyecto) ---
        $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        if ($scriptDir !== '/' && strpos($path, $scriptDir) === 0) {
            $path = substr($path, strlen($scriptDir));
        }
        // -----------------------------------------------------------------------

        // 3. Normalizamos la ruta y el método HTTP.
        $path = $this->normalizePath($path);
        $method = strtoupper($method);
        
        // 4. Comprobamos si la ruta está registrada.
        if (!isset($this->routes[$method][$path])) {
            http_response_code(404);
            echo '404 - Página no encontrada';
            return;
        }

        // Recuperamos la acción registrada para esta ruta
        $callback = $this->routes[$method][$path];

        // Separamos la clase del controlador y el método
        [$controller, $action] = $callback;

        // Creamos el controlador
        $controller = new $controller();

        // Ejecutamos el método correspondiente
        $controller->$action();
    }
    private function normalizePath(string $path): string
    {
        return '/' . trim($path, '/');
    }
}
