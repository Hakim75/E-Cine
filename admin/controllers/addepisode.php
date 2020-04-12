<?php
include("init.php");

$dataForm = $_REQUEST;
//1Mo = 1000 ko  ---- 750Mo = 750000 ko

if(is_numeric($dataForm["numero"])){
    
    if($dataForm["numero"]==0){
        echo "Le numero d'un épisode commence par 1";
    }
    else {
        if(!$cmn->sizeImage($_FILES["film"],750000)){
            echo "La taille de la vidéo ne doit pas dépasser 750M";
        }
        else{
            $add = $med->addEpisode($dataForm);
            if($add == "film"){
                echo "Les formats de vidéo autorisés sont .mp4, .webm, .ogg";
            }else{
                echo $add;
            }
        }
    }
}
else {
    echo "Mettez un numéro valide";
}


include("close.php");
?>