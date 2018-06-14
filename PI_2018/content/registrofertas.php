<?php
session_start();
include '../php/connection.php';

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="../img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/form.css">

    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/conectores_content.js"></script>
    <script type="text/javascript" src="../js/validacion_reg_ofertas.js"></script>
    <title>Index</title>
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
        <!-- formulario de login de usuarios -->
        <form action="../php/insert_oferta.php" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="form-oferta">


            <h1>REGISTRO DE OFERTAS</h1>
            <div id="form1">
                <label>Nombre</label><br>
                <input type="text" name="nombre" value="" placeholder="NOMBRE" id="nombre-ofe" required><br>

                <label>Provincia</label><br>
                <select name="provincia-ofe" id="provincia-ofe" required>
                    <option value='PROVINCIA'>PROVINCIA</option>
                    <option value='alava'>Álava</option>
                    <option value='albacete'>Albacete</option>
                    <option value='alicante'>Alicante/Alacant</option>
                    <option value='almeria'>Almería</option>
                    <option value='asturias'>Asturias</option>
                    <option value='avila'>Ávila</option>
                    <option value='badajoz'>Badajoz</option>
                    <option value='barcelona'>Barcelona</option>
                    <option value='burgos'>Burgos</option>
                    <option value='caceres'>Cáceres</option>
                    <option value='cadiz'>Cádiz</option>
                    <option value='cantabria'>Cantabria</option>
                    <option value='castellon'>Castellón/Castelló</option>
                    <option value='ceuta'>Ceuta</option>
                    <option value='ciudadreal'>Ciudad Real</option>
                    <option value='cordoba'>Córdoba</option>
                    <option value='cuenca'>Cuenca</option>
                    <option value='girona'>Girona</option>
                    <option value='laspalmas'>Las Palmas</option>
                    <option value='granada'>Granada</option>
                    <option value='guadalajara'>Guadalajara</option>
                    <option value='guipuzcoa'>Guipúzcoa</option>
                    <option value='huelva'>Huelva</option>
                    <option value='huesca'>Huesca</option>
                    <option value='illesbalears'>Illes Balears</option>
                    <option value='jaen'>Jaén</option>
                    <option value='acoruña'>A Coruña</option>
                    <option value='larioja'>La Rioja</option>
                    <option value='leon'>León</option>
                    <option value='lleida'>Lleida</option>
                    <option value='lugo'>Lugo</option>
                    <option value='madrid'>Madrid</option>
                    <option value='malaga'>Málaga</option>
                    <option value='melilla'>Melilla</option>
                    <option value='murcia'>Murcia</option>
                    <option value='navarra'>Navarra</option>
                    <option value='ourense'>Ourense</option>
                    <option value='palencia'>Palencia</option>
                    <option value='pontevedra'>Pontevedra</option>
                    <option value='salamanca'>Salamanca</option>
                    <option value='segovia'>Segovia</option>
                    <option value='sevilla'>Sevilla</option>
                    <option value='soria'>Soria</option>
                    <option value='tarragona'>Tarragona</option>
                    <option value='santacruztenerife'>Santa Cruz de Tenerife</option>
                    <option value='teruel'>Teruel</option>
                    <option value='toledo'>Toledo</option>
                    <option value='valencia'>Valencia/Valéncia</option>
                    <option value='valladolid'>Valladolid</option>
                    <option value='vizcaya'>Vizcaya</option>
                    <option value='zamora'>Zamora</option>
                    <option value='zaragoza'>Zaragoza</option>
                </select><br>
                <!-- si selecciona España aparece el desplegable con la lista de provincias, en caso contrario aparecerá una input text para rellenarla a mano -->
                <!--<input type="text" name="provincia" value="" placeholder="provincia" id="prov-usu"><br> -->

                <label>Municipio</label><br>
                <input type="text" name="municipio" value="" placeholder="MUNICIPIO" id="municipio-ofe" required><br>

                <label>Duración</label><br>
                <input type="text" name="duracion" value="" placeholder="DURACIÓN EN MINUTOS" id="duracion" required><br>

                <label>Número de plazas disponibles</label><br>
                <input type="text" name="plazas" value="" id="plazas" placeholder="Nº DE PLAZAS INDIVIDUALES" required><br>

                <label>Tipo de actividad</label><br>
                <input type="text" name="actividad" value="" placeholder="TIPO DE ACTIVIDAD" id="actividad" required><br>

                <label>Localizacion</label><br>
                <input type="text" name="localizacion" id="Localizacion" value="" placeholder="LOCALIZACIÓN EXACTA DE LA ACTIVIDAD" required><br>

                <div id="error-oferta"></div>

            </div>
            <div id="form2">
                <label>Precio</label><br>
                <input type="text" name="precio" id="precio" value="" placeholder="PRECIO EN EUROS" required><br>

                <label>Dificultad</label><br>
                <select name="dificultad" id="categ-usu" required>
                    <option value='DIFICULTAD'>DIFICULTAD</option>
                    <option value='facil'>Fácil</option>
                    <option value='media'>Media</option>
                    <option value='alta'>Alta</option>
                    <option value='experto'>Experto</option>
                </select><br>

                <label>Seleccione una categoria de actividades</label><br>
                <select name="categoria" id="categ-usu" required>
                    <option value='CATEGORÍS'>CATEGORIA</option>
                    <option value='agua'>Agua</option>
                    <option value='tierra'>Tierra</option>
                    <option value='aire'>Aire</option>
                    <option value='nieve'>Nieve</option>
                </select><br>

                <label>Agregue una imagen</label>
                <input name="upfile" type="file" />

                <label class="labelfecha">Fecha Inicio de la oferta</label><br/>
                <input name="inicio" id="date-ini" type="date" placeholder="FECHA INICIO DE LA OFERTA" required><br/>

                <label class="labelfecha">Fecha fin de la oferta</label><br/>
                <input name="fin" id="date-fin" type="date" placeholder="FECHA FINALIZACIÓN DE LA OFERTA" required><br/>

                <label >Describa la oferta:</label><br/>
                <textarea name="desc" placeholder="DESCRIPCION DE LA ACTIVIDAD" id="desc-empresa" required></textarea>

                <div>
                    <input id="enviar" type="submit" value="Enviar" class="botones">
                    <input id="reset" type="reset" value="Limpiar formulario" class="botones">


        </form>
    </article>
</section>

<footer class="pie">

</footer>

</body>
</html>