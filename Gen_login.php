<?php

require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST['correo']); // Ajustar el nombre del campo para coincidir con el formulario HTML
    $password = trim($_POST['password']); // Ajustar el nombre del campo para coincidir con el formulario HTML

    // Consulta para obtener el usuario por su correo y contraseña
    $query = "SELECT Id_TipoUsuario FROM Usuario WHERE Correo = ? AND Contrasenia = ?";
    $params = array($correo, $password);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Obtener el resultado de la consulta
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($row) {
        $tipo_usuario = $row['Id_TipoUsuario'];

        echo "Tipo de Usuario: " . $tipo_usuario; // Mensaje de depuración

        // Redirigir según el tipo de usuario
        switch ($tipo_usuario) {
            case 1:
                header("Location: Doc_page.html");
                exit();
            case 2:
                header("Location: pacientes.html");
                exit();
            case 3:
                header("Location: Recep_page.html");
                exit();
            default:
                // Redirigir a la página de inicio de sesión si el tipo de usuario no es válido
                header("Location: inicio_sesion_g.html");
                exit();
        }
    } else {
        // La autenticación falló, redirigir de nuevo a la página de inicio de sesión
        header("Location: inicio_sesion_g.html");
        exit();
    }

    sqlsrv_free_stmt($stmt);
}

sqlsrv_close($conn);
?>