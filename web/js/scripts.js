$(".idgrupo").on("click", function(e) {
    e.preventDefault();

    var id = $(this).attr("href");

    $.ajax({
        url: "/profesor/listaalumnos/",
        type: "GET",
        data: "idgrupo=" + id,
        success: function(respuesta) {
            $('#lista_alumnos').html(respuesta);
        }
    });
});