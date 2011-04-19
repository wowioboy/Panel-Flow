<? 
$include_dist = substr_count(dirname(__FILE__), DIRECTORY_SEPARATOR);
$calling_dist = substr_count(dirname($_SERVER['SCRIPT_FILENAME']), DIRECTORY_SEPARATOR);

	// Comic Header
include_once('includes/comic_init.php');
include_once($PFDIRECTORY.'/templates/common/includes/comic_functions.php');
include_once ($PFDIRECTORY.'/templates/common/includes/about_functions.php');
$Pagetracking = 'Profile'; 
$BGcolor = substr($MovieColor, 2, 6);  
?>
<? include $PFDIRECTORY.'/templates/'.$TEMPLATE.'/about_body.php';?>	

