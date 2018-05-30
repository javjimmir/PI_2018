<?php
session_start();
include '../php/connection.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Hacer reserva</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/conectores_content.js"></script>
</head>
<body>
<header class="menuLogin">

</header>
<nav class="menuPrincipalUser">

</nav>
<aside class="publicidad">

</aside>
<section>
    <article>
        <?php
        $id = $_GET['id'];
        $sql_oferta = "SELECT * FROM oferta WHERE id=".$id;
        $result = $conexion->query($sql_oferta);
        $row = $result->fetch_assoc();
        echo '<div id="detalle-oferta">';
        echo "<p>AVISO: ESTA VISTA ES PROVISIONAL PARA EL DESARROLLO DEL BACK, UNA VEZ QUE ESTÉ TODO FUNCIONANDO PERFE SE PONDRÁ LA VISTA DEFINITIVA EN PLAN BONITO. NO NOS REPORTEIS PROFES.</p>";
        echo '<p> Nombre de la oferta: '.$row['nombre'].'</p>';
        echo '<p> Provincia: '.$row['provincia'].'</p>';
        echo '<p> Municipio: '.$row['municipio'].'</p>';
        echo '<p> Duración: '.$row['duracion'].'</p>';
        echo '<p> Número de plazas disponibles: '.$row['num_plazas'].'</p>';
        echo '<p> Tipo de actividad: '.$row['tipo_actividad'].'</p>';
        echo '<p> Descripción: '.$row['descripcion'].'</p>';
        echo '<p> Precio: '.$row['precio'].' €</p>';
        echo '<p> Dificultad: '.$row['dificultad'].'</p>';
        echo '<p> Categoría: '.$row['categoria'].'</p>';
        echo '<p> Fecha de inicio: '.$row['fecha_inicio'].'</p>';
        echo '<p> Fecha de fin: '.$row['fecha_fin'].'</p>';
        echo '</div>';
        if ($_SESSION['tipo'] === "usuario") {
            //sacamos el nif del usuario que hace la reserva mediante la variable de sesión y también debemos multiplicar el precio de la oferta por el número de plazas que se vaya a reservar. En el caso de que l oferta no disponga del número de plazas que se va a solicitar peta y no te deja continuar. EL FORMULARIO HA DE SER VALIDADO PARA QUE SOLO ENTREN NÚMEROS.

            /* El formulario solo aparecerá cuando no haya datos post y cuando el que ha iniciado sesión es un usuario.*/
            if (!isset($_POST['plazas_reserva'])) {
                ?>
                <div id="reserva-oferta">
                    <h2>HACER LA RESERVA</h2>
                    <form method="POST">
                        <label>Número de plazas que desea reservar:</label><br>
                        <input required type="number" name="plazas_reserva" min="1" max=<?php echo $row['num_plazas'];?>><br>
                        <label>¿Cuándo desea empezar la actividad?</label><br>

                        <input required type="date" min="<?php echo $row['fecha_inicio'];?>" max="<?php echo $row['fecha_fin'];?>" name="fecha_reserva"><br>
                        Escoja un día entre el <?php echo $row['fecha_inicio'];?> y el <?php echo $row['fecha_fin'];?><br>
                        <input type="submit" name="enviar" value="Confirmar">
                    </form>
                </div>
        <?php
            } else {
                $num_plazas = $row['num_plazas'];
                // esta comprobación ya no es necesaria porque el formulario está validado y solo se puede escoger las plazas reservadas según dicta la oferta *juan*
                /*if ( $_POST['plazas_reserva']<=0 || $num_plazas < $_POST['plazas_reserva']) {
                    echo "ERROR: no se puede reservar porque no hay plazas suficientes";
                }else{*/
                    /* obtenemos el dni del usuario conectado */
                    $sql_nif = "SELECT nif FROM usuario WHERE alias = '".$_SESSION['nombre']."'";
                    $result_nif = $conexion->query($sql_nif);
                    $row2 = $result_nif->fetch_assoc();
                    $nif=$row2['nif'];

                    /* obtenemos la fecha de hoy en el formato YY/MM/DD */

                    /*$array_fecha = getdate();
                    $year = $array_fecha['year'];
                    $month = $array_fecha['mon'];
                    $day = $array_fecha['mday'];
                    $fecha = $year."-".$month."-".$day;*/


                    /* Actualización: ahora la fecha_reserva  NO es el día que reserva el usuario, sino el día que el usuario elige para empezar la actividad */
                    $insert_reserva = "INSERT INTO reserva (nif_usuario,id_oferta,fecha_reserva,num_plazas_reserva,coste_reserva)
				VALUES('".$nif."',".$id.",'".$_POST['fecha_reserva']."',".$_POST['plazas_reserva'].",".$_POST['plazas_reserva']."*".$row['precio'].")";

                    if ($conexion->query($insert_reserva) === TRUE) {
                        echo 'Registro insertado correctamente';
                        $sql_plazas = "UPDATE oferta SET num_plazas=num_plazas - ".$_POST['plazas_reserva']." WHERE id=".$id;
                        $conexion->query($sql_plazas);
                        echo '<a href="oferta.php?id='.$id.'">Volver</a>';
                    } else {
                        echo "Error: " . $insert_reserva . "<br>" . $conexion->error;
                    }
                //}
            }
        }

        if ($_SESSION['tipo'] === "empresa") {
            echo '<p>Solo los usuarios pueden realizar las reservas</p>';
        }

        ?>
        <br><br>
        <a href="../index.php">Volver al index</a>
    </article>
</section>

<footer class="pie">

</footer>
</body>
</html>