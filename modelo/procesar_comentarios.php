<?php
session_start();
include("../conexion.php");
include('funcionesConsultas.php');

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Recoger datos del formulario
$id_comentado = $_POST['id_vendedor'];
$comentario = trim($_POST['comentario']);
$valoracion = $_POST['clasificacion'];

// Obtener id_comentador desde sesión
$nombreUsuario = $_SESSION['usuario'];
$id_comentador = buscarUsuarioPorNombre($nombreUsuario);

if ($id_comentador === null) {
    echo "<p class='error'>No se pudo encontrar el usuario.</p>";
    exit();
}

// Insertar el comentario
$sql = "INSERT INTO comentarios (id_comentado, id_comentador, fecha_comentario, comentario, valoracion)
        VALUES (?, ?, NOW(), ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iisi", $id_comentado, $id_comentador, $comentario, $valoracion);

if ($stmt->execute()) {
    header("Location: ../vista/pagina_usuario.php");
    
} else {
    echo "<p class='error'>Error al enviar el comentario: " . $stmt->error . "</p>";
}



$stmt->close();
