<?php
if (!isset($_GET["vid"])) {
    header("location : ?p=dashboard");
}
$current = $db->sqlSingleResult("SELECT * FROM ".TABLE_JAB." jab
     INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
     INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
     WHERE jab.jab_iSta=? AND jab.jab_dDateFin>=? AND jab.usr_id=?",
     array("jab_iSta"=>1,"jab_dDateFin"=>date("Y-m-d"),"usr_id"=>$_SESSION["usr"]));

     if(!$current) {
         header("location :?p=subscription");
     }
     $m = $db->sqlSingleResult("SELECT * FROM ".TABLE_VID."
     WHERE vid_id=?", array("vid_id"=>$_GET["vid"]));
     if (!$m) {
        header("location : ?p=dashboard");
    }
     $preferences = $db->sqlSingleResult("SELECT * FROM ".TABLE_JPR." jpr
     INNER JOIN ".TABLE_VID." vid ON vid.vid_id=jpr.vid_id
     WHERE jpr.usr_id",
     array("usr_id"=>$_SESSION['usr']));

     $listeCategoties = $db->sqlManyResults("SELECT * FROM
     ".TABLE_VIC." vic INNER JOIN ".TABLE_CAT." cat ON
     cat.cat_id=vic.cat_id WHERE vic.vid_id =
     ?",array("vid_id"=>$m->vid_id));

     if($m->vid_sType == "Série") { 
         $saison=$db->sqlManyResults("SELECT * FROM " . TABLE_SAN . " WHERE vid_id=?", array("vid_id"=>$m->vid_id));
      }
?>

