<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['name'];
    $fecha = $_POST['date'];
    $hora = $_POST['time'];
    $especialidad = $_POST['especialidad'];
    $doctor = $_POST['doctor'];

    // Detalles de la conexión a la base de datos
    $host = 'MSI'; // Cambia MSI por el nombre de tu servidor SQL Server
    $dbname = 'LOL'; // Cambia cola por el nombre de tu base de datos

    try {
        // Conexión a la base de datos con autenticación de Windows
        $conn = new PDO("sqlsrv:Server=$host;Database=$dbname;ConnectionPooling=0");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Sentencia SQL preparada para insertar datos en la tabla citas
        $sql = "INSERT INTO citas (nombre, fecha, hora, especialidad, doctor) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        // Ejecutar la sentencia SQL preparada
        $stmt->execute([$nombre, $fecha, $hora, $especialidad, $doctor]);
        
        echo "<h2>¡Gracias por agendar tu cita!</h2>";
        echo "<p>Tus datos han sido registrados correctamente.</p>";
    } catch(PDOException $e) {
        echo "Error al insertar datos: " . $e->getMessage();
    } finally {
        // Liberar recursos
        unset($conn);
    }
} else {
    // Si el formulario no se ha enviado, redirigir a la página del formulario
    header("Location: citas.html");
    exit;
}
?>
