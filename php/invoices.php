<?php
     $invoices = $db->sqlManyResults("SELECT * FROM ".TABLE_JAB." jab
     INNER JOIN ".TABLE_PTA." pta ON pta.pta_id=jab.pta_id
     WHERE (jab.jab_iSta=1 || jab.jab_iSta=2) AND jab.usr_id=?",
     array("usr_id"=>$_SESSION["usr"]));

?>