<?php
require 'conexion.php'; // Ruta al archivo de conexión en la misma carpeta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $especialidad = $_POST['especialidad'];
    $doctor = $_POST['doctor'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE citas SET nombre = ?, fecha = ?, hora = ?, especialidad = ?, doctor = ? WHERE id = ?";
    $params = array($nombre, $fecha, $hora, $especialidad, $doctor, $id);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die("Error en la actualización: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "Registro actualizado con éxito.";
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    // Obtener el ID de la cita a editar
    $id = $_GET['id'];
    
    // Consultar los datos de la cita
    $sql = "SELECT id, nombre, fecha, hora, especialidad, doctor FROM citas WHERE id = ?";
    $params = array($id);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die("Error en la consulta: " . print_r(sqlsrv_errors(), true));
    }

    // Obtener los datos de la cita
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($row === null) {
        die("Registro no encontrado.");
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="estilos_ver_citas.css">
    <title>Editar Cita</title>
</head>
<body>
    <h1>Editar Cita</h1>
    <form method="post" action="editar.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
        <br>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($row['fecha']->format('Y-m-d')); ?>" required>
        <br>
        <label for="hora">Hora:</label>
        <input type="time" name="hora" id="hora" value="<?php echo htmlspecialchars($row['hora']->format('H:i:s')); ?>" required>
        <br>
        <label for="especialidad">Especialidad:</label>
        <input type="text" name="especialidad" id="especialidad" value="<?php echo htmlspecialchars($row['especialidad']); ?>" required>
        <br>
        <label for="doctor">Doctor:</label>
        <input type="text" name="doctor" id="doctor" value="<?php echo htmlspecialchars($row['doctor']); ?>" required>
        <br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
