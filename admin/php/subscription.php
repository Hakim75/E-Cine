<?php 
    $abonnements = $db->sqlManyResults("SELECT * FROM ".TABLE_JAB." jab 
                                        INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
                                        INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
                                        WHERE jab.jab_iSta=? AND jab_dDateFin>=?",array("jab_iSta"=>1,"jab_dDateFin"=>date("Y-m-d")));

    $attentes = $db->sqlManyResults("SELECT * FROM ".TABLE_JAB." jab 
                                        INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
                                        INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
                                        WHERE jab.jab_iSta=? ",array("jab_iSta"=>0));

    $termines = $db->sqlManyResults("SELECT * FROM ".TABLE_JAB." jab 
                                        INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
                                        INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
                                        WHERE jab.jab_iSta=? AND jab_dDateFin<?",array("jab_iSta"=>1,"jab_dDateFin"=>date("Y-m-d")));
  
    $resilies = $db->sqlManyResults("SELECT * FROM ".TABLE_JAB." jab 
                                        INNER JOIN ".TABLE_USR." usr ON usr.usr_id=jab.usr_id
                                        INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
                                        INNER JOIN ".TABLE_ADM." adm ON adm.adm_id=jab.adm_id
                                        WHERE jab.jab_iSta=? ",array("jab_iSta"=>2));
?>