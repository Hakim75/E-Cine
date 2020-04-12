<?php 

include("init.php");

$dataForm = $_REQUEST;
$update = $adm->editProfil($dataForm);

if (!$update) {
    echo "pseudo déja utilisé";

} else {
    echo "Vos informations ont été modifiées avec succès";
}

include("close.php");

?>