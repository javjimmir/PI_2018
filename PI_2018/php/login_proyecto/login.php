<?php
session_start(); 
if (isset($_POST['usuario']) and isset($_POST['password'])) {
	$conexion = mysqli_connect('localhost','root','','actividades') or die ('error al realizar la conexión'.mysqli_error($conexion));

	$username = mysqli_real_escape_string($conexion,$_POST['usuario']);
	$password = mysqli_real_escape_string($conexion,$_POST['password']);

	$sql = 'select * from usuario where alias="'.$username.'"';
	$comprobacion=$conexion->query($sql);
	
	if ($comprobacion->num_rows > 0) {
 		$pass = $comprobacion->fetch_array(MYSQLI_ASSOC);
 		print '1-'.$pass['password'].'- '.$username;
		if ($password === $pass['password']) {
			$_SESSION['nombre'] = $username;
			header('location: ./prueba.php');
		}else{
			print 'password incorrecto<br>
			<a href="./prueba.php">Volver atrás</a>';
		}
		
	}else{
			print 'usuario no correcto <br>
			<a href="./prueba.php">Volver atrás</a>';
	}

}else{
	echo 'login incorrecto';
	header('location: ./prueba.php');
}
?>