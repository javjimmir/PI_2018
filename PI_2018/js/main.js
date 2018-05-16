/* Precarga de funciones para el filtro de precio */
function changeInputValue(val){
    document.getElementById("number").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
}
function changeRangeValue(val){
    document.getElementById("range").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
}
$(document).ready(function () {
    // Intento de petición ajax
    $("#range").change(function() {
        var precio = $("#number").val();
        var count = 0;
        $.post("php/filter.php", {precio: precio, count: count}, function (data) {
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
                    "<p id='precio'>" + data[i].precio + "</p></div></div>");
            }
        });
    })
})