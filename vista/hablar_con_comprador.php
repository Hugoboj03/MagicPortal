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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
    <style>
        .form-container {
        max-width: 90%;
        margin: 0 auto;
        padding: clamp(15px, 3vw, 20px);
        text-align: center;
    }
    </style>
</head>

<body>

    <br><br>
    <div class="form-container">
        <h1>Usuarios que te escribieron</h1>
        <label for="usuarioSelect">Selecciona un usuario:</label><br>
        <select id="usuarioSelect" onchange="mostrarMensajes()">
            <option value="">-- Elige un usuario --</option>
            <?php foreach ($usuarios as $u): ?>
                <option value="<?php echo $u['id']; ?>"><?php echo $u['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <br><br>

        <label for="mensajes">Mensajes recibidos:</label><br>
        <textarea id="mensajes" rows="16" cols="50" readonly></textarea>
        <form action="../modelo/procesar_mensajes.php" method="post">
            <label for="comentario">Escribe tu mensaje:</label><br>
            <textarea name="comentario" rows="2" cols="50" required></textarea><br>
            <input type="hidden" name="nombre_emisor" value="<?php echo $_SESSION['usuario']; ?>">
            <input type="hidden" name="id_receptor" id="idReceptorInput">
            <input type="hidden" name="procedencia" value="1">
            <button type="submit">Comprar</button>
        </form>
    </div>

    <script>
        // Obtenemos nuestro nombre de usuario
        const idUsuarioActual = <?php echo buscarUsuarioPorNombre($nombreUsuario); ?>;

        const mensajesPorUsuario = <?php
                                    $mensajesJS = [];
                                    $idActual = buscarUsuarioPorNombre($nombreUsuario);

                                    foreach ($usuarios as $usuario) {
                                        $mensajes = obtenerMensajesDeUsuario($nombreUsuario, $usuario['id']);
                                        $mensajesFormateados = [];

                                        foreach ($mensajes as $mensaje) {
                                            $emisor = $mensaje['id_emisor'] == $idActual ? "Yo" : $usuario['nombre'];
                                            $mensajesFormateados[] = "[" . $mensaje['fecha_envio'] . "] " . $emisor . ": " . $mensaje['mensaje'];
                                        }

                                        $mensajesJS[$usuario['id']] = implode("\n", $mensajesFormateados);
                                    }

                                    echo json_encode($mensajesJS, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
                                    ?>;

        function mostrarMensajes() {
            const select = document.getElementById('usuarioSelect');
            const textarea = document.getElementById('mensajes');
            const idSeleccionado = select.value;

            // Mostramos el mensaje
            textarea.value = mensajesPorUsuario[idSeleccionado] || "No hay mensajes.";

            // Enviamos el id al hidden
            const inputReceptor = document.getElementById('idReceptorInput');
            inputReceptor.value = idSeleccionado;
        }
    </script>
</body>

</html>