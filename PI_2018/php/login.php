<?php
session_start(); 
if (isset($_POST['usuario']) and isset($_POST['password'])) {
    include 'connection.php';

	$username = mysqli_real_escape_string($conexion,$_POST['usuario']);
	$password = mysqli_real_escape_string($conexion,$_POST['password']);

	$sql = 'select * from usuario where alias="'.$username.'"';
	$comprobacion=$conexion->query($sql);
	
	if ($comprobacion->num_rows > 0) {
 		$pass = $comprobacion->fetch_array(MYSQLI_ASSOC);
 		print '#DEBUG: Pass > '.$pass['password'].' ---- User > '.$username.'</br>';
		if ($password === $pass['password']) {
			$_SESSION['nombre'] = $username;
			header('location: ../content/portal.php');
		}else{
            print 'Password incorrecto <br>
			<a href="../">Volver atrás</a>';
		}
		
	}else{
			print 'Usuario incorrecto <br>
			<a href="../">Volver atrás</a>';
	}

}else{
    // Aquí llegará alguna vez??
	echo 'login incorrecto';
	header('location: ../content/form_login.html');
}