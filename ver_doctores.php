<?php
require 'conexion.php'; // Ruta al archivo de conexión en la misma carpeta

$sql = "SELECT id, nombre, fecha, hora, especialidad, doctor FROM citas";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die("Error en la consulta: " . print_r(sqlsrv_errors(), true));
}

echo "<table>";
echo "<tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Especialidad</th>
        <th>Doctor</th>
        <th>Acciones</th>
      </tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($row['fecha']->format('Y-m-d')) . "</td>"; // Si fecha es un objeto DateTime
    echo "<td>" . htmlspecialchars($row['hora']->format('H:i:s')) . "</td>";  // Si hora es un objeto DateTime
    echo "<td>" . htmlspecialchars($row['especialidad']) . "</td>";
    echo "<td>" . htmlspecialchars($row['doctor']) . "</td>";
    echo "<td><a href='editar.php?id=" . htmlspecialchars($row['id']) . "'>Editar</a></td>";
    echo "</tr>";
}

echo "</table>";

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
