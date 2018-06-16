<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="navbar navbar-inverse">
	<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand nombre-web" href="#">WildSports</a>
    </div>
    <div id="logo"><img src="img/LogoAplicacion.png"/></div>
    <ul class="nav navbar-nav navbar-right">
    	<?php
        /**
         *
         *      Submenú lateral de usuario/empresa conectado
         *
         */
        // Si el usuario NO está logueado.
        if (!isset($_SESSION['nombre'])) {
            echo '<li><a href="content/selec_reg.php"><span class="glyphicon glyphicon-download-alt"></span> Registrarse</a></li>';
            echo '<li><a href="content/login.html"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>';
            // Si el usuario está logueado, y visualizará distintos menús dependiendo de si es EMPRESA o USUARIO.
        } else {
            echo '
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> ' . $_SESSION['nombre']  . '
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">';
            if ($_SESSION['tipo'] === "usuario") {
                echo '<li><a href="content/perfil.php"><span class="glyphicon glyphicon-cog"></span> Mi perfil</a></li>
                          <li><a href="content/reservas.php"><span class="glyphicon glyphicon-th-list"></span> Mis reservas</a></li>';
            } else if ($_SESSION['tipo'] === "empresa") {
                echo '<li><a href="content/perfil.php"><span class="glyphicon glyphicon-briefcase"></span> Perfil de empresa</a></li>';
            }
            echo '<li><a href="php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></a></li>
                    </ul>
                </li>';
        }
        ?>
    </ul>
  </div>

</div>
</body>
</html>