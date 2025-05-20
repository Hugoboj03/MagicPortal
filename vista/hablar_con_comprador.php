<?php
session_start();
include("../conexion.php");
include("../modelo/funcionesConsultas.php");
include("header.php");

$nombreUsuario = $_SESSION['usuario'];

// Obtener lista de usuarios que enviaron mensajes
$idsUsuarios = obtenerListaDeComentadores($nombreUsuario);
$usuarios = [];

foreach ($idsUsuarios as $idEmisor) {
    $stmt = $conexion->prepare("SELECT nombre FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $idEmisor);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado && $resultado->num_rows > 0) {
        $nombreEmisor = $resultado->fetch_assoc()['nombre'];
        $usuarios[] = ['id' => $idEmisor, 'nombre' => $nombreEmisor];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Hola, <?php echo htmlspecialchars($nombreUsuario); ?></h2>

    <div class="form-container">
        <label for="usuarioSelect">Selecciona un usuario:</label><br>
        <select id="usuarioSelect" onchange="mostrarMensajes()">
            <option value="">-- Elige un usuario --</option>
            <?php foreach ($usuarios as $u): ?>
                <option value="<?php echo $u['id']; ?>"><?php echo htmlspecialchars($u['nombre']); ?></option>
            <?php endforeach; ?>
        </select>

        <br><br>

        <label for="mensajes">Mensajes recibidos:</label><br>
        <textarea id="mensajes" rows="10" cols="50" readonly></textarea>
    </div>

    <script>
        const mensajesPorUsuario = <?php
            $mensajesJS = [];
            foreach ($usuarios as $usuario) {
                $mensajes = obtenerMensajesDeUsuario($nombreUsuario, $usuario['id']);
                $mensajesFormateados = [];
                foreach ($mensajes as $mensaje) {
                    $mensajesFormateados[] = "[" . $mensaje['fecha_envio'] . "] " . $mensaje['mensaje'];
                }
                $mensajesJS[$usuario['id']] = implode("\n---\n", $mensajesFormateados);
            }
            echo json_encode($mensajesJS, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        ?>;

        function mostrarMensajes() {
            const select = document.getElementById('usuarioSelect');
            const textarea = document.getElementById('mensajes');
            const idSeleccionado = select.value;
            textarea.value = mensajesPorUsuario[idSeleccionado] || "No hay mensajes.";
        }
    </script>
</body>
</html>