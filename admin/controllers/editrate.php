<?php 

include("init.php");

$dataForm = $_REQUEST;
if(!floatval($dataForm["prix"])){
    echo "Le prix doit contenir une valeur numérique";
}
else{

    $edit = $too->editRate($dataForm);
    if (!$edit) {
        echo "Ce plan tarifaire est déjà enregistré";
    } else {
        echo "ok";
    }
}

include("close.php");

?>