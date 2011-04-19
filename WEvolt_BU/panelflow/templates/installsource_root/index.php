<? 
$include_dist = substr_count(dirname(__FILE__), DIRECTORY_SEPARATOR);
$calling_dist = substr_count(dirname($_SERVER['SCRIPT_FILENAME']), DIRECTORY_SEPARATOR);
if (!file_exists('includes/config.php')) {
if (!file_exists('install/index.php')) {
     header('Location: /noconfig.php');
	 } else {
	 header('Location: install/index.php');
	 }
}	
include_once("includes/comic_init.php"); 
$Pagetracking = 'Home'; 
$Section = 'Pages';
include_once($PFDIRECTORY.'/templates/common/includes/comic_functions.php');
$BGcolor = substr($MovieColor, 2, 6);  
include $PFDIRECTORY.'/templates/'.$TEMPLATE.'/index_body.php';?>	
