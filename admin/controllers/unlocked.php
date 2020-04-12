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

    if(isset($_GET["idFilm"])){
        $param = array(
            "vid_iSta"=>1,
            "vid_id"=>$_GET["idFilm"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_VID." SET vid_iSta = ? WHERE vid_id = ?",$param);
        header("location:../?p=recycle");
    }

    if(isset($_GET["idSerie"])){
        $param = array(
            "vid_iSta"=>1,
            "vid_id"=>$_GET["idSerie"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_VID." SET vid_iSta = ? WHERE vid_id = ?",$param);
        header("location:../?p=recycle");
    }

    if(isset($_GET["idEpi"])){
        $param = array(
            "epi_iSta"=>1,
            "epi_id"=>$_GET["idEpi"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_EPI." SET epi_iSta = ? WHERE epi_id = ?",$param);
        header("location:../?p=recycle");
    }

    if(isset($_GET["idSan"])){
        $param = array(
            "san_iSta"=>1,
            "san_id"=>$_GET["idSan"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_SAN." SET san_iSta = ? WHERE san_id = ?",$param);
        header("location:../?p=recycle");
    }

    if(isset($_GET["idJab"])){
        $debut = date("Y-m-d");
        $maDate = strtotime($debut."+ ".$_GET["d"]." month");
        $fin = date("Y-m-d",$maDate). "\n";
        $param = array(
            "jab_iSta"=>1,
            "jab_dDateDeb"=> $debut,
            "jab_dDateFin"=>$fin,
            "jab_id"=>$_GET["idJab"]
        );
        $db->sqlSimpleQuery("UPDATE ".TABLE_JAB." SET jab_iSta = ?, jab_dDateDeb=?,jab_dDateFin=?  WHERE jab_id = ?",$param);
        header("location:../?p=subscription");
    }

    include("close.php");
?>