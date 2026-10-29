<?php

namespace App\Models;

use PDO;
use Throwable;

class Auxiliar
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    // Obtener las rutas existentes para mostrarlas en el formulario.
    public function obtenerRutas(): array
    {
        $sql = "SELECT id_ruta, nombre
                FROM ruta
                ORDER BY nombre ASC";

        $consulta = $this->conexion->query($sql);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Registrar al usuario y relacionarlo con una ruta.
    public function registrar(
        string $nombre,
        string $apellido,
        string $correo,
        string $contrasena,
        int $idRuta
    ): bool {

        try {
            $this->conexion->beginTransaction();

            // 1. Insertar los datos personales en la tabla usuario.
            $sqlUsuario = "INSERT INTO usuario
                           (nombre, apellido, correo, contrasena)
                           VALUES
                           (:nombre, :apellido, :correo, :contrasena)";

            $consultaUsuario = $this->conexion->prepare($sqlUsuario);

            $consultaUsuario->execute([
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':correo' => $correo,
                ':contrasena' => password_hash(
                    $contrasena,
                    PASSWORD_DEFAULT
                )
            ]);

            // Obtener el id_usuario generado por MySQL.
            $idUsuario = (int) $this->conexion->lastInsertId();

            if ($idUsuario <= 0) {
                throw new \RuntimeException(
                    'No se pudo obtener el ID del usuario.'
                );
            }

            // 2. Insertar la relación en la tabla auxiliar.
            $sqlAuxiliar = "INSERT INTO auxiliar
                            (fk_id_usuario, fk_id_ruta)
                            VALUES
                            (:id_usuario, :id_ruta)";

            $consultaAuxiliar = $this->conexion->prepare($sqlAuxiliar);

            $consultaAuxiliar->execute([
                ':id_usuario' => $idUsuario,
                ':id_ruta' => $idRuta
            ]);

            // Confirmar las dos inserciones.
            $this->conexion->commit();

            return true;

        } catch (Throwable $e) {

            // Si falla alguna inserción, deshacer ambas.
            if ($this->conexion->inTransaction()) {
                $this->conexion->rollBack();
            }

            throw $e;
        }
    }
}