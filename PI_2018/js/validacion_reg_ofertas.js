$(function () {

    $("#nombre-ofe").blur(function(){

        var name = $("#nombre-ofe").val();
        if (name == "") {
            $("#error-oferta").html("<p> Complete el campo Nombre</p>");
            $("#error-oferta").fadeIn();
            $("#nombre-ofe").focus();
        }else{
            $("#error-oferta").fadeOut();
        }
    });

    $("#duracion").blur(function(){
        var duracion = $("#duracion").val();
        var duraRegex = /^[0-9]+?$/;
        if (duraRegex.test(duracion) == false || duracion == "") {
            $("#error-oferta").html("<p>La duración de la actividad debe estar comprendida entre 1 y 999 min</p>");
            $("#error-oferta").fadeIn();
            $("#duracion").focus();
        }else{
            $("#error-oferta").fadeOut();
        }
    });

    $("#plazas").blur(function(){
        var plaza = $("#plazas").val();
        var plazaRegex = /^[0-9]+?$/;
        if (plazaRegex.test(plaza) == false || plaza == "") {
            $("#error-oferta").html("<p>Numero de plazas entre 1 y 99</p>");
            $("#error-oferta").fadeIn();
            $("#plazas").focus();
        }else{
            $("#error-oferta").fadeOut();
        }
    });

    $("#precio").blur(function(){
        var precio = $("#precio").val();
        var precioRegex = /^[0-9]+([,][0-9]+)?$/;
        if (precioRegex.test(precio) == false || precio == "") {
            $("#error-oferta").html("<p>La precio de la actividad debe estar comprendida entre 1 y 600 €</p>");
            $("#error-oferta").fadeIn();
            $("#precio").focus();
        }else{
            $("#error-oferta").fadeOut();
        }
    });

    $("#actividad").blur(function(){

        var name = $("#actividad").val();
        if (name == "") {
            $("#error-oferta").html("<p> Complete el campo Actividad</p>");
            $("#error-oferta").fadeIn();
            $("#actividad").focus();
        }else{
            $("#error-oferta").fadeOut();
        }
    });

    $("#municipio-ofe").blur(function(){

        var name = $("#municipio-ofe").val();
        if (name == "") {
            $("#error-oferta").html("<p> Complete el campo Municipio</p>");
            $("#error-oferta").fadeIn();
            $("#municipio-ofe").focus();
        }else{
            $("#error-oferta").fadeOut();
        }
    });

    $("#date-ini").blur(function(){
    var date = $("#date-ini").val();
    if (date == "") {
        $("#error-oferta").html("<p> Complete el Fecha de inicio</p>");
        $("#error-oferta").fadeIn();
        $("#date-ini").focus();
    }else{
        $("#error-oferta").fadeOut();
    }
    });

    $("#date-fin").blur(function(){
        var date = $("#date-fin").val();
        if (date == "") {
            $("#error-oferta").html("<p> Complete el Fecha de finalización</p>");
            $("#error-oferta").fadeIn();
            $("#date-fin").focus();
        }else{
            $("#error-oferta").fadeOut();
        }

        var date = new Date($('#date-ini').val());
        var date1 = new Date($('#date-fin').val());
        if (date >= date1){
            $("#error-oferta").html("<p>la fecha de finalización no puede ser anterior a la de inicio</p>");
            $("#error-oferta").fadeIn();
            $("#date-fin").focus();
        }else{
            $("#error-oferta").fadeOut();
        }
    });

});