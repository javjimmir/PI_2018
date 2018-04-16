<?php
session_start();
?>

<?php

//conexión a la base de datos.

$host = "localhost";
$usuario = "root";
$password = "root";
$database = "actividades";

$conexion = new mysqli($host, $usuario, $password, $database);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['username']; 
$password = $_POST['password']; 
 
$sql_usuarios = "SELECT nombre FROM usuario WHERE alias = '$username' AND password = '$password'"; // por ahora solo nos quedamos con el nombre para probar

// desconexión de la base de datos.
mysqli_close($conexion); 
 ?>
