<?php
	include 'connection.php';
	$sesion = $_POST['sesion'];
    $seccion = $_POST['seccion'];

	// Usuario
	if ($sesion == 'usuario') {
        if ($seccion == 'perfil') {
            $nif = $_POST['dni'];
            $nombre = $_POST['nombreusuario'];
            $apellidos = $_POST['apellidos'];
            $telefono = $_POST['telefono'];
            $actividad_favorita = $_POST['actfavorita'];
            $direccion = $_POST['direccion'];
            $provincia = $_POST['provincia'];
            $cp = $_POST['cp'];
            $pais = $_POST['pais'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = "UPDATE usuario SET nombre = '$nombre', apellidos = '$apellidos', telefono = '$telefono', pais = '$pais', email = '$email', cp = '$cp', provincia = '$provincia', direccion = '$direccion', password = MD5(\"'.$password.'\") WHERE nif = '$nif'";

            if ($conexion->query($sql) === TRUE) {
                header('location: ../content/perfil.php?confirmation=succeed'); // Enviamos a perfil por get que se ha editado con éxito, para coger el parámetro y enviar un mensaje en perfil.
            } else {
                echo "Error: " . $sql . "<br>" . $conexion->error;
            }
        } else if ($seccion == 'config') { // Es configuración
            $nif = $_POST['dni'];
            // Comprobamos que la "contraseña actual" es correcta y después la cambiamos por la nueva.
            $password_actual = $_POST['password'];
            $sql_comprob_password = 'select * from usuario where password = MD5("'.$password_actual.'")';
            $resultado=$conexion->query($sql_comprob_password);
            if ($resultado->num_rows === 1) {   // Si la contraseña es correcta, se cambiará por la nueva password que elija la empresa
                $nueva_password = $_POST['newpassword'];
                $sql = "UPDATE usuario SET password = MD5('$nueva_password') WHERE nif = '$nif'";
                if ($conexion->query($sql) === TRUE) {
                    header('location: ../content/perfil.php?confirmation=succeed'); // Enviamos a perfil por get que se ha editado con éxito, para coger el parámetro y enviar un mensaje en perfil.
                } else {
                    echo "Error: " . $sql . "<br>" . $conexion->error;
                }
            } else {
                header('location: ../content/perfil.php?confirmation=password'); // Enviamos a perfil por get que hay un error con la contraseña.
            }
        }

    // Empresa
    } else {
	    if ($seccion == 'perfil') {
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
            $sql = "UPDATE empresa SET nombre = '$nombre', telefono = '$telefono', pais = '$pais', provincia = '$provincia',email = '$email', tipo_actividad = '$tipo_actividad', web = '$web', descripcion = '$descripcion', cp = '$cp' WHERE cif = '$cif'";

            if ($conexion->query($sql) === TRUE) {
                header('location: ../content/perfil.php?confirmation=true'); // Enviamos a perfil por get que se ha editado con éxito, para coger el parámetro y enviar un mensaje en perfil.
            } else {
                echo "Error: " . $sql . "<br>" . $conexion->error;
            }
        } else if ($seccion == 'config') { // Es configuración
            $cif = $_POST['cif'];
	        // Comprobamos que la "contraseña actual" es correcta y después la cambiamos por la nueva.
	        $password_actual = $_POST['password'];
	        $sql_comprob_password = 'select * from empresa where password = MD5("'.$password_actual.'")';
            $resultado=$conexion->query($sql_comprob_password);
            if ($resultado->num_rows === 1) {   // Si la contraseña es correcta, se cambiará por la nueva password que elija la empresa
                $nueva_password = $_POST['newpassword'];
                $sql = "UPDATE empresa SET password = MD5('$nueva_password') WHERE cif = '$cif'";
                if ($conexion->query($sql) === TRUE) {
                    header('location: ../content/perfil.php?confirmation=succeed'); // Enviamos a perfil por get que se ha editado con éxito, para coger el parámetro y enviar un mensaje en perfil.
                } else {
                    echo "Error: " . $sql . "<br>" . $conexion->error;
                }
            } else {
                header('location: ../content/perfil.php?confirmation=password'); // Enviamos a perfil por get que hay un error con la contraseña.
            }
        }
    }
