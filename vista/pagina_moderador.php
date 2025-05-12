<?php
session_start();
include("../conexion.php");
include("header.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/estilo_moderador.css">
</head>
<body>

<div class="moderador-container">
<div class="modUsuarios">
    <a href="moderar_usuarios.php"><p>MODERAR USUARIOS</p></a>
</div>

<div class="modCartas">
    <a href="moderar_cartas.php"><p>MODERAR CARTAS</p></a>
</div>
</div>


    
</body>
</html>