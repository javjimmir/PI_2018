<?php
// Conectando, seleccionando la base de datos
// $mysqli = new mysqli('HOST', 'USER', 'PASS', 'NOMBRE_BD');
$conexion = new mysqli('localhost', 'root', '', 'actividades');
$conexion->set_charset("utf8");
/* En caso de que haya error... */
if ($conexion->connect_errno) {
    echo "No se pudo conectar a la BD";
    echo "Error: Fallo al conectarse a MySQL debido a: \n";
    echo "Errno: " . $conexion->connect_errno . "\n";
    echo "Error: " . $conexion->connect_error . "\n";
    exit;
}
