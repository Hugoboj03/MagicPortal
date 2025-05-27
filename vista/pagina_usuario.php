<?php
session_start();
include("../conexion.php");
include('../modelo/funcionesConsultas.php');

if (isset($_GET['obtenerImagen'])) {
    $nombreCarta = $_GET['obtenerImagen'];
    $imagen = obtenerImagenCarta($nombreCarta);
    echo "../img/" . $imagen;  // 🔧 CAMBIADO: ahora se construye bien la ruta
    exit;
}


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
    } else {
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
    <style>
        .contenedor-body {
            display: flex;
            align-items: flex-start;
        }

        @media (max-width: 768px) {
            .contenedor-body {
                display: block;
                /* Elimina flex, apila los bloques verticalmente */
                max-width: 95%;
                /* Más espacio en los bordes */
                margin: 0 auto;
            }

            .form-container {
                width: 100%;
                /* Ocupa todo el ancho disponible */
                margin-bottom: 1rem;
                text-align: center;
            }

            .carta img {
                max-width: 200px;
            }
        }

        @media (max-width: 500px) {
            .contenedor-body {
                display: block;
                
                max-width: 95%;
                
                margin: 0 auto;
            }

            .form-container {
                width: 100%;
                margin-bottom: 1rem;
                text-align: center;
            }

            .carta img {
                max-width: 170px;
            }
        }
    </style>

</head>

<body>

    <h1>Panel usuario</h1>

    <div class="contenedor-body">
        <div class="form-container">
            <h2>Poner carta en venta</h2>
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
        <div id="mostrar-imagen" class="form-container">
            <h2>Vista previa</h2>
            <div id="imagen-carta-preview" class="carta">
                <p>Selecciona una carta para ver la imagen.</p>
                <img id="imagenCartaSeleccionada" src="" alt="Imagen de carta" style="display:none; max-width:300px;">

            </div>
        </div>
        <div class="form-container">
            <h2>Historial de ventas</h2>
            <form action="../modelo/procesar_comentarios.php" method="post">
                <label for="venta">Selecciona una compra:</label><br>
                <select name="id_vendedor" id="venta" required>
                    <option value="">-- Elige una compra --</option>
                    <?php
                    $usuario = $_SESSION['usuario'];
                    $historial = historial($usuario); // Llama a la función

                    foreach ($historial as $compra) {
                        $vendedor = $compra['nombre_vendedor'];
                        $carta = $compra['nombre_carta'];
                        $precio = number_format($compra['precio'], 2);
                        $idVendedor = $compra['id_vendedor'];

                        echo "<option value='{$idVendedor}'>Vendedor: $vendedor | Carta: $carta | €$precio</option>";
                    }
                    ?>
                </select><br><br>

                <label for="comentario">Comentario:</label><br>
                <textarea name="comentario" id="comentario" rows="4" cols="40" required></textarea><br><br>

                <label>Clasificación:</label><br>
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    echo "<input type='radio' name='clasificacion' value='$i' id='star$i' required>
                  <label for='star$i'>$i</label> ";
                }
                ?>
                <br><br>
                <button type="submit">Enviar reseña</button>
            </form>
        </div>
    </div>



</body>


<script>
    function mostrarImagenCarta(nombreCarta) {
        fetch('?obtenerImagen=' + encodeURIComponent(nombreCarta))
            .then(response => response.text())
            .then(imagenUrl => {
                const contenedorImagen = document.getElementById('imagen-carta-preview');
                contenedorImagen.innerHTML = `<img src="${imagenUrl}" alt="Carta seleccionada" style="max-width:100%; border-radius: 10px;">`;
            });
    }
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
                            const nombreSeleccionado = sugerencia.textContent;
                            nombreInput.value = sugerencia.textContent;
                            sugerenciasDiv.innerHTML = ''; // Vaciar sugerencias al seleccionar

                            mostrarImagenCarta(nombreSeleccionado);
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