<?php
/**
 * Created by PhpStorm.
 * User: jdelgado
 * Date: 18/05/18
 * Time: 14:46
 */

/* Este php recibirá los datos de main.js (ajax) y procesará el username, password del usuario/empresa que haya enviado la petición. */

session_start();
if (isset($_POST['username']) && ($_POST['password'])) {

    include 'connection.php';

    $username = mysqli_real_escape_string($conexion,$_POST['username']);
    $password = mysqli_real_escape_string($conexion,$_POST['password']);
    $tiposesion = $_POST['tiposesion'];

    $sql = 'select * from '. $tiposesion .' where alias="'.$username.'"';
    $resultado=$conexion->query($sql);
    $datos = $resultado->fetch_array(MYSQLI_ASSOC);

    if ($password === $datos['password']) {
        $_SESSION['nombre'] = $username;    // Creamos una sesión y en el array le metemos tanto el nombre como el tipo de sesion (usuario/empresa)
        $_SESSION['tipo'] = $tiposesion;
        echo 0; // Datos correctos
    }else{
        // Enviar por ajax respuesta incorrecta
        echo 1;
    }
}