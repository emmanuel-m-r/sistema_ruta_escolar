<?php
namespace App\Controllers;

// Use
use App\Database\Connection;
use PDOException;


class LoginController
{
    public function inicio_login()
    {
        // Datos que la vista muestra si el intento anterior falló.
        $error = $_SESSION['login_error'] ?? null;
        $correoAnterior = $_SESSION['login_correo'] ?? ($_COOKIE['recordar_correo'] ?? '');
        $rolAnterior = $_SESSION['login_rol'] ?? 'administrador';
        $recordar = isset($_COOKIE['recordar_correo']);

        unset($_SESSION['login_error'], $_SESSION['login_correo'], $_SESSION['login_rol']);

        require_once __DIR__.'/../Views/auth/login.php';
    }

    public function autenticate():void
    {

        //Recibimos los datos del formulario.
        $correo= trim($_POST['correo']??'');
        $contrasena = trim($_POST['contrasena']??'');
        $rol = $_POST['rol'] ?? 'administrador';

        //Conservamos lo escrito por si hay que volver al formulario.
        $_SESSION['login_correo'] = $correo;
        $_SESSION['login_rol'] = $rol;


        //Comprobamos que los campos no estén vacíos.
        if ($correo === '' || $contrasena==='') {
            $this->volverAlLogin('Los campos deben estar llenos');
        }

        //Confirmamos el formato de correo
        if (!filter_var($correo,FILTER_VALIDATE_EMAIL)) {
            $this->volverAlLogin('El correo no es válido');
        }

        // Cargamos la configuración de la base de datos.
        $config = require __DIR__ . '/../../config/database.php';

        // Creamos la conexión PDO.
        try {
            $pdo = Connection::connect($config);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $this->volverAlLogin('No fue posible conectar con la base de datos.');
        }

        // Preparamos la consulta para buscar al usuario por correo.
        $sql = "SELECT id_usuario, nombre, apellido, correo, contrasena
                FROM usuario
                WHERE correo = :correo
                LIMIT 1";

        $stmt = $pdo->prepare($sql);

        // Ejecutamos la consulta con el correo recibido.
        $stmt->execute([
            'correo' => $correo
        ]);

        // Obtenemos el usuario encontrado.
        $usuario = $stmt->fetch();

        // Verificamos si existe y si la contraseña coincide.
        if (!$usuario || !password_verify($contrasena, $usuario['contrasena'])) {
            $this->volverAlLogin('Correo o contraseña incorrectos.');
        }

        //Consultamos el rol y la ruta asignada al usuario.
        $stmtRol = $pdo->prepare(
            "CALL obtener_rol_usuario(:id_usuario)"
        );

        $stmtRol->execute([
            'id_usuario' => $usuario['id_usuario']
        ]);

        $datosRol = $stmtRol->fetch();

        // Cerramos el cursor para liberar los resultados del procedimiento.
        $stmtRol->closeCursor();

        // Verificamos que el usuario tenga un rol válido.
        if (
            !$datosRol ||
            !in_array(
                $datosRol['rol'],
                ['administrador', 'auxiliar'],
                true
            )
        ) {
            $this->volverAlLogin('El usuario no tiene un rol válido asignado.');
        }

        // El rol elegido en el formulario debe coincidir con el de la base de datos.
        if ($datosRol['rol'] !== $rol) {
            $this->volverAlLogin('Este usuario no está registrado como ' . $rol . '.');
        }

        // "Recordarme" guarda solo el correo durante 30 días, nunca la contraseña.
        if (isset($_POST['recordarme'])) {
            setcookie('recordar_correo', $correo, time() + 60 * 60 * 24 * 30, '/');
        } else {
            setcookie('recordar_correo', '', time() - 3600, '/');
        }

        // Regeneramos el identificador de la sesión.
        session_regenerate_id(true);
        unset($_SESSION['login_correo'], $_SESSION['login_rol']);

        // Guardamos los datos necesarios del usuario en la sesión.
        $_SESSION['usuario'] = [
            'id_usuario' => $usuario['id_usuario'],
            'nombre' => $usuario['nombre'],
            'apellido' => $usuario['apellido'],
            'correo' => $usuario['correo'],
            'rol' => $datosRol['rol'],
            'id_ruta' => $datosRol['fk_id_ruta']
        ];

        //header realiza la redirección a la pagina de inicio de cada rol
        $inicio = $datosRol['rol'] === 'administrador' ? '' : 'estudiantes';
        header('Location: /sistema_ruta_escolar/public/' . $inicio);
        exit;
    }

    //Vuelve al formulario mostrando el mensaje en la tarjeta.
    private function volverAlLogin(string $mensaje): void
    {
        $_SESSION['login_error'] = $mensaje;
        header('Location: /sistema_ruta_escolar/public/login');
        exit;
    }
 
    //Función para cerrar sesión
    public function logout(): void{
    //Esto se encarga de eliminar las cookies que almacenan la pagina que de inicio a la que no se debe acceder despues de cerrar sesion
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {

        $params = session_get_cookie_params();
        setcookie(session_name(),
                  '',
                  time() - 42000,
                  $params['path'],
                  $params['domain'],
                  $params['secure'],
                  $params['httponly']);
    }
    @session_destroy();

    
    // Redirigimos al usuario al login.
    header('Location: /sistema_ruta_escolar/public/login');
    exit;
    }
            
}
?>
