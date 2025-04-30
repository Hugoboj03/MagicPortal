<?php
session_start();
include("../conexion.php");
include('../modelo/funcionesConsultas.php');


if (isset($_GET['buscarNombre'])) {

    $nombre = $_GET['buscarNombre'];
    $cartas = buscarCartasPorNombre($nombre);

    foreach ($cartas as $carta) {
        echo "<div class='sugerencia'>{$carta['nombre']}</div>";
    }
    exit; // Muy importante: terminamos aquí para no seguir generando HTML del resto de la página
}


include("header.php");



// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreCarta = isset($_POST['nombreCarta']) ? trim($_POST['nombreCarta']) : '';
    $precioCarta = isset($_POST['precioCarta']) ? trim($_POST['precioCarta']) : '';


    $errores = [];

    // Validación de nombre
    if (empty($nombreCarta)) {
        $errores[] = "El nombre de la carta no puede estar vacío.";
    }

    
    if (!validarPrecio($precioCarta)) {
        $errores[] = "El precio debe ser un número válido en formato euros (por ejemplo: 2.00 o 9999.99).";
        
    }else{
        $precioCarta = (float) $precioCarta;
    }

    // Comprobamos errores
    if (empty($errores)) {

        $idCarta = "SELECT id FROM cartas WHERE nombre = ?";
        $consultaIdCarta = $conexion->prepare($idCarta);
        $consultaIdCarta->bind_param("s", $nombreCarta);
        $consultaIdCarta->execute();
        $consultaIdCarta->bind_result($idCartaNombre);
        $consultaIdCarta->fetch();
        //$idCartaInsertarse = $idCartaNombre;
        $consultaIdCarta->close();

        //$nombreUsuario = $_SESSION['usuario'];

        $idUsuario = "SELECT id FROM usuarios WHERE nombre = ?";
        $consultaIdUsuario = $conexion->prepare($idUsuario);
        $consultaIdUsuario->bind_param("s", $_SESSION['usuario']);
        $consultaIdUsuario->execute();
        $consultaIdUsuario->bind_result($idUsuarioNombre);
        $consultaIdUsuario->fetch();
        //$idUsuarioInsertarse = $idUsuarioNombre;
        $consultaIdUsuario->close();

        $insertarCarta = "INSERT INTO `cartas_en_venta` (`id_carta`, `id_vendedor`, `precio`) VALUES (?, ?, ?)";
        $consultaInsertarCarta = $conexion->prepare($insertarCarta);
        $consultaInsertarCarta->bind_param("iid", $idCartaNombre, $idUsuarioNombre, $precioCarta);
        if ($consultaInsertarCarta->execute()) {
            echo "<p class='success'>Carta agregada a la lista de ventas correctamente.</p>";
        } else {
            $errores[] = "Error al agregar la carta a la lista de ventas: " . $consultaInsertarCarta->error;
        }
        $consultaInsertarCarta->close();

    } else {
        foreach ($errores as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}
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

    <h2>Poner carta en venta</h2>
    <div class="form-container">
        <form action="pagina_usuario.php" method="post">
            <div class="search-group">
                <label>Nombre:</label>
                <input type="text" id="nombreCarta" name="nombreCarta" placeholder="Ej: Black Lotus" autocomplete="off">
                <div id="sugerencias" class="sugerencias"></div>
            </div><br>
            <div class="search-group">
                <label>Precio en Euros:</label>
                <input type="text" id="precioCarta" name="precioCarta" placeholder="2.00">
            </div><br>
            <button type="submit">Poner a la venta</button>
        </form>
    </div>


</body>


<script>

    /**
     * Este script me ayuda a autocompletar la busqueda de cartas
     */
    function buscarCartasPorNombreScript() {
        const nombreInput = document.getElementById('nombreCarta');
        const sugerenciasDiv = document.getElementById('sugerencias');
        const nombre = nombreInput.value.trim();

        /**
         * Si han escrito almenos una letra empezara la busqueda
         */
        if (nombre.length > 0) {
            /**Codificamos en nombre para que pueda ser enviado como una URL para más tarde ser recogido por PHP */
            fetch('?buscarNombre=' + encodeURIComponent(nombre))
                .then(response => response.text())
                .then(data => {
                    sugerenciasDiv.innerHTML = data;

                    // Añadir event listeners a las sugerencias
                    const sugerencias = sugerenciasDiv.querySelectorAll('.sugerencia');
                    sugerencias.forEach(sugerencia => {
                        sugerencia.addEventListener('click', () => {
                            nombreInput.value = sugerencia.textContent;
                            sugerenciasDiv.innerHTML = ''; // Vaciar sugerencias al seleccionar
                        });
                    });
                });
        } else {
            sugerenciasDiv.innerHTML = '';
        }
    }

    /**Se añade un evento que se activara cada vez que el usuario escriba una letra */
    document.getElementById('nombreCarta').addEventListener('input', buscarCartasPorNombreScript);
</script>

</html>