<?php
include("../conexion.php");

// Obtener todos los usuarios excepto el admin (id = 1)
$usuarios = [];
$result = $conexion->query("SELECT id FROM usuarios WHERE id > 1");
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row['id'];
}

$valores = [];

foreach ($usuarios as $usuarioId) {
    for ($cartaId = 1; $cartaId <= 100; $cartaId++) {
        // Generar un precio aleatorio entre 2.00 y 5.00 con dos decimales
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