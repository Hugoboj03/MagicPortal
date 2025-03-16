<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php
    // Mostrar mensaje de error si existe
    if (isset($_GET['error']) && $_GET['error'] == 'credenciales') {
        echo '<p style="color: red;">Usuario o contraseña incorrectos.</p>';
    }
    ?>
    <form action="../modelo/comprueba_login.php" method="POST">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="contraseña">Contraseña:</label><br>
        <input type="password" id="contraseña" name="contraseña" required><br><br>

        <button type="submit">Iniciar Sesión</button>
    </form>

    <a href="register.php">Registrate aqui</a>
</body>
</html>