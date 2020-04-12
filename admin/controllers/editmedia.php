<?php
include("init.php");

$dataForm = $_REQUEST;
//1Mo = 1000 ko  ---- 750Mo = 750000 ko

if($_FILES["poster"]["name"] != ""){
    if(!$cmn->sizeImage($_FILES["poster"],1000)){
        echo "La taille de l'image ne doit pas dépasser 1M";
    } else{
        $edit = $med->editMedia($dataForm);
        if($edit == "poster"){
            echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
        }else{
            echo "ok";
        }   
    }
}
else {
    $edit = $med->editMedia($dataForm);
    if($edit == "poster"){
        echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
    }else{
        echo "ok";
    }   
}



include("close.php");
?>