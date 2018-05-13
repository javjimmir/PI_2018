$(document).ready(function () {
    $('form').submit(function(e) {
        e.preventDefault();
        var tipo_actividad = $('input[name=tipo_actividad]:checked', '#myform').val()
        $.post("php/filter.php", {tipo_actividad: tipo_actividad}, function (data) {
            data = $.parseJSON(data);

            for (var i = 0; i <= 3; i++) {
                console.log(data[i].nombre);
            }
        });
    })
})