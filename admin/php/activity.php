<?php 
    if(!isset($_GET['usr'])){
        header("location:?p=customers");
    }

    $user = $usr->infoUser($_GET['usr']);
    $wait = $db->sqlSingleResult("SELECT * FROM ".TABLE_JAB." jab
                                        INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
                                        INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
                                        WHERE jab.jab_iSta=? AND jab.usr_id=?",
                                        array("jab_iSta"=>0,"usr_id"=>$user->usr_id));

    $last = $db->sqlSingleResult("SELECT * FROM ".TABLE_JAB." jab
                                        INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
                                        INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
                                        WHERE jab.jab_iSta=? AND jab.jab_dDateFin<? AND jab.usr_id=? ORDER BY jab.jab_dDateFin DESC",
                                        array("jab_iSta"=>1,"jab_dDateFin"=>date("Y-m-d"),"usr_id"=>$user->usr_id));
                    
    $current = $db->sqlSingleResult("SELECT * FROM ".TABLE_JAB." jab
                                        INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
                                        INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
                                        WHERE jab.jab_iSta=? AND jab.jab_dDateFin>=? AND jab.usr_id=?",
                                        array("jab_iSta"=>1,"jab_dDateFin"=>date("Y-m-d"),"usr_id"=>$user->usr_id));

    $vues = $db->sqlManyResults("SELECT * FROM ".TABLE_JVV." jvv
                                INNER JOIN ".TABLE_VID." vid ON vid.vid_id=jvv.vid_id
                                INNER JOIN ".TABLE_CAT." cat ON cat.cat_id=vid.cat_id
                                WHERE jvv.usr_id = ?", array("usr_id"=>$user->usr_id));
    
    $total = $db->sqlSingleResult("SELECT SUM(pta.pta_iPrix) AS total FROM ".TABLE_JAB." jab
                                    INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
                                    WHERE (jab.jab_iSta=1 || jab.jab_iSta=2) AND jab.usr_id=?",
                                    array("usr_id"=>$user->usr_id));

    $preferences = $db->sqlManyResults("SELECT * FROM ".TABLE_JPR." jpr
                                        INNER JOIN ".TABLE_VID." vid ON vid.vid_id=jpr.vid_id
                                        WHERE jpr.jpr_iSta=? AND jpr.usr_id = ?",
                                        array("jpr_iSta"=>1,"usr_id"=>$user->usr_id));
?>