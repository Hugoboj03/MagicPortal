<?php
session_start();
include("../conexion.php");
include("funcionesConsultas.php");

/**
 * Esto archivo será utilizado por dos archivos php distintos y en ambos 
 * se dará para trabajar informacion distinta y tendra que hacerse un
 * Location a lugares distintos
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensaje = trim($_POST['comentario']);
    $nombreEmisor = $_POST['nombre_emisor'];
    $idEmisor = buscarUsuarioPorNombre($nombreEmisor);

    // Primero verificamos si viene un ID directamente (desde la vista de mensajes)
    if (!empty($_POST['id_receptor'])) {
        $idReceptor = intval($_POST['id_receptor']);

        if ($idEmisor && $idReceptor && $mensaje !== "") {
            $stmt = $conexion->prepare("INSERT INTO mensajes (id_emisor, id_receptor, mensaje) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $idEmisor, $idReceptor, $mensaje);
            $stmt->execute();

            // Redirigir de vuelta a la vista de mensajes
            header("Location: ../vista/hablar_con_comprador.php?mensaje_enviado=1");
            exit;
        }
    } elseif (!empty($_POST['nombre_receptor']) && isset($_POST['idCarta']) && isset($_POST['precio'])) {
        // Si en cambio viene por compra de carta (nombre receptor, idCarta, precio)
        $nombreReceptor = $_POST['nombre_receptor'];
        $idCarta = intval($_POST['idCarta']);
        $precio = floatval($_POST['precio']);
        $idReceptor = buscarUsuarioPorNombre($nombreReceptor);

        if ($idEmisor && $idReceptor && $mensaje !== "") {
            $stmt = $conexion->prepare("INSERT INTO mensajes (id_emisor, id_receptor, mensaje) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $idEmisor, $idReceptor, $mensaje);
            $stmt->execute();

            header("Location: ../vista/comprar_a_vendedor.php?idCarta=$idCarta&vendedor=$nombreReceptor&precioCarta=$precio&mensaje_enviado=1");
            exit;
        }
    }

    echo "Error: datos inválidos o incompletos.";
}
