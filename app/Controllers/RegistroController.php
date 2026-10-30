<?php

namespace App\Controllers;

use App\Database\Connection;

class RegistroController{

    public function registro()
    {
        require_once __DIR__.'/../Views/registro/registro.php';
    }

    public function registrar():void
    {
        //Recibimos los datos del formulario.
        $nombre= trim($_POST['nombre']??'');
        $apellido = trim($_POST['apellido']??'');
        $correo= trim($_POST['correo']??'');
        $contrasena = trim($_POST['contrasena']??'');


        //Comprobamos que los campos no estén vacíos.
        if ($correo === '' || $contrasena==='' || $nombre==='' || $apellido==='') {
        echo "Los campos deben estar llenos";
        return;
        }

        //Confirmamos el formato de correo
        if (!filter_var($correo,FILTER_VALIDATE_EMAIL)) {
            echo "El correo no es valido";
            return;
        }

        $password_segura = password_hash($contrasena,PASSWORD_DEFAULT);

        $config= require __DIR__ . '/../../config/database.php';
        $pdo=Connection::connect($config);


        //INSERT SQL
        $sql = 'INSERT INTO usuario (nombre,apellido,correo,contrasena) VALUES (:nombre,:apellido,:correo,:hash)';
        $sql = $pdo->prepare($sql);
        $sql->execute([
            ':nombre'=>$nombre,
            ':apellido'=>$apellido,
            ':correo'=> $correo,
            ':hash'=>$password_segura
        ]);

        echo "Parametros guardados";

        require_once __DIR__.'/../Views/registro/registro.php';

    }
}
?>
