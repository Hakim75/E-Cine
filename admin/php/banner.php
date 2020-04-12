<?php 
    $films = $db->sqlManyResults("SELECT * FROM ".TABLE_VID." WHERE vid_iSta=? AND vid_sType=? ORDER BY vid_sTitre ASC",
                                    array("vid_iSta"=>1,"vid_sType"=>"Film"));

    $banners = $db->sqlManyResults("SELECT * FROM ".TABLE_BAN." ban 
                                    INNER JOIN ".TABLE_VID." vid ON vid.vid_id=ban.vid_id");
?>