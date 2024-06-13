<?php
require 'conexion.php';

$id = $_GET['id'];
$query = "DELETE FROM usuarios WHERE id = ?";
$params = array($id);

$stmt = sqlsrv_query($conn, $query, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

sqlsrv_close($conn);
header("Location: Recep_page.html"); // Redirigir a la página principal
exit();
?>
