<?php
session_start();
include("../conexion.php");
include("header.php");

$usuario = $_SESSION['usuario'] ?? '';

if (!$usuario) {
    echo "<p>Debes iniciar sesión para ver tus cartas en venta.</p>";
    exit;
}

// Obtener el ID del usuario logueado
$sqlUser = "SELECT id FROM usuarios WHERE nombre = ?";
$stmtUser = $conexion->prepare($sqlUser);
$stmtUser->bind_param("s", $usuario);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$idUsuario = $resultUser->fetch_assoc()['id'] ?? 0;

$paginaActual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$cartasPorPagina = 12;
$offset = ($paginaActual - 1) * $cartasPorPagina;

// Total de cartas en venta por este usuario
$sqlTotal = "SELECT COUNT(*) AS total FROM cartas_en_venta WHERE id_vendedor = $idUsuario";
$resultTotal = $conexion->query($sqlTotal);
$totalFilas = $resultTotal->fetch_assoc()['total'];
$totalPaginas = ceil($totalFilas / $cartasPorPagina);

// Consulta de cartas en venta por el usuario
$sql = "SELECT cartas.*, cartas_en_venta.precio
        FROM cartas_en_venta
        JOIN cartas ON cartas_en_venta.id_carta = cartas.id
        WHERE cartas_en_venta.id_vendedor = $idUsuario
        LIMIT $offset, $cartasPorPagina";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Cartas en Venta</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
</head>

<body>
    <h1 class="ver-cartas">Tus cartas en venta</h1>

    <?php if ($resultado->num_rows > 0): ?>
        <div class="contenedor-cartas">
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <a href="editar_carta_en_venta.php?id_carta=<?php echo $row['id']; ?>" style="text-decoration: none; color: inherit;">
                    <div class="carta">
                        <img src="<?php echo "../img/" . $row['img']; ?>" alt="Imagen de la carta" style="width:200px">
                        <p><strong>Nombre:</strong> <?php echo $row['nombre']; ?></p>
                        <p><strong>Precio:</strong> €<?php echo number_format($row['precio'], 2); ?></p>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No tienes cartas a la venta actualmente.</p>
    <?php endif; ?>

    <div class="navegarPaginas">
        <a href="?pagina=1" class="navegacionEnlace">Principio</a>
        <a href="?pagina=<?php echo max(1, $paginaActual - 1); ?>" class="navegacionEnlace">Página Anterior</a>
        <span>Página <?php echo $paginaActual; ?> de <?php echo $totalPaginas; ?></span>
        <a href="?pagina=<?php echo min($totalPaginas, $paginaActual + 1); ?>" class="navegacionEnlace">Página Siguiente</a>
        <a href="?pagina=<?php echo $totalPaginas; ?>" class="navegacionEnlace">Final</a>
    </div>
</body>
<?php

include("footer.php");

?>

</html>