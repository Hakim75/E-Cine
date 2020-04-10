<?php  
include("init.php");

$dataForm = $_REQUEST;

$verif = $too->isCategorieAvailable($dataForm["lib"]);
if ($verif !=0) {
    echo "Cette catégorie est déjà enregistrée";
} else {
    $create = $too->addCategories($dataForm);
    echo "ok";
}

include("close.php");
?>