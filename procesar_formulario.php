<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $fecha = $_POST['date'];
    $hora = $_POST['time'];
    $especialidad = $_POST['especialidad'];
    $doctor = $_POST['doctor'];

    // Sentencia SQL preparada para insertar datos en la tabla citas
    $sql = "INSERT INTO citas (nombre, fecha, hora, especialidad, doctor) VALUES (?, ?, ?, ?, ?)";
    $params = array($nombre, $fecha, $hora, $especialidad, $doctor);

    // Ejecutar la consulta preparada
    $stmt = sqlsrv_prepare($conn, $sql, $params);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . print_r(sqlsrv_errors(), true));
    }

    // Ejecutar la consulta
    if (sqlsrv_execute($stmt) === false) {
        die("Error en la ejecución de la consulta: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "Cita agendada exitosamente.";
    }

    // Liberar recursos
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}


?>

