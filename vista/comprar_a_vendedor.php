<?php

session_start();
include("../conexion.php");
include('../modelo/funcionesConsultas.php');
include("header.php");

$idCarta = isset($_GET['idCarta']) ? intval($_GET['idCarta']) : 0;
$nombreVendedor = isset($_GET['vendedor']) ? trim($_GET['vendedor']) : "";
$precioCarta = isset($_GET['precioCarta']) ? floatval($_GET['precioCarta']) : 0;
$mensajeEnviado = isset($_GET['mensaje_enviado']) ? intval($_GET['mensaje_enviado']) : 0;

/***
 * $idCarta = 0;
$nombreVendedor = "";
$precioCarta = 0.0;
 * */








if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombreVendedor = $_POST['nombreVendedor'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $idCarta = intval($_POST['idCarta']);
    $precio = floatval($_POST['precio']);

    procesarVenta($nombreVendedor, $nombreUsuario, $idCarta, $precio);
    eliminarCartaEnVenta($nombreVendedor, $idCarta);
} else {

    $idCarta = isset($_GET['idCarta']) ? intval($_GET['idCarta']) : 0;
    $nombreVendedor = isset($_GET['vendedor']) ? $_GET['vendedor'] : "";
    $precioCarta = isset($_GET['precioCarta']) ? floatval($_GET['precioCarta']) : 0;
}



$sql = "SELECT img FROM cartas WHERE id = $idCarta";
$resultado = $conexion->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $carta = $resultado->fetch_assoc();
} else {
    echo "<p>No se encontró la carta.</p>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
    <style>
        .contenedor-body {
            display: flex;


        }

        @media (max-width: 768px) {
        .contenedor-body {
            display: block;
            max-width: 95%;
            margin: 0 auto; 
        }

        .form-container {
            width: 100%;
            margin-bottom: 1rem; 
            text-align: center;
        }

        .carta {
            display: flex;
            flex-direction: column;
            align-items: center; 
        }

        .carta img {
            max-width: 200px;
        }
    }

    
    @media (max-width: 500px) {
        .contenedor-body {
            display: block;
            max-width: 95%; 
            margin: 0 auto;
        }

        .form-container {
            width: 100%;
            margin-bottom: 1rem;
            text-align: center;
        }

        .carta img {
            max-width: 170px;
        }
    }
    </style>
</head>

<body>

    <div class="contenedor-body">
        <div class="form-container">
            <div class="carta">
                <h1>Comprar Carta</h1>
                <img src="<?php echo "../img/" . $carta['img']; ?>" alt="Imagen de la carta" style="width:250px">
                <p>
                    <strong><?php echo $precioCarta == 0 ? 'Vendida' : 'Precio:'; ?></strong>
                    <?php echo $precioCarta == 0 ? '' : '$' . number_format($precioCarta, 2); ?>
                </p>
                <p><strong>Vendedor: </strong><?php echo $nombreVendedor; ?></p>
                <form action="comprar_a_vendedor.php" method="post">
                    <input type="hidden" name="nombreVendedor" value="<?php echo $nombreVendedor; ?>">
                    <input type="hidden" name="nombreUsuario" value="<?php echo $_SESSION["usuario"]; ?>">
                    <input type="hidden" name="idCarta" value="<?php echo $idCarta; ?>">
                    <input type="hidden" name="precio" value="<?php echo $precioCarta; ?>">
                    <button type="submit">Comprar</button>
                </form>


            </div>


            <!-- Botón de compra -->

        </div>

        <div class="form-container">
            <h2>Enviar mensaje</h2>
            <form action="../modelo/procesar_mensajes.php" method="post">


                <label for="comentario">Mensaje:</label><br>
                <textarea name="comentario" id="comentario" rows="15" cols="40" required></textarea><br><br>
                <input type="hidden" name="nombre_emisor" value="<?php echo $_SESSION['usuario']; ?>">
                <input type="hidden" name="nombre_receptor" value="<?php echo $nombreVendedor; ?>">
                <input type="hidden" name="precio" value="<?php echo $precioCarta; ?>">
                <input type="hidden" name="idCarta" value="<?php echo $idCarta; ?>">

                <button type="submit">Enviar</button>
                <?php if ($mensajeEnviado == 1) { ?>
                    <span class="mensaje-enviado">Mensaje enviado</span>
                <?php } ?>


            </form>
            <h2>Calificación del Vendedor</h2>
            <?php

            $nota = obtenerCalificacionMediaUsuario($nombreVendedor);

            // Separar en enteros y medio
            $estrellasCompletas = floor($nota);
            $tieneMediaEstrella = fmod($nota, 1) == 0.5;


            // Mostrar estrellas completas
            for ($i = 0; $i < $estrellasCompletas; $i++) {
                echo '<img src="../img2/estrella.png" alt="estrella" width="60">';
            }

            // Mostrar media estrella
            if ($tieneMediaEstrella) {
                echo '<img src="../img2/mediaEstrella.png" alt="media estrella" width="60">';
            }


            ?>
        </div>
    </div>





</body>

</html>