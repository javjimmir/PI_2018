$(function () {
    $("#nombre-empresa").blur(function(){
        var nameRegex = /^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/;
        var name = $("#nombre-empresa").val();
        if (nameRegex.test(name) == false || name == "") {
            $("#error-empre").html("<p> El nombre no puede estar vacío y solo puede contener letras y números</p>");
            $("#error-empre").fadeIn();
            $("#nombre-empresa").css('color', 'white');
            $("#nombre-empresa").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#nombre-empresa").css('background', '#e6ffcc');
            $("#nombre-empresa").css('color', 'black');
        }
    });

    $("#Cif").blur(function(){
        var cif = $("#Cif").val();
        var cifRegex = /^[a-zA-Z]{1}\d{7}[a-zA-Z0-9]{1}$/;
        if (cifRegex.test(cif) == false || cif == "") {
            $("#error-empre").html("<p> El CIF no puede estar vacío y debe mantener la estructura x1234567z</p>");
            $("#error-empre").fadeIn();
            $("#Cif").css('color', 'white');
            $("#Cif").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#Cif").css('background', '#e6ffcc');
            $("#Cif").css('color', 'black');
        }
    });

    $("#web-empresa").blur(function(){
        var web = $("#web-empresa").val();

        if (web == "") {
            $("#error-empre").html("<p> la dirección web no puede estar vacia</p>");
            $("#error-empre").fadeIn();
            $("#web-empresa").css('color', 'white');
            $("#web-empresa").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#web-empresa").css('background', '#e6ffcc');
            $("#web-empresa").css('color', 'black');
        }
    });

    $("#username-empresa").blur(function(){
        var user = $("#username-empresa").val();
        var userRegex = /^[a-zA-Z0-9]{2,20}$/;
        if (userRegex.test(user) == false || user == "") {
            $("#error-empre").html("<p> El Usuario no puede estar vacío y solo puede contener letras y números</p>");
            $("#error-empre").fadeIn();
            $("#username-empresa").css('color', 'white');
            $("#username-empresa").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#username-empresa").css('background', '#e6ffcc');
            $("#username-empresa").css('color', 'black');
        }
    });
    $("#pass-empresa").blur(function(){
        var pass = $("#pass-empresa").val();
        var passRegex = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i;
        if (passRegex.test(pass) == false || pass == "") {
            $("#error-empre").html("<p>El campo contraseña no puede estar vacío y tiene que contener letras y numeros</p>");
            $("#error-empre").fadeIn();
            $("#pass-empresa").css('color', 'white');
            $("#pass-empresa").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#pass-empresa").css('background', '#e6ffcc');
            $("#pass-empresa").css('color', 'black');
        }
    });

    $("#conf-pass-empresa").blur(function(){
        var pass1 = $("#pass-empresa").val();
        var repass = $("#conf-pass-empresa").val();
        if (pass1 != repass) {
            $("#error-empre").html("<p>El campo confirmar contraseña no coincide con contraseña</p>");
            $("#error-empre").fadeIn();
            $("#conf-pass-empresa").css('color', 'white');
            $("#conf-pass-empresa").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#conf-pass-empresa").css('background', '#e6ffcc');
            $("#conf-pass-empresa").css('color', 'black');
        }
    });



    $("#pais-empresa").blur(function () {
        var pais = $("#pais-empresa").val();
        if(pais != "ES"){
            $("#provincia-empresa").prop('disabled', true);
            $("#cp-empresa").prop('disabled', true);

        }else{
            $("#provincia-empresa").prop('disabled', false);
            $("#cp-empresa").prop('disabled', false);

        }

    });

    $("#direccion-empresa").blur(function(){
        var web = $("#direccion-empresa").val();

        if (web == "") {
            $("#error-empre").html("<p> La dirección no puede estar vacia</p>");
            $("#error-empre").fadeIn();
            $("#direccion-empresa").css('color', 'white');
            $("#direccion-empresa").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#direccion-empresa").css('background', '#e6ffcc');
            $("#direccion-empresa").css('color', 'black');
        }
    });

    $("#cp-empresa").blur(function(){
        var cpRegex = /^(?:0[1-9]\d{3}|[1-4]\d{4}|5[0-2]\d{3})$/;
        var cp = $("#cp-empresa").val();
        if ( cpRegex.test(cp) == false || cp == "") {
            $("#error-empre").html("<p>Campo vacío o mal formado</p>");
            $("#error-empre").fadeIn();
            $("#cp-empresa").css('color', 'white');
            $("#cp-empresa").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#cp-empresa").css('background', '#e6ffcc');
            $("#cp-empresa").css('color', 'black');
        }
    });

    $("#tel-empresa").blur(function(){
        var telRegex = /^(\+34|0034|34)?[6|7|8|9][0-9]{8}$/;
        var tel = $("#tel-empresa").val();
        if (telRegex.test(tel) == false || tel == "") {
            $("#error-empre").html("<p>Campo teléfono erroneo o vacío</p>");
            $("#error-empre").fadeIn();
            $("#tel-empresa").css('color', 'white');
            $("#tel-empresa").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#tel-empresa").css('background', '#e6ffcc');
            $("#tel-empresa").css('color', 'black');
        }
    });

    $("#mail-empresa").blur(function(){
        var mailRegex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
        var mail = $("#mail-empresa").val();
        if (mailRegex.test(mail) == false || mail == "") {
            $("#error-empre").html("<p>El campo mail está vacío o mal formado</p>");
            $("#error-empre").fadeIn();
            $("#mail-empresa").css('color', 'white');
            $("#mail-empresa").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#mail-empresa").css('background', '#e6ffcc');
            $("#mail-empresa").css('color', 'black');
        }
    });


    $("#conf-mail-empresa").blur(function(){
        var mail = $("#mail-empresa").val();
        var remail = $("#conf-mail-empresa").val();
        if (mail != remail) {
            $("#error-empre").html("<p>El campo confirmar mail no coincide con mail</p>");
            $("#error-empre").fadeIn();
            $("#conf-mail-empresa").css('color', 'white');
            $("#conf-mail-empresa").css('background', '#ff8080');
        }else{
            $("#error-empre").fadeOut();
            $("#conf-mail-empresa").css('background', '#e6ffcc');
            $("#conf-mail-empresa").css('color', 'black');
        }
    });

    $("#reset").click(function(){
            $("input[type='text'], input[type='password'], input[type='email'], input[type='tel']").text("");
            $("input[type='text'], input[type='password'], input[type='email'], input[type='tel']").css('background', 'white');
            $("input[type='text'], input[type='password'], input[type='email'], input[type='tel']").css('color', '#7c7a7a');

    });

});