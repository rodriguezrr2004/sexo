<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_usuario = $_POST['tipo_usuario'];
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Obtener el Id_TipoUsuario correspondiente al tipo de usuario seleccionado
    $sql_tipo_usuario = "SELECT Id_TipoUsuario FROM Tipo_Usuario WHERE Tipo_de_Usuario = ?";
    $params_tipo_usuario = array($tipo_usuario);
    $stmt_tipo_usuario = sqlsrv_query($conn, $sql_tipo_usuario, $params_tipo_usuario);
    if ($stmt_tipo_usuario === false) {
        die("Error al obtener el ID de tipo de usuario: " . print_r(sqlsrv_errors(), true));
    }
    $row_tipo_usuario = sqlsrv_fetch_array($stmt_tipo_usuario, SQLSRV_FETCH_ASSOC);
    $id_tipo_usuario = $row_tipo_usuario['Id_TipoUsuario'];

    // Insertar en la tabla Usuario
    $sql_usuario = "INSERT INTO Usuario (Id_TipoUsuario, Nombre, ApellidoPaterno, ApellidoMaterno, FechaNacimiento, Id_Direccion, Telefono, Correo, Contrasenia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params_usuario = array($id_tipo_usuario, $nombre, $ap_paterno, $ap_materno, $fecha_nacimiento, $direccion, $telefono, $correo, $password);

    $stmt_usuario = sqlsrv_prepare($conn, $sql_usuario, $params_usuario);
    if ($stmt_usuario === false) {
        die("Error en la preparación de la consulta de usuario: " . print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt_usuario) === false) {
        die("Error en la ejecución de la consulta de usuario: " . print_r(sqlsrv_errors(), true));
    }

    // Obtener el ID de usuario generado
    $sql_id = "SELECT @@IDENTITY AS id";
    $stmt_id = sqlsrv_query($conn, $sql_id);
    if ($stmt_id === false) {
        die("Error al obtener el ID de usuario: " . print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt_id, SQLSRV_FETCH_ASSOC);
    $id_usuario = $row['id'];

    // Insertar en la tabla Pacientes
    $sql_paciente = "INSERT INTO Paciente (Id_Usuario) VALUES (?)";
    $params_paciente = array($id_usuario);

    $stmt_paciente = sqlsrv_prepare($conn, $sql_paciente, $params_paciente);
    if ($stmt_paciente === false) {
        die("Error en la preparación de la consulta de paciente: " . print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt_paciente) === false) {
        die("Error en la ejecución de la consulta de paciente: " . print_r(sqlsrv_errors(), true));
    }

    // Obtener el ID de paciente generado
    $sql_id_paciente = "SELECT @@IDENTITY AS id";
    $stmt_id_paciente = sqlsrv_query($conn, $sql_id_paciente);
    if ($stmt_id_paciente === false) {
        die("Error al obtener el ID de paciente: " . print_r(sqlsrv_errors(), true));
    }
    $row_paciente = sqlsrv_fetch_array($stmt_id_paciente, SQLSRV_FETCH_ASSOC);
    $id_paciente = $row_paciente['id'];

    // Redirigir a la página de confirmación con el ID de paciente
    header("Location: mostrar_id_paciente.php?id_paciente=" . $id_paciente);
}
?>
