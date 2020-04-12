<?php
    if(!isset($_GET["id"])){
        header("location:?p=new-media");
    }

    $media = $db->sqlSingleResult("SELECT * FROM ".TABLE_VID." WHERE vid_id = ?", array("vid_id"=>$_GET["id"]));
    if($media->vid_iSta==2){
        header("location:?p=new-media");
    }

    $categories = $db->sqlManyResults("SELECT * FROM ".TABLE_CAT);
?>