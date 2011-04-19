<? 
$include_dist = substr_count(dirname(__FILE__), DIRECTORY_SEPARATOR);
$calling_dist = substr_count(dirname($_SERVER['SCRIPT_FILENAME']), DIRECTORY_SEPARATOR);

	// Comic Header
include_once('includes/comic_init.php');
include_once($PFDIRECTORY.'/templates/common/includes/comic_functions.php');
include_once($PFDIRECTORY.'/templates/common/includes/downloads_functions.php');
$Pagetracking = 'Downloads'; 
$BGcolor = substr($MovieColor, 2, 6);  
?>
<? include $PFDIRECTORY.'/templates/'.$TEMPLATE.'/downloads_body.php';?>	
