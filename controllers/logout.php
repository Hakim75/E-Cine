<?php 

include("init.php");

$logout = $cmn->logout();
header("location:../");

include("close.php");

?>