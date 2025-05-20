<?php
session_start();
include("../conexion.php");
include("funcionesConsultas.php"); // Aquí está buscarUsuarioPorNombre()

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensaje = trim($_POST['comentario']);
    $nombreEmisor = $_POST['nombre_emisor'];
    $nombreReceptor = $_POST['nombre_receptor'];
    $idCarta = intval($_POST['idCarta']);
    $precio = floatval($_POST['precio']);

    $idEmisor = buscarUsuarioPorNombre($nombreEmisor);
    $idReceptor = buscarUsuarioPorNombre($nombreReceptor);

    if ($idEmisor && $idReceptor && $mensaje !== "") {
        $stmt = $conexion->prepare("INSERT INTO mensajes (id_emisor, id_receptor, mensaje) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $idEmisor, $idReceptor, $mensaje);
        $stmt->execute();

        header("Location: ../vista/comprar_a_vendedor.php?idCarta=$idCarta&vendedor=$nombreReceptor&precioCarta=$precio&mensaje_enviado=1");
        exit;
    } else {
        echo "Error: datos inválidos o incompletos.";
    }
}
?>