<?php

include("init.php");

$dataForm = $_REQUEST;
$pass = $usr->changePassUser($dataForm);
if (!$pass) {
    echo "Ancien mot de passe incorrect";

}else {
    echo "Votre mot de passe a été modifié avec succès";
}

include("close.php");

?>