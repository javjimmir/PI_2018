<?php
/**
 * Created by PhpStorm.
 * User: jdelgado
 * Date: 10/05/18
 * Time: 9:45
 */

$conexion = mysqli_connect('localhost','root','root','actividades');

/* En caso de que haya error... */
if ($conexion->connect_errno) {
    echo "No se pudo conectar a la BD";
    echo "Error: Fallo al conectarse a MySQL debido a: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    exit;
}