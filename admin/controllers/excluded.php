<?php
    include("init.php");

    if(isset($_GET["id"])){
        $param = array(
            "usr_iSta"=>2,
            "usr_id"=>$_GET["id"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_USR." SET usr_iSta = ? WHERE usr_id = ?",$param);
        header("location:../?p=customers");
    }

    if(isset($_GET["idAdm"])){
        $param = array(
            "adm_iSta"=>2,
            "adm_id"=>$_GET["idAdm"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_ADM." SET adm_iSta = ? WHERE adm_id = ?",$param);
        header("location:../?p=admins");
    }

    if(isset($_GET["idCat"])){
        $param = array(
            "cat_id"=>$_GET["idCat"]
        );
        $db->sqlSimpleQuery("DELETE FROM ".TABLE_CAT." WHERE cat_id = ?",$param);
        header("location:../?p=categories");
    }

    include("close.php");
?>