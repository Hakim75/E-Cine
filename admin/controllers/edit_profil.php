<?php 

include("init.php");

$dataForm = $_REQUEST;
if (!$cmn->verifMail($dataForm["email"])) {
    echo "Le format de votre mail est incorrect" ;
} else {

    $create = $usr->editInfoUser($dataForm);
    
     if ($create == "email") {
         echo "mail déja utilisé";
        
     } elseif ($create == "pseudo") {

         echo "pseudo déja utilisé";

     } elseif ($create == "oui") {
         echo "Vos informations ont été modifiées avec succès";
     }
}






include("close.php");




?>