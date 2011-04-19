<?php 
include 'init.php';
require_once("curl_http_client.php");
require_once("create_key_func.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$SkinCode = $_GET['skincode'];
$base_path = "templates/skins/".$SkinCode.'/images/';
$ComicID = $_GET['comic'];
$updateDB = new DB($db_database,$db_host, $db_user, $db_pass);

$query = "SELECT SafeFolder from comics where comiccrypt='$ComicID'";
$updateDB->query($query);

$query = "UPDATE comic_settings set Skin='$SkinCode' where ComicID='$ComicID'";
$updateDB->query($query);

$query = "SELECT AppInstallation from comics where comiccrypt ='$ComicID'";
$AppInstallID= $updateDB->queryUniqueValue($query);

$query = "SELECT * from comic_settings where ComicID ='$ComicID'";
$SettingArray= $updateDB->queryUniqueObject($query);

$query = "SELECT * from Applications where ID ='$AppInstallID'";
$ApplicationArray = $updateDB->queryUniqueObject($query);

$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;
$ConnectKey = createKey();
$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
$updateDB->query($query);

$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey, 's' => $SkinCode, 'a'=>'use','t'=>$SkinType);
$updateresult = $curl->send_post_data($ApplicationLink."/connectors/update_skins.php", $post_data);
unset($post_data);
			
$query = "SELECT * from template_skins where SkinCode='$SkinCode'";
$SkinArray = $updateDB->queryUniqueObject($query);
$BaseDirectory = '../templates/skins/'.$SkinCode.'/images/';
foreach ($SkinArray as $SkinRow) {
		if ((@exif_imagetype($BaseDirectory.$SkinRow) == IMAGETYPE_GIF) || (@exif_imagetype($BaseDirectory.$SkinRow) == IMAGETYPE_JPEG)|| (@exif_imagetype($BaseDirectory.$SkinRow) == IMAGETYPE_PNG)) {
			$SkinTypeArray = explode('.',$SkinRow);
			$SkinType = $SkinTypeArray[0];
			$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey, 's' => $SkinCode, 'a'=>'install','t'=>$SkinType,'type'=>$ContentType);
			$updateresult = $curl->send_post_data($ApplicationLink."/connectors/update_skins.php", $post_data);
			unset($post_data);
		}
}			
$updateDB->close();	
if ($ContentType == 'story')
header('location:/story/edit/'.$SafeFolder.'/?section=skins');
else
header('location:/cms/edit/'.$SafeFolder.'/?section=skins');
?>


