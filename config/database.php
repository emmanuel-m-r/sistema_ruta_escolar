<?php

//Devolvemos un array con los datos de la bd tomado del .env
return [
    'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
    'port' => $_ENV['DB_PORT'] ?? '3306',
    'name' => $_ENV['DB_NAME'] ?? 'ruta_escolar_v3',
    'user' => $_ENV['DB_USER'] ?? '',
    'password' => $_ENV['DB_PASSWORD'] ?? '',
    'charset' => 'utf8mb4',
];
