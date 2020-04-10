<?php  
include("init.php");

$dataForm = $_REQUEST;
if (!$cmn->verifMail($dataForm["email"])) {
    echo "Le format du mail est incorrecte";
}else {
    $verif = $adm->isMailAvailableAdmin($dataForm["email"]);
    if ($verif !=0) {
        echo "mail déja utilisé";
    } else {
        $create = $adm->addAdmin($dataForm);
        echo "Votre compte a été crée , BRAVO !!!!!!!!!!!";
    }

}

include("close.php");
?>