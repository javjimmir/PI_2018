<?php
session_start();
include '../php/connection.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Hacer reserva</title>
	<meta charset="utf-8"> 
</head>
<body>
<?php
if (empty($_SESSION['nombre'])) {
	/*REDIRECCIONAR A UNA PÁGINA DE ERROR DE INICIAR SESIÓN ??? */
		echo "Inicia sesión para reservar la actividad.";
		echo '<a href="content/login.html">Inicia sesión</a>';
	}else{
		$id = $_GET['id'];
		$sql_oferta = "SELECT * FROM oferta WHERE id=".$id;
		$result = $conexion->query($sql_oferta);
		$row = $result->fetch_assoc();
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
	}

?>

<h2>HACER LA RESERVA</h2>
<h3>¿ Cuantas plazas desea reservar ?</h3>

<form action="" method="POST">
	
	<label>Número de plazas que desea reservar:</label><br><br>
	<input type="text" name="plazas_reserva"><br><br>
	<input type="submit" name="enviar">

</form>

<?php 
	if (!empty($_POST['plazas_reserva']) && !empty($_SESSION['nombre'])) {
		//sacamos el nif del usuario que hace la reserva mediante la variable de sesión y también debemos multiplicar el precio de la oferta por el número de plazas que se vaya a reservar. En el caso de que l oferta no disponga del número de plazas que se va a solicitar peta y no te deja continuar. EL FORMULARIO HA DE SER VALIDADO PARA QUE SOLO ENTREN NÚMEROS.

		$num_plazas = $row['num_plazas'];

		if ($num_plazas < $_POST['plazas_reserva']) {
			echo "ERROR: no se puede reservar porque no hay plazas suficientes";
		}else{
			/* obetenemos el dni del usuario conectado */
			$sql_nif = "SELECT nif FROM usuario WHERE alias = '".$_SESSION['nombre']."'";
			$result_nif = $conexion->query($sql_nif);
			$row2 = $result_nif->fetch_assoc();
			$nif=$row2['nif'];

			/* obtenemos la fecha de hoy en el formato YY/MM/DD */

			$array_fecha = getdate();
			$year = $array_fecha['year'];
			$month = $array_fecha['mon'];
			$day = $array_fecha['mday'];
			$fecha = $year."-".$month."-".$day;

			$insert_reserva = "INSERT INTO reserva (nif_usuario,id_oferta,fecha_reserva,num_plazas_reserva,coste_reserva)
			VALUES('".$nif."',".$id.",'".$fecha."',".$_POST['plazas_reserva'].",".$_POST['plazas_reserva']."*".$row['precio'].")";

			if ($conexion->query($insert_reserva) === TRUE) {
				echo 'Registro insertado correctamente';
			} else {
				echo "Error: " . $sql . "<br>" . $conexion->error;
			}
		}
	}
?>

</body>
</html>