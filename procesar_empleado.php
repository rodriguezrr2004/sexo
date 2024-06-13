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

    echo "¡Registro de empleado exitoso!";
    // Redirigir a una página de confirmación o a otra página según sea necesario
    // header("Location: confirmacion_empleado.php");
}
?>

