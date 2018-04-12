<?php
session_start();
?>

<?php

//conexión a la base de datos.

$host = "localhost";
$usuario = "root";
$password = "root";
$database = "PI_2018";

$conexion = new mysqli($host, $usuario, $password, $database);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['username']; //usuario o empresa, dependiendo del tipo de login que se vaya a seleccionar.
$password = $_POST['password']; 
$tipo_login = $_POST['tipo_login'];

// la problemática surge a la hora de manipular el select, hay que mirar como se hace. 
 
$sql_usuarios = "SELECT nombre FROM usuario WHERE alias = '$username' AND password = '$password'"; // por ahora solo nos quedamos con el nombre para probar

$sql_empresas = "SELECT cif FROM empresa WHERE nombre = '$username' AND password = '$password'"; // nos quedamos con el cif

// desconexión de la base de datos.
mysqli_close($conexion); 
 ?>