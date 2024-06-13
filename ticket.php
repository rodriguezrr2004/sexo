<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_estatus = $_POST['estatus'];
    $id_servicio = $_POST['servicio'];
    $id_tipo_pago = $_POST['tipo_pago'];
    $fecha_de_pago = $_POST['fecha_pago'];
    $total = $_POST['total'];

    // Convertir fecha_de_pago a formato compatible con SQL Server
    $fecha_de_pago = date('Y-m-d H:i:s', strtotime($fecha_de_pago));

    // Insertar los datos en la tabla Pago
    $sql = "INSERT INTO Pago (Id_Estatus, Id_Servicio, Id_Tipo_De_Pago, Fecha_De_Pago, Total) VALUES (?, ?, ?, ?, ?)";
    $params = array($id_estatus, $id_servicio, $id_tipo_pago, $fecha_de_pago, $total);

    $stmt = sqlsrv_prepare($conn, $sql, $params);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        die("Error en la ejecución de la consulta: " . print_r(sqlsrv_errors(), true));
    } else {
        // Obtener el Id_Pago del pago recién insertado
        $id_pago = null;
        $sql = "SELECT SCOPE_IDENTITY() AS Id_Pago";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die("Error en la consulta del ID de pago: " . print_r(sqlsrv_errors(), true));
        } else {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $id_pago = $row['Id_Pago'];
        }

        // Generar el ticket de pago
        echo "<h1>Ticket de Pago</h1>";
        echo "<p>Id de Pago: " . $id_pago . "</p>";
        echo "<p>Estatus: " . $id_estatus . "</p>";
        echo "<p>Servicio: " . $id_servicio . "</p>";
        echo "<p>Tipo de Pago: " . $id_tipo_pago . "</p>";
        echo "<p>Fecha de Pago: " . $fecha_de_pago . "</p>";
        echo "<p>Total: $" . number_format($total, 2) . "</p>";

        // Liberar recursos
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }
}
?>
