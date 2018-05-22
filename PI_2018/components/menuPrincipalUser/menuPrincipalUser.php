<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel='stylesheet' id='BNS-Corner-Logo-Style-css'  href='./css/social_icons_from_Techandallcom.css' type='text/css' media='screen' />
  <link rel='stylesheet' id='BNS-Corner-Logo-Style-css'  href='../css/social_icons_from_Techandallcom.css' type='text/css' media='screen' />

</head>
<body>
  <div class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href=".">Inicio</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categorías
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="index.php?category=acuatica">Acuáticas</a></li>
          <li><a href="index.php?category=tierra">Tierra</a></li>
          <li><a href="index.php?category=aire">Aire</a></li>
          <li><a href="index.php?category=nieve">Nieve</a></li>
        </ul>
      </li>
        <?php
        if (!empty($_SESSION) && $_SESSION['tipo'] === "empresa") {
            echo "<li><a href='content/activity_manager.php'>Administrar actividades</a></li>";
        }
        ?>
      <li><a href="#">Como Funciona</a></li>
      <li><a href="#">Contacto</a></li>
      <li><a href="#">Acerca de</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      
        <div class="social-icons">
          <ul>
            <li class="twitter" style="background-color: #f0f0f0">
              <a href="http://www.twitter.com/techandallcom" target="_blank">Twitter</a>
            </li>
            <li class="facebook" style="background-color: #f0f0f0">
              <a href="http://www.twitter.com/techandallcom" target="_blank">Facebook</a>
            </li>

            <li class="youtube" style="background-color: #f0f0f0">
              <a href="http://www.twitter.com/techandallcom" target="_blank">YouTube</a>
            </li>

            <li class="googleplus" style="background-color: #f0f0f0">
              <a href="http://www.twitter.com/techandallcom" target="_blank">Google +r</a>
            </li>
          </ul>
        </div>
      
    </ul>
  </div>
</div> 
</body>
</html>
