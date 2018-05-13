<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 13/05/2018
 * Time: 12:48
 */

include 'connection.php';

$actividad = $_POST['tipo_actividad']; // Actividad a filtrar por el usuario

$res=[];
$sql = "select * from oferta where tipo_actividad = "."'$actividad'";
//echo $sql;
//SELECT COUNT(*) FROM oferta;              Para capturar el total de ofertas de ese tipo de actividad
$resultado = $mysqli->query($sql);


while($row = $resultado->fetch_object()){
    $fila=array(
        "nombre"=>$row->nombre
        /*"provincia"=>$row->provincia,
        "tipo_actividad"=>$row->tipo_actividad,
        "precio"=>$row->precio,
        "fecha_inicio"=>$row->fecha_inicio,
        "fecha_fin"=>$row->fecha_fin*/
    );
    array_push($res, $fila);
}
echo json_encode($res);
$resultado->free();
$mysqli->close();