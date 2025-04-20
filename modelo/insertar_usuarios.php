<?php
include("../conexion.php");

$nombres = [
    "Luna Torres", "Mateo Rivas", "Valentina Mora", "Tomás Delgado",
    "Sofía Nieto", "Leo Castillo", "Isabela Cruz", "Gael Herrera",
    "Camila Peña", "Emilio Vargas", "Martina Reyes", "Lucas Navarro",
    "Emilia Solís", "Diego Lozano", "Renata Paredes", "Thiago Fuentes",
    "Alejandra Ibáñez", "David Bravo", "Paulina Méndez"
];

$id = 2; // Empezamos desde 2
foreach ($nombres as $nombre) {
    $correo = strtolower(str_replace(' ', '', $nombre)) . "@gmail.com";
    $password = password_hash('1234', PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO usuarios (id, nombre, correo, contraseña) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id, $nombre, $correo, $password);
    $stmt->execute();
    $stmt->close();

    $id++;
}

echo "Usuarios insertados correctamente.";
?>