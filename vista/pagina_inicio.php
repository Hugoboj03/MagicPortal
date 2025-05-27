<?php
session_start();
include("../conexion.php");
include('../modelo/funcionesConsultas.php');
include("header.php");

/***
 * Me hize un lio.
 * El metodo de buscar las cartas en la base de datos al iniciar el programa y al hacer una busqueda filtrada es distinta
 * con un if y una sesion logre que funcionase.
 * Quidado al hacer cambios, puede hacer que explote, hay un caso parecido en el caso de recordar en que pagina nos encontramos
 */



// Verificar si el usuario ha iniciado sesión

/*
 * 
 * if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
 * 
 */


if (!isset($_SESSION['filtros'])) {
    $_SESSION['filtros'] = [
        'nombreCarta' => '',
        'mana' => [],
        'legendaria' => '',
        'habilidades' => [],
        'tipoCarta' => '',
        'tipoCriatura1' => '',
        'tipoCriatura2' => '',

    ];
}





// 1. Obtener los tipos de carta 
$listaTipoCartas = "SELECT tipo FROM tipo_carta";
$consultaTipoCartas = $conexion->prepare($listaTipoCartas);
$consultaTipoCartas->execute();
$consultaTipoCartas->bind_result($tipoCarta);

// Guardar los tipos en un array para usar más tarde en el HTML
$tipos = [];
while ($consultaTipoCartas->fetch()) {
    $tipos[] = $tipoCarta;
}
$consultaTipoCartas->close();

// 2. Obtener los tipos de carta 
$listaTipoCriaturas = "SELECT tipo_criatura_nombre FROM tipo_criatura";
$consultaTipoCriaturas = $conexion->prepare($listaTipoCriaturas);
$consultaTipoCriaturas->execute();
$consultaTipoCriaturas->bind_result($tipoCriatura);

// Guardar los tipos en un array para usar más tarde en el HTML
$tiposCriatura = [];
while ($consultaTipoCriaturas->fetch()) {
    $tiposCriatura[] = $tipoCriatura;
}
$consultaTipoCriaturas->close();

// Cartas por pagina
$cartasPorPagina = 32;

$nombreCarta = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreCarta = isset($_POST['nombreCarta']) ? trim($_POST['nombreCarta']) : '';
    $mana = isset($_POST['mana']) && is_array($_POST['mana']) ? $_POST['mana'] : [];
    $legendaria = isset($_POST['legendaria']) ? $_POST['legendaria'] : '';
    $habilidades = isset($_POST['habilidad']) && is_array($_POST['habilidad']) ? $_POST['habilidad'] : [];
    $tipoCarta = isset($_POST['tipoCarta']) ? trim($_POST['tipoCarta']) : '';
    $tipoCriatura1 = isset($_POST['TipoCriatura1']) ? trim($_POST['TipoCriatura1']) : '';
    $tipoCriatura2 = isset($_POST['TipoCriatura2']) ? trim($_POST['TipoCriatura2']) : '';

    $_SESSION['filtros'] = [
        'nombreCarta' => $nombreCarta,
        'mana' => $mana,
        'legendaria' => $legendaria,
        'habilidades' => $habilidades,
        'tipoCarta' => $tipoCarta,
        'tipoCriatura1' => $tipoCriatura1,
        'tipoCriatura2' => $tipoCriatura2,
    ];

    header("Location: pagina_inicio.php");
    exit();

    $consultaF = obtenerCartasFiltradas($nombreCarta, $legendaria, $mana, $habilidades, $tipoCarta, $tipoCriatura1, $tipoCriatura2);

    $totalCartasFiltradas = count($consultaF);

    $totalPaginas = ceil($totalCartasFiltradas / $cartasPorPagina);

    if (isset($_GET['pagina'])) {
        $paginaActual = $_GET['pagina'];
    } else {
        $paginaActual = 1;
    }

    $indiceInicio = ($paginaActual - 1) * $cartasPorPagina;
    $indiceFin = $indiceInicio + $cartasPorPagina - 1;

    $consultaFiltrada = array_slice($consultaF, $indiceInicio, $cartasPorPagina);
} else {

    if (isset($_SESSION['filtros'])) {

        $filtros = $_SESSION['filtros'];
        $nombreCarta = $filtros['nombreCarta'] ?? '';
        $legendaria = $filtros['legendaria'] ?? '';
        $mana = $filtros['mana'] ?? '';
        $habilidad = $filtros['habilidades'] ?? '';
        $tipoCarta = $filtros['tipoCarta'] ?? '';
        $tipoCriatura1 = $filtros['tipoCriatura1'] ?? '';
        $tipoCriatura2 = $filtros['tipoCriatura2'] ?? '';
        // Si obtienes más filtros en `obtenerCartasFiltradas`, pásalos aquí
        $consultaF = obtenerCartasFiltradas($nombreCarta, $legendaria, $mana, $habilidad, $tipoCarta, $tipoCriatura1, $tipoCriatura2);
        $totalCartasFiltradas = count($consultaF);
        $totalPaginas = ceil($totalCartasFiltradas / $cartasPorPagina);

        $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        if ($paginaActual < 1) $paginaActual = 1;

        $indiceInicio = ($paginaActual - 1) * $cartasPorPagina;
        $consultaFiltrada = array_slice($consultaF, $indiceInicio, $cartasPorPagina);
    } else {
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
        $listaCartas = "SELECT id, nombre, img FROM cartas LIMIT ? OFFSET ?";
        $consulta = $conexion->prepare($listaCartas);
        $consulta->bind_param("ii", $cartasPorPagina, $offset);
        $consulta->execute();
        $consulta->bind_result($idCarta, $nombre, $img);
    }
}







