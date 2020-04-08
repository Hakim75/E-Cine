<?php
session_start();
ini_set('display_errors',1);
error_reporting(1);

setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

include_once('./../includes/config.php');


require_once('./../classes/common.php');
require_once('./../classes/object.php');
require_once('./../classes/query.php');
require_once('./../classes/user.php');



$db  = new Query();
$cmn = new Common();
$usr = new User();


$page = htmlentities($_GET['p']);
$errors = scandir('html');

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

include_once('includes/header'.$headerfootersuffix.'.php');

include_once('views/'.$displayedPage.'.html');

include_once('includes/footer'.$headerfootersuffix.'.php');



unset($db);

unset($GLOBALS);

?>
