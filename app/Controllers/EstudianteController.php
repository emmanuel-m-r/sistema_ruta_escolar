<?php

namespace App\Controllers;

use App\Models\Estudiante;
use App\Database\Connection;

class EstudianteController
{
    public function presentacion()
    {
        // Obtener la configuración de la base de datos
        $config = require __DIR__ . '/../../config/database.php';

        // Crear la conexión PDO
        $conexion = Connection::connect($config);

        // Crear el modelo y consultar los estudiantes
        $modeloEstudiante = new Estudiante($conexion);
        $estudiantes = $modeloEstudiante->obtenerTodos();

        // Cargar la vista y pasarle los estudiantes
        require_once __DIR__ . '/../Views/estudiantes/presentacion.php';
    }
}