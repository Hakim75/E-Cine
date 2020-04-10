<?php 
include("init.php");

$dataForm = $_REQUEST;

$login = $adm->loginAdmin($dataForm);
if ($login) {
    echo "Connexion réussie";

}else {
    echo "Identifiant ou mot de passe incorrect";
}

include("close.php");
?>