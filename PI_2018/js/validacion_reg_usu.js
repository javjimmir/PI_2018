

$(function () {
    $("#nombre-usu").blur(function(){
        var nameRegex = /^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/;
        var name = $("#nombre-usu").val();
        if (nameRegex.test(name) == false || name == "") {
            $("#error-usu").html("<p> El nombre debe comenzar con mayúscula y no puede contener caracteres numéricos</p>");
            $("#error-usu").fadeIn();
            $("#nombre-usu").focus();
        }else{
            $("#error-usu").fadeOut();
        }
    });

    $("#apellidos-usu").blur(function(){
        var nameRegex = /^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/;
        var name = $("#apellidos-usu").val();
        if (nameRegex.test(name) == false || name == "") {
            $("#error-usu").html("<p> Los apellidos deben comenzar con mayúsculas y no pueden contener caracteres numéricos</p>");
            $("#error-usu").fadeIn();
            $("#apellidos-usu").focus();
        }else{
            $("#error-usu").fadeOut();
        }
    });


    $("#dni-usu").blur(function(){
        var nif = $("#dni-usu").val();
        var nifRegex = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
        if (nifRegex.test(nif) == false || nif == "") {
            $("#error-usu").html("<p> El DNI esta vacío o mal formado</p>");
            $("#error-usu").fadeIn();
            $("#dni-usu").focus();
        }else{
            $("#error-usu").fadeOut();
        }
    });


    $("#username").blur(function(){
        var user = $("#username").val();
        var userRegex = /^[a-zA-Z0-9]{2,20}$/;
        if (userRegex.test(user) == false || user == "") {
            $("#error-usu").html("<p> El Usuario no puede estar vacío y solo puede contener letras y números</p>");
            $("#error-usu").fadeIn();
            $("#username").focus();
        }else{
            $("#error-usu").fadeOut();
        }
    });

    $("#pass-usu").blur(function(){
        var pass = $("#pass-usu").val();
        var passRegex = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i;
        if (passRegex.test(pass) == false || pass == "") {
            $("#error-usu").html("<p>El campo contraseña no puede estar vacío y tiene que contener letras y numeros</p>");
            $("#error-usu").fadeIn();
            $("#pass-usu").focus();
        }else{
            $("#error-usu").fadeOut();
        }
    });

    $("#conf-pass-usu").blur(function(){
        var pass1 = $("#pass-usu").val();
        var repass = $("#conf-pass-usu").val();
        if (pass1 != repass) {
            $("#error-usu").html("<p>El campo confirmar contraseña no coincide con contraseña</p>");
            $("#error-usu").fadeIn();
            $("#conf-pass-usu").focus();
        }else{
            $("#error-usu").fadeOut();
        }
    });


    $("#pais-usu").blur(function () {
        var pais = $("#pais-usu").val();
        if(pais != "ES"){
            $("#provincia-usu").replaceWith('<input type="text" name="pais-empresa" id="pais-empresa" placeholder="Escriba aqui la región o provincia">');
            $("#cp-usuario").hide();
            $("#cp-usu").hide();
        }

    });

    $("#cp-usuario").blur(function(){
        var cp = $("#cp-usuario").val();
        if ( cp == "") {
            $("#error-usu").html("<p>Campo vacío</p>");
            $("#error-usu").fadeIn();
            $("#cp-usuario").focus();
        }else{
            $("#error-usu").fadeOut();
        }
    });

    $("#tel-usu").blur(function(){
        var telRegex = /^(\+34|0034|34)?[6|7|8|9][0-9]{8}$/;
        var tel = $("#tel-usu").val();
        if (telRegex.test(tel) == false || tel == "") {
            $("#error-usu").html("<p>Campo teléfono erroneo o vacío</p>");
            $("#error-usu").fadeIn();
            $("#tel-usu").focus();
        }else{
            $("#error-usu").fadeOut();
        }
    });

    $("#mail-usu").blur(function(){
        var mailRegex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
        var mail = $("#mail-usu").val();
        if (mailRegex.test(mail) == false || mail == "") {
            $("#error-usu").html("<p>El campo mail está vacío o mal formado</p>");
            $("#error-usu").fadeIn();
            $("#mail-usu").focus();
        }else{
            $("#error-usu").fadeOut();
        }
    });

    $("#conf-mail-usu").blur(function(){
        var mail = $("#mail-usu").val();
        var remail = $("#conf-mail-usu").val();
        if (mail != remail) {
            $("#error-usu").html("<p>El campo confirmar mail no coincide con mail</p>");
            $("#error-usu").fadeIn();
            $("#conf-mail-usu").focus();
        }else{
            $("#error-usu").fadeOut();
        }
    })
});