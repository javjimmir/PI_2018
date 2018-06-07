<?php
session_start();
include '../php/connection.php';
/* Sacando datos del user... */
$username = $_SESSION['nombre'];
$sesion = $_SESSION['tipo'];
header('Content-Type: text/plain; charset=utf-8');
try {
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['upfile']['error']) ||
        is_array($_FILES['upfile']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.', header('Location: ../content/perfil.php?user='. $username .'&status=parameters'));
    }
    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.', header('Location: ../content/perfil.php?user='. $username .'&status=nofilesent'));
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.', header('Location: ../content/perfil.php?user='. $username .'&status=filesizelimit'));
        default:
            throw new RuntimeException('Unknown errors.', header('Location: ../content/perfil.php?user='. $username .'&status=unknown'));
    }
    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.', header('Location: ../content/perfil.php?user='. $username .'&status=filesizelimit'));
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
        throw new RuntimeException('Invalid file format.', header('Location: ../content/perfil.php?user='. $username .'&status=fileformat'));
    }
    if ($sesion == "usuario") {
        $directorio = '../img/usuario/';
        $nombre_real = $_FILES["upfile"]["name"];
        $ext = pathinfo($nombre_real, PATHINFO_EXTENSION);
        $nombre_base = basename($username . '_perfil' . '.' . $ext);    // Modificamos el fichero por seguridad, y le adjuntamos la extensión
        if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'],
            sprintf($directorio . $nombre_base,
                $ext
            )
        )) {
            throw new RuntimeException('Failed to move uploaded file.', header('Location: ../content/perfil.php?user='. $username .'&status=generic'));
        }
        // En caso de que se haya subido correctamente...
        $sql = "UPDATE usuario SET imagen_perfil = '$nombre_base' WHERE alias = '$username'";
        if ($conexion->query($sql) === TRUE) {
            header('Location: ../content/perfil.php?user='. $username .'&status=success');
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    } else if ($sesion == "empresa") {
        $directorio = '../img/empresa/';
        $nombre_real = $_FILES["upfile"]["name"];
        $ext = pathinfo($nombre_real, PATHINFO_EXTENSION);
        $nombre_base = basename($username . '_perfil' . '.' . $ext);    // Modificamos el fichero por seguridad, y le adjuntamos la extensión
        if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'],
            sprintf($directorio . $nombre_base,
                $ext
            )
        )) {
            throw new RuntimeException('Failed to move uploaded file.', header('Location: ../content/perfil.php?user='. $username .'&status=generic'));
        }
        $sql = "UPDATE empresa SET imagen_perfil = '$nombre_base' WHERE alias = '$username'";
        if ($conexion->query($sql) === TRUE) {
            header('Location: ../content/perfil.php?user='. $username .'&status=success');
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    }
} catch (RuntimeException $e) {
    echo $e->getMessage();
}