<?php
session_start();
include '../php/connection.php';
if (!isset($_SESSION['nombre'])) {
    // Si es usuario anónimo (no logeado) no podrá acceder a esta página, así que será redirigido a un 404.
    header('Location: ./404.html');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="../js/conectores_content.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<title>Mis reservas</title>
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
      
      if(isset($_GET['aski']) == 'delete'){

        $id = mysqli_real_escape_string($conexion,(strip_tags($_GET["id"],ENT_QUOTES)));
        $sql_del = "DELETE FROM reserva WHERE id='$id'";
        $delete = $conexion->query($sql_del);
          if($delete){
            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
          }else{
            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
            echo "Error: " . $sql_del . "<br>" . $conexion->error;
          }
        }
      
      ?>
</article>
<article>
    <h2 class="text-center">Mis reservas</h2>
				<?php

				$sql_reserva = "SELECT * FROM reserva WHERE nif_usuario = (SELECT nif FROM usuario WHERE alias = '". $_SESSION['nombre']  ."') "; 

				  $result = $conexion->query($sql_reserva); 
          
          if ($result->num_rows === 0) {
            echo '<p class="text-center">No hay registros para mostrar</p>';
          }else{
            
           while($row = $result->fetch_assoc()) {
                $sql_oferta = "SELECT * from oferta where id = '".$row['id_oferta']."'";
                $result2 = $conexion->query($sql_oferta);
                $row2 = $result2->fetch_assoc();
                echo '  <div class="col-lg-4 actividad">
          <div class="row">
            <div class="col-lg-4">
              <img src="../img/submarinismo.jpg" alt="submarinismo" class="listImg">
            </div>
            <div class="col-lg-8">
                <p id="nombre_actividad">'.$row2['nombre'].'</p>
                <p id="tipo_actividad">'.$row2['tipo_actividad'].'</p>
              <p id="coste_reserva">Coste: '.$row['coste_reserva'].'€</p>';
                if ($row['num_plazas_reserva'] > 1) {
                    echo '<p id="plazas_reservadas">Plazas: '.$row['num_plazas_reserva'].' plazas reservadas</p>';
                } else {
                    echo '<p id="plazas_reservadas">Plazas: '.$row['num_plazas_reserva'].' plaza reservada</p>';
                }

               echo ' 
               <p id="fecha_reserva">Fecha de reserva: '.$row['fecha_reserva'].'</p>';
               $fecha_reserva = $row['fecha_reserva'];
               /* EN CASO DE QUE LA RESERVA HAYA CONCLUIDO ... */


               $fecha_expiracion_actividad = date("Y-m-d", strtotime('2018-5-30' . '+1 day'));
               $array_fecha = getdate();
               $year = $array_fecha['year'];
               $month = $array_fecha['mon'];
               $day = $array_fecha['mday'];
               $fecha_de_hoy = $year."-".$month."-".$day;
               $fecha_de_hoy = date("Y-m-d", strtotime($fecha_de_hoy)); // Convertimos al formato deseado.
               //echo "Hoy: " . $fecha_de_hoy . " ----- " . "Expira: " . $fecha_expiracion_actividad;

               // Si la fecha de hoy es mayor o igual a la fecha de expiración de la actividad, el usuario podrá valorar e incluir reseña. Tengo pensado hacerlo con AJAX
               // Para debugear, pon en fecha_de_hoy una fecha menor a la de expiración de la actividad :))
               if ($fecha_de_hoy >= $fecha_expiracion_actividad) {?>
                    <div id="puntuacion">
                        <form id="form-reseña" method="post">
                            <label>Califica la actividad</label>
                            <fieldset class="rating">
                                <input name="rating"
                                       type="radio"
                                       id="rating5"
                                       value="5"
                                       on="change:rating.submit" />
                                <label for="rating5"
                                       title="5 stars">☆</label>

                                <input name="rating"
                                       type="radio"
                                       id="rating4"
                                       value="4"
                                       on="change:rating.submit" />
                                <label for="rating4"
                                       title="4 stars">☆</label>

                                <input name="rating"
                                       type="radio"
                                       id="rating3"
                                       value="3"
                                       on="change:rating.submit" />
                                <label for="rating3"
                                       title="3 stars">☆</label>

                                <input name="rating"
                                       type="radio"
                                       id="rating2"
                                       value="2"
                                       on="change:rating.submit"
                                       checked="checked" />
                                <label for="rating2"
                                       title="2 stars">☆</label>

                                <input name="rating"
                                       type="radio"
                                       id="rating1"
                                       value="1"
                                       on="change:rating.submit" />
                                <label for="rating1"
                                       title="1 stars">☆</label>
                            </fieldset>
                            <label>¿Qué te ha parecido la actividad?</label>
                            <textarea name="resena" maxlength="200"></textarea><br>
                            <button id="enviar_resena">¡Calificar!</button>
                        </form>
                    </div>
               <?php
               }
               echo '
              <a href="oferta.php?id='.$row['id'].'">Ver actividad</a>';
                echo '
            </div>
          </div>
        </div>';
            }
          }
        ?>
			</table>
			</div>
		</div>

</article>

	
</section>

<footer>

</footer>

</body>
</html>