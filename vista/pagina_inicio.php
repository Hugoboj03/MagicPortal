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

    <div class="form-container">
        <h1>Magic Portal</h1>
        <form method="POST" action="">
            <div class="primer-contenedor-form">
                <!-- Barra de búsqueda -->
                <div class="search-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ej: Black Lotus">
                </div>

                <!-- Checkbox para manás -->
                <div class="mana-group">
                    <h3>Maná:</h3>
                    <div class="manas">
                        <div class="mana-option">
                            <input type="checkbox" id="rojo" name="mana[]" value="Rojo">
                            <label for="rojo">Rojo</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="azul" name="mana[]" value="Azul">
                            <label for="azul">Azul</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="verde" name="mana[]" value="Verde">
                            <label for="verde">Verde</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="negro" name="mana[]" value="Negro">
                            <label for="negro">Negro</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="blanco" name="mana[]" value="Blanco">
                            <label for="blanco">Blanco</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="incoloro" name="mana[]" value="Incoloro">
                            <label for="incoloro">Neutro</label>
                        </div>
                    </div>
                </div>

                <!-- Radio buttons para legendario -->
                <div class="legendary-group">
                    <h3>Legendaria:</h3>
                    <div class="radio-options">
                        <div>
                            <input type="radio" id="si" name="legendaria" value="Sí" required>
                            <label for="si">Sí</label>
                        </div>
                        <div>
                            <input type="radio" id="no" name="legendaria" value="No">
                            <label for="no">No</label>
                        </div>
                        <div>
                            <input type="radio" id="ambas" name="legendaria" value="Ambas">
                            <label for="no">Ambas</label>
                        </div>
                    </div>
                </div>

                <!-- Botón de envío -->
                <button type="submit">Buscar</button>
            </div>
            <div class="primer-contenedor-form">
                <div class="mana-group">
                    <h3>Habilidades:</h3>
                    <!-- Primera fila (5 habilidades) -->
                    <div class="manas">
                        <div class="mana-option">
                            <input type="checkbox" id="alcance" name="habilidad[]" value="Alcance">
                            <label for="alcance">Alcance</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="arrollar" name="habilidad[]" value="Arrollar">
                            <label for="arrollar">Arrollar</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="danar_dos_veces" name="habilidad[]" value="Dañar dos Veces">
                            <label for="danar_dos_veces">Dañar dos Veces</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="danar_primero" name="habilidad[]" value="Dañar Primero">
                            <label for="danar_primero">Dañar Primero</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="prisa" name="habilidad[]" value="Prisa">
                            <label for="prisa">Prisa</label>
                        </div>
                    </div>
                    <!-- Segunda fila (5 habilidades) -->
                    <div class="manas">
                        <div class="mana-option">
                            <input type="checkbox" id="toque_mortal" name="habilidad[]" value="Toque Mortal">
                            <label for="toque_mortal">Toque Mortal</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="vinculo_vital" name="habilidad[]" value="Vinculo Vital">
                            <label for="vinculo_vital">Vínculo Vital</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="volar" name="habilidad[]" value="Volar">
                            <label for="volar">Volar</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="amenaza" name="habilidad[]" value="Amenaza">
                            <label for="amenaza">Amenaza</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="antimaleficio" name="habilidad[]" value="Antimalefício">
                            <label for="antimaleficio">Antimalefício</label>
                        </div>
                    </div>
                    <!-- Tercera fila (5 habilidades) -->
                    <div class="manas">
                        <div class="mana-option">
                            <input type="checkbox" id="defensor" name="habilidad[]" value="Defensor">
                            <label for="defensor">Defensor</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="destello" name="habilidad[]" value="Destello">
                            <label for="destello">Destello</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="vigilancia" name="habilidad[]" value="Vigilancia">
                            <label for="vigilancia">Vigilancia</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="indestructible" name="habilidad[]" value="Indestructible">
                            <label for="indestructible">Indestructible</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="destreza" name="habilidad[]" value="Destreza">
                            <label for="destreza">Destreza</label>

                        </div>
                    </div>
                </div>
                <div class="tipo-carta">
                    <h3>Seleccione un tipo de carta</h3>
                    <select name="Sistema operativo favorito">
                        <option value="Linux">Tipo Carta</option>
                        <option value="Windows">Windows </option>
                        <option value="MacOS">Mac OS </option>
                    </select>
                </div>
                <div class="tipo-carta">
                <h3>Seleccione su primer tipo de criatura</h3>
                    <select name="Sistema operativo favorito">
                        <option value="Linux">Tipo Criatura</option>
                        <option value="Windows">Windows </option>
                        <option value="MacOS">Mac OS </option>
                    </select>
                </div>
                <div class="tipo-carta">
                <h3>Seleccione segundo tipo de criatura</h3>
                    <select name="Sistema operativo favorito">
                        <option value="Linux">Tipo Criatura</option>
                        <option value="Windows">Windows </option>
                        <option value="MacOS">Mac OS </option>
                    </select>
                </div>
            </div>

        </form>
    </div>

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