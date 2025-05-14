<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: vista/login.php");
    exit();
} else {
    // Si hay sesión activa, redirigir a la página de inicio
    header("Location: vista/pagina_inicio.php");
    exit();
}
?>