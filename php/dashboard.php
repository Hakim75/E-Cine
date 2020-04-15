<?php 
    $today = date("Y-m-d");
    $banners = $db->sqlManyResults("SELECT * FROM ".TABLE_BAN." ban
                            INNER JOIN ".TABLE_VID." vid ON vid.vid_id=ban.vid_id
                            ORDER BY ban.ban_iOrder ASC");

    
    $myDate = strtotime($today."- 2 month");
    $limitdate = date("Y-m-d",$myDate). "\n";
    $new = $db->sqlManyResults("SELECT * FROM ".TABLE_VID." WHERE vid_dDateSort>=? AND vid_iSta=?  ORDER BY vid_dDateSort DESC LIMIT 10",
                                array("vid_dDateSort"=>$limitdate,"vid_iSta"=>1));

    $movies = $db->sqlManyResults("SELECT * FROM ".TABLE_VID."
                                WHERE vid_sType = ? AND vid_iSta=? ORDER BY RAND() LIMIT 15",
                                array("vid_sType"=>"Film","vid_iSta"=>1));

    $series = $db->sqlManyResults("SELECT * FROM ".TABLE_VID."
                                WHERE vid_sType = ? AND vid_iSta=? ORDER BY RAND() LIMIT 10",
                                array("vid_sType"=>"Série","vid_iSta"=>1));

    $populars = $db->sqlManyResults("SELECT vid.vid_id,vid.vid_sPoster, vid.vid_sTitre, vid.vid_sType, vid.vid_sReal, vid.vid_dDateSort,
                                vid.vid_dDateAjout, COUNT(jvv.jvv_id) AS nb,jvv.jvv_id FROM ".TABLE_VID." vid 
                                LEFT JOIN ".TABLE_JVV." jvv ON jvv.vid_id = vid.vid_id
                                WHERE vid.vid_iSta = ? GROUP BY vid.vid_id ORDER BY nb DESC LIMIT 15",array('vid_iSta'=>1));
    
    $categories = $db->sqlManyResults("SELECT * FROM ".TABLE_CAT." ORDER BY RAND() LIMIT 3");
?>