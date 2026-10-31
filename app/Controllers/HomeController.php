<?php

namespace App\Controllers;

use App\Core\Auth;

class HomeController
{
    public function index()
    {
        Auth::requireRole("administrador");

        echo "Hola mundo";

        echo '
            <form action="/sistema_ruta_escolar/public/logout" method="POST">
                <button type="submit">Cerrar sesión</button>
            </form>
        ';
    }
}
