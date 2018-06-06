<?php
session_start(); 
include '../../../php/connection.php';
?>
<header class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../index.php">Nombre Web</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <?php
            /**
             *
             *      Submenú lateral de usuario/empresa conectado
             *
             */
            // Si el usuario NO está logueado.
            if (!isset($_SESSION['nombre'])) {
                echo '<li><a href="./selec_reg.php"><span class="glyphicon glyphicon-download-alt"></span> Registrarse</a></li>';
            echo '<li><a href="./login.html"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>';
            // Si el usuario está logueado, y visualizará distintos menús dependiendo de si es EMPRESA o USUARIO.
            } else {
            echo '
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> ' . $_SESSION['nombre']  . '
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">';
                    if ($_SESSION['tipo'] === "usuario") {
                    echo '<li><a href="./perfil.php"><span class="glyphicon glyphicon-cog"></span> Mi perfil</a></li>
                    <li><a href="./reservas.php"><span class="glyphicon glyphicon-th-list"></span> Mis reservas</a></li>';
                    } else if ($_SESSION['tipo'] === "empresa") {
                    echo '<li><a href="./perfil.php"><span class="glyphicon glyphicon-briefcase"></span> Perfil de empresa</a></li>';
                    }
                        echo '<li><a href="../php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></a></li>
                </ul>
            </li>';
            }
            ?>
        </ul>
    </div>
</header>