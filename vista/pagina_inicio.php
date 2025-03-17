<?php
session_start();
include("../conexion.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Cartas por pagina
$cartasPorPagina = 32;

// Obtener el número de página actual desde GET
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($paginaActual < 1) {
    $paginaActual = 1;
}

// Calcular el OFFSET
$offset = ($paginaActual - 1) * $cartasPorPagina;

// Obtener el número total de páginas
$listaTotal = "SELECT COUNT(*) FROM cartas";
$consultaTotal = $conexion->prepare($listaTotal);
$consultaTotal->execute();
$consultaTotal->bind_result($totalCartas);
$consultaTotal->fetch();
$consultaTotal->close();

$totalPaginas = ceil($totalCartas / $cartasPorPagina);

// Preparar la consulta
$listaCartas = "SELECT nombre, img FROM cartas LIMIT ? OFFSET ?";
$consulta = $conexion->prepare($listaCartas);
$consulta->bind_param("ii", $cartasPorPagina, $offset);
$consulta->execute();
$consulta->bind_result($nombre, $img);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h2>
    <p style="text-align: center;">Esta es la página de inicio.</p>
    <a href="../modelo/cerrar_sesion.php">Cerrar Sesión</a>

    <div class="contenedor-cartas">
        <?php while ($consulta->fetch()) { ?>
            <div class="carta">
                <p><?php echo $nombre; ?></p>
                <img src="<?php echo "../img/" . $img; ?>" alt="Imagen">
            </div>
        <?php } ?>
    </div>


    <!-- Enlaces para moverse -->

    <a href="?pagina=1">Principio</a>

    <a href="?pagina=<?php echo max(1, $paginaActual - 1); ?>">Página Anterior</a>

    <?php echo "Pagina " . $paginaActual; ?>

    <a href="?pagina=<?php echo $paginaActual + 1; ?>">Página Siguiente</a>

    <a href="?pagina=<?php echo $totalPaginas ?>">Final</a>


</body>

</html>

<?php
$consulta->close();
?>