<?php
session_start();
include '../php/connection.php';
/* Sacando datos del user... */
$id = $_GET['id'];
header('Content-Type: text/plain; charset=utf-8');
try {
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['upfile']['error']) ||
        is_array($_FILES['upfile']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.', header('Location: ../content/edit.php?id='. $id .'&status=parameters'));
    }
    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.', header('Location: ../content/edit.php?id='. $id .'&status=nofilesent'));
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.', header('Location: ../content/edit.php?id='. $id .'&status=filesizelimit'));
        default:
            throw new RuntimeException('Unknown errors.', header('Location: ../content/edit.php?id='. $id .'&status=unknown'));
    }
    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.', header('Location: ../content/edit.php?id='. $id .'&status=filesizelimit'));
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
        throw new RuntimeException('Invalid file format.', header('Location: ../content/edit.php?id='. $id .'&status=fileformat'));
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
            throw new RuntimeException('Failed to move uploaded file.', header('Location: ../content/edit.php?id='. $id .'&status=generic'));
        }
        $sql = "UPDATE oferta SET imagen_oferta = '$nombre_base' WHERE id = ".$id;
        if ($conexion->query($sql) === TRUE) {
            header('Location: ../content/edit.php?id='. $id .'&status=success');
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    
} catch (RuntimeException $e) {
    echo $e->getMessage();
}