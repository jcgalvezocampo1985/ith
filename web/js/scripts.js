$(".idgrupo").on("click", function(e) {
    e.preventDefault();

    var valor = $(this).attr("href");
    var url = valor.split('=')[0];
    var id = valor.split('=')[1];

    $.ajax({
        url: url,
        type: "GET",
        data: "idgrupo=" + id,
        success: function(respuesta) {
            $('#lista_alumnos').html(respuesta);
        }
    });
});