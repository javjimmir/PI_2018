<?php
	include 'connection.php';

	$nombre = $_POST['nombre'];
	$cif = $_POST['cif'];
	$web = $_POST['web'];
	$alias = $_POST['username'];
	$password = $_POST['pass'];
	$pais = $_POST['pais-empresa'];
	$provincia = $_POST['provincia-empresa'];
	$direccion = $_POST['direccion'];
	$cp = $_POST['cp-empresa'];
	$telefono = $_POST['telefono'];
	$email = $_POST['mail-empresa'];
	$categoria = $_POST['categoria'];
	$descripcion = $_POST['desc-empresa'];
	$imagen_perfil = 'user-default.png';
	  
	$sql = "INSERT INTO empresa (cif,nombre,telefono,pais,provincia,alias,imagen_perfil,tipo_actividad,web,email,descripcion,cp,password)
	VALUES ('$cif', '$nombre', '$telefono','$pais','$provincia','$alias','$imagen_perfil','$categoria','$web','$email','$descripcion','$cp', MD5('".$password."'))";

	if ($conexion->query($sql) === TRUE) {
	    echo "Registro añadido correctamente.";
	    header('location: ./login.html?register=company');
	} else {
	    echo "Error: " . $sql . "<br>" . $conexion->error;
	}