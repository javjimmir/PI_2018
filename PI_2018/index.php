<?php
session_start();
include 'php/connection.php';

$global_sql = "SELECT * FROM oferta ORDER BY fecha_inicio DESC"; // Sql global que carga las ofertas; por defecto seleccionará todas las ofertas más recientes
$global_cont_sql = "SELECT COUNT(*) AS `count` FROM `oferta`";   // Contador de ofertas; por defecto contará todas las ofertas de la bd

/**
 *
 *      Comprobación de categoría
 *
 */
if (isset($_GET['category'])) {
    $categoria = $_GET['category'];
    $global_cont_sql = "SELECT COUNT(*) AS `count` FROM `oferta` WHERE categoria = "."'$categoria'";
    $global_sql = "select * from oferta where categoria = "."'$categoria'";
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="./img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="./js/conectores.js"></script>
    <script type="text/javascript" src="./js/main.js"></script>
	<title>Portada | WildSports</title>
</head>
<body>
<button id="btnFiltros" class="btnIndex btn-contact">Filtros</button>
<header class="menuLogin">
  
</header>
<nav class="menuPrincipalUser">

</nav>
<aside class="filtroBusqueda">

</aside>
<section>
	<article class="index">
		<div id="myCarousel" class="carousel slide carousel-generico" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		    <li data-target="#myCarousel" data-slide-to="3"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="./img/ciclismo-slider.jpg" alt="ciclismo">
		      <div class="carousel-caption">
		        <h3>Ciclismo</h3>
			        <p>Todo sobre ruedas</p>
		      </div>
		    </div>

		    <div class="item">
		      <img src="./img/surf-slider.jpg" alt="Surf">
		      <div class="carousel-caption">
		        <h3>Surf</h3>
		        <p>¿Te apetece coger algunas olas?</p>
		      </div>
		    </div>

		    <div class="item">
		      <img src="./img/alpinismo-slider.jpg" alt="alpinismo">
		      <div class="carousel-caption">
		        <h3>Alpinismo</h3>
		        <p>Aire fresco</p>
		      </div>
		    </div>

		    <div class="item">
		      <img src="./img/submarinismo-slider.jpg" alt="submarinismo">
		      <div class="carousel-caption">
		        <h3>Submarinismo</h3>
		        <p>Conoce el fondo del mar</p>
		      </div>
		    </div>
		  </div>

		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
	</article>

	<article class="index offers">
        <div class="status"></div>
        <div class="row tabla">
        <?php
        	/* Cuenta las reservas que existen y dependiendo de las que salgan irá poniendo los elementos.
			   En el caso de que haya más reservas de 12, pues solo se mostrarán las 12 más recientes.
        	*/
        	$result = $conexion->query($global_cont_sql); // Select que se ejecutará. Si se usan filtros cambiará.
			$fila = $row = $result->fetch_assoc();
			$ofertas_encontradas = $fila['count'];
			$count = 12;

			if ($ofertas_encontradas == 0) {
                echo '<div id=\'no_offers\'><span class=\'alert alert-info\'><span class=\'glyphicon glyphicon-info-sign\'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>';
            }


			if ($ofertas_encontradas<12) {
				$count = $fila['count'];
			}
            $sql = $global_sql;
            $result = $conexion->query($sql);
			/* Realiza la consulta para extraer las ofertas de la base de datos ordenadas por su fecha de inicio de forma descendente. Tras esto, se realiza un corte de la descripción por si esta es demasiado extensa que solo salga una parte, y al lado un botón o enlace de leer más que llevara a la página de esa oferta concreta.

			*/
            /**
             *
             *      Comprobación de load more
             *
             */

            if (isset($_GET['load'])) {
                echo "<div id='load_more'><h3>Todas las actividades</h3><hr style='width: 90%'/>";
                for ($i = 1; $i <= $ofertas_encontradas; $i++) {
                    $row = $result->fetch_assoc();
                    $img = $row['imagen_oferta'];
                    $nombre = $row['nombre'];
                    $provincia = $row['provincia'];
                    $actividad = $row['tipo_actividad'];
                    $precio = $row['precio'];
                    $dificultad = $row['dificultad'];
                    echo '  
                                       <div class="snip1208 col-md-4 col-xs-12 col-lg-3 col-sm-6">
                                       <div class="aaa">
                                          <img src="img/oferta/'.$img.'" alt="Oferta de actividad"/>
                                          <figcaption>
                                          <h3 id="nombre">'.$nombre.'</h3>
                                          <p id="actividad">Actividad: '.$actividad.'</p>
                                          <p id="provincia">Provincia: '.$provincia.'</p>
                                          <p id="dificultad">Dificultad: '.$dificultad.'</p>
                                          <p id="precio">Precio: '.$precio.'€</p>
                                          <button>Ver actividad</button>
                                          </figcaption><a href="content/oferta.php?id='.$row['id'].'"></a>
                                      </div></div>
                ';
                }
            } else if (isset($_GET['category'])) {
                echo "<div id='bloque_destacados'><h3>Actividades de {$_GET['category']}</h3><hr style='width: 90%'/>";
                for ($i = 1; $i <= $ofertas_encontradas; $i++) {
                    $row = $result->fetch_assoc();
                    $img = $row['imagen_oferta'];
                    $nombre = $row['nombre'];
                    $provincia = $row['provincia'];
                    $actividad = $row['tipo_actividad'];
                    $precio = $row['precio'];
                    $dificultad = $row['dificultad'];
                    echo '   <div class="snip1208 col-md-4 col-xs-12 col-lg-3 col-sm-6">
                    <div class="aaa">
                                          <img src="img/oferta/'.$img.'" alt="Oferta de actividad"/>
                                          <figcaption>
                                          <h3 id="nombre">'.$nombre.'</h3>
                                          <p id="actividad">Actividad: '.$actividad.'</p>
                                          <p id="provincia">Provincia: '.$provincia.'</p>
                                          <p id="dificultad">Dificultad: '.$dificultad.'</p>
                                          <p id="precio">Precio: '.$precio.'€</p>
                                          <button>Ver actividad</button>
                                          </figcaption><a href="content/oferta.php?id='.$row['id'].'"></a>
                                      </div></div>';
                }
            } else {


                /**
                 *
                 * Bloque de actividades recomendadas para el usuario.
                 * En este bloque aparecerán 4 ofertas recomendadas para el usuario, según su categoría marcada como favorita al registrarse.
                 *
                 */
                if (isset($_SESSION['nombre']) && $_SESSION['tipo'] === 'usuario') { // Si hay un usuario conectado y es de tipo usuario...
                    $sql_destacados = "SELECT * FROM oferta WHERE categoria = (SELECT actividad_fav FROM usuario WHERE alias = '" . $_SESSION['nombre'] . "') ORDER BY RAND() LIMIT 4";
                    $result_destacados = $conexion->query($sql_destacados); // Select que buscará la actividad_fav del usuario con la sesión iniciada.
                    $fila_destacados = $row_destacados = $result->fetch_assoc();
                    $ofertas_destacadas_encontradas = $result_destacados->num_rows;
                    $count = 9;
                    if ($ofertas_destacadas_encontradas > 0) { // Si no existen actividades con la categoría favorita del user (mínimo 1), no saldrá el cuadro de DESTACADOS!!
                        if (isset($_SESSION['nombre'])) {
                            echo "<div id='bloque_destacados'><h3>Destacadas</h3><hr style='width: 90%'/>";
                            for ($i = 1; $i <= $ofertas_destacadas_encontradas; $i++) {
                                $row_destacados = $result_destacados->fetch_assoc();
                                $id = $row_destacados['id'];
                                $nombre = $row_destacados['nombre'];
                                $img = $row_destacados['imagen_oferta'];
                                $provincia = $row_destacados['provincia'];
                                $actividad = $row_destacados['tipo_actividad'];
                                $precio = $row_destacados['precio'];
                                $dificultad = $row_destacados['dificultad'];
                                echo '   <div class="snip1208 col-md-4 col-xs-12 col-lg-3 col-sm-6">
                                <div class="aaa destacada">
                                          <img src="img/oferta/'.$img.'" alt="Oferta de actividad"/>
                                          <figcaption>
                                          <h3 id="nombre">'.$nombre.'</h3>
                                          <p id="actividad">Actividad: '.$actividad.'</p>
                                          <p id="provincia">Provincia: '.$provincia.'</p>
                                          <p id="dificultad">Dificultad: '.$dificultad.'</p>
                                          <p id="precio">Precio: '.$precio.'€</p>
                                          <p id="id" hidden>'.$id.'</p>
                                          <button>Ver actividad</button>
                                          </figcaption><a href="content/oferta.php?id='.$row_destacados['id'].'"></a>
                                      </div></div>';
                            }
                        }
                    }
                }

                /* Carga de las demás ofertas, máximo 9 hasta pulsar "Cargar más" Este if-else hace que en caso de que haya menos de 9 actividades en TOTAL, semuestren normalmente
                las que haya en pantalla, y si supera el máximo por pantalla (9), se mostrará el máximo. */
                if ($ofertas_encontradas >= 9) {
                    $ofertas_mostradas = 9;
                } else {
                    $ofertas_mostradas = $ofertas_encontradas-1;
                }
                echo "<div id='ofertas'><h3>Últimas actividades</h3><hr style='width: 90%'/>";
                for ($i = 1; $i <= $ofertas_mostradas; $i++) {
                    $row = $result->fetch_assoc();
                    $img = $row['imagen_oferta'];
                    $nombre = $row['nombre'];
                    $provincia = $row['provincia'];
                    $actividad = $row['tipo_actividad'];
                    $precio = $row['precio'];
                    $dificultad = $row['dificultad'];
                    echo '
               <div class="snip1208 col-md-4 col-xs-12 col-lg-3 col-sm-6">
               <div class="aaa">
                                          <img src="img/oferta/'.$img.'" alt="Oferta de actividad"/>
                                          <figcaption>
                                          <h3 id="nombre">'.$nombre.'</h3>
                                          <p id="actividad">Actividad: '.$actividad.'</p>
                                          <p id="provincia">Provincia: '.$provincia.'</p>
                                          <p id="dificultad">Dificultad: '.$dificultad.'</p>
                                          <p id="precio">Precio: '.$precio.'€</p>
                                          <button>Ver actividad</button>
                                          </figcaption><a href="content/oferta.php?id='.$row['id'].'"></a>
                                      </div></div>';
                }
                echo '</div>';
            }
        ?>
  		</div>
       
  </article>
  <form action="?load=all" method="get">
      <input type="hidden" name="load" value="all">
      <button id="cargar">Cargar más</button>
  </form>
</section>
<footer class="pie">
</footer>
</body>
</html>