<?php

include("../conexion.php");
//session_start();
/**
 * $nombreCarta = isset($_POST['nombreCarta']) ? trim($_POST['nombreCarta']) : '';
 *$mana = isset($_POST['mana']) && is_array($_POST['mana']) ? $_POST['mana'] : [];
 *$legendaria = isset($_POST['legendaria']) ? $_POST['legendaria'] : '';
 *$habilidades = isset($_POST['habilidad']) && is_array($_POST['habilidad']) ? $_POST['habilidad'] : [];
 *$tipoCarta = isset($_POST['tipoCarta']) ? trim($_POST['tipoCarta']) : '';
 *$tipoCriatura1 = isset($_POST['TipoCriatura1']) ? trim($_POST['TipoCriatura1']) : '';
 *$tipoCriatura2 = isset($_POST['TipoCriatura2']) ? trim($_POST['TipoCriatura2']) : '';
 */

/***
 * Descubri esta manera de hacer busquedas en un video de youtube, pero me daba fallos en apartados como
  la busqueda de mana o habilidades. Antonio me presto unos apuntes que tenia con los que acabe sacando esto.
 */



function obtenerCartasFiltradas($nombreCarta, $legendaria, $manas, $habilidades, $tipoCarta, $tipoCriatura1, $tipoCriatura2)
{

    global $conexion;

    $sql = "SELECT * FROM cartas LEFT JOIN tipo_carta ON cartas.tipo_carta = tipo_carta.id_habilidad WHERE 1=1";

    if (!empty($nombreCarta)) {
        $sql .= " AND nombre LIKE '%$nombreCarta%'";
    }

    if ($legendaria !== '') {
        $sql .= " AND legendaria = $legendaria";
    }

    if (!empty($manas)) {
        $manaCondiciones = array();
        foreach ($manas as $mana) {

            switch ($mana) {
                case 'rojo':
                    $manaCondiciones[] = "mana_rojo > 0";
                    break;
                case 'azul':
                    $manaCondiciones[] = "mana_azul > 0";
                    break;
                case 'verde':
                    $manaCondiciones[] = "mana_verde > 0";
                    break;
                case 'negro':
                    $manaCondiciones[] = "mana_negro > 0";
                    break;
                case 'blanco':
                    $manaCondiciones[] = "mana_blanco > 0";
                    break;
            }
        }
        if (!empty($manaCondiciones)) {
            $sql .= " AND (" . implode(" AND ", $manaCondiciones) . ")";
        }
    }

    // Filtro por habilidades
    if (!empty($habilidades)) {
        $habilidades = array_map('intval', $habilidades); // Sanear datos por si acaso
        $ids = implode(',', $habilidades);
        $cantidad = count($habilidades);

        $sql .= " AND id IN (
            SELECT id_carta FROM cartas_habilidades
            WHERE id_habilidad IN ($ids)
            GROUP BY id_carta
            HAVING COUNT(DISTINCT id_habilidad) = $cantidad
        )";
    }

    // Filtro por tipo
    if (!empty($tipoCarta)) {
        $tipoCarta = $conexion->real_escape_string($tipoCarta);
        $sql .= " AND tipo_carta.tipo = '$tipoCarta'";
    }

    // Filtro por criatura
    if (!empty($tipoCriatura1) || !empty($tipoCriatura2)) {
        $tiposSeleccionados = [];

        if (!empty($tipoCriatura1)) {
            $tiposSeleccionados[] = "'" . $conexion->real_escape_string($tipoCriatura1) . "'";
        }
        if (!empty($tipoCriatura2)) {
            $tiposSeleccionados[] = "'" . $conexion->real_escape_string($tipoCriatura2) . "'";
        }

        $cantidad = count($tiposSeleccionados);
        $sql .= " AND cartas.id IN (
            SELECT id_carta FROM cartas_tipos_criatura
            INNER JOIN tipo_criatura ON cartas_tipos_criatura.id_tipo_criatura = tipo_criatura.id
            WHERE tipo_criatura.tipo_criatura_nombre IN (" . implode(',', $tiposSeleccionados) . ")
            GROUP BY id_carta
            HAVING COUNT(DISTINCT tipo_criatura.tipo_criatura_nombre) = $cantidad
        )";
    }

    $result = $conexion->query($sql);

    $cartas = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cartas[] = $row;
        }
    }

    // Cierrar conexión
    $conexion->close();

    return $cartas;
}

