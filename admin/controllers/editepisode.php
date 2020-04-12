<?php
include("init.php");

$dataForm = $_REQUEST;
//1Mo = 1000 ko  ---- 750Mo = 750000 ko

if(is_numeric($dataForm["numero"])){
    
    if($dataForm["numero"]==0){
        echo "Le numero d'un épisode commence par 1";
    }
    else {
        $edit = $med->editEpisode($dataForm);
        echo "ok";
    }
}
else {
    echo "Mettez un numéro valide";
}


include("close.php");
?>