<?php
session_start();
include("../conexion.php");
include("../modelo/funcionesConsultas.php");
include("header.php");

// Obtener todos los usuarios registrados
$usuarios = [];
$resultado = $conexion->query("SELECT nombre FROM usuarios");
while ($fila = $resultado->fetch_assoc()) {
    $usuarios[] = $fila['nombre'];
}

// Filtrar usuarios con media < 3
$usuariosMalos = [];
foreach ($usuarios as $usuario) {
    $media = usuariosConMenosDeTresEstrellas($usuario);
    if ($media !== null && $media < 3) {
        $usuariosMalos[] = ['nombre' => $usuario, 'media' => $media];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Usuarios con baja calificación</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <style>
        .contenedor-body {
            display: flex;

        }
    </style>
</head>

<body>

    <div class="contenedor-body">
        <div class="form-container">
            <h2>Usuarios con menos de 3 estrellas</h2>
            <ul>
                <?php if (count($usuariosMalos) > 0): ?>
                    <?php foreach ($usuariosMalos as $usuario): ?>
                        <form method="get" action="">
                            <input type="hidden" name="usuario" value="<?php echo $usuario['nombre']; ?>">
                            <button type="submit">
                                <?php echo $usuario['nombre'] . " - ⭐ " . $usuario['media']; ?>
                            </button><br><br>
                        </form>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No hay usuarios con mala calificación.</li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="form-container">
            <?php if (isset($_GET['usuario'])): ?>
                <?php
                $nombreSeleccionado = $_GET['usuario'];
                $id = buscarUsuarioPorNombre($nombreSeleccionado);
                $comentarios = obtenerComentariosDeUsuario($id);
                ?>
                <h2>Comentarios de <?php echo $nombreSeleccionado; ?></h2>
                <?php if (count($comentarios) > 0): ?>
                    <ul>
                        <?php foreach ($comentarios as $comentario): ?>
                            <li><strong><?php echo $comentario['fecha_comentario']; ?></strong>: <?php echo $comentario['comentario']; ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <form action="eliminar_usuario.php" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                        <input type="hidden" name="usuario" value="<?php echo $nombreSeleccionado; ?>">
                        <button type="submit">Eliminar usuario</button>
                    </form>
                    <?php if (isset($_GET['eliminado'])): ?>
                        <p style="color: green;">Usuario eliminado correctamente.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>No hay comentarios para este usuario.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>