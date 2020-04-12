<?php
include("init.php");

$dataForm = $_REQUEST;
//1Mo = 1000 ko  ---- 750Mo = 750000 ko
if(!$cmn->sizeImage($_FILES["banniere"],1000)){
    echo "La taille de l'image ne doit pas dépasser 1M";
} else{
    $add = $act->addbanner($dataForm);
    if(!$add){
        echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
    }else{
        echo "ok";
    }
}

include("close.php");
?>