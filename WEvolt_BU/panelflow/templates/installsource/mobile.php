<? 
$Pagetracking = 'Mobile'; 
$Section = 'Mobile';
include_once("includes/comic_init.php"); 

include_once($PFDIRECTORY.'/templates/common/includes/comic_functions.php');
include_once($PFDIRECTORY.'/templates/common/includes/mobile_functions.php');
// Comic Header
include $PFDIRECTORY.'/templates/common/includes/comic_header_template.php';
 
echo $TemplateString;

// Comic Footer
include $PFDIRECTORY.'/templates/common/includes/comic_footer.php';?>



