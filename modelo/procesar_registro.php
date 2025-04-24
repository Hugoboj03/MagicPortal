<?php
include("../conexion.php");
session_start();

// Obtener los datos del formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';


// Comprobar que los campos no estén vacíos
if (empty($nombre) || empty($correo) || empty($contraseña)) {
    header("Location: ../vista/register.php?error=campos_vacios");
    exit();

}

// Verificar si el correo ya está registrado
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$stmt->bind_result($id_usuario);

// Si fetch() devuelve true, el correo ya existe
if ($stmt->fetch()) {
    $stmt->close();
    mysqli_close($conexion);
    header("Location: ../vista/register.php?error=correo_existente");
    exit();
}

// Verificar si el nombre ya está registrado
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE nombre = ?");
$stmt->bind_param("s", $nombre);
$stmt->execute();
$stmt->bind_result($id_usuario);

// Si fetch() devuelve true, el nombre ya existe
if ($stmt->fetch()) {
    $stmt->close();
    mysqli_close($conexion);
    header("Location: ../vista/register.php?error=nombre_existente");
    exit();
}

$stmt->close();

// Encriptar la contraseña
$contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

// Insertar el nuevo usuario en la base de datos
$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $correo, $contraseña_hash);

if ($stmt->execute()) {
    // Registro exitoso
    $stmt->close();
    mysqli_close($conexion);
    header("Location: ../vista/register.php?success=registro");
    exit();
} else {
    // Error al insertar
    $stmt->close();
    mysqli_close($conexion);
    header("Location: ../vista/register.php?error=fallo_registro");
    exit();
}
?>