<?php 
include("init.php");

$recup = $db->sqlSingleResult("SELECT * FROM ".TABLE_VID." WHERE vid_id = ?",array("vid_id"=>$_GET["id"]));
echo $recup->vid_sReal."-/-".$cmn->affDateFrNum($recup->vid_dDateSort);

include("close.php");
?>