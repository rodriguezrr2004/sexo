<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="estilos_ver_citas.css"> <!-- Estilos CSS personalizados -->
    <title>Lista de Citas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            position: relative;
            line-height: 1.6;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            position: relative;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-link {
            color: #007bff;
            text-decoration: none;
        }
        .edit-link:hover {
            text-decoration: underline;
        }
        .search-container {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .search-container input[type=text] {
            padding: 5px;
            margin-right: 5px;
        }
        .search-button {
            padding: 5px 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }
        .search-button:hover {
            background-color: #0056b3;
        }
        .top-right-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Lista de Citas</h1>

    <!-- Botón para regresar -->
    <a href="Doc_page.html" class="top-right-button">Regresar</a>

    <!-- Formulario de búsqueda -->
    <div class="search-container">
        <form method="GET">
            <input type="text" name="id_search" placeholder="Buscar por ID...">
            <button type="submit" class="search-button">Buscar</button>
        </form>
        <form method="GET">
            <button type="submit" class="search-button" style="margin-top: 10px;">Mostrar Todas</button>
        </form>
    </div>

    <!-- Tabla de citas -->
    <?php
    require 'conexion.php'; // Ruta al archivo de conexión en la misma carpeta

    // Consulta SQL
    $sql = "SELECT id, nombre, fecha, hora, especialidad, doctor FROM citas";

    // Si se envió un ID para búsqueda
    if (isset($_GET['id_search']) && !empty($_GET['id_search'])) {
        $id_search = $_GET['id_search'];
        $sql .= " WHERE id = '$id_search'";
    }

    // Ejecutar consulta
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die("Error en la consulta: " . print_r(sqlsrv_errors(), true));
    }

    // Crear tabla de citas
    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Especialidad</th>
            <th>Doctor</th>
          </tr>";

    // Mostrar resultados
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['fecha']->format('Y-m-d')) . "</td>"; // Si fecha es un objeto DateTime
        echo "<td>" . htmlspecialchars($row['hora']->format('H:i:s')) . "</td>";  // Si hora es un objeto DateTime
        echo "<td>" . htmlspecialchars($row['especialidad']) . "</td>";
        echo "<td>" . htmlspecialchars($row['doctor']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    // Liberar recursos
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    ?>
</body>
</html>


