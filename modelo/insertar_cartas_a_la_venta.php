<?php
include("../conexion.php");

/**
 * No volver a ejecutar este fichero
 * Se uso para insertar datos a la base de datos.
 */


$usuarios = [];
$result = $conexion->query("SELECT id FROM usuarios WHERE id > 1");
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row['id'];
}

$valores = [];

foreach ($usuarios as $usuarioId) {
    for ($cartaId = 101; $cartaId <= 255; $cartaId++) {
        $precio = number_format(mt_rand(200, 500) / 100, 2, '.', '');
        $valores[] = "($cartaId, $usuarioId, $precio)";
    }
}

if (!empty($valores)) {
    $insertSQL = "INSERT INTO cartas_en_venta (id_carta, id_vendedor, precio) VALUES " . implode(',', $valores);
    if ($conexion->query($insertSQL)) {
        echo "Cartas insertadas correctamente.";
    } else {
        echo "Error al insertar: " . $conexion->error;
    }
} else {
    echo "No hay usuarios disponibles.";
}

$conexion->close();
?>