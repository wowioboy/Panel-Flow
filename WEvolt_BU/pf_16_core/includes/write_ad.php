<?php
include_once("init.php"); 
require_once("curl_http_client.php");
require_once("create_key_func.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$settingsinfoDB = new DB($db_database,$db_host, $db_user, $db_pass);

$Published = $_POST['txtPublished'];
$AdSpace = $_POST['txtPosition'];
$Template = $_POST['txtTemplate'];
$ComicID = $_POST['txtComic'];
$StoryID = $_POST['txtStory'];

if ($StoryID != '') {
	$TargetName = 'StoryID';
	$TargetID = $StoryID;
	$ContentType = 'story';

} else {
$TargetName = 'ComicID';
	$TargetID = $ComicID;
$ContentType = 'comic';

}
$AdCode = mysql_real_escape_string($_POST['txtAdCode']);
$SafeFolder = $_POST['txtSafeFolder'];
if ($StoryID != '') {
	$query = "SELECT AppInstallation from stories where StoryID ='$StoryID'";
	$AppInstallID= $settingsinfoDB->queryUniqueValue($query);
	$query = "SELECT * from story_settings where StoryID ='$StoryID'";
	$SettingArray= $settingsinfoDB->queryUniqueObject($query);
} else {
	$query = "SELECT AppInstallation from comics where comiccrypt ='$ComicID'";
	$AppInstallID= $settingsinfoDB->queryUniqueValue($query);
	$query = "SELECT * from comic_settings where ComicID ='$ComicID'";
	$SettingArray= $settingsinfoDB->queryUniqueObject($query);
}

$query = "SELECT * from Applications where ID ='$AppInstallID'";
$ApplicationArray = $settingsinfoDB->queryUniqueObject($query);
$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;

$query = "UPDATE adspaces SET AdCode='$AdCode', Published='$Published' where ".$TargetName."='$TargetID' and Position='$AdSpace' and Template='$Template'";
$settingsinfoDB->query($query);
$ConnectKey = createKey();
$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
$settingsinfoDB->query($query);
$settingsinfoDB->close();
///GRAB TEMPLATE INFORMATION
$post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID,'p' =>$AdSpace,'t' =>$Template, 'pub' => $Published,'k' => $ConnectKey,'type'=>$ContentType);
$curl->send_post_data($ApplicationLink."/connectors/update_ads.php", $post_data);
//echo 'MY UPDATE RESULT FROM NEED COMICS :::<br/>' . $updateresult;
unset($post_data);

if ($ContentType != 'story')
	header("location:/cms/edit/".$SafeFolder."/?section=ads"); 
else
	header("location:/story/edit/".$SafeFolder."/?section=ads"); 
?>