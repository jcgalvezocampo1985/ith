$(".idgrupo").on("click", function(e) {
    e.preventDefault();

    var idciclo = $("#ciclosearch-idciclo").val();
    var valor = $(this).attr("href");
    var url = valor.split('=')[0];
    var id = valor.split('=')[1];

    $.ajax({
        url: url + "?idgrupo=" + id + "&idciclo=" + idciclo,
        type: "GET",
        beforeSend: function() {
            $('#lista_alumnos').empty();
        },
        //data: "idgrupo=" + id + "&idciclo=" + idciclo,
        success: function(respuesta) {
            $('#lista_alumnos').html(respuesta);
        }
    });
});