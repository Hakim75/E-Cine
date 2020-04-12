<?php
    if(!isset($_GET["id"])){
        header("location:?p=series");
    }
    $param = array("epi_id"=>$_GET["id"],"epi_iSta"=>1);
    $e = $db->sqlSingleResult("SELECT * FROM ".TABLE_EPI." epi
                                    INNER JOIN ".TABLE_SAN." san ON san.san_id = epi.san_id
                                    INNER JOIN ".TABLE_VID." vid ON vid.vid_id = san.vid_id
                                    INNER JOIN ".TABLE_ADM." adm ON adm.adm_id = epi.adm_id
                                    WHERE epi.epi_id = ? AND epi.epi_iSta = ?", $param);
    if($e->vid_iSta==2 || $e->vid_sType!="Série"){
        header("location:?p=series");
    }
    $params = array("vid_id"=>$e->vid_id,"san_iSta"=>1);
     $saisons = $db->sqlManyResults("SELECT * FROM ".TABLE_SAN." WHERE vid_id = ? AND san_iSta = ? ORDER BY san_iNumero DESC", $params);
?>