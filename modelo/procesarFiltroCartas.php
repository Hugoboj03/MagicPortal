<?php
include("../conexion.php");
session_start();

/**
 * Este fichero no hace absolutamente nada
 */

$nombreCarta = isset($_POST['nombreCarta']) ? trim($_POST['nombreCarta']) : '';
$mana = isset($_POST['mana']) && is_array($_POST['mana']) ? $_POST['mana'] : [];
$legendaria = isset($_POST['legendaria']) ? $_POST['legendaria'] : '';
$habilidades = isset($_POST['habilidad']) && is_array($_POST['habilidad']) ? $_POST['habilidad'] : [];
$tipoCarta = isset($_POST['tipoCarta']) ? trim($_POST['tipoCarta']) : '';
$tipoCriatura1 = isset($_POST['TipoCriatura1']) ? trim($_POST['TipoCriatura1']) : '';
$tipoCriatura2 = isset($_POST['TipoCriatura2']) ? trim($_POST['TipoCriatura2']) : '';

$sql = "SELECT * FROM cartas WHERE 1=1";
$params = [];

if (!empty($nombreCarta)) {
    $sql .= " AND nombre LIKE ?";
    $params[] = "%$nombreCarta%";
}

if (!empty($mana)) {
    $placeholders = implode(',', array_fill(0, count($mana), '?'));
    $sql .= " AND mana IN ($placeholders)";
    $params = array_merge($params, $mana);
}

if ($legendaria === "1" || $legendaria === "0") {
    $sql .= " AND legendaria = ?";
    $params[] = $legendaria;
}


?>


