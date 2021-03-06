<?php 

if(!isset($_GET["rate"])){
    header("location:?p=subscription");
}

$wait = $db->sqlSingleResult("SELECT * FROM ".TABLE_JAB." jab
    INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
    INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
    WHERE jab.jab_iSta=? AND jab.usr_id=?",
    array("jab_iSta"=>0,"usr_id"=>$_SESSION["usr"]));

$current = $db->sqlSingleResult("SELECT * FROM ".TABLE_JAB." jab
    INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
    INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
    WHERE jab.jab_iSta=? AND jab.jab_dDateFin>=? AND jab.usr_id=?",
    array("jab_iSta"=>1,"jab_dDateFin"=>date("Y-m-d"),"usr_id"=>$_SESSION["usr"]));

if($wait || $current){
    header("location:?p=account");
}

$rate = $db->sqlSingleResult("SELECT * FROM ".TABLE_PTA." WHERE pta_id = ?",array("pta_id"=>$_GET["rate"]));
if(!$rate){
    header("location:?p=subscription");
}
?>