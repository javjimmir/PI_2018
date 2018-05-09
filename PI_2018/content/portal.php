<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  	<script type="text/javascript" src="./js/conectores.js"></script>
	<title>Index</title>
</head>
<body>
<div class="navbar navbar-inverse"> 
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Nombre Web</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <?php
			echo '<li><a href="../php/logout.php"><span class="glyphicon glyphicon-user"></span> Cerrar Sesión</a></li>';
			echo '<li><a href="#"><span class="glyphicon glyphicon-log-in">'.' '.$_SESSION['nombre'].'</a><li>';
      ?>
    </ul>
  </div>
</div>-->
<nav class="menuPrincipalUser">
	
</nav>
<aside class="filtroBusqueda">
	
</aside>
<section>
	<article>
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

	<article>
		<div class="row">
    		<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
			<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
    		<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
  		</div>

	</article>

	<article>
		<div class="row">
    		<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
			<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
    		<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
  		</div>

	</article>

	<article>
		<div class="row">
    		<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
			<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
    		<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
  		</div>

	</article>

	<article>
		<div class="row">
    		<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
			<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
    		<div class="col-lg-4 actividad">
    			<div class="row">
	    			<div class="col-lg-4">
	    				<img src="./img/submarinismo.jpg" alt="submarinismo" class="listImg">
	    			</div>
	    			<div class="col-lg-8">
	    				<p>Adentrate en las profundidades del mar y mira los arrecifes de corales, los peces que viven en ellos y conoce un mundo nuevo.</p>
	    			</div>
    			</div>
    		</div>
  		</div>

	</article>
</section>

<footer>
	
</footer>

</body>
</html>