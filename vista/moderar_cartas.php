<?php
session_start();
include("../conexion.php");
include('../modelo/funcionesConsultas.php');

// ------------------------------
// 1. Lógica AJAX para buscar nombre
// ------------------------------
if (isset($_GET['buscarNombre'])) {
    $nombre = $_GET['buscarNombre'];
    $cartas = buscarCartasPorNombre($nombre);

    foreach ($cartas as $carta) {
        echo "<div class='sugerencia'>{$carta['nombre']}</div>";
    }
    exit;
}

// ------------------------------
// 2. Lógica AJAX para obtener datos de la carta
// ------------------------------
if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
    $datosCarta = obtenerDatosDeCartaPorNombre($nombre);

    header('Content-Type: application/json');
    if ($datosCarta) {
        echo json_encode($datosCarta);
    } else {
        echo json_encode(["error" => "Carta no encontrada."]);
    }
    exit;
}

// ------------------------------
// 3. Resto del flujo normal de la página
// ------------------------------
include("header.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreCarta = isset($_POST['nombreCarta']) ? trim($_POST['nombreCarta']) : '';
    $mana_rojo = $_POST['mana_rojo'] ?? null;
    $mana_azul = $_POST['mana_azul'] ?? null;
    $mana_verde = $_POST['mana_verde'] ?? null;
    $mana_negro = $_POST['mana_negro'] ?? null;
    $mana_blanco = $_POST['mana_blanco'] ?? null;
    $mana_neutro = $_POST['mana_neutro'] ?? null;
    $tipo_carta = $_POST['tipo_carta'] ?? null;
    $legendaria = $_POST['legendaria'] ?? 0;
    $ataque = $_POST['ataque'] !== '' ? $_POST['ataque'] : null;
    $defensa = $_POST['defensa'] !== '' ? $_POST['defensa'] : null;
    
    $errores = [];

    // Validaciones
    if (empty($nombreCarta)) {
        $errores[] = "El nombre de la carta no puede estar vacío.";
    }

    if (!is_numeric($tipo_carta) || $tipo_carta < 1 || $tipo_carta > 7) {
        $errores[] = "El tipo de carta debe ser un número entre 1 y 7.";
    }

    if (!is_numeric($mana_rojo) || $mana_rojo < 0 ||
        !is_numeric($mana_azul) || $mana_azul < 0 ||
        !is_numeric($mana_verde) || $mana_verde < 0 ||
        !is_numeric($mana_negro) || $mana_negro < 0 ||
        !is_numeric($mana_blanco) || $mana_blanco < 0 ||
        !is_numeric($mana_neutro) || $mana_neutro < 0) {
        $errores[] = "Todos los campos de maná deben ser números positivos.";
    }

    // Si no hay errores, insertar en la base de datos
    if (empty($errores)) {
        $resultado = actualizarCarta($nombreCarta, $mana_rojo, $mana_azul, $mana_verde, $mana_negro, $mana_blanco, $mana_neutro, $tipo_carta, $legendaria, $ataque, $defensa);
    } else {
        // Mostrar errores
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

</head>

<body>

    <h1>Editar carta</h1>
    <div class="form-container">
        <form action="moderar_cartas.php" method="post">
            <div class="search-group">
                <label>Nombre:</label>
                <input type="text" id="nombreCarta" name="nombreCarta" placeholder="Ej: Black Lotus" autocomplete="off">
                <div id="sugerencias" class="sugerencias"></div>
            </div><br>
            <div id="formAdicional" style="display: none;">
                <div class="search-group">
                    <label for="mana_rojo">Maná Rojo:</label>
                    <input type="number" id="mana_rojo" name="mana_rojo" min="0" required><br>

                    <label for="mana_azul">Maná Azul:</label>
                    <input type="number" id="mana_azul" name="mana_azul" min="0" required><br>

                    <label for="mana_verde">Maná Verde:</label>
                    <input type="number" id="mana_verde" name="mana_verde" min="0" required><br>

                    <label for="mana_negro">Maná Negro:</label>
                    <input type="number" id="mana_negro" name="mana_negro" min="0" required><br>

                    <label for="mana_blanco">Maná Blanco:</label>
                    <input type="number" id="mana_blanco" name="mana_blanco" min="0" required><br>

                    <label for="mana_neutro">Maná Neutro:</label>
                    <input type="number" id="mana_neutro" name="mana_neutro" min="0" required><br><br>

                    <label for="tipo_carta">Tipo de Carta (ID):</label>
                    <input type="number" id="tipo_carta" name="tipo_carta" required max=7 min=1><br><br>

                    <label for="legendaria">¿Es legendaria?</label>
                    <select id="legendaria" name="legendaria" required>
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select><br><br>

                    <label for="ataque">Ataque:</label>
                    <input type="number" id="ataque" name="ataque"><br>

                    <label for="defensa">Defensa:</label>
                    <input type="number" id="defensa" name="defensa"><br>


                    <br>
                </div><br>
                <button type="submit">Actualizar Carta</button>
            </div>

        </form>
    </div>


</body>


<script>
    const nombreInput = document.getElementById('nombreCarta');
    const sugerenciasDiv = document.getElementById('sugerencias');
    const formAdicional = document.getElementById('formAdicional');

    function buscarCartasPorNombreScript() {
        const nombre = nombreInput.value.trim();

        if (nombre.length > 0) {
            fetch('?buscarNombre=' + encodeURIComponent(nombre))
                .then(response => response.text())
                .then(data => {
                    sugerenciasDiv.innerHTML = data;

                    const sugerencias = sugerenciasDiv.querySelectorAll('.sugerencia');
                    sugerencias.forEach(sugerencia => {
                        sugerencia.addEventListener('click', () => {
                            const nombreSeleccionado = sugerencia.textContent;
                            nombreInput.value = nombreSeleccionado;
                            sugerenciasDiv.innerHTML = '';

                            // Obtener datos de la carta desde el servidor
                            fetch('moderar_cartas.php?nombre=' + encodeURIComponent(nombreSeleccionado))
                                .then(response => response.json())
                                .then(carta => {
                                    if (carta.error) {
                                        alert("Carta no encontrada.");
                                        formAdicional.style.display = 'none';
                                    } else {
                                        // Rellenar formulario con los datos recibidos
                                        document.getElementById('mana_rojo').value = carta.mana_rojo;
                                        document.getElementById('mana_azul').value = carta.mana_azul;
                                        document.getElementById('mana_verde').value = carta.mana_verde;
                                        document.getElementById('mana_negro').value = carta.mana_negro;
                                        document.getElementById('mana_blanco').value = carta.mana_blanco;
                                        document.getElementById('mana_neutro').value = carta.mana_neutro;
                                        document.getElementById('tipo_carta').value = carta.tipo_carta;
                                        document.getElementById('legendaria').value = carta.legendaria;
                                        document.getElementById('ataque').value = carta.ataque !== null ? carta.ataque : '';
                                        document.getElementById('defensa').value = carta.defensa !== null ? carta.defensa : '';

                                        formAdicional.style.display = 'block';
                                    }
                                })
                                .catch(error => {
                                    console.error("Error al obtener la carta:", error);
                                    alert("Ocurrió un error al cargar los datos de la carta.");
                                });
                        });
                    });
                });
        } else {
            sugerenciasDiv.innerHTML = '';
            formAdicional.style.display = 'none'; // Ocultar si no hay texto
        }
    }

    nombreInput.addEventListener('input', buscarCartasPorNombreScript);
</script>

</html>