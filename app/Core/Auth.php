<?php

namespace App\Core;

class Auth
{
    
    //Comprueba si existe una sesión autenticada.
    
    public static function requireLogin(): void
    {
        // Evitamos que el navegador almacene páginas protegidas.
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');


        if (!isset($_SESSION['usuario'])) {
            header('Location: /sistema_ruta_escolar/public/login');
            exit;
        }
    }

    //Comprueba si el usuario tiene el rol requerido.
     
    public static function requireRole(string $rol): void
    {
        self::requireLogin();

        if ($_SESSION['usuario']['rol'] !== $rol) {
            http_response_code(403);
            echo '403 - No tienes permiso para acceder a esta página.';
            exit;
        }
    }
}
