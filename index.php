<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Citas</title>
    <link rel="icon" href="./images/favicon.png" type="image/png">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/estilos_citas.css">
</head>
<body>
    <main>
        <h2 class="subtitle2">Bienvenido a su gestor de citas</h2>
        <section class="knowledge2">
            <div class="knowledge__container2">
                <section class="price container">
                    <div class="price__table2">
                        <div class="cuestionario">
                            <form class="appointment-form" action="procesar_formulario.php" method="post">
                                <label for="name">Nombre:</label>
                                <input type="text" id="name" name="name" required>

                                <label for="date">Fecha:</label>
                                <input type="date" id="date" name="date" required>

                                <label for="time">Hora:</label>
                                <input type="time" id="time" name="time" required>

                                <label for="especialidad">Especialidad:</label>
                                <select id="especialidad" name="especialidad">
                                    <option value="odontologia">Odontología</option>
                                    <option value="pediatria">Pediatría</option>
                                    <option value="cardiologia">Cardiología</option>
                                </select>

                                <label for="doctor">Doctor:</label>
                                <select id="doctor" name="doctor">
                                    <option value="doctor1">Dr. Juan Pérez</option>
                                    <option value="doctor2">Dra. María García</option>
                                    <option value="doctor3">Dr. Carlos López</option>
                                </select>

                                <button type="submit" class="price__cta">Agendar Cita</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </main>
</body>
</html>
