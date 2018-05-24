<?php

session_start();
include '../php/connection.php';


/* Sacando datos del user... */
$username = $_SESSION['nombre'];
$sesion = $_SESSION['tipo'];

/* Comprobamos si es usuario o empresa */
if ($sesion == "usuario") {
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
} else if ($sesion == "empresa") {
    $sql = "select * from empresa where alias = " . "'$username'";
    $resultado = $conexion->query($sql);
    $res = [];
    while($row = $resultado->fetch_object()){
        $fila=array(
            "cif"=>$row->cif,
            "nombre"=>$row->nombre,
            "telefono"=>$row->telefono,
            "pais"=>$row->pais,
            "provincia"=>$row->provincia,
            "alias"=>$row->alias,
            "imagen_perfil"=>$row->imagen_perfil,
            "tipo_actividad"=>$row->tipo_actividad,
            "web"=>$row->web,
            "email"=>$row->email,
            "descripcion"=>$row->descripcion,
            "cp"=>$row->cp,
            "password"=>$row->password
        );
        array_push($res, $fila);
    }
} else {
    // Si es usuario anónimo (no logeado) no podrá acceder a esta página, así que será redirigido a un 404.
    header('Location: ./404.html');
    exit;
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
    <script type="text/javascript" src="../js/main.js"></script>
    <title>Mi Perfil</title>
    </head>
<body>

<header class="menuLogin"></header>
<nav class="menuPrincipalUser"></nav>
<aside class="publicidad"></aside>
<section>
<article>
</article>
<article>

    <?php
        /* Comprobamos si se ha actualizado el perfil, para mostrar un mensaje de confirmación o de éxito */
        if (!empty($_GET['confirmation'])) {
            echo "<p id='confirmed'>¡Perfil actualizado con éxito!</p>";
        }
    ?>

    <h2 class="text-center titulo">Perfil de <?php echo $sesion ?></h2>

      <div class="imgperfil">
          <?php $myfoto = $res[0]['imagen_perfil'];
          echo "<img src='../img/$myfoto' alt='Imagen de $username' />";?>
      <button type="button" class="btn btn-info">Subir</button> 
    </div>
      <div class="alias">
          <h2><?php echo $res[0]['alias'];?></h2>
          <h4> Información personal </h4>
          <div id="lista">
              <?php
              // Formulario dinámico que depende de si es usuario o empresa.
              if ($sesion == "usuario") {
                  echo "<form id=\"datos_usuario\" action=\"../php/update_profile.php\" method=\"post\">
                  <label>Nombre: </label>
                  <input type=\"text\" name=\"nombreusuario\" disabled class=\"perfil\" value={$res[0]['nombre']}>
                  <br><label>Apellidos: </label>
                  <input type=\"text\" name=\"apellidos\" disabled class=\"perfil\" value={$res[0]['apellidos']}>
                  <br><label>Teléfono: </label>
                  <input type=\"text\" name=\"telefono\" disabled class=\"perfil\" value={$res[0]['telefono']}>
                  <br><br><label>Dirección: </label><br>
                  <br><label>Calle: </label>
                  <input type=\"text\" name=\"direccion\" disabled class=\"perfil\" value={$res[0]['direccion']}>
                  <br><label>Provincia: </label>
                  <input type=\"text\" name=\"provincia\" disabled class=\"perfil\" value={$res[0]['provincia']}>
                  <br><label>CP: </label>
                  <input type=\"text\" name=\"cp\" disabled class=\"perfil\" value={$res[0]['cp']}>
                  <br><label>Pais: </label>
                  <input type=\"text\" name=\"pais\" disabled class=\"perfil\" value={$res[0]['pais']}><br>

                  <br><label>Correo: </label>
                  <input type=\"text\" name=\"email\" disabled class=\"perfil\" value={$res[0]['email']}>
                  <br><label>Contraseña: </label>
                  <input type=\"password\" name=\"password\" disabled class=\"perfil\" value={$res[0]['password']}><br>
                  <input type=\"hidden\" name=\"sesion\" disabled class=\"perfil\" value={$sesion}><br>
                  <input type=\"hidden\" name=\"dni\" disabled class=\"perfil\" value={$res[0]['nif']}>
                  <button id=\"edit\" type=\"button\" class=\"btn btn-info\">Editar</button>
                  <button type=\"submit\" id='save' disabled class=\"btn btn-info\">Guardar</button>
              </form>";
              } else {
                  echo "<form id=\"datos_empresa\" action=\"../php/update_profile.php\" method=\"post\">
                  <label>Nombre: </label>
                  <input type=\"text\" name=\"nombreempresa\" disabled class=\"perfil\" value={$res[0]['nombre']}>
                  <br><label>Teléfono: </label>
                  <input type=\"text\" name=\"telefono\" disabled class=\"perfil\" value={$res[0]['telefono']}>
                  <br><label>Tipo de actividad: </label>
                  <input type=\"text\" name=\"tipoactividad\" disabled class=\"perfil\" value={$res[0]['tipo_actividad']}>
                  <br><label>Descripción: </label>
                  <input type=\"text\" name=\"descripcion\" disabled class=\"perfil\" value={$res[0]['descripcion']}>
                  <br><label>Web: </label>
                  <input type=\"text\" name=\"web\" disabled class=\"perfil\" value={$res[0]['web']}>
                  <br><label>Provincia: </label>
                  <input type=\"text\" name=\"provincia\" disabled class=\"perfil\" value={$res[0]['provincia']}>
                  <br><label>Código postal: </label>
                  <input type=\"text\" name=\"cp\" disabled class=\"perfil\" value={$res[0]['cp']}>
                  <br><label>Pais: </label>
                  <input type=\"text\" name=\"pais\" disabled class=\"perfil\" value={$res[0]['pais']}><br>

                  <br><label>Correo eletrónico: </label>
                  <input type=\"text\" name=\"email\" disabled class=\"perfil\" value={$res[0]['email']}>
                  <br><label>Contraseña: </label>
                  <input type=\"password\" name=\"password\" disabled class=\"perfil\" value={$res[0]['password']}>
                  <input type=\"hidden\" name=\"sesion\" disabled class=\"perfil\" value={$sesion}><br>
                  <input type=\"hidden\" name=\"cif\" disabled class=\"perfil\" value={$res[0]['cif']}>
                  <button id=\"edit\" type=\"button\" class=\"btn btn-info\">Editar</button>
                  <button type=\"submit\" disabled id='save' class=\"btn btn-info\">Guardar</button>
              </form>";
              }
              ?>
          </div>
</br>
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