<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes</title>
</head>
<body>

    <h1>Listado de estudiantes</h1>

    <?php
    if(!empty($estudiantes)){
        echo "No Esta vacío"."<br>";
        
        foreach($estudiantes as $estudiante){
            echo  "Nombre: ". $estudiante['nombre'];
            echo PHP_EOL."Fecha De Nacimiento: ".$estudiante['fecha_nacimiento'];
        }
    }   
    ?>

    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes</title>
</head>
<body>

    <h1>Listado de estudiantes</h1>

    <?php if (count($estudiantes) > 0): ?>

        <table border="1">
            <thead>
                <tr>
                    <?php foreach (array_keys($estudiantes[0]) as $columna): ?>
                        <th>
                            <?= htmlspecialchars($columna) ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($estudiantes as $estudiante): ?>
                    <tr>
                        <?php foreach ($estudiante as $dato): ?>
                            <td>
                                <?= htmlspecialchars((string) $dato) ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>

        <p>No hay estudiantes registrados.</p>

    <?php endif; ?>

</body>
</html>


</body>
</html>