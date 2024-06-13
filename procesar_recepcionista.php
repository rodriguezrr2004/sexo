<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $id_turno = $_POST['id_turno'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $hora_ingreso = $_POST['hora_ingreso'];
    $fecha_hora_ingreso = $fecha_ingreso . ' ' . $hora_ingreso; // Combinar fecha y hora

    // Insertar en la tabla EMPLEADO
    $sql_empleado = "INSERT INTO Empleado (Id_Usuario, Id_Turno, FechaIngreso) VALUES (?, ?, ?)";
    $params_empleado = array($id_usuario, $id_turno, $fecha_hora_ingreso);

    $stmt_empleado = sqlsrv_prepare($conn, $sql_empleado, $params_empleado);
    if ($stmt_empleado === false) {
        die("Error en la preparación de la consulta de empleado: " . print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt_empleado) === false) {
        die("Error en la ejecución de la consulta de empleado: " . print_r(sqlsrv_errors(), true));
    }

    // Obtener el ID de empleado generado
    $sql_id = "SELECT @@IDENTITY AS id";
    $stmt_id = sqlsrv_query($conn, $sql_id);
    if ($stmt_id === false) {
        die("Error al obtener el ID de empleado: " . print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmt_id, SQLSRV_FETCH_ASSOC);
    $id_empleado = $row['id'];

    // Insertar en la tabla RECEPCIONISTA
    $sql_recepcionista = "INSERT INTO Recepcionista (Id_Empleado) VALUES (?)";
    $params_recepcionista = array($id_empleado);

    $stmt_recepcionista = sqlsrv_prepare($conn, $sql_recepcionista, $params_recepcionista);
    if ($stmt_recepcionista === false) {
        die("Error en la preparación de la consulta de recepcionista: " . print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt_recepcionista) === false) {
        die("Error en la ejecución de la consulta de recepcionista: " . print_r(sqlsrv_errors(), true));
    }

    // Redirigir a la página de confirmación o a otra página según sea necesario
    header("Location: Recep_page.html");
    exit();
}
?>
