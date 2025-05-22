<?php
session_start();
include("../conexion.php");
include("../modelo/funcionesConsultas.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre         = $_POST['nombre'];
    $mana_rojo      = $_POST['mana_rojo'];
    $mana_azul      = $_POST['mana_azul'];
    $mana_verde     = $_POST['mana_verde'];
    $mana_negro     = $_POST['mana_negro'];
    $mana_blanco    = $_POST['mana_blanco'];
    $mana_neutro    = $_POST['mana_neutro'];
    $tipo_carta     = $_POST['tipo_carta'];
    $tipo_criatura  = $_POST['tipo_criatura'] ?? null;
    $tipo_criatura2  = $_POST['tipo_criatura2'] ?? null;
    $legendaria     = isset($_POST['legendaria']) ? 1 : 0;
    $ataque         = $_POST['ataque'] ?? null;
    $defensa        = $_POST['defensa'] ?? null;
    $habilidades    = $_POST['habilidades'] ?? [];

    if ($tipo_carta != "Criatura" && ($ataque != null || $defensa != null) && ($tipo_criatura != null || $tipo_criatura2 != null)) {

        echo "❌ Error: Solo las cartas de tipo 'Criatura' pueden tener ataque, defensa o tipos de criatura.";
    } elseif (!isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
    echo "❌ Error: cpn la imagen.";
    } else {
        $nombreImg = basename($_FILES['img']['name']);
        $rutaTemp = $_FILES['img']['tmp_name'];
        $rutaDestino = "../img/" . $nombreImg;

        if (!move_uploaded_file($rutaTemp, $rutaDestino)) {
            echo "❌ Error al guardar la imagen.";
            exit;
        }

        $nombreCarta = $nombreImg;

        $tipoCartaNumerico = 0;

        if ($tipo_carta === "Criatura") {
            $tipoCartaNumerico = 1;
        } elseif ($tipo_carta === "Conjuro") {
            $tipoCartaNumerico = 2;
        } elseif ($tipo_carta === "Instantáneo") {
            $tipoCartaNumerico = 3;
        } elseif ($tipo_carta === "Encantamiento") {
            $tipoCartaNumerico = 4;
        } elseif ($tipo_carta === "Artefacto") {
            $tipoCartaNumerico = 5;
        } elseif ($tipo_carta === "Tierra") {
            $tipoCartaNumerico = 6;
        } elseif ($tipo_carta === "PlanesWalker") {
            $tipoCartaNumerico = 7;
        } else {
            echo "❌ Tipo de carta no válido.";
            exit;
        }

        $sql = "INSERT INTO cartas (
                    nombre, mana_rojo, mana_azul, mana_verde, mana_negro, mana_blanco, mana_neutro,
                    tipo_carta, legendaria, ataque, defensa, img
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param(
            "siiiiiiisdds",
            $nombre,
            $mana_rojo,
            $mana_azul,
            $mana_verde,
            $mana_negro,
            $mana_blanco,
            $mana_neutro,
            $tipoCartaNumerico,
            $legendaria,
            $ataque,
            $defensa,
            $nombreImg
        );

        if ($stmt->execute()) {
            echo "✅ Carta insertada correctamente con ID: " . $stmt->insert_id;
            $idCarta = $stmt->insert_id;

            if ($tipoCartaNumerico == 1) {

                // Insertar habilidades (si hay)
                if (!empty($habilidades)) {
                    $sqlHabilidad = "INSERT INTO habilidades (id, habilidad) VALUES (?, ?)";
                    $stmtHabilidad = $conexion->prepare($sqlHabilidad);

                    foreach ($habilidades as $habilidad) {
                        $stmtHabilidad->bind_param("ii", $idCarta, $habilidad);
                        $stmtHabilidad->execute();
                    }

                    $stmtHabilidad->close();
                }

                // Insertar tipo de criatura (1 o 2)
                $sqlTipoCriatura = "INSERT INTO tipo_criatura (id, tipo_criatura_nombre) VALUES (?, ?)";
                $stmtTipo = $conexion->prepare($sqlTipoCriatura);

                if (!empty($tipo_criatura)) {
                    $stmtTipo->bind_param("ii", $idCarta, $tipo_criatura);
                    $stmtTipo->execute();
                }

                if ($tipo_criatura != $tipo_criatura2) {
                    if (!empty($tipo_criatura2)) {
                        $stmtTipo->bind_param("ii", $idCarta, $tipo_criatura2);
                        $stmtTipo->execute();
                    }
                }



                $stmtTipo->close();
            }
        } else {
            echo "❌ Error al insertar la carta: " . $stmt->error;
        }

        $stmt->close();
        $conexion->close();
    }
}
