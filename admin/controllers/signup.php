<?php  
include("init.php");

$dataFrom = $_REQUEST;
if (!$cmn->verifMail($dataFrom["email"])) {
    echo "Le format du mail est incorrecte";
}else {
    $verif = $adm->isMailAvailableAdmin($dataFrom["email"]);
    if ($verif !=0) {
        echo "mail déja utilisé";
    } else {
        $create = $adm->addAdmin($dataFrom);
        echo "Votre compte a été crée , BRAVO !!!!!!!!!!!";
    }

}

include("close.php");
?>