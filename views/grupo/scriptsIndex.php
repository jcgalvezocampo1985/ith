<?php
$this->registerJs('
    $(".idgrupo").on("click", function(e) {
        e.preventDefault();

        var valor = $(this).attr("href");
        var url = valor.split("=")[0];
        var idgrupo = valor.split("=")[1];
        var idcarrera = valor.split("=")[2];

        $.ajax({
            url: url,
            type: "GET",
            data: {
                "idgrupo": idgrupo,
                "idcarrera": idcarrera
            },
            beforeSend: function() {
                $("#lista_alumnos").empty();
            },
            success: function(respuesta) {
                $("#lista_alumnos").html(respuesta);
            }
        });
    });
');
?>