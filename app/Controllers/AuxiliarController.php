<?php

namespace App\Controllers;

use App\Database\Connection;
use App\Models\Auxiliar;
use PDOException;
use Throwable;

class AuxiliarController
{
    // Mostrar el formulario de registro.
    public function registro(): void
    {
        try {
            $config = require dirname(__DIR__, 2) . '/config/database.php';

            $conexion = Connection::connect($config);

            $modelo = new Auxiliar($conexion);

            $rutas = $modelo->obtenerRutas();
            $mensaje = '';

            require dirname(__DIR__) . '/Views/auxiliar/registro.php';

        } catch (Throwable $e) {
            error_log($e->getMessage());

            http_response_code(500);
            echo 'No fue posible cargar el formulario de auxiliares.';
        }
    }

    // Procesar el formulario y registrar al auxiliar.
    public function registrar(): void
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $contrasena = $_POST['contrasena'] ?? '';
        $idRuta = filter_var(
            $_POST['id_ruta'] ?? null,
            FILTER_VALIDATE_INT
        );

        if (
            $nombre === '' ||
            $apellido === '' ||
            $correo === '' ||
            $contrasena === '' ||
            !$idRuta ||
            !filter_var($correo, FILTER_VALIDATE_EMAIL)
        ) {
            $mensaje = 'Completa todos los campos con información válida.';
            $this->mostrarFormulario($mensaje);
            return;
        }

        try {
            $config = require dirname(__DIR__, 2) . '/config/database.php';

            $conexion = Connection::connect($config);

            $modelo = new Auxiliar($conexion);

            // Verificar que la ruta seleccionada exista.
            $consulta = $conexion->prepare(
                'SELECT id_ruta FROM ruta WHERE id_ruta = :id_ruta'
            );

            $consulta->execute([
                ':id_ruta' => $idRuta
            ]);

            if (!$consulta->fetch()) {
                $mensaje = 'La ruta seleccionada no existe.';
                $this->mostrarFormulario($mensaje);
                return;
            }

            // El modelo ejecuta las dos inserciones SQL.
            $modelo->registrar(
                $nombre,
                $apellido,
                $correo,
                $contrasena,
                $idRuta
            );

            $mensaje = 'Auxiliar registrado correctamente.';

            $this->mostrarFormulario($mensaje);

        } catch (PDOException $e) {
            error_log($e->getMessage());

            if ($e->getCode() === '23000') {
                $mensaje = 'El correo ya está registrado o existe un problema con la ruta seleccionada.';
            } else {
                $mensaje = 'Ocurrió un error al registrar el auxiliar.';
            }

            $this->mostrarFormulario($mensaje);

        } catch (Throwable $e) {
            error_log($e->getMessage());

            $mensaje = 'No fue posible completar el registro.';
            $this->mostrarFormulario($mensaje);
        }
    }

    // Cargar nuevamente el formulario con las rutas y el mensaje.
    private function mostrarFormulario(string $mensaje): void
    {
        $config = require dirname(__DIR__, 2) . '/config/database.php';

        $conexion = Connection::connect($config);

        $modelo = new Auxiliar($conexion);

        $rutas = $modelo->obtenerRutas();

        require dirname(__DIR__) . '/Views/auxiliar/registro.php';
    }
}