?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
    <style>
        @media (max-width: 768px) {
            .primer-contenedor-form {
                flex-direction: column;
                
                align-items: center;
            }


            button[type="submit"] {
                width: 100%;
                max-width: 150px;
            }
        }

        @media (max-width: 500px) {
            .primer-contenedor-form {
                flex-direction: column;
                
                align-items: center;
            }


            button[type="submit"] {
                width: 100%;
                max-width: 150px;
            }
        }

        
    </style>
</head>

<body>

    <!--<p style="text-align: center;">Esta es la página de inicio.</p>-->
    <!--<a href="../modelo/cerrar_sesion.php">Cerrar Sesión</a>-->

    <div class="form-container">
        <h1>Magic Portal</h1>
        <!-- ../modelo/funcionesConsultas.php -->
        <form method="POST" action="pagina_inicio.php">
            <div class="primer-contenedor-form">
                <!-- Barra de búsqueda -->
                <div class="search-group">
                    <label>Nombre:</label>
                    <input type="text" id="nombreCarta" name="nombreCarta" placeholder="Ej: Black Lotus" value=<?php echo $nombreCarta ?>>
                </div>

                <!-- Checkbox para manás -->
                <div class="mana-group">
                    <h3>Maná:</h3>
                    <div class="manas">
                        <div class="mana-option">
                            <input type="checkbox" id="rojo" name="mana[]" value=rojo <?php echo (isset($_SESSION['filtros']['mana']) && in_array('rojo', $_SESSION['filtros']['mana'])) ? 'checked' : ''; ?>>
                            <label>Rojo</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="azul" name="mana[]" value=azul <?php echo (isset($_SESSION['filtros']['mana']) && in_array('azul', $_SESSION['filtros']['mana'])) ? 'checked' : ''; ?>>
                            <label>Azul</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="verde" name="mana[]" value=verde <?php echo (isset($_SESSION['filtros']['mana']) && in_array('verde', $_SESSION['filtros']['mana'])) ? 'checked' : ''; ?>>
                            <label>Verde</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="negro" name="mana[]" value=negro <?php echo (isset($_SESSION['filtros']['mana']) && in_array('negro', $_SESSION['filtros']['mana'])) ? 'checked' : ''; ?>>
                            <label>Negro</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="blanco" name="mana[]" value=blanco <?php echo (isset($_SESSION['filtros']['mana']) && in_array('blanco', $_SESSION['filtros']['mana'])) ? 'checked' : ''; ?>>
                            <label>Blanco</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="incoloro" name="mana[]" value=1>
                            <label>Neutro</label>
                        </div>
                    </div>
                </div>

                <!-- Radio buttons para legendario -->
                <div class="legendary-group">
                    <h3>Legendaria:</h3>
                    <div class="radio-options">
                        <div>
                            <input type="radio" id="si" name="legendaria" value="1" <?php echo (isset($_SESSION['filtros']['legendaria']) && $_SESSION['filtros']['legendaria'] === '1') ? 'checked' : ''; ?>>
                            <label>Sí</label>
                        </div>
                        <div>
                            <input type="radio" id="no" name="legendaria" value="0" <?php echo (isset($_SESSION['filtros']['legendaria']) && $_SESSION['filtros']['legendaria'] === '0') ? 'checked' : ''; ?>>
                            <label>No</label>
                        </div>
                        <div>
                            <input type="radio" id="ambas" name="legendaria" value="" <?php echo (isset($_SESSION['filtros']['legendaria']) && $_SESSION['filtros']['legendaria'] === '') ? 'checked' : ''; ?>>
                            <label>Ambas</label>
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
                            <input type="checkbox" id="alcance" name="habilidad[]" value=1 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(1, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Alcance</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="arrollar" name="habilidad[]" value=2 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(2, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Arrollar</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="danar_dos_veces" name="habilidad[]" value=3 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(3, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Dañar dos Veces</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="danar_primero" name="habilidad[]" value=4 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(4, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Dañar Primero</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="prisa" name="habilidad[]" value=5 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(5, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Prisa</label>
                        </div>
                    </div>
                    <!-- Segunda fila (5 habilidades) -->
                    <div class="manas">
                        <div class="mana-option">
                            <input type="checkbox" id="toque_mortal" name="habilidad[]" value=6 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(6, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Toque Mortal</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="vinculo_vital" name="habilidad[]" value=7 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(7, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Vínculo Vital</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="volar" name="habilidad[]" value=8 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(8, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Volar</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="amenaza" name="habilidad[]" value=9 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(9, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Amenaza</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="antimaleficio" name="habilidad[]" value=10 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(10, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Antimalefício</label>
                        </div>
                    </div>
                    <!-- Tercera fila (5 habilidades) -->
                    <div class="manas">
                        <div class="mana-option">
                            <input type="checkbox" id="defensor" name="habilidad[]" value=11 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(11, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Defensor</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="destello" name="habilidad[]" value=12 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(12, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Destello</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="vigilancia" name="habilidad[]" value=13 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(13, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Vigilancia</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="indestructible" name="habilidad[]" value=14 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(14, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Indestructible</label>
                        </div>
                        <div class="mana-option">
                            <input type="checkbox" id="destreza" name="habilidad[]" value=15 <?php echo (isset($_SESSION['filtros']['habilidades']) && in_array(15, $_SESSION['filtros']['habilidades'])) ? 'checked' : ''; ?>>
                            <label>Destreza</label>

                        </div>
                    </div>
                </div>
                <div class="tipo-carta">
                    <h3>Seleccione un tipo de carta</h3>
                    <select name="tipoCarta">
                        <?php
                        echo "<option value=''>Tipo de carta</option>";
                        foreach ($tipos as $tipo) {
                            $selected = (isset($_SESSION['filtros']['tipoCriatura1']) && $_SESSION['filtros']['tipoCarta'] === $tipo) ? 'selected' : '';
                            echo "<option value='$tipo' $selected>$tipo</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="tipo-criatura1">
                    <h3>Seleccione su primer tipo de criatura</h3>
                    <select name="TipoCriatura1">
                        <?php
                        echo "<option value=''>Tipo de criatura</option>";
                        foreach ($tiposCriatura as $tipoCriatura) {
                            $selected = (isset($_SESSION['filtros']['tipoCriatura1']) && $_SESSION['filtros']['tipoCriatura1'] === $tipoCriatura) ? 'selected' : '';
                            echo "<option value='$tipoCriatura' $selected>$tipoCriatura</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="tipo-criatura2">
                    <h3>Seleccione segundo tipo de criatura</h3>
                    <select name="TipoCriatura2">
                        <?php
                        echo "<option value=''>Tipo de criatura</option>";
                        foreach ($tiposCriatura as $tipoCriatura) {
                            $selected = (isset($_SESSION['filtros']['tipoCriatura2']) && $_SESSION['filtros']['tipoCriatura2'] === $tipoCriatura) ? 'selected' : '';
                            echo "<option value='$tipoCriatura' $selected>$tipoCriatura</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

        </form>
    </div><br><br>

    <div class="contenedor-cartas">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_SESSION['filtros'])) {
            foreach ($consultaFiltrada as $carta): ?>
                <div class="carta">
                    <p class="nombreCarta"><?php echo $carta['nombre']; ?></p>
                    <a href="cartas_en_venta.php?id=<?php echo $carta['id']; ?>">
                        <img src="<?php echo "../img/" . $carta['img']; ?>" alt="Imagen">
                    </a>

                </div>
            <?php
            endforeach;
        } else {
            while ($consulta->fetch()): ?>
                <div class="carta">
                    <p class="nombreCarta"><?php echo $nombre; ?></p>
                    <a href="cartas_en_venta.php?id=<?php echo $idCarta ?>">
                        <img src="<?php echo "../img/" . $img; ?>" alt="Imagen">
                    </a>

                </div>
        <?php
            endwhile;
        }
        ?>
    </div>


    <!-- Enlaces para moverse -->

    <div class="navegarPaginas">
        <a href="?pagina=1" class="navegacionEnlace">Principio</a>

        <a href="?pagina=<?php echo max(1, $paginaActual - 1); ?>" class="navegacionEnlace">Página Anterior</a>

        <?php echo "Pagina " . $paginaActual; ?>

        <a href="?pagina=<?php echo $paginaActual + 1; ?>" class="navegacionEnlace">Página Siguiente</a>

        <a href="?pagina=<?php echo $totalPaginas ?>" class="navegacionEnlace">Final</a>
    </div>




</body>

</html>

<?php

if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    $consulta->close();
}

?>