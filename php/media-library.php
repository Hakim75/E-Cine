<?php
    if(!isset($_GET["q"])){
        if(!isset($_GET["categories"])){
            if(!isset($_GET["liked"])){
                header("location: ?p=dashboard");
            }else{
                $preferences = $db->sqlManyResults("SELECT * FROM ".TABLE_JPR." jpr
                                        INNER JOIN ".TABLE_VID." vid ON vid.vid_id=jpr.vid_id
                                        WHERE jpr.jpr_iSta=? AND jpr.usr_id = ? AND vid.vid_iSta = ?",
                                        array("jpr_iSta"=>1,"usr_id"=>$_SESSION['usr'],"vid_iSta"=>1));
            }
        }else{
            $categories = $db->sqlManyResults("SELECT * FROM ".TABLE_VIC." vic
                                        INNER JOIN ".TABLE_VID." vid ON vid.vid_id=vic.vid_id
                                        INNER JOIN ".TABLE_CAT." cat ON cat.cat_id=vic.cat_id
                                        WHERE vid.vid_iSta=? AND vic.cat_id=?",
                                        array("vid_iSta"=>1,"cat_id"=>$_GET["categories"]));
            
            if(!$categories){
                header("location: ?p=dashboard");
            }
        }
    }else{
        if($_GET["q"]=="s"){
            $type = "Série";
        }
        else if($_GET["q"]=="m"){
            $type = "Film";
        }
        else{
            header("location: ?p=dashboard");
        }
        $media = $db->sqlManyResults("SELECT * FROM ".TABLE_VID." WHERE vid_sType=?",array("vid_sType"=>$type));
    }

?>