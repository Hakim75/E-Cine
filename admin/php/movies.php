<?php 
    $films = $db->sqlManyResults("SELECT * FROM ".TABLE_VID." vid 
                            LEFT JOIN ".TABLE_ADM." adm ON adm.adm_id=vid.adm_id
                            WHERE vid.vid_sType = ? AND vid.vid_iSta=? 
                            ORDER BY vid.vid_dDateAjout DESC",array("vid_sType"=>"Film","vid_iSta"=>1));
?>