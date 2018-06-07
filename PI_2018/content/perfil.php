<?php

session_start();
include '../php/connection.php';


/* Sacando datos del user... */
$username = $_SESSION['nombre'];
$sesion = $_SESSION['tipo'];

/* Comprobamos si es usuario o empresa */
if ($sesion == "usuario") {
    $sql = "select * from usuario where alias = " . "'$username'";
    $sql_actividades_recientes = "select * from reserva where nif_usuario = (select nif from usuario where alias = '$username') ORDER BY fecha_reserva DESC LIMIT 3;";
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

    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.1.24.min.js"></script>
    <!--<script src="../js/aws_config.js"></script> COMENTADO PORQUE NO HACE FALTA Y DA 404 EN EL NAVEGADOR-->
    <!--<script src="../js/s3_upload.js"></script>-->
    <script type="text/javascript" src="../js/conectores_content.js"></script>
    <script type="text/javascript" src="../js/validacion_reg_usu.js"></script>
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
<article style="background-color: #f5f5f0;">

    <?php
        /* Comprobamos si se ha actualizado el perfil, para mostrar un mensaje de confirmación o de éxito HAY QUE APLICAR ESTILO */
    if (isset($_GET['confirmation'])) {
        if ($_GET['confirmation'] == 'success') {
            echo "<p id='confirmed'>¡Perfil actualizado con éxito!</p>";
        } else if ($_GET['confirmation'] == 'password') {
            echo "<p id='passworderror'>¡La contraseña actual es incorrecta!</p>";
        }
    }
    ?>

    <h2 class="text-center titulo">Perfil de <?php echo $sesion ?></h2>
    <div class="infoperfil">
      <div class="imgperfil">
          <?php $myfoto = $res[0]['imagen_perfil'];
                    echo "<img src='../img/$sesion/$myfoto' alt='Imagen de $username' />";?>
          <form action="../php/upload.php" id="upfile" method='post' enctype="multipart/form-data">
    <h3>Imagen de perfil</h3><br/>
     <input type='file' name="upfile" id="upfile" required="" />
			<br>
			<input type='submit' value='Actualizar'/>
			</form>
    </div>
      <div class="alias">
          <h2><?php echo $res[0]['alias'];?></h2>
          <h4> Información personal </h4>
          <div id="lista">
             <?php
              // Formulario dinámico que depende de si es usuario o empresa.
                // Cada formulario se divide en dos secciones: perfil y configuración.
              if ($sesion == "usuario") {
                echo "<form id=\"datos_usuario\" action=\"../php/update_profile.php\" method=\"post\">
                <div class='filainfo'>
                <div class='infoperfiliz'><label>Nombre: </label></div>
                <div class='infoperfilde'><input type=\"text\" name=\"nombreusuario\" disabled class=\"perfil\" value={$res[0]['nombre']} id='nombre-usu' required></div>
                </div>
                  <div class='filainfo'>
                <div class='infoperfiliz'><label>Apellidos: </label></div>
                <div class='infoperfilde'><input type=\"text\" name=\"apellidos\" disabled class=\"perfil\" value={$res[0]['apellidos']} id=\"apellidos-usu\" required></div>
                  </div>
                  <div class='filainfo'>
                <div class='infoperfiliz'><label>Teléfono: </label></div>
                <div class='infoperfilde'><input type=\"text\" name=\"telefono\" disabled class=\"perfil\" value={$res[0]['telefono']} id=\"tel-usu\" required></div>
                </div>

<div class='filainfo'>
                <div class='infoperfiliz'><label>Calle: </label></div>
                <div class='infoperfilde'><input type=\"text\" name=\"direccion\" disabled class=\"perfil\" value={$res[0]['direccion']} id=\"direccion-usu\" required></div>
</div>
<div class='filainfo'>
                <div class='infoperfiliz'><label>Provincia: </label></div>
                <div class='infoperfilde'><input type=\"text\" name=\"provincia\" disabled class=\"perfil\" value={$res[0]['provincia']} id=\"provincia-usu\" required></div>
<div>
<div class='filainfo'>
                <div class='infoperfiliz'><label>CP: </label></div>
                <div class='infoperfilde'><input type=\"text\" name=\"cp\" disabled class=\"perfil\" value={$res[0]['cp']} id=\"cp-usuario\" required></div>
</div>
<div class='filainfo'>
                <div class='infoperfiliz'><label>Pais: </label></div>
                <div class='infoperfilde'><input type=\"text\" name=\"pais\" disabled class=\"perfil\" value={$res[0]['pais']} id=\"pais-usu\" required></div>
</div>
<div class='filainfo'>
                <div class='infoperfiliz'><label>Correo: </label></div>
                <div class='infoperfilde'><input type=\"text\" name=\"email\" disabled class=\"perfil\" value={$res[0]['email']} id=\"mail-usu\" required>
                  <input type=\"hidden\" name=\"sesion\" disabled class=\"perfil\" value={$sesion}><br>
                  <input type=\"hidden\" name=\"seccion\" disabled class=\"perfil\" value='perfil'><br>
                  <input type=\"hidden\" name=\"dni\" disabled class=\"perfil\" value={$res[0]['nif']}></div>
                  </div>
<div class='filainfo'>
                <div class='infoperfiliz'><button id=\"editperfil\" type=\"button\" class=\"btn btn-info\">Editar</button></div>
                <div class='infoperfilde'><button type=\"submit\" id='saveperfil' disabled class=\"btn btn-info\">Guardar</button></div>
                
                </div>
                    
                  <div class='filainfo'><h4>Datos de acceso</h4></div>
<div class='filainfo'>
                  <div class='infoperfiliz'><label>Contraseña: </label></div>
                  <div class='infoperfilde'><input type=\"password\" name=\"password\" disabled class=\"config\" value=><br></div>
                  </div>
<div class='filainfo'>
                  <div class='infoperfiliz'><label>Nueva contraseña: </label></div>
                  <div class='infoperfilde'><input type=\"password\" name=\"newpassword\" disabled class=\"config\" id=\"pass-usu\" required></div>
</div>
<div class='filainfo'>
                  <div class='infoperfiliz'><label>Confirmar contraseña: </label></div>
                  <div class='infoperfilde'><input type=\"password\" name=\"newpassword\" disabled class=\"config\" id=\"conf-pass-usu\" required>
                  <input type=\"hidden\" name=\"sesion\" disabled class=\"config\" value={$sesion}>
                  <input type=\"hidden\" name=\"seccion\" disabled class=\"config\" value='config'>
                  <input type=\"hidden\" name=\"dni\" disabled class=\"config\" value={$res[0]['nif']}></div>
                  </div>
<div class='filainfo'>
                  <div class='infoperfiliz'><button id=\"editconfig\" type=\"button\" class=\"btn btn-info\">Editar</button></div>
                  <div class='infoperfilde'><button type=\"submit\" id='saveconfig' disabled class=\"btn btn-info\">Guardar</button></div>
                  </div>
                  
              </form>";
              } else {
                  echo

                  "<form id=\"datos_empresa\" action=\"../php/update_profile.php\" method=\"post\">
<div class='filainfo'>
                      <div class='infoperfiliz'><label>Nombre: </label></div>
                      <div class='infoperfilde'><input type=\"text\" name=\"nombreempresa\" id='nombre-empresa' disabled class=\"perfil\" value={$res[0]['nombre']} required></div>
</div>
<div class='filainfo'>
                      <div class='infoperfiliz'><label>Teléfono: </label></div>
                      <div class='infoperfilde'><input type=\"tel\" name=\"telefono\" id='tel-empresa' disabled class=\"perfil\" value={$res[0]['telefono']} required></div>
                      </div>

                      <div class='filainfo'>

                      <div class='infoperfiliz'><label>Tipo de actividad: </label></div>
                      <div class='infoperfilde'><input type=\"text\" name=\"tipoactividad\" id=\"busqueda_provincia\" disabled class=\"perfil\" value={$res[0]['tipo_actividad']} required></div>
                      </div>

<div class='filainfo'>
                      <div class='infoperfiliz'><label>Descripción: </label></div>
                      <div class='infoperfilde'><input type=\"text\" name=\"descripcion\" id=\"desc-empresa\" disabled class=\"perfil\" value={$res[0]['descripcion']} required></div>
                      </div>

<div class='filainfo'>
                      <div class='infoperfiliz'><label>Web: </label></div>
                      <div class='infoperfilde'><input type=\"text\" name=\"web\"  id=\"web-empresa\" disabled class=\"perfil\" value={$res[0]['web']} required></div>
                      </div>
<div class='filainfo'>
                      <div class='infoperfiliz'><label>Provincia: </label></div>
                      <div class='infoperfilde'><input type=\"text\" name=\"provincia\" id=\"provincia-empresa\" disabled class=\"perfil\" value={$res[0]['provincia']} required></div>
</div>
<div class='filainfo'>
                      <div class='infoperfiliz'><label>Código postal: </label></div>
                      <div class='infoperfilde'><input type=\"text\" name=\"cp\" id=\"cp-empresa\" disabled class=\"perfil\" value={$res[0]['cp']} required></div>
                      </div>
<div class='filainfo'>
                      <div class='infoperfiliz'><label>Pais: </label></div>
                      <div class='infoperfilde'><input type=\"text\" name=\"pais\" id=\"pais-empresa\" disabled class=\"perfil\" value={$res[0]['pais']} required><br></div>
                      </div>
<div class='filainfo'>
                      <div class='infoperfiliz'><label>Correo electrónico: </label></div>
                      <div class='infoperfilde'> <input type=\"text\" name=\"email\" id=\"mail-empresa\" disabled class=\"perfil\" value={$res[0]['email']} required>
                      <input type=\"hidden\" name=\"sesion\" disabled class=\"perfil\" value={$sesion}><br>
                      <input type=\"hidden\" name=\"seccion\" disabled class=\"perfil\" value='perfil'><br>
                      <input type=\"hidden\" name=\"cif\" disabled class=\"perfil\" value={$res[0]['cif']}></div>
                      </div>
                      <div class='filainfo'>

                      <div class='infoperfiliz'><button id=\"editperfil\" type=\"button\" class=\"btn btn-info\">Editar</button></div>
                    <div class='infoperfilde'><button type=\"submit\" disabled id='saveperfil' class=\"btn btn-info\">Guardar</button> </div>
                    </div>

                    <span id=\"error-empre\" class='error-login'>

                        </span>
                     
                  </form>
                  
                  <div class='filainfo'><h4>Cambiar la contraseña</h4></div>
                  
                  <form id=\"config_empresa\" action=\"../php/update_profile.php\" method=\"post\">

<div class='filainfo'>
                      <div class='infoperfiliz'><label>Contraseña actual: </label></div>
                      <div class='infoperfilde'><input type=\"password\" name=\"password\" disabled class=\"config\" value=></div>
</div>
<div class='filainfo'>
                      <div class='infoperfiliz'><label>Nueva contraseña: </label></div>
                      <div class='infoperfilde'><input type=\"password\" name=\"newpassword\" disabled class=\"config\" id=\"pass-empresa\" required></div>
                      </div>
<div class='filainfo'>
                      <div class='infoperfiliz'><label>COnfirmar nueva contraseña: </label></div>
                      <div class='infoperfilde'><input type=\"password\" name=\"newpassword\" disabled class=\"config\" id=\"conf-pass-empresa\" required>
                      <input type=\"hidden\" name=\"sesion\" disabled class=\"config\" value={$sesion}><br>
                      <input type=\"hidden\" name=\"cif\" disabled class=\"config\" value={$res[0]['cif']}>
                      <input type=\"hidden\" name=\"seccion\" disabled class=\"config\" value='config'><br></div>
</div>
<div class='filainfo'>
                      <div class='infoperfiliz'><button id=\"editconfig\" type=\"button\" class=\"btn btn-info\">Editar</button></div>
                    <div class='infoperfilde'><button type=\"submit\" disabled id='saveconfig' class=\"btn btn-info\">Guardar</button></div>
                      </div>
                  </form>";
              }
              ?>
          </div>
          </div>
</br>
        </div>
         <?php
         if ($sesion == 'usuario') {
             /* Consulta para últimas actividades o actividades recientes */
             $result = $conexion->query($sql_actividades_recientes);
             if ($result->num_rows === 0) {
                 echo '<p class="text-center">No has participado en actividades aún :(</p>';
             } else {
                 $resultado_ult_act = $conexion->query($sql_actividades_recientes); // Con esta query sacamos las ofertas asociadas al usuario logueado.
                 echo ' <br><br><br><h4>Actividades recientes</h4>';
                 while ($row = $resultado_ult_act->fetch_assoc()) {
                     $sql_oferta = "SELECT * from oferta where id = '" . $row['id_oferta'] . "'";
                     $result2 = $conexion->query($sql_oferta);
                     $row2 = $result2->fetch_assoc();
                     
                     echo '
     
      <div class="col-lg-4 actividad">


               <figure class="snip1208">
                     <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample66.jpg" alt="sample66"/>
                     
                     <figcaption>
                      <p id="nombre_actividad">' . $row2['nombre'] . '</p>
                    <p id="tipo_actividad">' . $row2['tipo_actividad'] . '</p>
                  <p id="coste_reserva">Te costó ' . $row['coste_reserva'] . '€</p>
                  <p id="fecha_reserva">La hiciste el ' . $row['fecha_reserva'] . '</p>
                   <p id="valoracion">Tu valoración fue de ' . $row['valoracion'] . '<em>/5</em></p>
                   <button>Ver actividad</button>
                      </figcaption><a href="oferta.php?id=' . $row['id'] . '"></a>                     
            </div>';
                 }
             }
         }
         ?>
         <br><br>

         
</article>

	
</section>

<footer>

</footer>

</body>
</html>