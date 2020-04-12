<?php 
include("init.php");

$recup = $db->sqlManyResults("SELECT * FROM ".TABLE_VID." WHERE vid_sType = ?",array("vid_sType"=>$_GET["type"]));

 if($_GET["type"] == "Film"){
    echo '<optgroup label="Les titres des films de A - Z">';
 }
 else {
    echo '<optgroup label="Les titres des séries de A - Z">';
 }

 foreach($recup AS $s){
    echo "<option value='".$s->vid_id."'>".$s->vid_sTitre."</option>";
 }
 echo '</optgroup>';
include("close.php");
?>