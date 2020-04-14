<?php
    include("init.php");    

    if(isset($_GET["idJab"])){
        $param = array(
            "jab_id"=>$_GET["idJab"]
        );
        $db->sqlSimpleQuery("DELETE FROM ".TABLE_JAB." WHERE jab_id = ?",$param);
        header("location:../?p=account");
    }


    if(isset($_GET["remPref"])){
        $param = array(
            "vid_id"=>$_GET["remPref"], "usr_id"=>$_SESSION["usr"]
        );
        $db->sqlSimpleQuery("DELETE FROM ".TABLE_JPR." WHERE vid_id = ? AND usr_id=?",$param);
        echo 'oki';
    }

    if(isset($_GET["addPref"])){
        $param = array(
            "vid_id"=>$_GET["addPref"], "usr_id"=>$_SESSION["usr"], "jpr_iSta" => 1 
        );
        $db->sqlSimpleQuery("INSERT INTO ".TABLE_JPR." (vid_id, usr_id, jpr_iSta) VALUES(?,?,?)",$param);
        echo 'oki';
    }
    
    include("close.php");

?>