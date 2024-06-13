<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="estilos_ver_citas.css">
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
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            color: #fff;
            position: absolute;
            top: 20px;
            left: 20px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        .search-container {
            text-align: left;
            margin-top: 10px;
            margin-left: 20px;
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
    </style>
    <title>Ver Registros</title>
</head>
<body>
    <a href="Recep_page.html" class="back-button">Regresar</a>
    <h1>Lista de Usuarios</h1>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Buscar ID...">
        <button onclick="searchTable()" class="search-button">Buscar</button>
    </div>
    <table id="userTable">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha de Nacimiento</th>
            <th>Dirección</th>
            <th>Teléfono</th>
        </tr>
        <?php
        include 'ver_cita.php';
        ?>
    </table>

    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("userTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>