<?php 

include("init.php");

$dataForm = $_REQUEST;
$edit = $too->editCategories($dataForm);
if (!$edit) {
    echo "Cette catégorie est déjà enregistrée";
} else {
    echo "ok";
}

include("close.php");

?>