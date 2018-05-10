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
	  
	$sql = "INSERT INTO empresa (cif,nombre,telefono,pais,provincia,alias,tipo_actividad,web,email,descripcion,cp,password)
	VALUES ('$cif', '$nombre', '$telefono','$pais','$provincia','$alias','$categoria','$web','$email','$descripcion','$cp','$password')";

	if ($conn->query($sql) === TRUE) {
	    echo "Registro añadido correctamente.";
	    header('location: ./success.html');
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}