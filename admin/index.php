<?php
session_start();
ini_set('display_errors',1);
error_reporting(1);

setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

include_once('./../includes/config.php');

require_once('./../models/common.php');
require_once('./../models/object.php');
require_once('./../models/query.php');
require_once('./../models/user.php');
require_once('./../models/admin.php');
require_once('./../models/tool.php');


$db  = new Query();
$cmn = new Common();
$usr = new User();
$adm = new Admin();
$too = new Tool();


$page = htmlentities($_GET['p']);
$errors = scandir('views');

// print_r($errors);
if(isset($_GET['p'])){
	if(in_array($_GET['p'].".html",$errors)){
		$displayedPage = $page;
	}else{
		header('location:?p=error');
	}
}else{
	header('location:?p=login');
}

switch($displayedPage){
	case 'login':
		$headerfootersuffix = '_other';
		break;	
	default :
		$headerfootersuffix = '_home';
		break;
}



@include_once('php/'.$displayedPage.'.php');

include_once('includes/header'.$headerfootersuffix.'.html');

include_once('views/'.$displayedPage.'.html');

include_once('includes/footer'.$headerfootersuffix.'.html');



unset($db);

unset($GLOBALS);

?>
