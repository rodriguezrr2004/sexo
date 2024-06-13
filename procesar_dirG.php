<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $delegacion = $_POST['delegacion'];
    $numero = $_POST['numero'];
    $codigo_postal = $_POST['codigo_postal'];

    // Sentencia SQL preparada para insertar datos en la tabla Direccion
    $sql = "INSERT INTO Direccion (Delegacion, Numero, CodigoPostal) VALUES (?, ?, ?)";
    $params = array($delegacion, $numero, $codigo_postal);

    // Ejecutar la consulta preparada
    $stmt = sqlsrv_prepare($conn, $sql, $params);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . print_r(sqlsrv_errors(), true));
    }

    // Ejecutar la consulta
    if (sqlsrv_execute($stmt) === false) {
        die("Error en la ejecución de la consulta: " . print_r(sqlsrv_errors(), true));
    } else {
        // Obtener el ID generado
        $sql = "SELECT @@IDENTITY AS id";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die("Error al obtener el ID generado: " . print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $id_direccion = $row['id'];

        // Redirigir a login.html con el ID de dirección
        header("Location: login.html?id_direccion=" . $id_direccion);
    }

    // Liberar recursos
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>
