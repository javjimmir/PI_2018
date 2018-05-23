<?php

session_start();
include '../php/connection.php';


?>
<div class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../index.php">Nombre Web</a>
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
            echo '<li><a href="content/login.html"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>';

        }else{
            echo '
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> ' . $_SESSION['nombre']  . '
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="perfil.php"><span class="glyphicon glyphicon-cog"></span> Mi perfil</a></li>
                      <li><a href="reservas.php"><span class="glyphicon glyphicon-th-list"></span> Mis reservas</a></li>
                      <li><a href="../php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></a></li>
                    </ul>
                </li>';
        }
        ?>
    </ul>
  </div>
</div>