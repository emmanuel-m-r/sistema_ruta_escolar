<?php

namespace App\Models;

use PDO;

class Estudiante
{
    //Atributo PDO
    private PDO $conexion;

    //Constructor que recibe un objeto PDO
    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }


    public function obtenerTodos(): array
    {
        $sql = 'SELECT *
                FROM estudiante
                LIMIT 5';
        //Variable que almacena la consulta que se hace a través de la conexión
        $consulta = $this->conexion->query($sql);
        //con fetcheAll() obtenemos todo lo que tiene la consulta sql como un array
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
