<?php

include("init.php");

$dataForm = $_REQUEST;
$pass = $adm->changePassVerif($dataForm["apass"]);
if (!$pass) {
    echo "Ancien mot de passe incorrect";

}else {
    $update = $adm->changePass($dataForm["npass"]);
    echo "Votre mot de passe a été modifié avec succès";
}

include("close.php");
?>