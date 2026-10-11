<?php
//devolvemos un array con los siguientes datos del sistema tomados del .env
return [
    'name'=> $_ENV['APP_NAME'],
    'env' => $_ENV['APP_ENV'],
    //nos aseguramos que sea booleano
    'debug'=> filter_var(
    $_ENV['APP_DEBUG']?? false,
        FILTER_VALIDATE_BOOLEAN
    )
];
