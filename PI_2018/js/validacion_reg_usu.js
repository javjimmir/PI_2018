

$(function () {
    $("#nombre-usu").blur(function(){
        var nameRegex = /^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/;
        var name = $("#nombre-usu").val();
        if (nameRegex.test(name) == false || name == "") {
            $("#error-usu").html("<p> El nombre debe comenzar con mayúscula y no puede contener caracteres numéricos</p>");
            $("#error-usu").fadeIn();
            $("#nombre-usu").css('color', 'white');
            $("#nombre-usu").css('background', '#ff8080');
        }else{
            $("#error-usu").fadeOut();
            $("#nombre-usu").css('background', '#e6ffcc');
            $("#nombre-usu").css('color', 'black');
        }
    });

    $("#apellidos-usu").blur(function(){
        var nameRegex = /^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/;
        var name = $("#apellidos-usu").val();
        if (nameRegex.test(name) == false || name == "") {
            $("#error-usu").html("<p> Los apellidos deben comenzar con mayúsculas y no pueden contener caracteres numéricos</p>");
            $("#error-usu").fadeIn();
            $("#apellidos-usu").css('color', 'white');
            $("#apellidos-usu").css('background', '#ff8080');
        }else{
            $("#error-usu").fadeOut();
            $("#apellidos-usu").css('background', '#e6ffcc');
            $("#apellidos-usu").css('color', 'black');
        }
    });



    $("#dni-usu").blur(function(){
        var nif = $("#dni-usu").val();
        var nifRegex = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
        if (nifRegex.test(nif) == false || nif == "") {
            $("#error-usu").html("<p> El DNI esta vacío o mal formado</p>");
            $("#error-usu").fadeIn();
            $("#dni-usu").css('color', 'white');
            $("#dni-usu").css('background', '#ff8080');
        }else{
            $("#error-usu").fadeOut();
            $("#dni-usu").css('background', '#e6ffcc');
            $("#dni-usu").css('color', 'black');
        }
    });


    $("#username").blur(function(){
        var user = $("#username").val();
        var userRegex = /^[a-zA-Z0-9]{2,20}$/;
        if (userRegex.test(user) == false || user == "") {
            $("#error-usu").html("<p> El Usuario no puede estar vacío y solo puede contener letras y números</p>");
            $("#error-usu").fadeIn();
            $("#username").css('color', 'white');
            $("#username").css('background', '#ff8080');
        }else{
            $("#error-usu").fadeOut();
            $("#username").css('background', '#e6ffcc');
            $("#username").css('color', 'black');
        }
    });

    $("#pass-usu").blur(function(){
        var pass = $("#pass-usu").val();
        var passRegex = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i;
        if (passRegex.test(pass) == false || pass == "") {
            $("#error-usu").html("<p>El campo contraseña no puede estar vacío y tiene que contener letras y numeros</p>");
            $("#error-usu").fadeIn();
            $("#pass-usu").css('color', 'white');
            $("#pass-usu").css('background', '#ff8080');
        }else{
            $("#error-usu").fadeOut();
            $("#pass-usu").css('background', '#e6ffcc');
            $("#pass-usu").css('color', 'black');
        }
    });

    $("#conf-pass-usu").blur(function(){
        var pass1 = $("#pass-usu").val();
        var repass = $("#conf-pass-usu").val();
        if (pass1 != repass) {
            $("#error-usu").html("<p>El campo confirmar contraseña no coincide con contraseña</p>");
            $("#error-usu").fadeIn();
            $("#conf-pass-usu").css('color', 'white');
            $("#conf-pass-usu").css('background', '#ff8080');
        }else{
            $("#error-usu").fadeOut();
            $("#conf-pass-usu").css('background', '#e6ffcc');
            $("#conf-pass-usu").css('color', 'black');
        }
    });


    $("#pais-usu").blur(function () {
        var pais = $("#pais-usu").val();
        if(pais != "España"){
            $("#provincia-usu").prop('disabled', true);
            $("#cp-usuario").prop('disabled', true);

        }else{
            $("#provincia-usu").prop('disabled', false);
            $("#cp-usuario").prop('disabled', false);

        }

    });

    $("#cp-usuario").blur(function(){
        var cp = $("#cp-usuario").val();
        if ( cp == "") {
            $("#error-usu").html("<p>Campo vacío</p>");
            $("#error-usu").fadeIn();
            $("#cp-usuario").css('color', 'white');
            $("#cp-usuario").css('background', '#ff8080');
        }else{
            $("#error-usu").fadeOut();
            $("#cp-usuario").css('background', '#e6ffcc');
            $("#cp-usuario").css('color', 'black');
        }
    });

    $("#direccion-usu").blur(function(){
        var web = $("#direccion-usu").val();

        if (web == "") {
            $("#error-empre").html("<p> La dirección no puede estar vacia</p>");
            $("#error-empre").fadeIn();
            $("#direccion-usu").css('color', 'white');
            $("#direccion-usu").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#direccion-usu").css('background', '#e6ffcc');
            $("#direccion-usu").css('color', 'black');
        }
    });

    $("#tel-usu").blur(function(){
        var telRegex = /^(\+34|0034|34)?[6|7|8|9][0-9]{8}$/;
        var tel = $("#tel-usu").val();
        if (telRegex.test(tel) == false || tel == "") {
            $("#error-usu").html("<p>Campo teléfono erroneo o vacío</p>");
            $("#error-usu").fadeIn();
            $("#tel-usu").css('color', 'white');
            $("#tel-usu").css('background', '#ff8080');
        }else{
            $("#error-usu").fadeOut();
            $("#tel-usu").css('background', '#e6ffcc');
            $("#tel-usu").css('color', 'black');
        }
    });


    $("#mail-usu").blur(function(){
        var mailRegex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
        var mail = $("#mail-usu").val();
        if (mailRegex.test(mail) == false || mail == "") {
            $("#error-usu").html("<p>El campo mail está vacío o mal formado</p>");
            $("#error-usu").fadeIn();
            $("#mail-usu").css('color', 'white');
            $("#mail-usu").css('background', '#ff8080');
        }else{
            $("#error-usu").fadeOut();
            $("#mail-usu").css('background', '#e6ffcc');
            $("#mail-usu").css('color', 'black');
        }
    });

    $("#conf-mail-usu").blur(function(){
        var mail = $("#mail-usu").val();
        var remail = $("#conf-mail-usu").val();
        if (mail != remail) {
            $("#error-usu").html("<p>El campo confirmar mail no coincide con mail</p>");
            $("#conf-mail-usu").css('color', 'white');
            $("#conf-mail-usu").css('background', '#ff8080');
        }else{
            $("#error-usu").fadeOut();
            $("#conf-mail-usu").css('background', '#e6ffcc');
            $("#conf-mail-usu").css('color', 'black');
        }
    });

    $("#reset").click(function(){
        $("input[type='text'], input[type='password'], input[type='email'], input[type='tel']").text("");
        $("input[type='text'], input[type='password'], input[type='email'], input[type='tel']").css('background', 'white');
        $("input[type='text'], input[type='password'], input[type='email'], input[type='tel']").css('color', '#7c7a7a');

    });


});