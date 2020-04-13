<?php 
include("init.php");

$dataForm = $_REQUEST;
$create = $usr->editInfoUser($dataForm);

if ($create == "pseudo") {
    echo "pseudo déja utilisé";
} elseif ($create == "oui") {
    echo "Vos informations ont été modifiées avec succès";
}

include("close.php");
?>