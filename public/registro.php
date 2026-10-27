
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
</head>
<body>

    <h1>Registro</h1>

    <form action="registro" method="POST">

        <label for="nombre">Nombre:</label>
        <input
            type="name"
            id="nombre"
            name="nombre"
            required
        >

        <br><br>

        <label for="apellido">Apellido:</label>
        <input
            type="lastname"
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

        <button type="submit">registrar</button>

    </form>

</body>
</html>