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
  <title>Administrar ofertas</title>
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
                      <li><a href="ofertas.php"><span class="glyphicon glyphicon-th-list"></span> Mis reservas</a></li>
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
      /* Se encarga de borrar el registro seleccionado pulsando el botón que tenemos en la tabla. Solo se puede borrar una oferta si esta no tiene reservas pendientes. */
    if(isset($_GET['aski']) == 'delete'){
        
        $id = mysqli_real_escape_string($conexion,(strip_tags($_GET["id"],ENT_QUOTES)));
        $sql_reservas = "SELECT * FROM reserva WHERE id='$id'"; //comprobamos que no haya reservas.
        $comprobar = $conexion->query($sql_reservas);
        
        if ($comprobar->num_rows > 0) {
            echo '<div class="alert alert-danger alert-dismissable"><a href="ofertas.php"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></a> No se puede borrar el registro porque tiene una reserva asociada.</div>';
        }else{
          
          $sql_del = "DELETE FROM oferta WHERE id='$id'";
          $delete = $conexion->query($sql_del);
          
          if($delete){
              echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
          }else{
              echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos --> ';
            }
        }
    }
      
?>
</article>
<article>
    <h2 class="text-center">Mis actividades</h2><br/>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
        <tr>
          <th>Nº</th>
          <th>Actividad</th>
          <th>Tipo de actividad</th>
          <th>Localización</th>
          <th>Precio</th>
          <th>Inicio de la actividad</th>
          <th>Fin de la actividad</th>
          <th>Dificultad</th>
          <th>Acciones</th>
        </tr>
        </thead>

        <?php
        /* Este es el data-table que mostrará los datos de las actividades publicadas por la empresa.*/
        $sql_oferta = "SELECT * FROM oferta WHERE cif_empresa = (SELECT cif FROM empresa WHERE alias = '". $_SESSION['nombre']  ."') "; 
          $result = $conexion->query($sql_oferta); 
          $no = 1;
          if ($result->num_rows === 0) {
            echo '<tr><td colspan="8">No hay actividades.</td></tr>';
          }else{
          while($row = $result->fetch_assoc()){
            echo '
            <tr>
              <td>'.$no.'</td>
              <td>'.$row['nombre'].'</td>
              <td>'.$row['tipo_actividad'].'</td>
              <td>'.$row['localizacion'].'</td>
              <td>'.$row['precio'].' €</td>
              <td>'.$row['fecha_inicio'].'</td>
              <td>'.$row['fecha_fin'].'</td>
              <td>';
              if($row['dificultad'] == 'facil'){
                echo '<span class="label label-success">Fácil</span>';
              }
                            else if ($row['dificultad'] == 'medio' ){
                echo '<span class="label label-primary">Medio</span>';
              }
                            else if ($row['dificultad'] == 'dificil' ){
                echo '<span class="label label-warning">Difícil</span>';
              }
                            else{
                echo '<span class="label label-danger">Experto</span>';
              }
            echo '
              </td>              
              <td>
 
                <a href="actividad.php?id='.$row['id'].'" title="Ver" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span></a>
                <a href="edit.php?id='.$row['id'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a>                
                <a href="activity_manager.php?aski=delete&id='.$row['id'].'" title="Eliminar" onclick="return confirm(\'¿Está seguro de que quiere anular la reserva?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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