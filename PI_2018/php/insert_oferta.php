<?php
	include 'connection.php';
	session_start();

	/* Extracción del cif de la empresa mediante el alias proporcionado por la variable de sesión, no se controla que esta variable sea null o no puesto que no se puede llegar aquí si no estás logueado como una empresa. */

	$sql_cif = "SELECT cif from empresa where alias='".$_SESSION['nombre']."'";

	$result = $conexion->query($sql_cif); 
	$fila = $row = $result->fetch_assoc();

	$cif = $fila['cif'];
	$nombre = $_POST['nombre'];
	$provincia = $_POST['provincia-ofe'];
	$municipio = $_POST['municipio'];
	$duracion = $_POST['duracion'];
	$plazas = $_POST['plazas'];
	$actividad = $_POST['actividad'];
	$localizacion = $_POST['localizacion'];
	$precio = $_POST['precio'];
	$dificultad = $_POST['dificultad'];
	$categoria = $_POST['categoria'];
	$img = "submarinismo.jpg";
	$fecha_inicio = $_POST['inicio'];
	$fecha_fin = $_POST['fin'];
	$descripcion = $_POST['desc'];
	  
	$sql = "INSERT INTO oferta (cif_empresa,nombre,provincia,municipio,duracion,num_plazas,tipo_actividad,localizacion,precio,dificultad,categoria,imagen_oferta,fecha_inicio,fecha_fin,descripcion)
	VALUES ('$cif','$nombre','$provincia','$municipio','$duracion',$plazas,'$actividad','$localizacion',$precio,'$dificultad','$categoria','$img','$fecha_inicio','$fecha_fin','$descripcion')";

	if ($conexion->query($sql) === TRUE) {
	    print 'Registro insertado correctamente <br>
			<a href="../content/registrofertas.html">Volver atrás</a>';

	} else {
	    echo "Error: " . $sql . "<br>" . $conexion->error;
	}

?>	