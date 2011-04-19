<?php
include_once("includes/init.php"); 
include("editor/fckeditor.php") ;
?>
<div style="color:#FFFFFF;">
<?
$PageID = $_GET['pageid'];
if ($PageID =='')
	$PageID = $_POST['txtPage'];
	
$db = new DB($db_database,$db_host, $db_user, $db_pass);

$query = "select cp.HTMLFile,c.HostedUrl from comic_pages as cp 
		  join comics as c on cp.ComicID=c.comiccrypt
 		  where ParentPage='$PageID' and PageType='script'";
$PageArray = $db->queryUniqueObject($query);

$HTMLFile = $PageArray->HTMLFile;
$HostedUrl = $PageArray->HostedUrl;
if ($HTMLFile != '') 
	$HtmlContent = @file_get_contents('../comics/'.$HostedUrl.'/images/pages/'.$HTMLFile);

if ($_POST['txtEdit']==1) { 
$HtmlContent = $_POST['pf_post'];
$OldFile = $_POST['ScriptHTML'];

//print 'OLD CONTENT = ' . $OldFile."<br/>";
$HTMLFile = strtotime("now").".html"; 
//print 'temp/'.$HTMLFile.'<br/>'; 
$fp = fopen('temp/'.$HTMLFile,'w');
$write = fwrite($fp,$HtmlContent);
chmod('temp/'.$HTMLFile,0777);
//unlink('../comics/'.$HostedUrl.'/images/pages/'.$OldFile);

?>
<script language="javascript" type="text/javascript">

from_mysql_obj          = window.parent.document.getElementById( 'txtPeelFourFilename' );
from_mysql_obj.value = '<?php echo $HTMLFile; ?>';
window.parent.document.getElementById( 'scriptdiv' ).innerHTML = 'PAGE UPLOADED, IMAGE WILL BE PROCESSED ON SAVE';

//alert('FILE = ' + from_mysql_obj.value); 
//parent.document.getElementById( 'uploadModal' ).style.display = 'none';
/*
//document.location.href = "/<? //echo $PFDIRECTORY;?>/script_write.php?pageid=<? //echo $_GET['pageid'];?>";
*/
window.parent.document.getElementById("savealert").innerHTML = '<div style=\"padding:5px;\">Your New Pages have been changed, you will need to still save your changes to take effect</div>';
window.parent.document.getElementById("scriptModal").style.display = 'none';
</script>

<? }

?>
<div style="font-size:12px; color:#FFFFFF;font-family:Verdana, Arial, Helvetica, sans-serif;padding-bottom:5px;">
Paste your script page into the editor below and click SAVE SCRIPT</div>
<form action="#" method="post">
<input type="submit" value ='SAVE SCRIPT' style="width:500px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;border:1px #FFFFFF solid;"/>
<div class="spacer"></div>
<?php
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

$oFCKeditor = new FCKeditor('pf_post') ;
$oFCKeditor->BasePath	= '/'.$PFDIRECTORY.'/editor/';
$oFCKeditor->Height = '600';
$oFCKeditor->Width = '500';
$oFCKeditor->Value		= $HtmlContent;
$oFCKeditor->Create() ;
?>

<input type="hidden" name="txtPage" value="<? echo $PageID; ?>">
<input type="hidden" name="ScriptHTML" value="<? echo $HTMLFile; ?>">
<input type="hidden" name="txtEdit" value="1">
</form>
</div>