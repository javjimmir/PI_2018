$(function () {

    $("#nombre-ofe").blur(function(){

        var name = $("#nombre-ofe").val();
        if (name == "") {
            $("#error-oferta").html("<p> Complete el campo Nombre</p>");
            $("#error-oferta").fadeIn();
            $("#nombre-ofe").css('color', 'white');
            $("#nombre-ofe").css('background', '#ff8080');
        }else{
            $("#error-oferta").fadeOut();
            $("#nombre-ofe").css('background', '#e6ffcc');
            $("#nombre-ofe").css('color', 'black');
        }
    });

    $("#duracion").blur(function(){
        var duracion = $("#duracion").val();
        var duraRegex = /^[0-9]+?$/;
        if (duraRegex.test(duracion) == false || duracion == "") {
            $("#error-oferta").html("<p>La duración de la actividad debe estar comprendida entre 1 y 999 min</p>");
            $("#error-oferta").fadeIn();
            $("#duracion").css('color', 'white');
            $("#duracion").css('background', '#ff8080');
        }else{
            $("#error-oferta").fadeOut();
            $("#duracion").css('background', '#e6ffcc');
            $("#duracion").css('color', 'black');
        }
    });

    $("#plazas").blur(function(){
        var plaza = $("#plazas").val();
        var plazaRegex = /^[0-9]+?$/;
        if (plazaRegex.test(plaza) == false || plaza == "") {
            $("#error-oferta").html("<p>Numero de plazas entre 1 y 99</p>");
            $("#error-oferta").fadeIn();
            $("#plazas").css('color', 'white');
            $("#plazas").css('background', '#ff8080');
        }else{
            $("#error-oferta").fadeOut();
            $("#plazas").css('background', '#e6ffcc');
            $("#plazas").css('color', 'black');
        }
    });

    $("#precio").blur(function(){
        var precio = $("#precio").val();
        var precioRegex = /^[0-9]+([,][0-9]+)?$/;
        if (precioRegex.test(precio) == false || precio == "") {
            $("#error-oferta").html("<p>La precio de la actividad debe estar comprendida entre 1 y 600 €</p>");
            $("#error-oferta").fadeIn();
            $("#precio").css('color', 'white');
            $("#precio").css('background', '#ff8080');
        }else{
            $("#error-oferta").fadeOut();
            $("#precio").css('background', '#e6ffcc');
            $("#precio").css('color', 'black');
        }
    });

    $("#actividad").blur(function(){

        var name = $("#actividad").val();
        if (name == "") {
            $("#error-oferta").html("<p> Complete el campo Actividad</p>");
            $("#error-oferta").fadeIn();
            $("#actividad").css('color', 'white');
            $("#actividad").css('background', '#ff8080');
        }else{
            $("#error-oferta").fadeOut();
            $("#actividad").css('background', '#e6ffcc');
            $("#actividad").css('color', 'black');
        }
    });

    $("#municipio-ofe").blur(function(){

        var name = $("#municipio-ofe").val();
        if (name == "") {
            $("#error-oferta").html("<p> Complete el campo Municipio</p>");
            $("#error-oferta").fadeIn();
            $("#municipio-ofe").css('color', 'white');
            $("#municipio-ofe").css('background', '#ff8080');
        }else{
            $("#error-oferta").fadeOut();
            $("#municipio-ofe").css('background', '#e6ffcc');
            $("#municipio-ofe").css('color', 'black');
        }
    });

    $("#date-ini").blur(function(){
    var date = $("#date-ini").val();
    if (date == "") {
        $("#error-oferta").html("<p> Complete el Fecha de inicio</p>");
        $("#error-oferta").fadeIn();
        $("#date-ini").css('color', 'white');
        $("#date-ini").css('background', '#ff8080');
    }else{
        $("#error-oferta").fadeOut();
        $("#date-ini").css('background', '#e6ffcc');
        $("#date-ini").css('color', 'black');
    }
    });

    $("#date-fin").blur(function(){
        var date = $("#date-fin").val();
        if (date == "") {
            $("#error-oferta").html("<p> Complete el Fecha de finalización</p>");
            $("#error-oferta").fadeIn();
            $("#date-fin").css('color', 'white');
            $("#date-fin").css('background', '#ff8080');
        }else{
            $("#error-oferta").fadeOut();
            $("#date-fin").css('background', '#e6ffcc');
            $("#date-fin").css('color', 'black');
        }

        var date = new Date($('#date-ini').val());
        var date1 = new Date($('#date-fin').val());
        if (date >= date1){
            $("#error-oferta").html("<p>la fecha de finalización no puede ser anterior a la de inicio</p>");
            $("#error-oferta").fadeIn();
            $("#date-fin").css('color', 'white');
            $("#date-fin").css('background', '#ff8080');
        }else{
            $("#error-oferta").fadeOut();
            $("#date-fin").css('background', '#e6ffcc');
            $("#date-fin").css('color', 'black');
        }
    });

});