/* Comienzo filtros */

$(".tipoact").change(function() {
    var tipo_actividad = $('input[name=tipo_actividad]:checked', '#myform').val()
    /* Petición ajax que envía el tipo de actividad marcado */

    $.post("php/filter.php", {tipo_actividad: tipo_actividad}, function (data) { // Le pasamos el tipo de actividad, que es lo que se procesará en servidor
        $(".tabla").empty();
        data = $.parseJSON(data);
        /* Bloque de comprobación de disponibilidad de ofertas */
        if (data.length === 0) {
            $(".tabla").append("<div id='titulo_filtro'><h3>Actividades de " + tipo_actividad + "</h3><hr style='width: 90%'/>");
            $("#no_offers").remove();
            $(".offers").append("<div id='no_offers'><span class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>");
            $("#cargar").hide();
        } else {
            $("#cargar").show();
            $("#no_offers").remove();
            $(".tabla").append("<div id='titulo_filtro'><h3>Actividades de " + tipo_actividad + "</h3><hr style='width: 90%'/>");
            for (var i = 0; i <= data.length-1; i++) {
                $(".tabla").append(
                    "<div class=\"snip1208 col-md-4 col-xs-12 col-lg-3 col-sm-6\">" +
                    "<div class=\"aaa\">"+
                    "<img src='img/oferta/"+data[i].imagen_oferta+"' alt='sample66'/>"+
                    "<figcaption>"+
                    "<h3 id='nombre'>"+data[i].nombre+"</h3>"+
                    "<p id='actividad'>Actividad: " + data[i].tipo_actividad + "</p>" +
                    "<p id='provincia'>Provincia: " + data[i].provincia + "</p>" +
                    "<p id='dificultad'>Dificultad: " + data[i].dificultad + "</p>" +
                    "<p id='precio'>Precio " + data[i].precio + "€</p>"+
                    "<button>Ver actividad</button>"+
                    "</figcaption><a href='content/oferta.php?id="+data[i].id+"'></a>"+
                    "</div></div>");
            }
        }
    });
});

/* Filtro por provincia */
$(".prov-filter").change(function() {
    var provincia =  $(this).val();
    $.post("php/filter.php", {provincia: provincia}, function (data) { // Le pasamos el tipo de actividad, que es lo que se procesará en servidor
        $(".tabla").empty();
        data = $.parseJSON(data);
        /* Bloque de comprobación de disponibilidad de ofertas */
        if (data.length === 0) {
            $(".tabla").append("<div id='titulo_filtro'><h3>Actividades en <text style='text-transform: capitalize'>" + provincia + "</text></h3><hr style='width: 90%'/>");
            $("#no_offers").remove();
            $(".offers").append("<div id='no_offers'><span class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>");
            $("#cargar").hide();
        } else {
            $("#cargar").show();
            $("#no_offers").remove();
            $(".tabla").append("<div id='titulo_filtro'><h3>Actividades en <text style='text-transform: capitalize'>" + provincia + "</text></h3><hr style='width: 90%'/>");
            for (var i = 0; i <= data.length - 1; i++) {
                $(".tabla").append("<div class=\"snip1208 col-md-4 col-xs-12 col-lg-3 col-sm-6\">" +
                    "<div class=\"aaa\">"+
                    "<img src='img/oferta/"+data[i].imagen_oferta+"' alt='sample66'/>"+
                    "<figcaption>"+
                    "<h3 id='nombre'>"+data[i].nombre+"</h3>"+
                    "<p id='actividad'>Actividad: " + data[i].tipo_actividad + "</p>" +
                    "<p id='provincia'>Provincia: " + data[i].provincia + "</p>" +
                    "<p id='dificultad'>Dificultad: " + data[i].dificultad + "</p>" +
                    "<p id='precio'>Precio " + data[i].precio + "€</p>"+
                    "<button>Ver actividad</button>"+
                    "</figcaption><a href='content/oferta.php?id="+data[i].id+"'></a>"+
                    "</div></div>");
            }
        }
    });
});