function buscarCartasPorNombre($nombre)
{

    global $conexion;

    $nombre = $conexion->real_escape_string($nombre);
    $sql = "SELECT id, nombre FROM cartas WHERE nombre LIKE '%$nombre%' LIMIT 5";
    $result = $conexion->query($sql);

    $cartas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cartas[] = $row;
        }
    }

    return $cartas;
}

function obtenerDatosDeCartaPorNombre($nombre)
{

    global $conexion;

    $sql = "SELECT * FROM cartas WHERE nombre = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        return $resultado->fetch_assoc();
    } else {
        return null;
    }

    $stmt->close();
}

function obtenerTiposDeCriatura()
{

    global $conexion;

    $sql = "SELECT id_tipo_criatura, tipo_criatura_nombre FROM tipo_criatura";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $tipos = [];

    if ($resultado->num_rows > 0) {
        $tipos = $resultado->fetch_all(MYSQLI_ASSOC); // devuelve todas las filas como array asociativo
    }

    $stmt->close();
    return $tipos;
}

function buscarUsuarioPorNombre($nombre)
{

    global $conexion;

    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        return $fila['id'];
    } else {
        return null;
    }
}

function validarPrecio($precio)
{
    // Permite números con hasta 2 decimales, sin letras
    return preg_match('/^\d{1,6}(\.\d{1,2})?$/', $precio);
}

function procesarVenta($nombreVendedor, $nombreComprador, $idCarta, $precio)
{

    global $conexion;

    $idVendedor = buscarUsuarioPorNombre($nombreVendedor);
    $idComprador = buscarUsuarioPorNombre($nombreComprador);

    if ($idVendedor === null || $idComprador === null) {
        return "Error: No se encontró alguno de los usuarios.";
    }

    // Preparar sentencia de inserción
    $stmt = $conexion->prepare("INSERT INTO ventas (id_vendedor, id_comprador, id_carta, fecha_compra, precio) VALUES (?, ?, ?, NOW(), ?)");
    $stmt->bind_param("iiid", $idVendedor, $idComprador, $idCarta, $precio);

    if ($stmt->execute()) {
        return "Venta registrada con éxito.";

        $stmt->close();

        //eliminarCartaEnVenta($idVendedor, $idCarta);



    } else {
        return "Error al registrar la venta: " . $stmt->error;
    }
}

function eliminarCartaEnVenta($nombreVendedor, $idCarta)
{

    global $conexion;

    $idVendedor = buscarUsuarioPorNombre($nombreVendedor);

    $stmt = $conexion->prepare("DELETE FROM cartas_en_venta WHERE id_carta = ? AND id_vendedor = ?");
    $stmt->bind_param("ii", $idCarta, $idVendedor);

    if ($stmt->execute()) {
        $stmt->close();
        return "Carta eliminada";
    } else {
        $error = "Error al eliminar la carta en venta: " . $stmt->error;
        $stmt->close();
        return $error;
    }
}

function actualizarCarta($nombre, $mana_rojo, $mana_azul, $mana_verde, $mana_negro, $mana_blanco, $mana_neutro, $tipo_carta, $legendaria, $ataque, $defensa)
{
    global $conexion;

    $sql = "UPDATE cartas 
            SET mana_rojo = ?, mana_azul = ?, mana_verde = ?, mana_negro = ?, mana_blanco = ?, mana_neutro = ?, 
                tipo_carta = ?, legendaria = ?, ataque = ?, defensa = ?
            WHERE nombre = ?";

    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        return "Error al preparar la consulta: " . $conexion->error;
    }

    $stmt->bind_param(
        "iiiiiiiisss",
        $mana_rojo,
        $mana_azul,
        $mana_verde,
        $mana_negro,
        $mana_blanco,
        $mana_neutro,
        $tipo_carta,
        $legendaria,
        $ataque,
        $defensa,
        $nombre
    );

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return "No se modificó ninguna carta (puede que no exista o no hubo cambios).";
        }
    } else {
        $error = $stmt->error;
        $stmt->close();
        return "Error al ejecutar la actualización: " . $error;
    }
}

