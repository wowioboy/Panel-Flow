<? 
$include_dist = substr_count(dirname(__FILE__), DIRECTORY_SEPARATOR);
$calling_dist = substr_count(dirname($_SERVER['SCRIPT_FILENAME']), DIRECTORY_SEPARATOR);

	// Comic Header
include_once('includes/comic_init.php');
include_once($PFDIRECTORY.'/templates/common/includes/comic_functions.php');
$Pagetracking = 'Contact'; 

if ($ContactSetting == 0) {
 	header("Location:index.php");
 }
$BGcolor = substr($MovieColor, 2, 6);  
?>
<? include str_repeat($PFDIRECTORY.'/templates/'.$TEMPLATE.'/contact_body.php';?>	
