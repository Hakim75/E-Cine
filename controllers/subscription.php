<?php  
include("init.php");

$dataForm = $_REQUEST;
if (!$cmn->verifMail($dataForm["email"])) {
    echo "Le format de votre mail est incorrect";
}else {
   $param = array(
       "jab_iSta"=>0,
       "pta_id"=>$dataForm["tarif"],
       "usr_id"=>$_SESSION["usr"]
   );
   $db->sqlSimpleQuery("INSERT INTO ".TABLE_JAB."(jab_iSta,pta_id,usr_id)
                        VALUES(?,?,?)",$param);
    echo "ok";
}

include("close.php");
?>