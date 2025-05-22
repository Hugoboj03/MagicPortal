<?php
session_start();
include("../conexion.php");
include("../modelo/funcionesConsultas.php");
include("header.php");
$tiposDeCarta = obtenerTiposDeCarta();
$tiposDeCriatura = obtenerTiposDeCriatura();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Añadir Carta</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/estilo_añadir_carta.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">

    <style>

    </style>
</head>

<body>
    <div class="form-container">
        <h1>Añadir Carta</h1>
        <form method="post" action="../modelo/introducir_carta.php" enctype="multipart/form-data">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="mana_rojo">Maná Rojo:</label>
            <input type="number" id="mana_rojo" name="mana_rojo" min="0" value="0"><br>

            <label for="mana_azul">Maná Azul:</label>
            <input type="number" id="mana_azul" name="mana_azul" min="0" value="0"><br>

            <label for="mana_verde">Maná Verde:</label>
            <input type="number" id="mana_verde" name="mana_verde" min="0" value="0"><br>

            <label for="mana_negro">Maná Negro:</label>
            <input type="number" id="mana_negro" name="mana_negro" min="0" value="0"><br>

            <label for="mana_blanco">Maná Blanco:</label>
            <input type="number" id="mana_blanco" name="mana_blanco" min="0" value="0"><br>

            <label for="mana_neutro">Maná Neutro:</label>
            <input type="number" id="mana_neutro" name="mana_neutro" min="0" value="0"><br><br>

            <label for="tipo_carta">Tipo de Carta:</label>
            <select id="tipo_carta" name="tipo_carta" required>
                <option value="">-- Selecciona un tipo --</option>
                <?php foreach ($tiposDeCarta as $tipo): ?>
                    <option value="<?= $tipo ?>"><?= $tipo ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="legendaria">¿Es legendaria?</label>
            <input type="checkbox" id="legendaria" name="legendaria"><br><br>

            <label for="tipo_criatura">Tipo de Criatura:</label>
            <select id="tipo_criatura" name="tipo_criatura">
                <option value="">-- Selecciona un tipo de criatura (opcional) --</option>
                <?php foreach ($tiposDeCriatura as $criatura): ?>
                    <option value="<?= $criatura ?>"><?= $criatura ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="tipo_criatura2">Tipo de Criatura 2:</label>
            <select id="tipo_criatura2" name="tipo_criatura2">
                <option value="">-- Selecciona un tipo de criatura (opcional) --</option>
                <?php foreach ($tiposDeCriatura as $criatura): ?>
                    <option value="<?= $criatura ?>"><?= $criatura ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="ataque">Ataque:</label>
            <input type="number" id="ataque" name="ataque" min="0"><br>

            <label for="defensa">Defensa:</label>
            <input type="number" id="defensa" name="defensa" min="0"><br><br>

            <label>Habilidades:</label><br>

            <input type="checkbox" id="habilidad_1" name="habilidades[]" value="Alcance">
            <label for="habilidad_1">Alcance</label><br>

            <input type="checkbox" id="habilidad_2" name="habilidades[]" value="Arrollar">
            <label for="habilidad_2">Arrollar</label><br>

            <input type="checkbox" id="habilidad_3" name="habilidades[]" value="Dañar dos Veces">
            <label for="habilidad_3">Dañar dos Veces</label><br>

            <input type="checkbox" id="habilidad_4" name="habilidades[]" value="Dañar Primero">
            <label for="habilidad_4">Dañar Primero</label><br>

            <input type="checkbox" id="habilidad_5" name="habilidades[]" value="Prisa">
            <label for="habilidad_5">Prisa</label><br>

            <input type="checkbox" id="habilidad_6" name="habilidades[]" value="Toque Mortal">
            <label for="habilidad_6">Toque Mortal</label><br>

            <input type="checkbox" id="habilidad_7" name="habilidades[]" value="Vinculo Vital">
            <label for="habilidad_7">Vinculo Vital</label><br>

            <input type="checkbox" id="habilidad_8" name="habilidades[]" value="Volar">
            <label for="habilidad_8">Volar</label><br>

            <input type="checkbox" id="habilidad_9" name="habilidades[]" value="Amenaza">
            <label for="habilidad_9">Amenaza</label><br>

            <input type="checkbox" id="habilidad_10" name="habilidades[]" value="Antimalefício">
            <label for="habilidad_10">Antimalefício</label><br>

            <input type="checkbox" id="habilidad_11" name="habilidades[]" value="Defensor">
            <label for="habilidad_11">Defensor</label><br>

            <input type="checkbox" id="habilidad_12" name="habilidades[]" value="Destello">
            <label for="habilidad_12">Destello</label><br>

            <input type="checkbox" id="habilidad_13" name="habilidades[]" value="Vigilancia">
            <label for="habilidad_13">Vigilancia</label><br>

            <input type="checkbox" id="habilidad_14" name="habilidades[]" value="Indestructible">
            <label for="habilidad_14">Indestructible</label><br>

            <input type="checkbox" id="habilidad_15" name="habilidades[]" value="Destreza">
            <label for="habilidad_15">Destreza</label><br><br>

            <label for="img">Imagen:</label>
            <input type="file" id="img" name="img" accept="image/*"><br><br>

            <button type="submit">Agregar Carta</button>
        </form>
    </div>
</body>

</html>