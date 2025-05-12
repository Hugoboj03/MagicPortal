<?php

session_start();
include("../conexion.php");

$idCarta = isset($_GET['idCarta']) ? intval($_GET['idCarta']) : 0;
$nombreVendedor = isset($_GET['vendedor']) ? intval($_GET['vendedor']) : "";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    
</body>
</html>