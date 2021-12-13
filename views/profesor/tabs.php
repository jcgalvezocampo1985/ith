<table border="1" id="tabla">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>C1</th>
            <th>C2</th>
            <th>C3</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $valores = ["1000", "1001", "1002"];
        $valores1 = ["juan", "pedro", "carlos"];
        $j = 1;
        for($i = 0; $i < count($valores); $i++):
        ?>
        <tr>
            <td><input type="text" name="idestudiante[]" id="idestudiante<?= $j ?>" value="<?= $valores[$i] ?>" /></td>
            <td><input type="text" name="valor[]" id="valor1<?= $valores[$i] ?>" class="valor1" /></td>
            <td><input type="text" name="valor[]" id="valor2<?= $valores[$i] ?>" class="valor2" /></td>
            <td><input type="text" name="valor[]" id="valor3<?= $valores[$i] ?>" class="valor3" /></td>
        </tr>
        <?php
        $j++;
        endfor;
        ?>
    </tbody>
</table>

<?php
$this->registerJs('
$(document).ready(function(){
    /*let nFilas = $("#tabla tbody tr").length;
    let nColumnas = $("#tabla tr:last td").length;
    let id = 1;
    for(i = 2; i <= nColumnas; i++)
    {
        let idestudiante = $("#idestudiante" + id).val();
        for(j = 1; j <= nFilas; j++)
        {
            let valor = $("#valor" + j + idestudiante).val();//Obtiene el valor de todos los campos de calificaciones
            let hasFocus = $("#valor" + j + "-" + idestudiante).is(":focus");
            if(hasFocus)
            {
                alert(valor);
                //$(".valor1:eq(j+1)").focus();
            }
        }
        id = id + 1;
    }*/
});

$(document).keydown(function(objEvent) {
    if (objEvent.keyCode == 9) {  //tab pressed
        objEvent.preventDefault(); // stops its action
        let nFilas = $("#tabla tbody tr").length;
        let nColumnas = $("#tabla tr:last td").length;
        let id = 1;

        for(i = 2; i <= nColumnas; i++)
        {
            let idestudiante = $("#idestudiante" + id).val();
            for(j = 1; j <= nFilas; j++)
            {
                let valor = $("#valor" + j + idestudiante).val();//Obtiene el valor de todos los campos de calificaciones
                let hasFocus = $("#valor" + j + idestudiante).is(":focus");

                if(hasFocus)
                {
                    $(".valor1:eq(1)").focus();
                }
            }
            id = id + 1;
        }
    }
})
');
?>