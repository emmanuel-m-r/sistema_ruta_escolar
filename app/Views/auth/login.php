<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>

    <h1>Iniciar sesión</h1>

    <form action="login" method="POST">

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

        <button type="submit">Ingresar</button>

    </form>

</body>
</html>
