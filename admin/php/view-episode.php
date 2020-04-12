<?php 
    if(!isset($_GET["id"])){
        header("location:?p=series");
    }
    $param = array("epi_id"=>$_GET["id"],"epi_iSta"=>1);
    $episode = $db->sqlSingleResult("SELECT * FROM ".TABLE_EPI." epi
                                    INNER JOIN ".TABLE_SAN." san ON san.san_id = epi.san_id
                                    INNER JOIN ".TABLE_VID." vid ON vid.vid_id = san.vid_id
                                    INNER JOIN ".TABLE_ADM." adm ON adm.adm_id = epi.adm_id
                                    WHERE epi.epi_id = ? AND epi.epi_iSta = ?", $param);
    if($episode->vid_iSta==2 || $episode->vid_sType!="Série"){
        header("location:?p=series");
    }

    $categoties = $db->sqlManyResults("SELECT * FROM ".TABLE_VIC." vic 
                                    INNER JOIN ".TABLE_CAT." cat ON cat.cat_id=vic.cat_id 
                                    WHERE vic.vid_id = ?",array("vid_id"=>$episode->vid_id));
    $last_key = end(array_keys($categoties));
?>