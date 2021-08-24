$(".idgrupo").on("click", function(e) {
    e.preventDefault();

    var id = $(this).attr("href");

    $.ajax({
        url: "http://localhost/ithuimanguillo/web/profesor/listaalumnos?idgrupo=" + id,
        type: "GET",
        //data: "idgrupo=" + id,
        success: function(respuesta) {
            $('#lista_alumnos').html(respuesta);
        }
    });
});