// Petición ajax que se lanza cuando se desliza la barra de precio
$("#range").change(function() {
    if ($('.tipoact').is(':checked')) {     // Si tipo de actividad está marcada, se enviará con el post precio y actividad
        var precio = $("#number").val();
        var tipo_actividad = $('input[name=tipo_actividad]:checked', '#myform').val()

        $.post("php/filter.php", {precio: precio, tipo_actividad: tipo_actividad}, function (data) { // Le pasamos el precio, que es lo que se procesará en servidor
            $(".tabla").empty();
            data = $.parseJSON(data);
            /* Bloque de comprobación de disponibilidad de ofertas */
            if (data.length === 0) {
                $(".tabla").append("<div id='titulo_filtro'><h3>Actividades de " + tipo_actividad + " por menos de " + precio + "€</h3><hr style='width: 90%'/>");
                $("#no_offers").remove();
                $(".offers").append("<div id='no_offers'><span class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>");
                $("#cargar").hide();
            } else {
                $("#cargar").show();
                $("#no_offers").remove();
                $(".tabla").append("<div id='titulo_filtro'><h3>Actividades de " + tipo_actividad + " por menos de " + precio + "€</h3><hr style='width: 90%'/>");
                for (var i = 0; i <= data.length - 1; i++) {
                    $(".tabla").append("<div class=\"snip1208 col-md-4 col-xs-12 col-lg-3 col-sm-6\">" +
                        "<div class=\"aaa\">"+
                        "<img src='img/oferta/"+data[i].imagen_oferta+"' alt='sample66'/>"+
                        "<figcaption>"+
                        "<h3 id='nombre'>"+data[i].nombre+"</h3>"+
                        "<p id='actividad'>Actividad: " + data[i].tipo_actividad + "</p>" +
                        "<p id='provincia'>Provincia: " + data[i].provincia + "</p>" +
                        "<p id='dificultad'>Dificultad: " + data[i].dificultad + "</p>" +
                        "<p id='precio'>Precio " + data[i].precio + "€</p>"+
                        "<button>Ver actividad</button>"+
                        "</figcaption><a href='content/oferta.php?id="+data[i].id+"'></a>"+
                        "</div></div>");
                }
            }

        });
    } else {    // Si no hay tipo de actividad marcada, hará el post solo con el precio
        var precio = $("#number").val();

        /* Petición ajax que envía el precio seleccionado en el rango */

        $.post("php/filter.php", {precio: precio}, function (data) { // Le pasamos el precio, que es lo que se procesará en servidor
            $(".tabla").empty();
            data = $.parseJSON(data);
            /* Bloque de comprobación de disponibilidad de ofertas */
            if (data.length === 0) {
                $(".tabla").append("<div id='titulo_filtro'><h3>Actividades por menos de " + precio + "€</h3><hr style='width: 90%'/>");
                $("#no_offers").remove();
                $(".offers").append("<div id='no_offers'><span class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>");
                $("#cargar").hide();
            } else {
                $("#cargar").show();
                $("#no_offers").remove();
                $(".tabla").append("<div id='titulo_filtro'><h3>Actividades por menos de " + precio + "€</h3><hr style='width: 90%'/>");
                for (var i = 0; i <= data.length - 1; i++) {
                    $(".tabla").append("<div class=\"snip1208 col-md-4 col-xs-12 col-lg-3 col-sm-6\">" +
                        "<div class=\"aaa\">"+
                        "<img src='img/oferta/"+data[i].imagen_oferta+"' alt='sample66'/>"+
                        "<figcaption>"+
                        "<h3 id='nombre'>"+data[i].nombre+"</h3>"+
                        "<p id='actividad'>Actividad: " + data[i].tipo_actividad + "</p>" +
                        "<p id='provincia'>Provincia: " + data[i].provincia + "</p>" +
                        "<p id='dificultad'>Dificultad: " + data[i].dificultad + "</p>" +
                        "<p id='precio'>Precio " + data[i].precio + "€</p>"+
                        "<button>Ver actividad</button>"+
                        "</figcaption><a href='content/oferta.php?id="+data[i].id+"'></a>"+
                        "</div></div>");
                }
            }
        });
    }
});

/* Petición ajax que se lanza cuando se pulsa "Quitar filtros" */
$("#quitarfiltros").click(function(e) {
    e.preventDefault();
    var desactivar = 'desactivar';
    $(".tipoact").prop('checked', false); // Desactivamos el check del radio

    $.post("php/filter.php", {desactivar: desactivar}, function (data) {
        $(".tabla").empty();
        data = $.parseJSON(data);
        /* Bloque de comprobación de disponibilidad de ofertas */
        if (data.length === 0) {
            $(".tabla").append("<div id='titulo_filtro'><h3>Últimas actividades</h3><hr style='width: 90%'/>");
            $("#no_offers").remove();
            $(".offers").append("<div id='no_offers'><span class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>");
            $("#cargar").hide();
        } else {
            $("#cargar").show();
            $("#no_offers").remove();
            $(".tabla").append("<div id='titulo_filtro'><h3>Últimas actividades</h3><hr style='width: 90%'/>");
            for (var i = 0; i <= data.length - 1; i++) {
                $(".tabla").append("<div class=\"snip1208 col-md-4 col-xs-12 col-lg-3 col-sm-6\">" +
                    "<div class=\"aaa\">"+
                    "<img src='img/oferta/"+data[i].imagen_oferta+"' alt='sample66'/>"+
                    "<figcaption>"+
                    "<h3 id='nombre'>"+data[i].nombre+"</h3>"+
                    "<p id='actividad'>Actividad: " + data[i].tipo_actividad + "</p>" +
                    "<p id='provincia'>Provincia: " + data[i].provincia + "</p>" +
                    "<p id='dificultad'>Dificultad: " + data[i].dificultad + "</p>" +
                    "<p id='precio'>Precio " + data[i].precio + "€</p>"+
                    "<button>Ver actividad</button>"+
                    "</figcaption><a href='content/oferta.php?id="+data[i].id+"'></a>"+
                    "</div></div>");
            }
        }
    });
});
/* Fin de filtros */