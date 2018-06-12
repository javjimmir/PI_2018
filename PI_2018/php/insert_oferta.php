<?php
	include 'connection.php';
	session_start();
	$username = $_SESSION['nombre'];
	/* Extracción del cif de la empresa mediante el alias proporcionado por la variable de sesión, no se controla que esta variable sea null o no puesto que no se puede llegar aquí si no estás logueado como una empresa. */

	$sql_cif = "SELECT cif from empresa where alias='".$username."'";

	$result = $conexion->query($sql_cif); 
	$fila = $row = $result->fetch_assoc();
	$img = "default.jpg";

header('Content-Type: text/plain; charset=utf-8');
try {
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.', header('Location: ../content/registrofertas.php?status=nofilesent'));
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.', header('Location: ../content/registrofertas.php?status=filesizelimit'));
        default:
            throw new RuntimeException('Unknown errors.', header('Location: ../content/registrofertas.php?status=unknown'));
    }
    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.', header('Location: ../content/registrofertas.php?status=filesizelimit'));
    }
    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
            $finfo->file($_FILES['upfile']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        )) {
        throw new RuntimeException('Invalid file format.', header('Location: ../content/registrofertas.php?status=fileformat'));
    }
        $directorio = '../img/oferta/';
        $nombre_real = $_FILES["upfile"]["name"];
        $ext = pathinfo($nombre_real, PATHINFO_EXTENSION);
        $nombre_base = basename($nombre_real);    // Modificamos el fichero por seguridad, y le adjuntamos la extensión
        if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'],
            sprintf($directorio . $nombre_base,
                $ext
            )
        )) {
            throw new RuntimeException('Failed to move uploaded file.', header('Location: ../content/registrofertas.php?status=generic'));
        }
        // En caso de que se haya subido correctamente...
        $img = $nombre_real;
        echo "<p>flama</p>";
     
} catch (RuntimeException $e) {
    echo $e->getMessage();
}	

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
	$fecha_inicio = $_POST['inicio'];
	$fecha_fin = $_POST['fin'];
	$descripcion = $_POST['desc'];
	  
	$sql = "INSERT INTO oferta (cif_empresa,nombre,provincia,municipio,duracion,num_plazas,tipo_actividad,localizacion,precio,dificultad,categoria,imagen_oferta,fecha_inicio,fecha_fin,descripcion)
	VALUES ('$cif','$nombre','$provincia','$municipio','$duracion',$plazas,'$actividad','$localizacion',$precio,'$dificultad','$categoria','$img','$fecha_inicio','$fecha_fin','$descripcion')";

	if ($conexion->query($sql) === TRUE) {
	    header('Location: ../content/registrofertas.php');
	} else {
	    echo "Error: " . $sql . "<br>" . $conexion->error;
	}

?>	