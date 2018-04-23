<?php
session_start();
if (empty($_SESSION['nombre'])) {
?>
<!DOCTYPE html>

<html lang="en">

<head>
	<title>Login</title>
	<meta charset = "utf-8">
</head>
<body>
	<h1>Login de Usuarios</h1>
	<hr />
 	<form action="login.php" method="post" >
		<label>Usuario:</label><br>
		<input name="usuario" type="text" id="usuario" required>
		<br><br>
		<label>Password:</label><br>
		<input name="password" type="password" id="password" required>
		<br><br>
		<input type="submit" name="Submit" value="LOGIN">
	</form>
	<hr />
</body>
</html>

<?php

}else{
	print 'bienvenido '.$_SESSION['nombre'];
	print '<a href="logout.php">Cerrar sesión</a>';
}

?>
