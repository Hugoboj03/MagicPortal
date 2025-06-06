<?php
include_once("../modelo/funcionesConsultas.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #120c0c;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            font-size: 14px;
        }

        h1 {
            font-size: 16pt;
            font-weight: bold;
            color: #0066CC;
            text-align: center;
        }

        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <div>
            Magic Portal: compra y venta de cartas
            <?php if ($nombreUsuario && tieneMensajes($nombreUsuario)): ?>
                <a href="hablar_con_comprador.php"><img src="../img2/campana.png" width="20" alt="Tienes mensajes"></a>
            <?php endif; ?>
        </div>

        <div>
            <?php if ($nombreUsuario): ?>
                <a href="pagina_usuario.php">Usuario</a>
            <?php else: ?>
                <a href="login.php">Iniciar sesión</a>
            <?php endif; ?>
        </div>

        <div>
            <?php if ($nombreUsuario): ?>
                Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>
                <a href="../modelo/cerrar_sesion.php">
                    <img src="../img2/salir.png" width="20" alt="Cerrar sesión">
                </a>
            <?php else: ?>
                Invitado
            <?php endif; ?>
        </div>
    </header>

    
</body>

</html>