$(function () {
    $("#nombre-empresa").blur(function(){
        var nameRegex = /^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/;
        var name = $("#nombre-empresa").val();
        if (nameRegex.test(name) == false || name == "") {
            $("#error-empre").html("<p> El nombre no puede estar vacío y solo puede contener letras y números</p>");
            $("#error-empre").fadeIn();
            $("#nombre-empresa").focus();
        }else{
            $("#error-empre").fadeOut();
        }
    });

    $("#Cif").blur(function(){
        var cif = $("#Cif").val();
        var cifRegex = /^[a-zA-Z]{1}\d{7}[a-zA-Z0-9]{1}$/;
        if (cifRegex.test(cif) == false || cif == "") {
            $("#error-empre").html("<p> El CIF no puede estar vacío y debe mantener la estructura x1234567z</p>");
            $("#error-empre").fadeIn();
            $("#Cif").focus();
        }else{
            $("#error-empre").fadeOut();
        }
    });

    $("#username-empresa").blur(function(){
        var user = $("#username-empresa").val();
        var userRegex = /^[a-zA-Z0-9]{2,20}$/;
        if (userRegex.test(user) == false || user == "") {
            $("#error-empre").html("<p> El Usuario no puede estar vacío y solo puede contener letras y números</p>");
            $("#error-empre").fadeIn();
            $("#username-empresa").focus();
        }else{
            $("#error-empre").fadeOut();
        }
    });

    $("#pass-empresa").blur(function(){
        var pass = $("#pass-empresa").val();
        var passRegex = /^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i;
        if (passRegex.test(pass) == false || pass == "") {
            $("#error-empre").html("<p>El campo contraseña no puede estar vacío y tiene que contener letras y numeros</p>");
            $("#error-empre").fadeIn();
            $("#pass-empresa").focus();
        }else{
            $("#error-empre").fadeOut();
        }
    });

    $("#conf-pass-empresa").blur(function(){
        var pass1 = $("#pass-empresa").val();
        var repass = $("#conf-pass-empresa").val();
        if (pass1 != repass) {
            $("#error-empre").html("<p>El campo confirmar contraseña no coincide con contraseña</p>");
            $("#error-empre").fadeIn();
            $("#conf-pass-empresa").focus();
        }else{
            $("#error-empre").fadeOut();
        }
    });


    $("#pais-empresa").blur(function () {
        var pais = $("#pais-empresa").val();
        if(pais != "ES"){
            $("#provincia-empresa").replaceWith('<input type="text" name="pais-empresa" id="pais-empresa" placeholder="Escriba aqui la región o provincia">');
            $("#cp-empresa").hide();
            $("#cp-em").hide();
        }

    });



    $("#cp-empresa").blur(function(){
        var cpRegex = /^(?:0[1-9]\d{3}|[1-4]\d{4}|5[0-2]\d{3})$/;
        var cp = $("#cp-empresa").val();
        if ( cp == "") {
            $("#error-empre").html("<p>Campo vacío</p>");
            $("#error-empre").fadeIn();
            $("#cp-empresa").focus();
        }else{
            $("#error-empre").fadeOut();
        }
    });

    $("#tel-empresa").blur(function(){
        var telRegex = /^(\+34|0034|34)?[6|7|8|9][0-9]{8}$/;
        var tel = $("#tel-empresa").val();
        if (telRegex.test(tel) == false || tel == "") {
            $("#error-empre").html("<p>Campo teléfono erroneo o vacío</p>");
            $("#error-empre").fadeIn();
            $("#tel-empresa").focus();
        }else{
            $("#error-empre").fadeOut();
        }
    });

    $("#mail-empresa").blur(function(){
        var mailRegex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
        var mail = $("#mail-empresa").val();
        if (mailRegex.test(mail) == false || mail == "") {
            $("#error-empre").html("<p>El campo mail está vacío o mal formado</p>");
            $("#error-empre").fadeIn();
            $("#mail-empresa").focus();
        }else{
            $("#error-empre").fadeOut();
        }
    });

    $("#conf-mail-empresa").blur(function(){
        var mail = $("#mail-empresa").val();
        var remail = $("#conf-mail-empresa").val();
        if (mail != remail) {
            $("#error-empre").html("<p>El campo confirmar mail no coincide con mail</p>");
            $("#error-empre").fadeIn();
            $("#conf-mail-empresa").focus();
        }else{
            $("#error-empre").fadeOut();
        }
    })
});