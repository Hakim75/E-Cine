<?php 
include("init.php");

$recup = $db->sqlManyResults("SELECT * FROM ".TABLE_EPI." WHERE san_id = ?",array("san_id"=>$_GET["s"]));

 foreach($recup AS $e){
    echo '<a href="?p=player&serie='.$e->epi_id.'"><b><i class="fas fa-play-circle"></i> épisode '.$e->epi_iNum.' :</b> '.$e->epi_sTitre.'</a>';
 }

include("close.php");
?>