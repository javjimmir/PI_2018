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
    <h2 class="text-center">Mis reservas</h2>

    <h2 class="text-center">----------------------------------------</h2>
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
                <p id="nombre">'.$row2['nombre'].'</p>
                <p id="actividad">'.$row2['tipo_actividad'].'</p>
              <p id="provincia">'.$row['coste_reserva'].'</p>
              <p id="dificultad">'.$row['num_plazas_reserva'].'</p>
              <p id="precio">'.$row['fecha_reserva'].'</p>
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