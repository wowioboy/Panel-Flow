<? 
$include_dist = substr_count(dirname(__FILE__), DIRECTORY_SEPARATOR);
$calling_dist = substr_count(dirname($_SERVER['SCRIPT_FILENAME']), DIRECTORY_SEPARATOR);
include_once("includes/comic_init.php"); 
include_once($PFDIRECTORY.'/templates/common/includes/extras_functions.php');
$Pagetracking = 'Extras'; 
$Section = 'Extras';
$BGcolor = substr($MovieColor, 2, 6);  
include $PFDIRECTORY.'/templates/'.$TEMPLATE.'/extras_body.php';?>	
