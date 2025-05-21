<?php
session_start();
include("../conexion.php");
include("../modelo/funcionesConsultas.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $nombre = $_POST['usuario'];
    $id = buscarUsuarioPorNombre($nombre);

    if ($id) {
        
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: moderar_usuarios.php?eliminado=1");
        exit;

    } else {
        echo "Usuario no encontrado.";
    }
}
?>