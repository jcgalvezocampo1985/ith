<?php
$this->registerJs('
    $("#agregar-alumnos").on("click", function(e){
        e.preventDefault();
        let datos = $("#datos-alumnos").serialize();
        let idestudiante = $("#idestudiante").val();
        let url = $(this).prop("href");
/*         tabla = $("#tabla-estudiantes");
        tr = $("tr:last", tabla);
        tr.clone(true).appendTo(tabla);
        $("tr:last td:first").html(idestudiante);
        $("tr:last td:last(1)").html(idestudiante); */
        
        $.ajax({
            url: url,
            type: "POST",
            data: datos,
            dataType: "JSON",
            success: function(data){
                if(data.resultado == 1){
                    $("#idestudiante option:selected").remove();
                    $("#tabla-estudiantes>tbody").append("<tr><td>"+data.idestudiante+"</td><td>"+data.nombre+"</td><td></td></tr>");
                    $("#idestudiante, #idopcioncurso").val("");
                }else{
                    alert("Error");
                }
            }
        });
    });
');
?>