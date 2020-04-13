<?php
    include("init.php");    

    if(isset($_GET["idJab"])){
        $param = array(
            "jab_id"=>$_GET["idJab"]
        );
        $db->sqlSimpleQuery("DELETE FROM ".TABLE_JAB." WHERE jab_id = ?",$param);
        header("location:../?p=account");
    }

    include("close.php");
?>