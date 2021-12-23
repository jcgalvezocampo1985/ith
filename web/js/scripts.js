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
    e.preventDefault;
    location.reload();
});

$("#buscar_materia").on("click", function(e) {
    e.preventDefault();

    var desc_materia = $("#desc_materia").val();

    var valor_url = $(this).attr("href");
    var url = valor_url.split("?")[0];
    var variables = valor_url.split("?")[1];

    var var_idestudiante = variables.split("&")[0];
    var idestudiante = var_idestudiante.split("=")[1];

    var var_idciclo = variables.split("&")[1];
    var idciclo = var_idciclo.split("=")[1];

    var var_idcarrera = variables.split("&")[2];
    var idcarrera = var_idcarrera.split("=")[1];

    $.ajax({
        url: url,
        type: "GET",
        data: {
            "idestudiante": idestudiante,
            "idciclo": idciclo,
            "idcarrera": idcarrera,
            "desc_materia": desc_materia
        },
        beforeSend: function() {
            $('#alumno_horario_agregar').empty();
        },
        success: function(data) {
            $('#alumno_horario_agregar').html(data);
        }
    });
});

$("#refrecar_lista_materia").on("click", function(e) {
    e.preventDefault();

    var desc_materia = $("#desc_materia").val("");

    var valor_url = $(this).attr("href");
    var url = valor_url.split("?")[0];
    var variables = valor_url.split("?")[1];

    var var_idestudiante = variables.split("&")[0];
    var idestudiante = var_idestudiante.split("=")[1];

    var var_idciclo = variables.split("&")[1];
    var idciclo = var_idciclo.split("=")[1];

    var var_idcarrera = variables.split("&")[2];
    var idcarrera = var_idcarrera.split("=")[1];

    $.ajax({
        url: url,
        type: "GET",
        data: {
            "idestudiante": idestudiante,
            "idciclo": idciclo,
            "idcarrera": idcarrera
        },
        beforeSend: function() {
            $('#alumno_horario_agregar').empty();
        },
        success: function(data) {
            $('#alumno_horario_agregar').html(data);
        }
    });
});