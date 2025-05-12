<?php
session_start();
include("../conexion.php");
include("header.php");

$idCarta = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT cartas.*, cartas_en_venta.precio, usuarios.nombre AS vendedor
        FROM cartas_en_venta
        JOIN cartas ON cartas_en_venta.id_carta = cartas.id
        JOIN usuarios ON cartas_en_venta.id_vendedor = usuarios.id
        WHERE cartas_en_venta.id_carta = $idCarta";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
    <h1>Cartas en venta</h1>
    

    <?php
    // Comprobamos si hay resultados
    if ($resultado->num_rows > 0): ?>
        <div class="contenedor-cartas">
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <div class="carta">
                    
                    <a href="comprar_a_vendedor.php?idCarta=<?php echo $row['id']; ?>&vendedor=<?php echo $row['vendedor']; ?>">
                        <img src="<?php echo "../img/" . $row['img']; ?>" alt="Imagen de la carta" style="width:200px">
                    </a>
                    <!--<p><strong>Nombre:</strong> <?php echo $row['nombre']; ?></p>-->
                    <p><strong>Vendedor:</strong> <?php echo $row['vendedor']; ?></p>
                    <p><strong>Precio:</strong> $<?php echo $row['precio']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No hay vendedores para esta carta.</p>
    <?php endif; ?>



</body>

</html>