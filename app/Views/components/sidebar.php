<?php

// SCRIPT_NAME: Contiene la ruta de la unicación actual
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']),'/');

//Obtenemos la ruta completa solicitada por el usuario
//PHP_URL_PATH: Devuelve la ruta unicamente después del dominio
$rutaSolicitada = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

//Con substr le quitamos una parte de la ruta, eliminamos $base
$rutaActual = substr($rutaSolicitada,strlen($base));

//Normalizamos la ruta actual
$rutaActual= '/'.trim($rutaActual,'/');
?>


<aside>
    <nav>
        <ul>
            <li>
                <a href="<?= $base?>/"
                class="<?= $rutaActual === '/' ?'activo': '' ?>"
                <?= $rutaActual=== '/' ? 'aria-current="page"': '' ?>
                >Inicio</a>
            </li>
            <li>
                Registrar Asistencia
            </li>
            <li>
                Asistencias
            </li>
            <li>
                <a href="<?= $base?>/estudiantes"
                class ="<?= $rutaActual=== '/estudiantes' ? 'activo': '' ?>"
                <?= $rutaActual=== '/estudiantes' ? 'aria-current="page"': '' ?>
                >
                    Estudiantes
                </a>
            </li>
            <li>
                Rutas
            </li>
        </ul>
    </nav>
</aside>