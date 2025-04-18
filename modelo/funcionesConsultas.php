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


function obtenerCartasFiltradas($nombreCarta, $legendaria, $manas, $habilidades, $tipoCarta, $tipoCriatura1, $tipoCriatura2){

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
            // Asegúrate de que el nombre coincide con las columnas
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
        $habilidades = array_map('intval', $habilidades); // Sanear datos
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

?>