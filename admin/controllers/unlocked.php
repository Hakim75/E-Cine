<?php
    include("init.php");

    if(isset($_GET["id"])){
        $param = array(
            "usr_iSta"=>1,
            "usr_id"=>$_GET["id"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_USR." SET usr_iSta = ? WHERE usr_id = ?",$param);
        header("location:../?p=customers");
    }

    if(isset($_GET["idAdm"])){
        $param = array(
            "adm_iSta"=>1,
            "adm_id"=>$_GET["idAdm"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_ADM." SET adm_iSta = ? WHERE adm_id = ?",$param);
        header("location:../?p=admins");
    }

    if(isset($_GET["idPta"])){
        $param = array(
            "pta_iSta"=>1,
            "pta_id"=>$_GET["idPta"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_PTA." SET pta_iSta = ? WHERE pta_id = ?",$param);
        header("location:../?p=rate");
    }
    
    if(isset($_GET["pass"])){
        $param = array(
            "adm_sPass"=>$cmn->cryptPass("123456"),
            "adm_id"=>$_GET["pass"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_ADM." SET adm_sPass = ? WHERE adm_id = ?",$param);
        header("location:../?p=admins");
    }

    include("close.php");
?>