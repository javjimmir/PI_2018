<?php
session_start();
include '../php/connection.php';

//Cantidad de resultados por página 
$resultados_por_pagina = 10;

if (isset($_GET["pagina"])) {

     if (is_numeric($_GET["pagina"])) {

       if ($_GET["pagina"] == 1) {
         header("Location: ./activity_manager.php");
         die();
       } else { 
         $pagina = $_GET["pagina"];
      };

     } else { //si el parámetro get no es un número redirige al index.php
       header("Location: ./activity_manager.php");
      die();
     };
} else { //si el get no se ha seteado pues la página será la número 1.
  $pagina = 1;
};

//Define el número 0 para empezar a paginar multiplicado por la cantidad de resultados por página
$empezar_desde = ($pagina-1) * $resultados_por_pagina;
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
  <title>Administrar ofertas</title>
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
    /* Parte del código que se encarga de borrar una oferta siempre y cuando no tenga reservas asociadas */
    if(isset($_GET['aski']) == 'delete'){
        
        $id = mysqli_real_escape_string($conexion,(strip_tags($_GET["id"],ENT_QUOTES)));
        $sql_reservas = "SELECT * FROM reserva WHERE id_oferta='$id'"; //comprobamos que no haya reservas.
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
    <h2 class="text-center">Administración de actividades</h2><br/>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
        <tr>
          <th>ID</th>
          <th>Actividad</th>
          <th>Tipo de actividad</th>
          <th>Localización</th>
          <th>Precio</th>
          <th>Inicio de la actividad</th>
          <th>Fin de la actividad</th>
          <th>Nº de Reservas</th>
          <th>Dificultad</th>
          <th>Acciones</th>
        </tr>
        </thead>

        <?php
        $sql_count = "SELECT * FROM oferta WHERE cif_empresa = (SELECT cif FROM empresa WHERE alias = '". $_SESSION['nombre']  ."')"; 
          $result = $conexion->query($sql_count);

          $total_registros = $result->num_rows;

          $total_paginas = ceil($total_registros / $resultados_por_pagina); 

          $sql_oferta = "SELECT * FROM oferta WHERE cif_empresa = (SELECT cif FROM empresa WHERE alias = '". $_SESSION['nombre']  ."') LIMIT $empezar_desde, $resultados_por_pagina";

          $result2 = $conexion->query($sql_oferta);
          $no = 1;
          if ($total_registros === 0) {
            echo '<tr><td colspan="8">No hay actividades.</td></tr>';
          }else{
          while($row = $result2->fetch_assoc()){
            $sql_num_reservas = "SELECT * from reserva WHERE id_oferta = ".$row['id'];
            $result3 = $conexion->query($sql_num_reservas);
            $reservas = $result3->num_rows;
            echo '
            <tr>
              <td>'.$row['id'].'</td>                          
              <td>'.$row['nombre'].'</td>
              <td>'.$row['tipo_actividad'].'</td>
              <td>'.$row['localizacion'].'</td>
              <td>'.$row['precio'].' €</td>
              <td>'.$row['fecha_inicio'].'</td>
              <td>'.$row['fecha_fin'].'</td>
              <td>'.$reservas.'</td>              
              <td>';
              if($row['dificultad'] == 'facil'){
                echo '<span class="label label-success">Fácil</span>';
              }
                            else if ($row['dificultad'] == 'media' ){
                echo '<span class="label label-primary">Media</span>';
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
 
                <a href="oferta.php?id='.$row['id'].'" title="Ver" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span></a>
                <a href="edit.php?id='.$row['id'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a>                
                <a href="activity_manager.php?aski=delete&id='.$row['id'].'" title="Eliminar" onclick="return confirm(\'¿Está seguro de que quiere anular la oferta?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
              </td>
            </tr>
            ';
          }
            $url = "activity_manager.php";
            echo '<p>';

          if ($total_paginas > 1) {
            if ($pagina != 1)
              echo '<a href="'.$url.'?pagina='.($pagina-1).'"><img src="../img/izq.gif" border="0"></a>';
            for ($i=1;$i<=$total_paginas;$i++) {
              if ($pagina == $i)
                //si muestro el �ndice de la p�gina actual, no coloco enlace
                echo $pagina;
              else
                //si el �ndice no corresponde con la p�gina mostrada actualmente,
                //coloco el enlace para ir a esa p�gina
                echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
            }
            if ($pagina != $total_paginas)
              echo '<a href="'.$url.'?pagina='.($pagina+1).'"><img src="../img/der.gif" border="0"></a>';
          }
          echo '</p>';
        }

        echo '<center><a href="registrofertas.html" title="Añadir" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Añadir actividad</a></center>';

        ?>
          
      </table>
      </div>
    </div>

</article>
<article>
</article>
  
</section>

<footer class="pie">

</footer>

</body>
</html>