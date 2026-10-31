<?php
namespace App\Controllers;

// Use
use App\Database\Connection;


class LoginController
{
    public function inicio_login()
    {
        require_once __DIR__.'/../Views/auth/login.php';
    }

    public function autenticate():void
    {

        //Recibimos los datos del formulario.
        $correo= trim($_POST['correo']??'');
        $contrasena = trim($_POST['contrasena']??'');


        //Comprobamos que los campos no estén vacíos.
        if ($correo === '' || $contrasena==='') {
        echo "Los campos deben estar llenos";
        return;
        }

        //Confirmamos el formato de correo
        if (!filter_var($correo,FILTER_VALIDATE_EMAIL)) {
            echo "El correo no es valido";
            return;
        }

        // Cargamos la configuración de la base de datos.
        $config = require __DIR__ . '/../../config/database.php';

        // Creamos la conexión PDO.
        $pdo = Connection::connect($config);

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
            echo 'Correo o contraseña incorrectos.';
            return;
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
            echo 'El usuario no tiene un rol válido asignado.';
            return;
        }

        // Regeneramos el identificador de la sesión.
        session_regenerate_id(true);

        // Guardamos los datos necesarios del usuario en la sesión.
        $_SESSION['usuario'] = [
            'id_usuario' => $usuario['id_usuario'],
            'nombre' => $usuario['nombre'],
            'apellido' => $usuario['apellido'],
            'correo' => $usuario['correo'],
            'rol' => $datosRol['rol'],
            'id_ruta' => $datosRol['fk_id_ruta']
        ];

        //header realiza la redirección a la pagina Home que sería la pagina de inicio
        header('Location: /sistema_ruta_escolar/public/');
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
    //Esto hay que actualizarlo a todas las rutas que tengamos en las que se vaya a cerrar sesión (modulos de estudiante, rutas, etc)
    
    // Redirigimos al usuario al login.
    header('Location: /sistema_ruta_escolar/public/login');
    exit;
    }
            
}
?>
