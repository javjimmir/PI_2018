<?php
	include 'connection.php';
	$sesion = $_POST['sesion'];

	// Usuario
	if ($sesion == 'usuario') {
        $nif = $_POST['dni'];
        $nombre = $_POST['nombreusuario'];
        $apellidos = $_POST['apellidos'];
        //$alias = $_POST['username']; Se debería poder cambiar?
        $telefono = $_POST['telefono'];
        $actividad_favorita = $_POST['actfavorita'];
        $direccion = $_POST['direccion'];
        $provincia = $_POST['provincia'];
        $cp = $_POST['cp'];
        $pais = $_POST['pais'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "UPDATE usuario SET nombre = '$nombre', apellidos = '$apellidos', telefono = '$telefono', pais = '$pais', email = '$email', cp = '$cp', provincia = '$provincia', direccion = '$direccion', password = '$password' WHERE nif = '$nif'";

        if ($conexion->query($sql) === TRUE) {
            header('location: ../content/perfil.php?confirmation=true'); // Enviamos a perfil por get que se ha editado con éxito, para coger el parámetro y enviar un mensaje en perfil.
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    // Empresa
    } else {
        $cif = $_POST['cif'];
        $nombre = $_POST['nombreempresa'];
        //$alias = $_POST['username']; Se debería poder cambiar?
        $telefono = $_POST['telefono'];
        $tipo_actividad = $_POST['tipoactividad'];
        $descripcion = $_POST['descripcion'];
        $web = $_POST['web'];
        $provincia = $_POST['provincia'];
        $cp = $_POST['cp'];
        $pais = $_POST['pais'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "UPDATE empresa SET nombre = '$nombre', telefono = '$telefono', pais = '$pais', provincia = '$provincia', tipo_actividad = '$tipo_actividad', web = '$web', email = '$email', descripcion = '$descripcion', cp = '$cp', password = '$password' WHERE cif = '$cif'";

        if ($conexion->query($sql) === TRUE) {
            header('location: ../content/perfil.php?confirmation=true'); // Enviamos a perfil por get que se ha editado con éxito, para coger el parámetro y enviar un mensaje en perfil.
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    }
