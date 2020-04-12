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

    if(isset($_GET["idPta"])){
        $param = array(
            "pta_iSta"=>2,
            "pta_id"=>$_GET["idPta"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_PTA." SET pta_iSta = ? WHERE pta_id = ?",$param);
        header("location:../?p=rate");
    }

    if(isset($_GET["idCat"])){
        $param = array(
            "cat_id"=>$_GET["idCat"]
        );
        $db->sqlSimpleQuery("DELETE FROM ".TABLE_CAT." WHERE cat_id = ?",$param);
        header("location:../?p=categories");
    }

    if(isset($_GET["idFilm"])){
        $param = array(
            "vid_iSta"=>2,
            "vid_id"=>$_GET["idFilm"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_VID." SET vid_iSta = ? WHERE vid_id = ?",$param);
        header("location:../?p=movies");
    }

    if(isset($_GET["idSerie"])){
        $param = array(
            "vid_iSta"=>2,
            "vid_id"=>$_GET["idSerie"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_VID." SET vid_iSta = ? WHERE vid_id = ?",$param);
        header("location:../?p=series");
    }

    if(isset($_GET["idEpi"])){
        $param = array(
            "epi_iSta"=>2,
            "epi_id"=>$_GET["idEpi"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_EPI." SET epi_iSta = ? WHERE epi_id = ?",$param);
        header("location:../?p=series");
    }

    if(isset($_GET["idSan"])){
        $param = array(
            "san_iSta"=>2,
            "san_id"=>$_GET["idSan"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_SAN." SET san_iSta = ? WHERE san_id = ?",$param);
        header("location:../?p=series");
    }

    if(isset($_GET["idJab"])){
        $param = array(
            "jab_iSta"=>2,
            "jab_dDateResi"=>date("Y-m-d"),
            "adm_id"=>$_SESSION['adm'],
            "jab_id"=>$_GET["idJab"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_JAB." SET jab_iSta = ?, jab_dDateResi = ?, adm_id = ? WHERE jab_id = ?",$param);
        header("location:../?p=subscription");
    }

    if(isset($_GET["idJabSupp"])){
        $param = array(
            "jab_id"=>$_GET["idJabSupp"]
        );
        $db->sqlSimpleQuery("DELETE FROM ".TABLE_JAB." WHERE jab_id = ?",$param);
        header("location:../?p=subscription");
    }

    if(isset($_GET["idBan"]) AND isset($_GET["order"])){
        $db->sqlSimpleQuery("DELETE FROM ".TABLE_BAN." WHERE ban_id = ?",array("ban_id"=>$_GET["idBan"]));
        $db->sqlSimpleQuery("UPDATE ".TABLE_BAN." SET ban_iOrder = ban_iOrder - 1 WHERE ban_iOrder>? ",array("ban_iOrder"=>$_GET["order"]));
        header("location:../?p=banner");
    }

    include("close.php");
?>