<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/models/Users.php');

if ($_SESSION['username'] == 'matteblack') {
$XPMaker = new Users();
$XPMaker->addxp($InitDB, $_GET['user'], $_GET['xp']);
}
$InitDB->close();