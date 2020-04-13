<?php  
include("init.php");

$dataForm = $_REQUEST;
if (!$cmn->verifMail($dataForm["email"])) {
    echo "Le format de votre mail est incorrecte";
}else {
    $create = $usr->createUser($dataForm);
    if ($create == "email") {
        echo "mail déja utilisé";
        
    } elseif ($create == "pseudo") {

        echo "pseudo déja utilisé";

    } elseif ($create == "oui") {
        echo "Votre compte a été crée , BRAVO !!!!!!!!!!!";
    }

}

include("close.php");
?>