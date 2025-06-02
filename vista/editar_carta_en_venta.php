<?php
session_start();
include("../conexion.php");
include('../modelo/funcionesConsultas.php');
include("header.php");

$usuario = $_SESSION['usuario'] ?? '';
if (!$usuario) {
    echo "<p>Debes iniciar sesión para editar tus cartas en venta.</p>";
    include("footer.php");
    exit;
}

// Obtener el ID del usuario actual
$stmtUser = $conexion->prepare("SELECT id FROM usuarios WHERE nombre = ?");
$stmtUser->bind_param("s", $usuario);
$stmtUser->execute();
$idUsuario = $stmtUser->get_result()->fetch_assoc()['id'] ?? 0;
$stmtUser->close();

if (!$idUsuario) {
    echo "<p>Error: No se pudo obtener el ID del usuario.</p>";
    include("footer.php");
    exit;
}

// Obtener el ID de la carta desde GET
$idCarta = isset($_GET['id_carta']) ? intval($_GET['id_carta']) : 0;

// Buscar la carta en venta del usuario
$sql = "SELECT cartas.*, cartas_en_venta.precio 
        FROM cartas_en_venta 
        JOIN cartas ON cartas_en_venta.id_carta = cartas.id 
        WHERE cartas.id = ? AND cartas_en_venta.id_vendedor = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $idCarta, $idUsuario);
$stmt->execute();
$carta = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$carta) {
    echo "<p>No tienes acceso para editar esta carta o no existe.</p>";
    include("footer.php");
    exit;
}

// Procesar el formulario solo si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCarta = isset($_POST['id_carta']) ? intval($_POST['id_carta']) : 0;
    $accion = $_POST['accion'] ?? '';

    if ($accion === "actualizar") {
        $precio = $_POST['precio'] ?? '';

        if (!validarPrecio($precio)) {
            echo "<p>El precio ingresado no es válido. Debe ser un número con hasta 2 decimales.</p>";
        } elseif (actualizarPrecioCarta($conexion, $idCarta, $idUsuario, floatval($precio))) {
            header("Location: usuario_cartas_en_venta.php");
            exit;
        } else {
            echo "<p>Error al actualizar el precio.</p>";
        }
    } elseif ($accion === "eliminar") {
        if (eliminarCartaEnVentaDesdeUsuario($conexion, $idCarta, $idUsuario)) {
            header("Location: usuario_cartas_en_venta.php");
            exit;
        } else {
            echo "<p>Error al eliminar la carta.</p>";
        }
    } else {
        echo "<p>Acción no válida.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Carta en Venta</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
    <style>
        .contenedor {
            display: flex;
            flex-direction: column;
            align-items: center;

            

        }
    </style>
</head>

<body>
    <h1>Editar Carta: <?php echo $carta['nombre']; ?></h1>

    <div class="contenedor">
        <img src="<?php echo "../img/" . $carta['img']; ?>" alt="Imagen carta" style="max-width: 300px;"><br><br>

        <form action="" method="post">
            <input type="hidden" name="id_carta" value="<?php echo $idCarta; ?>">

            <label for="precio">Precio (€):</label><br>
            <input type="text" name="precio" id="precio" value="<?php echo number_format($carta['precio'], 2); ?>" required><br><br>

            <button type="submit" name="accion" value="actualizar">Actualizar Precio</button>
            <button type="submit" name="accion" value="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta carta de la venta?');">Eliminar de la venta</button>
        </form>
    </div>

    <?php include("footer.php"); ?>
</body>

</html>