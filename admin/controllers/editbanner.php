<?php
include("init.php");

$dataForm = $_REQUEST;
//1Mo = 1000 ko  ---- 750Mo = 750000 ko

if($_FILES["banniere"]["name"] != ""){
    if(!$cmn->sizeImage($_FILES["banniere"],1000)){
        echo "La taille de l'image ne doit pas dépasser 1M";
    } else{
        $update = $act->editbanner($dataForm);
        if(!$add){
            echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
        }else{
            echo "ok";
        }
    }
}
else{
    $update = $act->editbanner($dataForm);
    if(!$update){
        echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
    }else{
        echo "ok";
    }
}

include("close.php");
?>