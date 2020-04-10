<?php  
include("init.php");

$dataForm = $_REQUEST;

if(!floatval($dataForm["prix"])){
    echo "Le prix doit contenir une valeur numérique";
}
else{
    $verif = $too->isRateAvailable($dataForm["lib"]);
    if ($verif !=0) {
        echo "Ce plan tarifaire est déjà enregistré";
    } else {
        $create = $too->addRate($dataForm);
        echo "ok";
    }
}

include("close.php");
?>