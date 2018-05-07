$(document).ready(function(){
	$("#enviar").click(function(){
		var username = $("#username").val();
		var password = $("#password").val();

		var expr_user = /^[a-z0-9]{7,20}$/;
		if (username.test(expr_user) == false || username == "") {
			alert("Introduzca correctamente el nombre de usuario, por favor.,");
			return false;
		}else{
			if (password == "" || password.length > 6) {
				alert("Por favor, Introduzca una contraseña de más de 6 carácteres.");
			}
		}
	})
})