<?php
	include 'connection.php';

	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$dni = $_POST['dni'];
	$alias = $_POST['username'];
	$password = $_POST['pass'];
	$pais = $_POST['pais-usu'];
	$email = $_POST['mail'];
	$provincia = $_POST['provincia-usu'];
	$direccion = $_POST['direccion'];
	$cp = $_POST['cp-usuario'];
	$telefono = $_POST['telefono'];
	$categoria = $_POST['categoria'];
	  
	$sql = "INSERT INTO usuario (nif,nombre,apellidos,telefono,pais,alias,email,cp,provincia,direccion,actividad_fav,password)
	VALUES ('$dni','$nombre', '$apellidos','$telefono','$pais','$alias','$email','$cp','$provincia','$direccion','$categoria',MD5('".$password."'));";
	if ($conexion->query($sql) === TRUE) {
	    // Hace algún efecto con jquery o una redirección...
	    header('location: ./success.html');
	} else {
	    echo "Error: " . $sql . "<br>" . $conexion->error;
	}