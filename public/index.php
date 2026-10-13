
<?php

// primero hay que cargar el .env por medio del directorio en boobstrap



require_once __DIR__.'/../bootstrap/app.php';


$app = require __DIR__ . '/../config/app.php';
$database = require __DIR__ . '/../config/database.php';

//"importamos" la clase connection
use App\Database\Connection;
//se comprobo la conexión al 

Connection::connect($database);

//PHP_EOL hace un salto de linea
//Estamos imprimiendo el valor de name que vien desde nuestra variable $app que es un array
//lo mismo con debug
echo $app['name'].PHP_EOL;
var_dump($app['debug']);
echo $database['name'].PHP_EOL;
echo $database['user'].PHP_EOL;
//var_dump hace que se convierta en boolena y que no lo devuelva como un numero string
var_dump($app['debug']);

echo "conexión comprobada al servidor ya que ejecuta con la conexión establecida";
