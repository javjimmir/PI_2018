<?php
/* Este php procesa la petición ajax de reservas.php */

include 'connection.php'; // Usa la variable $conexion

$estrellas = $_POST['starselected'];
$texto_opinion = $_POST['rating_text'];
$nif_user = $_POST['input_nif_usuario'];
$id_oferta = $_POST['input_id_oferta'];

$sql = "UPDATE reserva SET valoracion = $estrellas, resena = '$texto_opinion' WHERE nif_usuario = '$nif_user' and id_oferta = $id_oferta";

if ($conexion->query($sql) === TRUE) {
    echo 0; // Éxito
} else {
    echo 1; // Error
}