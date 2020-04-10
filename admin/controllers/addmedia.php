<?php
include("init.php");

$dataForm = $_REQUEST;
//1Mo = 1000 ko  ---- 750Mo = 750000 ko
if(!$cmn->sizeImage($_FILES["poster"],1000)){
    echo "La taille de l'image ne doit pas dépasser 1M";
} else{
    if($_FILES["film"]["name"] != ""){
        if(!$cmn->sizeImage($_FILES["film"],750000)){
            echo "La taille de la vidéo ne doit pas dépasser 750M";
        }
        else{
            $add = $med->addMedia($dataForm);
            if($add == "poster"){
                echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
            }else if($add == "film"){
                echo "Les formats de vidéo autorisés sont .mp4, .webm, .ogg";
            }else{
                echo $add;
            }
        }
    }
    else {
        $add = $med->addMedia($dataForm);
        if($add == "poster"){
            echo "Les formats de l'image autorisés sont .jpg, .jpeg, .png";
        }else{
            echo $add;
        }
    }
}


include("close.php");
?>