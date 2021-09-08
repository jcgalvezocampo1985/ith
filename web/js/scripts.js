$(".idgrupo").on("click", function(e) {
    e.preventDefault();

    var idciclo1 = $("#ciclosearch-idciclo").val();
    var idciclo2 = $("#cicloprofesorsearch-idciclo").val();
    var idciclo = (idciclo1 === undefined) ? idciclo2 : idciclo1;
    var valor = $(this).attr("href");
    var url = valor.split('=')[0];
    var idgrupo = valor.split('=')[1];

    $.ajax({
        url: url,
        type: "GET",
        data: {
            "idgrupo": idgrupo,
            "idciclo": idciclo
        },
        beforeSend: function() {
            $('#lista_alumnos').empty();
        },
        //data: "idgrupo=" + id + "&idciclo=" + idciclo,
        success: function(respuesta) {
            $('#lista_alumnos').html(respuesta);
        }
    });
});

$(".eliminar_materia").on("click", function(e) {
    e.preventDefault();

    var url = $(this).attr("href");

    if (confirm("¿Eliminar registro?")) {
        $(location).attr('href', url)
    }
});

$("#horario_agregar").on("click", function(e) {
    e.preventDefault();

    var valor_url = $(this).attr("href");
    var url = valor_url.split('=')[0];
    var idestudiante = valor_url.split('=')[1];
    var idciclo = valor_url.split('=')[2];
    var idcarrera = valor_url.split('=')[3];

    $.ajax({
        url: url,
        type: "GET",
        data: {
            "idcarrera": idcarrera,
            "idestudiante": idestudiante,
            "idciclo": idciclo
        },
        beforeSend: function() {
            $('#alumno_horario_agregar').empty();
        },
        success: function(respuesta) {
            $('#alumno_horario_agregar').html(respuesta);
        }
    });
});
$('#materias').on('hidden.bs.modal', function(e) {
    location.reload();
});
/*
$(".agregar_materia").on("click", function(e) {
    e.preventDefault();

    var url = $(this).attr("href");
    var fila = $(this).attr("id");
    var numero = fila.split('-')[1];

    var idopcion_curso = $("#idopcion_curso-" + numero).val();
    var idestudiante = $("#idestudiante").val();
    var idciclo = $("#idciclo").val();
    var idgrupo = $("#idgrupo-" + numero).val();

    if (idopcion_curso !== "") {
        $.ajax({
            url: url,
            type: "GET",
            data: {
                "idgrupo": idgrupo,
                "idopcion_curso": idopcion_curso,
                "idestudiante": idestudiante,
                "idciclo": idciclo
            },
            beforeSend: function() {

            },
            success: function(data) {
                if (data === 1) {
                    $("tr#fila-" + numero).remove();
                }
            }
        });
    } else {
        alert("Selecciona la opción del curso");
    }
});*/