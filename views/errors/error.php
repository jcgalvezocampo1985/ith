<?php
if($msg){
    if($error == 1){
        $alert = "success";
    }else if($error == 2){
        $alert = "warning";
    }else if($error == 3){
        $alert = "danger";
    }else{
        $alert = "";
    }
?>
<div id="mensaje">
    <div class="alert alert-<?= $alert ?>" role="<?= $alert ?>">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Mensaje:</span>
        <?= $msg ?>
    </div>
</div>    
<?php } ?>
<?php
$this->registerJs('$(document).ready(function(){
    $("#mensaje").slideDown(1000).delay(4000).slideUp(1000);
})');
?>