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

$db  = new Query();
$cmn = new Common();
$usr = new User();


?>
