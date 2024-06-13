<?php
$id_paciente = $_GET['id_paciente'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID de Paciente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 2em;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        h2 {
            margin-bottom: 1em;
        }
        p {
            font-size: 1.2em;
            margin-bottom: 2em;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 0.5em 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>ID de Paciente</h2>
        <p>El ID de su paciente es: <?php echo htmlspecialchars($id_paciente); ?></p>
        <a href="inicio_sesion.html" class="btn">Iniciar Sesión</a>
    </div>
</body>
</html>

