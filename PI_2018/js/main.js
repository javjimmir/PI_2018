/* Precarga de funciones para el filtro de precio */
function changeInputValue(val){
    document.getElementById("number").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
}
function changeRangeValue(val){
    document.getElementById("range").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
}

$(document).ready(function () {
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

    /* Implementación de login por ajax */

    $("#validar").click(function (e) {
        e.preventDefault();
        // Se haga petición ajax
        var username = $("#alias").val();
        var password = $("#password").val();
        var tiposesion = $('input[name=tiposesion]:checked', '#form-sesion').val();

        // HAY QUE VALIDAR QUE SE INTRODUCEN LOS DATOS, YA QUE DE MOMENTO SE PUEDE PULSAR EL BOTÓN DE SUBMIT Y HACER INFINITOS POST.!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        $.post("../php/success.php", {username: username, password: password, tiposesion: tiposesion}, function (data) { // Le pasamos el precio, que es lo que se procesará en servidor
            data = $.parseJSON(data);
            console.log(data);
            if (data === 0) {
                // Datos correctos. Añadir algún efecto de loading o algo interesante...
                setTimeout(function () {
                    window.location.replace("../index.php");
                }, 3000);
            } else {
                alert("Datos incorrectos");
            }


            // Aquí se añadirá el mensaje de error si los datos son incorrectos, o será redirigido al index.php si es correcto.

        });
    })
});