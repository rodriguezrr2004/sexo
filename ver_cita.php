<?php
require 'conexion.php'; // Ruta al archivo de conexión en la misma carpeta

$sql = "SELECT id, nombre, ap_paterno, ap_materno, fecha_nacimiento, direccion, telefono FROM usuarios";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die("Error en la consulta: " . print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($row['ap_paterno']) . "</td>";
    echo "<td>" . htmlspecialchars($row['ap_materno']) . "</td>";
    echo "<td>" . htmlspecialchars($row['fecha_nacimiento']->format('Y-m-d')) . "</td>"; // Si fecha_nacimiento es un objeto DateTime
    echo "<td>" . htmlspecialchars($row['direccion']) . "</td>";
    echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
    echo "</tr>";
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>