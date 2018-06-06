<?php
include 'connection.php';      

/* Si se recibe solo una actividad... */
if (isset($_POST['tipo_actividad']) && empty($_POST['precio'])) {
    $actividad = $_POST['tipo_actividad']; // Actividad a filtrar por el usuario
    $res=[];
    $sql = "select * from oferta where tipo_actividad = "."'$actividad'" . " ORDER BY fecha_inicio DESC LIMIT 50";

    $resultado = $conexion->query($sql);

    while($row = $resultado->fetch_object()){
        $fila=array(
            "id"=>$row->id,
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
}

/* Si se recibe solo un precio... */
if (isset($_POST['precio']) && empty($_POST['tipo_actividad'])) {
    $precio = $_POST['precio']; // Actividad a filtrar por el usuario
    $res=[];
    $sql = "select * from oferta where precio < "."'$precio'" . " ORDER BY fecha_inicio DESC LIMIT 50";
    $resultado = $conexion->query($sql);

    while($row = $resultado->fetch_object()){
        $fila=array(
            "id"=>$row->id,
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
}

/* Si se recibe precio y actividad... */
if (isset($_POST['precio'], $_POST['tipo_actividad'])) {
    $precio = $_POST['precio']; // Actividad a filtrar por el usuario
    $actividad = $_POST['tipo_actividad']; // Actividad a filtrar por el usuario

    $res=[];
    $sql = "select * from oferta where precio < "."'$precio'" . " and tipo_actividad = "."'$actividad' ORDER BY fecha_inicio DESC LIMIT 50";
    $resultado = $conexion->query($sql);
    //echo $sql;
    while($row = $resultado->fetch_object()){
        $fila=array(
            "id"=>$row->id,
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
}

/* Si se recibe solo una provincia... */
if (isset($_POST['provincia']) && empty($_POST['tipo_actividad']) && empty($_POST['precio'])) {
    $provincia = $_POST['provincia'];
    $res=[];
    $sql = "select * from oferta where provincia = "."'$provincia'" . " ORDER BY fecha_inicio DESC";
    $resultado = $conexion->query($sql);

    while($row = $resultado->fetch_object()){
        $fila=array(
            "id"=>$row->id,
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
}
