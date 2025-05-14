<?php

session_start();
include("../conexion.php");
include('../modelo/funcionesConsultas.php');
include("header.php");

$idCarta = 0;
$nombreVendedor = "";
$precioCarta = 0.0;






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
</head>

<body>

    <h1>Comprar Carta</h1>

    <div class="contenedor-cartas">
        <div class="carta">
            <img src="<?php echo "../img/" . $carta['img']; ?>" alt="Imagen de la carta" style="width:250px">
            <p>
                <strong><?php echo $precioCarta == 0 ? 'Vendida' : 'Precio:'; ?></strong>
                <?php echo $precioCarta == 0 ? '' : '$' . number_format($precioCarta, 2); ?>
            </p>
            <p><strong>Vendedor:</strong><?php echo $nombreVendedor; ?></p>
            <form action="comprar_a_vendedor.php" method="post">
                <input type="hidden" name="nombreVendedor" value="<?php echo $nombreVendedor; ?>">
                <input type="hidden" name="nombreUsuario" value="<?php echo $_SESSION["usuario"]; ?>">
                <input type="hidden" name="idCarta" value="<?php echo $idCarta; ?>">
                <input type="hidden" name="precio" value="<?php echo $precioCarta; ?>">
                <button type="submit">Comprar</button>
            </form>
        </div>


        <!-- Botón de compra (puedes enlazarlo a un script que procese la compra) -->

    </div>



</body>

</html>