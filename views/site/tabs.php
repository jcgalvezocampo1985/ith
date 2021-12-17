<table border="1">
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
        for($i = 0; $i < count($valores); $i++):
        ?>
        <tr>
            <td><?= $valores[$i]."-".$valores1[$i] ?></td>
            <td><input type="text" name="valor[]" id="valor1-<?= $valores[$i] ?>" class="valor" /></td>
            <td><input type="text" name="valor[]" id="valor2-<?= $valores[$i] ?>" class="valor" /></td>
            <td><input type="text" name="valor[]" id="valor3-<?= $valores[$i] ?>" class="valor" /></td>
        </tr>
        <?php endfor;?>
    </tbody>
</table>


<?php
$this->registerJs('$(document).ready(function(){
    $(".valor1:first").focus();
    //alert($(this).attr("id"));
});
$(document).keydown(function(objEvent) {
    if (objEvent.keyCode == 9) {  //tab pressed
        objEvent.preventDefault(); // stops its action
        
        var id = $(".valor").attr("id");
        var hasFocus = $(".valor").is(":focus");
        alert(id);
    }
})
');
?>