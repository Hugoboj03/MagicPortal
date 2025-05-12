<?php
$nombreUsuario = $_SESSION['usuario'];
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
        <div>Sistema de Gestión de Noticias</div>

        <div>
            <a href="pagina_usuario.php">Usuario</a>
        </div>

        <div>Bienvenido, <?php echo $nombreUsuario; ?>

            <a href="../modelo/cerrar_sesion.php">
                <img src="../img2/salir.png" width="20" alt="Cerrar sesión">
            </a>
        </div>
    </header>

</body>

</html>