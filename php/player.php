<?php
$current = $db->sqlSingleResult("SELECT * FROM ".TABLE_JAB." jab
INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
WHERE jab.jab_iSta=? AND jab.jab_dDateFin>=? AND jab.usr_id=?",
array("jab_iSta"=>1,"jab_dDateFin"=>date("Y-m-d"),"usr_id"=>$_SESSION["usr"]));

if(!$current) {
    header("location :?p=subscription");
} 
if (!isset($_GET["movie"])) {
    if (!isset($_GET["serie"])) {
        header("location : ?p=dashboard");
    } else {
        $e = $db->sqlSingleResult("SELECT * FROM ".TABLE_EPI." epi
        INNER JOIN ". TABLE_SAN ." san ON san.san_id=epi.san_id
        INNER JOIN ". TABLE_VID ." vid ON vid.vid_id=san.vid_id
        WHERE epi.epi_id=?", array("epi_id"=>$_GET["serie"]));
        $video = $e->epi_sVideo;
        $banniere = $e->vid_sPoster;
        $param = array("jvv_dDate"=>date("Y-m-d"), "vid_id"=>$e->vid_id, "usr_id"=>$_SESSION["usr"]);
        $db->sqlSimpleQuery("INSERT INTO ".TABLE_JVV."(jvv_dDate, vid_id, usr_id) VALUES(?,?,?)", $param);
        if (!$e) {
           header("location : ?p=dashboard");
       }  
    }
} else {
    $m = $db->sqlSingleResult("SELECT * FROM ".TABLE_VID."
    WHERE vid_id=?", array("vid_id"=>$_GET["movie"]));
    $video = $m->vid_sVideo;
    $banniere = $m->vid_sPoster;
    $param = array("jvv_dDate"=>date("Y-m-d"), "vid_id"=>$m->vid_id, "usr_id"=>$_SESSION["usr"]);
    $db->sqlSimpleQuery("INSERT INTO ".TABLE_JVV."(jvv_dDate, vid_id, usr_id) VALUES(?,?,?)", $param);
    if (!$m) {
       header("location : ?p=dashboard");
   }  
}

?>

