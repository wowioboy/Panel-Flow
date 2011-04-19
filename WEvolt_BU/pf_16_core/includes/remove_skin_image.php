<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
header('Content-type: text/html; charset=UTF-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

$SkinCode = $_GET['skincode'];
$base_path = "templates/skins/".$SkinCode.'/images/';
$SkinNameArray = explode('-',$SkinCode);

if ($SkinNameArray[0] == 'PFSK')
	$SkinTable = 'template_skins';
else if ($SkinNameArray[0] == 'PFPSK')
	$SkinTable = 'project_skins';
	
$SkinType = $_GET['type'];
$ComicID = $_GET['comic'];
$StoryID = $_GET['story'];

if ($StoryID == '') {
$TargetID = $ComicID;
	$TargetName = 'ComicID';
	$TargetTable = 'comics';
	$EncryptName = 'comiccrypt';
	$ContentType = 'comic';
} else {
	$TargetID = $StoryID;
	$TargetName = 'StoryID';
	$TargetTable = 'stories';
	$EncryptName = 'StoryID';
	$ContentType = 'story';

}
//header( 'Content-Type: text/javascript' );
//database info: Change password and DB Name <br />
header( 'Content-Type: text/javascript' );
$query = "SELECT $SkinType from $SkinTable where SkinCode='$SkinCode'";
$FlaggedImage = $InitDB->queryUniqueValue($query);

if ((strpos($SkinType,'Button')) && ($SkinType != 'ButtonImage')) {
	$ButtonName = explode('Image',$SkinType);
	$RollOverImage = $ButtonName[0].'RolloverImage';
	$query = "SELECT $RollOverImage  from template_skins where SkinCode='$SkinCode'";
	$FlaggedRolloverImage = $InitDB->queryUniqueValue($query);
}
$query = "UPDATE $SkinTable set ".$SkinType."='' where SkinCode='$SkinCode'";
$InitDB->query($query);
@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$base_path.$FlaggedImage);

if ((strpos($SkinType,'Button')) && ($SkinType != 'ButtonImage')) {
	$ButtonName = explode('Image',$SkinType);
	$RollOverImage = $ButtonName[0].'RolloverImage';
	$query = "UPDATE $SkinTable set ".$RollOverImage."='' where SkinCode='$SkinCode'";
	$InitDB->query($query);
@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$base_path.$FlaggedRolloverImage);
}
$InitDB->close();
			/*
			$query = "SELECT AppInstallation from ".$TargetTable." where ".$EncryptName." ='$TargetID'";
			$AppInstallID= $updateDB->queryUniqueValue($query);
			
			if ($StoryID != '') 
				$query = "SELECT * from story_settings where ".$TargetName." ='$TargetID'";
			else
				$query = "SELECT * from comic_settings where ".$TargetName." ='$TargetID'";
			
			$SettingArray= $updateDB->queryUniqueObject($query);
			$query = "SELECT * from Applications where ID ='$AppInstallID'";
			$ApplicationArray = $updateDB->queryUniqueObject($query);
			$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;
			$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$updateDB->query($query);
			$post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID, 'k' => $ConnectKey, 's' => $SkinCode, 'a'=>'delete','t'=>$SkinType,'type'=>$ContentType);
			$updateresult = $curl->send_post_data($ApplicationLink."/connectors/update_skins.php", $post_data);
			unset($post_data);
	
			$updateDB->close();
			*/
?>

var SkinType = '<? echo $SkinType;?>';
var loadimage = '';
if ((SkinType == 'ModTopRightImage') || (SkinType == 'ModTopLeftImage')|| (SkinType == 'ModBottomLeftImage')|| (SkinType == 'ModBottomRighttImage') || (SkinType == 'ModTopImage')|| (SkinType == 'ModBottomImage')|| (SkinType == 'ModLeftSideImage')|| (SkinType == 'ModRightSideImage') || (SkinType == 'ContentBoxImage')) {
if  (SkinType != 'ContentBoxImage')
	loadimage = 'http://www.wevolt.com/images/cms/cms_grey_load_image.jpg';
}

if (loadimage == '') 
loadimage = 'http://www.wevolt.com/images/cms/cms_grey_load_background.jpg';

var htmlstring = '<a href=\"javascript:void(0)\"  onclick=\"revealModal(\'uploadModal\',\'<? echo $SkinType;?>\');return false;\"><img src=\"'+loadimage+'\" border=\"0\" class=\"navbuttons\"></a>';
window.parent.document.getElementById("<? echo $SkinType;?>Div").innerHTML = htmlstring;
<? /*
//document.getElementById("<? //echo $SkinType;?>Div").innerHTML = '<a href=\"#\"\"><font color=\"#0099FF\">[UPLOAD IMAGE]</font></a>';*/?>
