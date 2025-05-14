<?php
session_start();
include("../conexion.php");
include("header.php");

$idCarta = isset($_GET['id']) ? intval($_GET['id']) : 0;

$paginaActual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$cartasPorPagina = 12;
$offset = ($paginaActual - 1) * $cartasPorPagina;

$sqlTotal = "SELECT COUNT(*) AS total
             FROM cartas_en_venta
             WHERE id_carta = $idCarta";
$resultTotal = $conexion->query($sqlTotal);
$totalFilas = $resultTotal->fetch_assoc()['total'];
$totalPaginas = ceil($totalFilas / $cartasPorPagina);

$sql = "SELECT cartas.*, cartas_en_venta.precio, usuarios.nombre AS vendedor
        FROM cartas_en_venta
        JOIN cartas ON cartas_en_venta.id_carta = cartas.id
        JOIN usuarios ON cartas_en_venta.id_vendedor = usuarios.id
        WHERE cartas_en_venta.id_carta = $idCarta
        LIMIT $offset, $cartasPorPagina";

$resultado = $conexion->query($sql);

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
    <h1>Cartas en venta</h1>


    <?php
    // Comprobamos si hay resultados
    if ($resultado->num_rows > 0): ?>
        <div class="contenedor-cartas">
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <div class="carta">

                    <?php if (isset($_SESSION['usuario'])): ?>
                        <a href="comprar_a_vendedor.php?idCarta=<?php echo $row['id']; ?>&vendedor=<?php echo $row['vendedor']; ?>&precioCarta=<?php echo $row['precio']; ?>">
                            <img src="<?php echo "../img/" . $row['img']; ?>" alt="Imagen de la carta" style="width:200px">
                        </a>
                    <?php else: ?>
                        <img src="<?php echo "../img/" . $row['img']; ?>" alt="Imagen de la carta" style="width:200px; opacity: 0.7;">
                        <p style="color: red; font-weight: bold;">Debes iniciar sesión para comprar esta carta.</p>
                    <?php endif; ?>
                    <!--<p><strong>Nombre:</strong> <?php echo $row['nombre']; ?></p>-->
                    <p><strong>Vendedor:</strong> <?php echo $row['vendedor']; ?></p>
                    <p><strong>Precio:</strong> $<?php echo $row['precio']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No hay vendedores para esta carta.</p>
    <?php endif; ?>


    <div class="navegarPaginas">
    <a href="?id=<?php echo $idCarta; ?>&pagina=1">Principio</a>
    <a href="?id=<?php echo $idCarta; ?>&pagina=<?php echo max(1, $paginaActual - 1); ?>">Página Anterior</a>
    <span>Página <?php echo $paginaActual; ?> de <?php echo $totalPaginas; ?></span>
    <a href="?id=<?php echo $idCarta; ?>&pagina=<?php echo min($totalPaginas, $paginaActual + 1); ?>">Página Siguiente</a>
    <a href="?id=<?php echo $idCarta; ?>&pagina=<?php echo $totalPaginas; ?>">Final</a>
</div>



</body>

</html>