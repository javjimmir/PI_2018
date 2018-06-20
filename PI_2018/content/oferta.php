<?php
session_start();
include '../php/connection.php';

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="../img/favicon.ico" />
	<title>Detalle de actividad | WildSports</title>
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
        $sql_cont_reservas = "SELECT TRUNCATE(AVG(valoracion),1) as media, COUNT(*) as total FROM reserva WHERE id_oferta=".$id;
        $result = $conexion->query($sql_oferta);
        $result2 = $conexion->query($sql_cont_reservas);
        $row = $result->fetch_assoc();
        $row2 = $result2->fetch_assoc();
        $media = 0;
        $total = 0;

        if ($row2['media']!=null) {
            $media = $row2['media'];
            $total = $row2['total'];
        }
        /* Query que obtiene el nombre de la empresa que organiza la oferta/actividad */
        $sql_nombre_empresa = "select nombre,alias from empresa where cif = (select cif_empresa from oferta where id = $id)";
        $result_nombre_empresa = $conexion->query($sql_nombre_empresa);
        $row_nombre_empresa = $result_nombre_empresa->fetch_assoc();


        echo '<div>';
    echo '<div><h3>DETALLE DE LA ACTIVIDAD</h3><hr style=\'width: 90%\'/>

    <img class="imgOffer" src="../img/oferta/'.$row['imagen_oferta'].'"></div>';

        echo '<br><div class="table-title">
				</div>
				<table class="table-fill">
				<thead>
				
				</thead>';
				echo '<tbody class="table-hover">';

				echo '<tr>
				<td class="text-left">Nombre</td>
				<td class="text-left">'.$row['nombre'].'</td>
				</tr>';

                echo "<tr>
				<td class=\"text-left\">Empresa organizadora</td>
				<td class=\"text-left\"><a href='perfil.php?alias={$row_nombre_empresa['alias']}'>{$row_nombre_empresa['nombre']} <span class='glyphicon glyphicon-share-alt'></span></a></td>
				</tr>";

				echo '<tr>
				<td class="text-left">Provincia</td>
				<td class="text-left">'.$row['provincia'].'</td>
				</tr>';

				echo '<tr>
				<td class="text-left">Municipio</td>
				<td class="text-left">'.$row['municipio'].'</td>
				</tr>';
				echo '<tr>
				<td class="text-left">Duración</td>
				<td class="text-left">'.$row['duracion'].' minutos</td>
				</tr>';

				echo '<tr>
				<td class="text-left">Número de plazas disponibles</td>
				<td class="text-left">'.$row['num_plazas'].'</td>
				</tr>';

				echo '<tr>
				<td class="text-left">Tipo de actividad</td>
				<td class="text-left" style="text-transform: capitalize">'.$row['tipo_actividad'].'</td>
				</tr>';

				echo '<tr>
				<td class="text-left">Descripción</td>
				<td class="text-left">'.$row['descripcion'].'</td>
				</tr>';

				echo '<tr>
				<td class="text-left">Precio</td>
				<td class="text-left">'.$row['precio'].'€</td>
				</tr>';

				echo '<tr>
				<td class="text-left">Dificultad</td>
				<td class="text-left" style="text-transform: capitalize">'.$row['dificultad']. '</td>
				</tr>';

				echo '<tr>
				<td class="text-left">Categoría</td>
				<td class="text-left" style="text-transform: capitalize">'.$row['categoria'].'</td>
				</tr>';

				echo '<tr>
				<td class="text-left">Fecha de inicio</td>
				<td class="text-left">'.$row['fecha_inicio'].'</td>
				</tr>';

				echo '<tr>
				<td class="text-left">Fecha de fin</td>
				<td class="text-left">'.$row['fecha_fin'].'</td>
				</tr>';

				echo '<tr>
				<td class="text-left">Media de valoraciones</td>
				<td class="text-left">'.$media.'/5 <br>(basado en '.$total.' puntuaciones)</td>
				</tr>';

				echo '</tbody>';
				echo '</table>';
      
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
                                    <input class="form-control caja" required type="number" name="plazas_reserva" min="1" max=<?php echo $row['num_plazas'];?>><br>
                                    <label>¿Cuándo desea empezar la actividad?</label><br>

                                    <input class="form-control caja" required type="date" min="<?php echo $row['fecha_inicio'];?>" max="<?php echo $row['fecha_fin'];?>" name="fecha_reserva"><br>
                                    Escoja un día entre el <?php echo $row['fecha_inicio'];?> y el <?php echo $row['fecha_fin'];?><br>
                                    <input class="form-control caja2 btn-primary" type="submit" name="enviar" value="Confirmar">
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
                                        echo '<div id=\'reserva_ok\'><span class=\'alert alert-success\'><span class=\'glyphicon glyphicon-ok-circle\'></span> ¡Reserva realizada con éxito! Accede a <a href="reservas.php">tus reservas</a> para ver más información</span></div>';
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

        <?php 

            /* Esto de mostrar el error así es un viaje de pachanguero, pero por ahora lo dejo así porque no se me ocurre otra forma. Fran */ 

            if ($insert_correcto === 1) {
                echo '<div id=\'reserva_ok\' style="position: absolute; width: 37%;"><span class=\'alert alert-success\'><span class=\'glyphicon glyphicon-ok-circle\'></span> ¡Reserva realizada con éxito! Accede a <a href="reservas.php">tus reservas</a> para ver más información</span></div>';
            }

            if ($insert_correcto === 2) {
                echo '<div id=\'reserva_error\' style="position: absolute; width: 37%;"><span class=\'alert alert-danger\'><span class=\'glyphicon glyphicon-remove\'></span> Ha ocurrido un error en la reserva, inténtalo más tarde</span></div>';
            }

            if (isset($_SESSION['tipo'])) {
                
                if ($_SESSION['tipo'] === "usuario") { 
                echo '<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#miModal" id="reservaoferta">
                    Realizar reserva
                </button>';
                }
            }
        ?>

        <br><br>
                <a class="btn btn-primary btn-lg" id="volverInd" href="../index.php">Volver al index</a>
        <br><br>
    </article>
</section>

<footer class="pie">

</footer>
</body>
</html>
