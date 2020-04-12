<?php
    $listeUsers=$db->sqlManyResults("SELECT * FROM ".TABLE_USR);

    $abonnements=$db->sqlManyResults("SELECT * FROM ".TABLE_JAB." WHERE jab_iSta=? AND jab_dDateFin>=?",
                                        array("jab_iSta"=>1,"jab_dDateFin"=>date("Y-m-d")));

    $revenus = $db->sqlSingleResult("SELECT SUM(pta.pta_iPrix) AS total FROM ".TABLE_JAB." jab
                                        INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
                                        WHERE (jab.jab_iSta=1 || jab.jab_iSta=2)");
    
    $attentes=$db->sqlManyResults("SELECT * FROM ".TABLE_JAB." WHERE jab_iSta=?",array("jab_iSta"=>0));

    $films=$db->sqlManyResults("SELECT * FROM ".TABLE_VID." WHERE vid_iSta = ? AND vid_sType = ?",array("vid_iSta"=>1,"vid_sType"=>"Film"));
    $series=$db->sqlManyResults("SELECT * FROM ".TABLE_VID." WHERE vid_iSta = ? AND vid_sType = ?",array("vid_iSta"=>1,"vid_sType"=>"Série"));
    $episodes=$db->sqlManyResults("SELECT * FROM ".TABLE_EPI." WHERE epi_iSta = 1");

    $topFilms = $db->sqlManyResults("SELECT vid.vid_id,vid.vid_sPoster, vid.vid_sTitre, vid.vid_sType, vid.vid_sReal, vid.vid_dDateSort,
                                vid.vid_dDateAjout, COUNT(jvv.jvv_id) AS nb,jvv.jvv_id FROM ".TABLE_VID." vid 
                                LEFT JOIN ".TABLE_JVV." jvv ON jvv.vid_id = vid.vid_id
                                WHERE vid.vid_sType = ? GROUP BY vid.vid_id ORDER BY nb DESC LIMIT 5",array('vid_sType'=>"Film"));
    $topSeries = $db->sqlManyResults("SELECT vid.vid_id,vid.vid_sPoster, vid.vid_sTitre, vid.vid_sType, vid.vid_sReal, vid.vid_dDateSort,
                                vid.vid_dDateAjout, COUNT(jvv.jvv_id) AS nb,jvv.jvv_id FROM ".TABLE_VID." vid 
                                LEFT JOIN ".TABLE_JVV." jvv ON jvv.vid_id = vid.vid_id
                                WHERE vid.vid_sType = ? GROUP BY vid.vid_id ORDER BY nb DESC LIMIT 5",array('vid_sType'=>"Série"));
?>