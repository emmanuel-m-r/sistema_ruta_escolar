<?php
//namspace para que composer y autoload identifiquen la clase
namespace App\Database;

// "importamos PDO"
use PDO;

class Connection{
    // se le va a pasar como parametro a la función un array
    //la función devuelve una instancia PDO
    public static function connect(array $config):PDO{
            //con la función sprintf obtenemos los valores como cadena de texto en posiciones especificas
        $dsn = sprintf(
            //la función está indicada por esta cadena
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            //valores a devolver
            $config['host'],
            $config['port'],
            $config['name'],
            $config['charset']

        );
    
        return new PDO(
            $dsn,
            $user =$config['user'],
            $password = $config['password'],
            [   //Hace que los errores de PDO se comuniquen mediante excepciones.
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                //Hace que las consultas devuelvan filas como arreglos asociativos es decir clave : valor
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                //Favorece el uso de consultas preparadas desde MySQL
                PDO::ATTR_EMULATE_PREPARES => false
            ]

        );
    }

}