<?php  
include("init.php");

$dataFrom = $_REQUEST;

$verif = $too->isCategorieAvailable($dataFrom["lib"]);
if ($verif !=0) {
    echo "Cette catégorie est déjà enregistrée";
} else {
    $create = $too->addCategories($dataFrom);
    echo "ok";
}

include("close.php");
?>