function historial($usuarioNombre)
{

    global $conexion;

    $consulta = "
        SELECT 
            ventas.id AS id_venta,
            u_vendedor.id AS id_vendedor,
            u_vendedor.nombre AS nombre_vendedor,
            c.nombre AS nombre_carta,
            ventas.precio
        FROM ventas
        JOIN usuarios u_comprador ON ventas.id_comprador = u_comprador.id
        JOIN usuarios u_vendedor ON ventas.id_vendedor = u_vendedor.id
        JOIN cartas c ON ventas.id_carta = c.id
        WHERE u_comprador.nombre = ?
    ";

    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("s", $usuarioNombre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $historial = [];
    while ($fila = $resultado->fetch_assoc()) {
        $historial[] = $fila;
    }

    $stmt->close();
    return $historial;
}

function obtenerImagenCarta($nombreCarta)
{
    global $conexion;
    $imagen = "";

    $stmt = $conexion->prepare("SELECT img FROM cartas WHERE nombre = ?");
    $stmt->bind_param("s", $nombreCarta);
    $stmt->execute();
    $stmt->bind_result($imagen);

    // Solo devuelve $imagen si se pudo hacer fetch correctamente
    if ($stmt->fetch()) {
        $stmt->close();
        return $imagen;
    } else {
        $stmt->close();
        
        return "img/no_disponible.jpg";
    }
}

function redondearMitad($numero)
{
    return round($numero * 2) / 2;
}

function obtenerCalificacionMediaUsuario($nombreUsuario)
{

    global $conexion;

    $suma = 0;
    $cantidad = 0;

    $idUsuario = buscarUsuarioPorNombre($nombreUsuario);

    $stmt = $conexion->prepare("SELECT valoracion FROM comentarios WHERE id_comentado = ?");
    $stmt->bind_param("s", $idUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $suma += $fila['valoracion'];
        $cantidad++;
    }

    $stmt->close();


    if ($cantidad > 0) {
        return redondearMitad($suma / $cantidad);
    } else {
        return 0;
    }
}

function usuariosConMenosDeTresEstrellas($nombreUsuario) {
    global $conexion;

    $suma = 0;
    $cantidad = 0;

    $idUsuario = buscarUsuarioPorNombre($nombreUsuario);

    $stmt = $conexion->prepare("SELECT valoracion FROM comentarios WHERE id_comentado = ?");
    $stmt->bind_param("i", $idUsuario); 
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $suma += $fila['valoracion'];
        $cantidad++;
    }

    $stmt->close();

    if ($cantidad > 0) {
        return redondearMitad($suma / $cantidad);
    } else {
        return null; 
    }
}

function obtenerComentariosDeUsuario($idUsuario) {
    global $conexion;

    $comentarios = [];

    $stmt = $conexion->prepare("SELECT comentario, fecha_comentario FROM comentarios WHERE id_comentado = ?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $comentarios[] = $fila;
    }

    $stmt->close();

    return $comentarios;
}

function tieneMensajes($nombreUsuario)
{
    global $conexion;


    $idUsuario = buscarUsuarioPorNombre($nombreUsuario);

    // Si sale falso es porque el usuario no a recibido mensajes
    if (!$idUsuario) {
        return false; 
    }

    // Si tiene almenos un mensaje se considerará true
    $stmt = $conexion->prepare("SELECT 1 FROM mensajes WHERE id_receptor = ? LIMIT 1");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    return $resultado->num_rows > 0;
}

function obtenerListaDeComentadores($nombreUsuario)
{
    global $conexion;

    $idReceptor = buscarUsuarioPorNombre($nombreUsuario);
    if (!$idReceptor) return [];

    $stmt = $conexion->prepare("
        SELECT DISTINCT id_emisor
        FROM mensajes
        WHERE id_receptor = ?
    ");
    $stmt->bind_param("i", $idReceptor);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $emisores = [];

    while ($fila = $resultado->fetch_assoc()) {
        $emisores[] = $fila['id_emisor'];
    }

    return $emisores;
}

function obtenerMensajesDeUsuario($nombreUsuario, $idOtroUsuario)
{
    global $conexion;

    $idActual = buscarUsuarioPorNombre($nombreUsuario);
    if (!$idActual || !$idOtroUsuario) return [];

    $stmt = $conexion->prepare("
        SELECT id_emisor, mensaje, fecha_envio
        FROM mensajes
        WHERE (id_emisor = ? AND id_receptor = ?)
           OR (id_emisor = ? AND id_receptor = ?)
        ORDER BY fecha_envio ASC
    ");
    $stmt->bind_param("iiii", $idActual, $idOtroUsuario, $idOtroUsuario, $idActual);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $mensajes = [];

    while ($fila = $resultado->fetch_assoc()) {
        $mensajes[] = $fila;
    }

    return $mensajes;
}
