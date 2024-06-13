<?php
require 'conexion.php';

// Consulta a la base de datos
$sql = "SELECT nombre, precio, inventario FROM medicamentos";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["precio"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["inventario"]) . "</td>";
    echo "</tr>";
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

