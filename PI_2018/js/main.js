/* Precarga de funciones para el filtro de precio */
function changeInputValue(val){
    document.getElementById("number").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
}
function changeRangeValue(val){
    document.getElementById("range").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
}

// Función que obtiene un parámetro get.
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$(document).ready(function () {
    if (getUrlParameter('load') == 'all') {
        $("#cargar").attr("disabled", "disabled");
    }

    $(".tipoact").change(function() {
        var tipo_actividad = $('input[name=tipo_actividad]:checked', '#myform').val()
        console.log(tipo_actividad)

        /* Petición ajax que envía el tipo de actividad marcado */

        $.post("php/filter.php", {tipo_actividad: tipo_actividad}, function (data) { // Le pasamos el tipo de actividad, que es lo que se procesará en servidor
            $(".tabla").empty();
            data = $.parseJSON(data);
            for (var i = 0; i <= data.length-1; i++) {
                //console.log(data[i]);
                $(".tabla").append("<div class='col-lg-4 actividad'>" +
                    "<div class='row'>" + "<div class='col-lg-4'>" + "<img src='./img/submarinismo.jpg' alt='submarinismo' class='listImg'></div>" +
                    "<div class='col-lg-8'>" +
                    "<p id='nombre'>" + data[i].nombre + "</p>" +
                    "<p id='actividad'>" + data[i].provincia + "</p>" +
                    "<p id='provincia'>" + data[i].tipo_actividad + "</p>" +
                    "<p id='dificultad'>" + data[i].dificultad + "</p>" +
                    "<p id='precio'>" + data[i].precio + "€</p></div></div>");
            }
        });
    })


        // Petición ajax que se lanza cuando se desliza la barra de precio
    $("#range").change(function() {
        if ($('.tipoact').is(':checked')) {     // Si tipo de actividad está marcada, se enviará con el post precio y actividad
            var precio = $("#number").val();
            var tipo_actividad = $('input[name=tipo_actividad]:checked', '#myform').val()
            console.log(tipo_actividad + " --- " + precio);

            /* Petición ajax que envía el precio seleccionado en el rango */

            $.post("php/filter.php", {precio: precio, tipo_actividad: tipo_actividad}, function (data) { // Le pasamos el precio, que es lo que se procesará en servidor
                $(".tabla").empty();
                data = $.parseJSON(data);
                for (var i = 0; i <= data.length - 1; i++) {
                    //console.log(data[i]);
                    $(".tabla").append("<div class='col-lg-4 actividad'>" +
                        "<div class='row'>" + "<div class='col-lg-4'>" + "<img src='./img/submarinismo.jpg' alt='submarinismo' class='listImg'></div>" +
                        "<div class='col-lg-8'>" +
                        "<p id='nombre'>" + data[i].nombre + "</p>" +
                        "<p id='actividad'>" + data[i].provincia + "</p>" +
                        "<p id='provincia'>" + data[i].tipo_actividad + "</p>" +
                        "<p id='dificultad'>" + data[i].dificultad + "</p>" +
                        "<p id='precio'>" + data[i].precio + "€</p></div></div>");
                }
            });
        } else {    // Si no hay tipo de actividad marcada, hará el post solo con el precio
            var precio = $("#number").val();

            /* Petición ajax que envía el precio seleccionado en el rango */

            $.post("php/filter.php", {precio: precio}, function (data) { // Le pasamos el precio, que es lo que se procesará en servidor
                $(".tabla").empty();
                data = $.parseJSON(data);
                for (var i = 0; i <= data.length - 1; i++) {
                    //console.log(data[i]);
                    $(".tabla").append("<div class='col-lg-4 actividad'>" +
                        "<div class='row'>" + "<div class='col-lg-4'>" + "<img src='./img/submarinismo.jpg' alt='submarinismo' class='listImg'></div>" +
                        "<div class='col-lg-8'>" +
                        "<p id='nombre'>" + data[i].nombre + "</p>" +
                        "<p id='actividad'>" + data[i].provincia + "</p>" +
                        "<p id='provincia'>" + data[i].tipo_actividad + "</p>" +
                        "<p id='dificultad'>" + data[i].dificultad + "</p>" +
                        "<p id='precio'>" + data[i].precio + "€</p></div></div>");
                }
            });
        }
    })
    /**
     *
     *      Implementación de login por ajax.
     *      El uso de setTimeout es para evitar el uso de excesivas peticiones post seguidas, dando un pequeño respiro al servidor y agilizando las conexiones
     *
     */
    $("#validar").click(function (e) {
        var msginfo = $("#msginfo");
        msginfo.text("");
        e.preventDefault();
        // Se haga petición ajax
        var username = $("#alias").val();
        var password = $("#password").val();
        var tiposesion = $('input[name=tiposesion]:checked', '#form-sesion').val();


        if (username != "" && password != "" && tiposesion != undefined){
            $.post("../php/success.php", {username: username, password: password, tiposesion: tiposesion}, function (data) { // Le pasamos el precio, que es lo que se procesará en servidor
                data = $.parseJSON(data);
                if (data === 0) {
                    /* En caso de que los datos sean correctos... */
                    $("body").addClass("loading");
                    setTimeout(function () {
                        msginfo.text("");
                        $("body").removeClass("loading");
                        window.location.replace("../index.php");
                    }, 3000);
                } else {
                    /* En caso de que se introduzcan datos incorrectos... */
                    $("body").addClass("loading");
                    setTimeout(function () {
                        msginfo.text("");
                        msginfo.animate({fontSize: "17px"});
                        msginfo.animate({fontSize: "15px"});
                        msginfo.html("<p>El usuario o contraseñas son incorrectos. <a href='#'>¿Has olvidado tu contraseña?</a></p>");
                        $("#password").val("");
                        $("#alias").val("");
                        $("body").removeClass("loading");
                    }, 2000);
                }
            });
        } else {
            /* En caso de que introduzcan campos vacíos... */
            $("body").addClass("loading");
            setTimeout(function () {
                msginfo.text("");
                msginfo.animate({fontSize: "17px"});
                msginfo.animate({fontSize: "15px"});
                msginfo.text("Hay campos vacíos");
                $("#password").val("");
                $("#alias").val("");
                $("body").removeClass("loading");
            }, 2000);
        }
    });

    $("#editperfil").click(function () {
        $("#editconfig").attr("disabled", "disabled");
        $(this).attr("disabled", "disabled");
        $(".perfil").removeAttr("disabled");
        $("#saveperfil").removeAttr("disabled");
    })
    $("#editconfig").click(function () {
        $(this).attr("disabled", "disabled");
        $(".config").removeAttr("disabled");
        $("#saveconfig").removeAttr("disabled");
    })

});