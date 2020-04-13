<?php 

include("init.php");

$dataForm = $_REQUEST;

$login = $usr->loginUser($dataForm["login"],$dataForm["pass"]);
if ($login) {
    echo "Connexion réussie";

}else {
    echo "Identifiant ou mot de passe incorrects";
}

include("close.php");

?>