<?php

/* ESTO ES TEMPORAL, ES PARA IR TRABAJANDO EN EL DATA-TABLE DE LAS RESERVAS, LA IDEA ES QUE ESTE VAYA PAGINADO CADA X RESERVAS */ 

session_start();
include '../php/connection.php';

/* Se obtiene el nif del usuario que ha iniciado sesión*/


//$sql_reserva = "SELECT * FROM reserva ORDER BY fecha_reserva DESC"; 

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="../js/conectores.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<title>Index</title>
</head>
<body>
<!-- ESTO ES LO MISMO QUE EL COMPONENTE, BASTA CON VOLVER A SUSTITUIRLO, CON LA DIFERENCIA DE QUE EL COMPONENTE NO ENLAZA BIEN CON EL LOGIN -->
<header class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Nombre Web</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
    	<?php
        /**
         *
         *      Sesión del usuario (no empresa)
         *
         */
            //$nombreuser = $_SESSION['nombre']; // 'Alias' del usuario que ha iniciado sesión, da error cuando no está iniciada la sesión porque dicha variable queda vacía.
    		if (!isset($_SESSION['nombre'])) {
    			echo '<li><a href="content/registrouser.html"><span class="glyphicon glyphicon-download-alt"></span> Registrarse</a></li>';
      			echo '<li><a href="content/form_login.html"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>';

    		}else{
      			echo '
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> ' . $_SESSION['nombre']  . '
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="perfil.php"><span class="glyphicon glyphicon-cog"></span> Mi perfil</a></li>
                      <li><a href="reservas.php"><span class="glyphicon glyphicon-th-list"></span> Mis reservas</a></li>
                      <li><a href="php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></a></li>
                    </ul>
                </li>';
    		}
    	?>
    </ul>
  </div>
</header>
<nav class="menuPrincipalUser">

</nav>
<aside class="filtroBusqueda">

</aside>
<section>

<article>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>ID de la oferta</th>
                    <th>Fecha de reserva</th>
                    <th>Número de plazas</th>
					<th>Coste de la reserva</th>
					<th>Acciones</th>
				</tr>
				<?php

				$sql_reserva = "SELECT * FROM reserva WHERE nif_usuario = (SELECT nif FROM usuario WHERE alias = '". $_SESSION['nombre']  ."')"; 

				$result = $conexion->query($sql_reserva); 
					while($row = $result->fetch_assoc()){
						echo '
						<tr>
							<td>'.$row['id_oferta'].'</td>
                            <td>'.$row['fecha_reserva'].'</td>
                            <td>'.$row['num_plazas_reserva'].'</td>
							<td>'.$row['coste_reserva'].'</td>
							<td>
							

								<a href="#" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="#" title="Eliminar" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
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