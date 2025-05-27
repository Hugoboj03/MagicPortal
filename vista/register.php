<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/estilo_login.css">
</head>
<body>
    <h2>Registro de Usuario</h2>
    <?php
    // Mostrar mensajes de error o éxito si existen
    if (isset($_GET['error']) && $_GET['error'] == 'correo_existente') {
        echo '<p style="color: red;">El correo ya está registrado. Usa otro correo.</p>';
    }elseif(isset($_GET['error']) && $_GET['error'] == 'nombre_existente'){
        echo '<p style="color: red;">El nombre de usuario ya está registrado. Usa otro nombre.</p>';
    }
    if (isset($_GET['success']) && $_GET['success'] == 'registro') {
        echo '<p style="color: green;">Registro exitoso. Ahora puedes <a href="login.php">iniciar sesión</a>.</p>';
    }
    ?>
    <form action="../modelo/procesar_registro.php" method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="contraseña">Contraseña:</label><br>
        <input type="password" id="contraseña" name="contraseña" required><br><br>

        <button type="submit">Registrarse</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
</body>
</html>