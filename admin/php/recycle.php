<?php

    $films = $db->sqlManyResults("SELECT * FROM ".TABLE_VID." WHERE vid_sType = ? AND vid_iSta = ?",array("vid_sType"=>"Film","vid_iSta"=>2));
    $series = $db->sqlManyResults("SELECT * FROM ".TABLE_VID." WHERE vid_sType = ? AND vid_iSta = ?",array("vid_sType"=>"Série","vid_iSta"=>2));
    $saisons = $db->sqlManyResults("SELECT * FROM ".TABLE_SAN." san
                                    INNER JOIN ".TABLE_VID." vid ON vid.vid_id = san.vid_id
                                    WHERE san.san_iSta = ?", array("san_iSta"=>2));
    $episodes = $db->sqlManyResults("SELECT * FROM ".TABLE_EPI." epi
                                    INNER JOIN ".TABLE_SAN." san ON san.san_id = epi.san_id
                                    INNER JOIN ".TABLE_VID." vid ON vid.vid_id = san.vid_id
                                    WHERE epi.epi_iSta = ?", array("san_iSta"=>2));
?>