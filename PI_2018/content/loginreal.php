<?php
/**
 * Created by PhpStorm.
 * User: jdelgado
 * Date: 18/05/18
 * Time: 12:32
 */

session_start();


/* Este será el único login que habrá, de modo que form_login.html (usuario) y form_login_empresa.html (empresa) serán eliminados.
Este login usará una petición ajax. */
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./../css/loginform.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
	<title>Iniciar sesión</title>
</head>
<body>
<section>
	<article>
		<!-- formulario de login de usuarios por AJAX -->
		<form action="" method="post" id="form-sesion">

			<h1>Iniciar sesión</h1>

			<label>Alias</label><br>
			<input class="login" type="text" name="alias" value="" placeholder="Alias" id="alias" required><br>

			<label>Contraseña</label><br>
			<input class="login" type="password" name="password" value="" placeholder="Contraseña" id="password" required><br>

            <label></label><br>
            <input type="radio" class="tiposes" name="tiposesion" value="usuario">  Usuario
            <input type="radio" class="tiposes" name="tiposesion" value="empresa">  Empresa<br>

			<img src="./../img/captcha.jpg" id="captcha">
		<br/>
            <button id="validar">Enviar</button>
			<input id="boton" type="reset" value="Limpiar formulario">
			<br><br>
			<a href="form_login_empresa.html">Haz click aquí si eres una empresa</a>
		</form>

	</article>
</section>

</body>
</html>