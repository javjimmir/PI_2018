<?php

session_start();
include '../php/connection.php';

/* Sacando datos del user... */
$username = $_SESSION['nombre'];
$sql = "select * from usuario where alias = " . "'$username'";
$resultado = $conexion->query($sql);
$res = [];

while($row = $resultado->fetch_object()){
    $fila=array(
        "nif"=>$row->nif,
        "nombre"=>$row->nombre,
        "apellidos"=>$row->apellidos,
        "telefono"=>$row->telefono,
        "pais"=>$row->pais,
        "alias"=>$row->alias,
        "email"=>$row->email,
        "cp"=>$row->cp,
        "imagen_perfil"=>$row->imagen_perfil,
        "provincia"=>$row->provincia,
        "direccion"=>$row->direccion,
        "actividad_fav"=>$row->actividad_fav,
        "password"=>$row->password
    );
    array_push($res, $fila);
}

?>
<!DOCTYPE html>
<html><head>
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/conectores_content.js"></script>
    <script type="text/javascript" src="../js/validacion_reg_empre.js"></script>
    <title>Mi Perfil</title>
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
</article>
<article>
    <h2 class="text-center titulo">Perfil</h2>

      <div class="imgperfil">
      <img src="https://pbs.twimg.com/profile_images/2212581035/image_400x400.jpg" alt="Mountain View">
      <button type="button" class="btn btn-info">Subir</button> 
    </div>
      <div class="alias">
          <h2><?php echo $res[0]['alias'];?></h2>
          <h4> Información personal </h4>
          <div id="lista">
            <ul>
              <li>Nombre y apellidos: <?php echo $res[0]['nombre'] . " " . $res[0]['apellidos'];?></li>
              <li>Teléfono: <?php echo $res[0]['telefono'];?></li>
              <li>Dirección: <?php echo $res[0]['direccion'] . ", " . $res[0]['provincia'] . ", " . $res[0]['cp'] . ", " . $res[0]['pais'];?></li>
              <li>Correo eletrónico: <?php echo $res[0]['email'];?></li>
              <li>al ataquerl quietooor a wan me cago en tus muelas tiene musho peligro mamaar. </li>        
</ul>
          </div>
</br>
          <button type="button" class="btn btn-info">Editar</button>
        </div>
          <div class="actividadesRecientes">
              <h4>Mis actividades Recientes</h4> </br>
              <p>Ese hombree no puedor torpedo papaar papaar me cago en tus muelas qué dise usteer la caidita a gramenawer. Diodeno ese pedazo de hasta luego Lucas amatomaa torpedo te va a hasé pupitaa de la pradera. Se calle ustée llevame al sircoo diodeno tiene musho peligro. Me cago en tus muelas por la gloria de mi madre</p>
              </div>
            <div class="actividadesFavoritas">
            <h4>Mis actividades Favoritas</h4> </br>
                <img src="http://s.newsweek.com/sites/www.newsweek.com/files/styles/embed-lg/public/2018/03/21/vladimir-putin-satan-2.jpg" alt="Mountain View">
                <img src="http://s.newsweek.com/sites/www.newsweek.com/files/styles/embed-lg/public/2018/03/21/vladimir-putin-satan-2.jpg" alt="Mountain View">
                <img src="http://s.newsweek.com/sites/www.newsweek.com/files/styles/embed-lg/public/2018/03/21/vladimir-putin-satan-2.jpg" alt="Mountain View">
           </div>
       
</article>

	
</section>

<footer>

</footer>

</body>
</html>