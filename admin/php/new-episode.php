<?php
    if(!isset($_GET["serie"])){
        header("location:?p=series");
    }
    $param = array("vid_id"=>$_GET["serie"]);
    $media = $db->sqlSingleResult("SELECT * FROM ".TABLE_VID." WHERE vid_id = ?", $param);
    if($media->vid_iSta==2 || $media->vid_sType!="Série"){
        header("location:?p=series");
    }

    $saisons = $db->sqlManyResults("SELECT * FROM ".TABLE_SAN." WHERE vid_id = ? AND san_iSta = 1 ORDER BY san_iNumero DESC", $param);
?>