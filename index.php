<?php
session_start();
ini_set('display_errors',1);
error_reporting(1);

setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

include_once('includes/config.php');


require_once('models/common.php');
require_once('models/object.php');
require_once('models/query.php');
require_once('models/user.php');
require_once('models/tool.php');
require_once('models/media.php');
require_once('models/activity.php');



$db  = new Query();
$cmn = new Common();
$usr = new User();
$too = new Tool();
$med = new Media();
$act = new Activity();


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
	header('location:?p=home');
}

switch($displayedPage){
	case 'sign-up':
	case 'sign-in':
		$headerfootersuffix = '_other';
	break;	
	case 'home';
		$headerfootersuffix = '_home';
	break;
	case 'player';
		$headerfootersuffix = '_play';
	break;
	default :
		$headerfootersuffix = '_app';
	break;
}



@include_once('php/'.$displayedPage.'.php');

include_once('includes/header'.$headerfootersuffix.'.html');

include_once('views/'.$displayedPage.'.html');

include_once('includes/footer'.$headerfootersuffix.'.html');


unset($db);
unset($GLOBALS);

?>
