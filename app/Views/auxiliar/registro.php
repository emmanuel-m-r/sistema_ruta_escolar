<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Auxiliares</title>
</head>

<body>

    <h1>Registro de Auxiliares</h1>

    <?php if (!empty($mensaje)): ?>
        <p style="color: green;">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <form
        action="<?= htmlspecialchars(
            rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/auxiliar/registro',
            ENT_QUOTES,
            'UTF-8'
        ) ?>"
        method="POST"
    >

        <label for="nombre">Nombre:</label>
        <input
            type="text"
            id="nombre"
            name="nombre"
            required
        >

        <br><br>

        <label for="apellido">Apellido:</label>
        <input
            type="text"
            id="apellido"
            name="apellido"
            required
        >

        <br><br>

        <label for="correo">Correo electrónico:</label>
        <input
            type="email"
            id="correo"
            name="correo"
            required
        >

        <br><br>

        <label for="contrasena">Contraseña:</label>
        <input
            type="password"
            id="contrasena"
            name="contrasena"
            required
        >

        <br><br>

        <label for="id_ruta">Ruta asignada:</label>

        <select id="id_ruta" name="id_ruta" required>

            <option value="">Selecciona una ruta</option>

            <?php foreach ($rutas as $ruta): ?>
                <option value="<?= (int) $ruta['id_ruta'] ?>">
                    <?= htmlspecialchars(
                        $ruta['nombre'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </option>
            <?php endforeach; ?>

        </select>

        <br><br>

        <?php if (empty($rutas)): ?>

            <p>No hay rutas registradas. Debes crear una ruta antes de registrar un auxiliar.</p>

            <button type="submit" disabled>
                Registrar auxiliar
            </button>

        <?php else: ?>

            <button type="submit">
                Registrar auxiliar
            </button>

        <?php endif; ?>

    </form>

</body>

</html>
