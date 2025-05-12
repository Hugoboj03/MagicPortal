<?php

/**
 * Codigo casi reciclado del ejercicio de pelis de Dani
 */

if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    if (empty($usuario) || empty($contraseña)) {
        header("Location: ../vista/login.php?error=Debes introducir un usuario y contraseña");
        exit();
    } else {
        include('../conexion.php');

        $usuario = mysqli_real_escape_string($conexion, $usuario);
        $contraseña_input = mysqli_real_escape_string($conexion, $contraseña);

        $sql = "SELECT nombre, contraseña, moderador FROM usuarios WHERE nombre = '$usuario'";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado === false) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
        }

        if ($row = mysqli_fetch_assoc($resultado)) {
            $contraseña_hash = $row['contraseña'];
            $nombre = $row['nombre'];
            $esModerador = $row['moderador'];

            echo "Llego aquí";

            if (password_verify($contraseña, $contraseña_hash)) {
                session_start();
                $_SESSION['usuario'] = $nombre;
                $_SESSION['nombre_usuario'] = $usuario;
                echo "Llego aquí";
                if($esModerador == 1){
                    header("Location: ../vista/pagina_moderador.php");
                }else{
                    header("Location: ../vista/pagina_inicio.php");
                }
                
                exit();
            } else {
                header("Location: ../vista/login.php?error=Usuario o contraseña incorrectos");
                exit();
            }
        } else {
            header("Location: ../vista/login.php?error=Usuario no encontrado");
            exit();
        }

        mysqli_close($conexion);
    }
} else {
    header("Location: ../vista/login.php?error=Formulario no enviado");
    exit();
}
?>