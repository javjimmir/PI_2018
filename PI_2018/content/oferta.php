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

        ?>

        <!-- Modal que contiene el formulario de reserva de la actividad, al cual solo podemos acceder cuando se está logueado como usuario y no como empresa. -->
        <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Reserva de actividad</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $insert_correcto = 0;
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
                                    $sql_nif = "SELECT nif FROM usuario WHERE alias = '".$_SESSION['nombre']."'";
                                    $result_nif = $conexion->query($sql_nif);
                                    $row2 = $result_nif->fetch_assoc();
                                    $nif=$row2['nif'];
                                    $insert_reserva = "INSERT INTO reserva (nif_usuario,id_oferta,fecha_reserva,num_plazas_reserva,coste_reserva)
                                VALUES('".$nif."',".$id.",'".$_POST['fecha_reserva']."',".$_POST['plazas_reserva'].",".$_POST['plazas_reserva']."*".$row['precio'].")";

                                    if ($conexion->query($insert_reserva) === TRUE) {
                                        echo 'Registro insertado correctamente';
                                        $sql_plazas = "UPDATE oferta SET num_plazas=num_plazas - ".$_POST['plazas_reserva']." WHERE id=".$id;
                                        $conexion->query($sql_plazas);
                                        $insert_correcto = 1;
                                        echo '<a href="oferta.php?id='.$id.'">Volver</a>';
                                    } else {
                                        echo "Error: " . $insert_reserva . "<br>" . $conexion->error;
                                        $insert_correcto = 2;
                                    }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
        <a href="../index.php">Volver al index</a>
        <br><br>

        <?php 

            /* Esto de mostrar el error así es un viaje de pachanguero, pero por ahora lo dejo así porque no se me ocurre otra forma. Fran */ 

            if ($insert_correcto === 1) {
                echo '<p>Registro insertado correctamente!!!</p>';
            }

            if ($insert_correcto === 2) {
                echo '<p>Error al intentar hacer la reserva.</p>';
            }

            if ($_SESSION['tipo'] === "usuario") { 
            echo '<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#miModal">
                Realizar reserva
            </button>';
            }
        ?>
    </article>
</section>

<footer class="pie">

</footer>
</body>
</html>