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
/*Boton de filtros*/
var hide=true;
   


        $("#btnFiltros").click(function(){
            if(hide){
                $("#filters").animate({left: '1px'}, 1000);
                $("#btnFiltros").animate({left: '49px'}, 1000);
                hide=false;
            }else{
                $("#filters").animate({left: '-250px'}, 1000);
                $("#btnFiltros").animate({left: '-220px'}, 1000);
                hide=true;
            } 
        });
//     /*Fondo dinámico */
//     var d = new Date();
//     var n = d.getMonth();

// if(n>10 && n<2){
//     // invierno
//             $(document.body).css('background-image', 'url(http://www.hdbilder.eu/p/get_photo/544286/2560/1440)');
// }else if(n>=2 && n<5){
//     // primavera
//              $(document.body).css('background-image', 'url(http://www.thetravelboss.com/images/gallery/img_1515493479.jpg)');
// }else if(n>=5 && n<8){
//     // verano
//              $(document.body).css('background-image', 'url(https://www.sunsportsmaine.com/wp-content/uploads/2017/12/GoPro-Hero-Session-Floaty-3.jpg)');
// }else if(n>=8 && n<11){
//     // otoño 
//              $(document.body).css('background-image', 'url(https://hdwallsource.com/img/2014/9/downhill-wallpaper-hd-35545-36355-hd-wallpapers.jpg)');
// }

    /* Bloque de mensajes de información relacionados con la actualización de imágenes en el perfil */

    if (getUrlParameter('status') == 'success') {
        $(".status").append("<span class='alert alert-success'>¡Imagen actualizada con éxito!</span>").delay(3000).fadeOut();
    } else if (getUrlParameter('status') == 'generic') {
        $(".status").append("<span class='alert alert-danger'>¡ERROR! - No se ha podido subir la imagen al servidor, espera unos instantes e inténtalo de nuevo</span>").delay(3000).fadeOut("slow");
    } else if (getUrlParameter('status') == 'fileformat') {
        $(".status").append("<span class='alert alert-danger'>¡ERROR! - Solo están permitidos los formatos png, jpg y gif</span>").delay(3000).fadeOut("slow");
    } else if (getUrlParameter('status') == 'filesizelimit') {
        $(".status").append("<span class='alert alert-danger'>¡ERROR! - Solo se permiten imágenes de como máximo 2MB</span>").delay(3000).fadeOut("slow");
    } else if (getUrlParameter('status') == 'unknown') {
        $(".status").append("<span class='alert alert-danger'>¡ERROR! - Error desconocido. ¡Estamos solucionándolo!</span>").delay(3000).fadeOut("slow");
    } else if (getUrlParameter('status') == 'parameters') {
        $(".status").append("<span class='alert alert-danger'>¡ERROR! - Parámetros inválidos. Contacta con un administrador del site</span>").delay(3000).fadeOut("slow");
    }

    /* Notificación cuando una empresa crea una actividad */
    if (getUrlParameter('status') == 'created') {
        $(".status").append("<span class='alert alert-success'>¡Actividad creada con éxito! </span>").delay(3000).fadeOut();
    }

    if (getUrlParameter('load') == 'all') {
        $("#cargar").attr("disabled", "disabled");
    }
    // Elimina el botón "Load more" si se está filtrando por categoría
    if (getUrlParameter('category')) {
        $("#cargar").remove();
    }

    /* Notificación cuando se editan campos en el perfil */
    if (getUrlParameter('confirmation') == 'passucceed') {
        $(".status").append("<span class='alert alert-success'><span class='glyphicon glyphicon-ok-circle'></span> ¡Contraseña actualizada con éxito! </span>").delay(3000).fadeOut();
    } else if (getUrlParameter('confirmation') == 'paserror') {
        $(".status").append("<span class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Contraseña incorrecta. Inténtalo de nuevo </span>").delay(3000).fadeOut();
    } else if (getUrlParameter('confirmation') == 'succeed') {
        $(".status").append("<span class='alert alert-success'><span class='glyphicon glyphicon-ok-circle'></span> Perfil actualizado correctamente </span>").delay(3000).fadeOut();
    }

    /* Notificación cuando se edita una oferta */
    if (getUrlParameter('offer') == 'succeed') {
        $(".status").append("<span class='alert alert-success'><span class='glyphicon glyphicon-ok-circle'></span> Actividad editada con éxito </span>").delay(3000).fadeOut();
    } else if (getUrlParameter('offer') == 'error') {
        $(".status").append("<span class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Ha ocurrido un error. Inténtalo más tarde </span>").delay(3000).fadeOut();
    }

    // Redirección al registrarte. Obtiene si se ha registrado un usuario o empresa y realiza algunos efectos to guapos.
    if (getUrlParameter('register')) {
        $(".status").append("<span class='alert alert-success'><span class='glyphicon glyphicon-ok-circle'></span> ¡Registro completado! Ahora inicia sesión con tus datos</span>").delay(4000).fadeOut("slow");
        if (getUrlParameter('register') == 'user') {
            $("#user").prop( "checked", true );
        } else if(getUrlParameter('register') == 'company') {
            $("#company").prop( "checked", true );
        }
    }


    $(".tipoact").change(function() {
        var tipo_actividad = $('input[name=tipo_actividad]:checked', '#myform').val()
        /* Petición ajax que envía el tipo de actividad marcado */

        $.post("php/filter.php", {tipo_actividad: tipo_actividad}, function (data) { // Le pasamos el tipo de actividad, que es lo que se procesará en servidor
            $(".tabla").empty();
            data = $.parseJSON(data);
            /* Bloque de comprobación de disponibilidad de ofertas */
            if (data.length === 0) {
                $("#no_offers").remove();
                $(".offers").append("<div id='no_offers'><span class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>");
                $("#cargar").hide();
            } else {
                $("#cargar").show();
                $("#no_offers").remove();
                for (var i = 0; i <= data.length-1; i++) {
                    //console.log(data[i]);
                    $(".tabla").append("<div class='col-lg-4 actividad'>" +
                        "<figure class='snip1208'>"+
                        "<img src='img/oferta/"+data[i].imagen_oferta+"' alt='sample66'/>"+

                        "<figcaption>"+
                        "<h3 id='nombre'>"+data[i].nombre+"</h3>"+


                        "<p id='actividad'>" + data[i].tipo_actividad + "</p>" +
                        "<p id='provincia'>" + data[i].provincia + "</p>" +
                        "<p id='dificultad'>" + data[i].dificultad + "</p>" +
                        "<p id='precio'>" + data[i].precio + "€</p>"+
                        "<button>Ver actividad</button>"+
                        "</figcaption><a href='content/oferta.php?id="+data[i].id+"'></a>"+
                        "</figure></div>");
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
                $("#no_offers").remove();
                $(".offers").append("<div id='no_offers'><span class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>");
                $("#cargar").hide();
            } else {
                $("#cargar").show();
                $("#no_offers").remove();
                for (var i = 0; i <= data.length - 1; i++) {
                    $(".tabla").append("<div class='col-lg-4 actividad'>" +
                        "<figure class='snip1208'>" +
                        "<img src='img/oferta/" + data[i].imagen_oferta + "' alt='sample66'/>" +
                        "<figcaption>" +
                        "<h3 id='nombre'>" + data[i].nombre + "</h3>" +
                        "<p id='actividad'>" + data[i].tipo_actividad + "</p>" +
                        "<p id='provincia'>" + data[i].provincia + "</p>" +
                        "<p id='dificultad'>" + data[i].dificultad + "</p>" +
                        "<p id='precio'>" + data[i].precio + "€</p>" +
                        "<button>Ver actividad</button>" +
                        "</figcaption><a href='content/oferta.php?id=" + data[i].id + "'></a>" +
                        "</figure></div>");
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
                    $("#no_offers").remove();
                    $(".offers").append("<div id='no_offers'><span class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>");
                    $("#cargar").hide();
                } else {
                    $("#cargar").show();
                    $("#no_offers").remove();
                    for (var i = 0; i <= data.length - 1; i++) {
                        $(".tabla").append("<div class='col-lg-4 actividad'>" +
                            "<figure class='snip1208'>" +
                            "<img src='img/oferta/" + data[i].imagen_oferta + "' alt='sample66'/>" +
                            "<figcaption>" +
                            "<h3 id='nombre'>" + data[i].nombre + "</h3>" +
                            "<p id='actividad'>" + data[i].tipo_actividad + "</p>" +
                            "<p id='provincia'>" + data[i].provincia + "</p>" +
                            "<p id='dificultad'>" + data[i].dificultad + "</p>" +
                            "<p id='precio'>" + data[i].precio + "€</p>" +
                            "<button>Ver actividad</button>" +
                            "</figcaption><a href='content/oferta.php?id=" + data[i].id + "'></a>" +
                            "</figure></div>");
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
                    $("#no_offers").remove();
                    $(".offers").append("<div id='no_offers'><span class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>");
                    $("#cargar").hide();
                } else {
                    $("#cargar").show();
                    $("#no_offers").remove();
                    for (var i = 0; i <= data.length - 1; i++) {
                        $(".tabla").append("<div class='col-lg-4 actividad'>" +
                            "<figure class='snip1208'>" +
                            "<img src='img/oferta/" + data[i].imagen_oferta + "' alt='sample66'/>" +
                            "<figcaption>" +
                            "<h3 id='nombre'>" + data[i].nombre + "</h3>" +
                            "<p id='actividad'>" + data[i].tipo_actividad + "</p>" +
                            "<p id='provincia'>" + data[i].provincia + "</p>" +
                            "<p id='dificultad'>" + data[i].dificultad + "</p>" +
                            "<p id='precio'>" + data[i].precio + "€</p>" +
                            "<button>Ver actividad</button>" +
                            "</figcaption><a href='content/oferta.php?id=" + data[i].id + "'></a>" +
                            "</figure></div>");
                    }
                }
            });
        }
    });
    /* Petición ajax que se lanza cuando se pulsa "Quitar filtros" */
    $("#quitarfiltros").click(function(e) {
        e.preventDefault();
        var desactivar = 'desactivar';
        $.post("php/filter.php", {desactivar: desactivar}, function (data) { // Le pasamos el precio, que es lo que se procesará en servidor
            $(".tabla").empty();
            data = $.parseJSON(data);
            /* Bloque de comprobación de disponibilidad de ofertas */
            if (data.length === 0) {
                $("#no_offers").remove();
                $(".offers").append("<div id='no_offers'><span class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No hay ofertas disponibles con el filtro seleccionado</span></div>");
                $("#cargar").hide();
            } else {
                $("#cargar").show();
                $("#no_offers").remove();
                for (var i = 0; i <= data.length - 1; i++) {
                    $(".tabla").append("<div class='col-lg-4 actividad'>" +
                        "<figure class='snip1208'>" +
                        "<img src='img/oferta/" + data[i].imagen_oferta + "' alt='sample66'/>" +
                        "<figcaption>" +
                        "<h3 id='nombre'>" + data[i].nombre + "</h3>" +
                        "<p id='actividad'>" + data[i].tipo_actividad + "</p>" +
                        "<p id='provincia'>" + data[i].provincia + "</p>" +
                        "<p id='dificultad'>" + data[i].dificultad + "</p>" +
                        "<p id='precio'>" + data[i].precio + "€</p>" +
                        "<button>Ver actividad</button>" +
                        "</figcaption><a href='content/oferta.php?id=" + data[i].id + "'></a>" +
                        "</figure></div>");
                }
            }
        });
    });


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
                        msginfo.html("<p>El usuario o contraseñas son incorrectos. <a href='contacto.php'>¿Has olvidado tu contraseña?</a></p>");
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

    /* Implementación de sistema de puntuación y reseña por ajax */
    $("#rating").click(function(e) {
        e.preventDefault();
        var starselected = $('input[name=rating]:checked', '#form-rating').val();
        var rating_text = $("#rating-text").val();
        var input_nif_usuario = $("#input_nif").val();
        var input_id_oferta = $("#input_id_oferta").val();

        $.post("../php/rating.php", {starselected: starselected, rating_text: rating_text, input_nif_usuario: input_nif_usuario, input_id_oferta: input_id_oferta}, function (data) {
            $("#puntuacion").empty();
            if (data == 0) {
                /* En caso de que los datos sean correctos... */
                $(".status").append("<span class='alert alert-success'>¡Muchas gracias por tu opinión!</span>").delay(3000).fadeOut();
            } else {
                /* En caso de algún error... */
                $(".status").append("<span class='alert alert-danger'>Ha ocurrido un error inesperado, ¡inténtalo más tarde!</span>").delay(3000).fadeOut("slow");
            }
        });
    });

    /*
    *
    * Perfil.php
    *
     */

    /* Botones de edición de perfil.php. */
    $("#editperfil").click(function () {
        if ($("#editperfil").text() === 'Cancelar') { // Cuando se está editando se convierte en cancelar, que cancela los cambios
            window.location.reload();
        } else {
            $("#editperfil").text("Cancelar");
            $(".perfil").removeAttr("disabled");
            $("#saveperfil").removeAttr("disabled");
        }
    });
    $("#editconfig").click(function () {
        if ($("#editconfig").text() === 'Cancelar') { // Cuando se está editando se convierte en cancelar, que cancela los cambios
            window.location.reload();
        } else {
            $("#editconfig").text("Cancelar");
            $(".config").removeAttr("disabled");
            $("#saveconfig").removeAttr("disabled");
        }
    });

    /* ---------------------------------------------------------------------------------------------------- */
    /*Toogle de seguir leyendo, vista acerca de  */




});


