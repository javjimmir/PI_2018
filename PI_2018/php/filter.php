<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 13/05/2018
 * Time: 12:48
 */

include 'connection.php';        // Usa la variable $conexion

$precio = $_POST['precio']; // Actividad a filtrar por el usuario
$res=[];
$sql = "select * from oferta where precio < "."'$precio'";


$resultado = $conexion->query($sql);

while($row = $resultado->fetch_object()){
    $fila=array(
        "nombre"=>$row->nombre,
        "tipo_actividad"=>$row->tipo_actividad,
        "provincia"=>$row->provincia,
        "dificultad"=>$row->dificultad,
        "precio"=>$row->precio
    );
    array_push($res, $fila);
}
echo json_encode($res);
$resultado->free();
$conexion->close();