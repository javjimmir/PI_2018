<?php

session_start();
include '../php/connection.php';


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
	<title>Mis reservas</title>
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
    <h2 class="text-center">Mis reservas</h2><br/>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
        <thead>
				<tr>
					<th>Nº</th> <!-- Esta es una variable que muestra el orden de los registros, pero que no pertenece a la bd. -->
          <th>Nombre de actividad</th>
          <th>Tipo de actividad</th>
          <th>Plazas reservadas</th>
					<th>Coste de la reserva</th>
          <th>Dificultad</th>
					<th>Acciones</th>
				</tr>
        </thead>

				<?php



        /* Este es el data-table que mostrará los datos de las reservas de los usuarios. Hay una primera consulta que se encarga de listar todas las ofertas del usuario, y una vez que están listadas dentro del bucle pondremos otra que se encargará de ir mostrando los datos de esa reserva procedentes de la taba oferta por su id.*/

				$sql_reserva = "SELECT * FROM reserva WHERE nif_usuario = (SELECT nif FROM usuario WHERE alias = '". $_SESSION['nombre']  ."') "; 

				  $result = $conexion->query($sql_reserva); 
          $no = 1;
          if ($result->num_rows === 0) {
            echo '<tr><td colspan="8">No hay reservas.</td></tr>';
          }else{
          while($row = $result->fetch_assoc()){
            $sql_oferta = "SELECT * from oferta where id = '".$row['id_oferta']."'";
            $result2 = $conexion->query($sql_oferta);
            $row2 = $result2->fetch_assoc(); 
            echo '
            <tr>
              <td>'.$no.'</td>
              <td>'.$row2['nombre'].'</td>
              <td>'.$row2['tipo_actividad'].'</td>
              <td class="text-center">'.$row['num_plazas_reserva'].'</td>
              <td class="text-center">'.$row['coste_reserva'].'</td>
              <td>';
              if($row2['dificultad'] == 'facil'){
                echo '<span class="label label-success">Fácil</span>';
              }
                            else if ($row2['dificultad'] == 'medio' ){
                echo '<span class="label label-primary">Medio</span>';
              }
                            else if ($row2['dificultad'] == 'dificil' ){
                echo '<span class="label label-warning">Difícil</span>';
              }
                            else{
                echo '<span class="label label-danger">Experto</span>';
              }
            echo '
              </td>
              <td>
 
                <a href="edit.php?nik='.$row['id'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                <a href="reservas.php?aski=delete&id='.$row['id'].'" title="Eliminar" onclick="return confirm(\'¿Está seguro de que quiere anular la reserva?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
              </td>
            </tr>
            ';
            $no++;
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