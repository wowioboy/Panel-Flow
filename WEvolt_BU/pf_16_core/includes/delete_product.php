<?php 
include 'init.php';
header( 'Content-Type: text/javascript' );
require_once("curl_http_client.php");
require_once("create_key_func.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$ComicID = $_GET['comic'];
$UserID = $_GET['user'];
$ItemID = $_GET['id'];

$updateDB = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "SELECT AppInstallation from comics where comiccrypt ='$ComicID'";
$AppInstallID= $updateDB->queryUniqueValue($query);
$query = "SELECT * from comic_settings where ComicID ='$ComicID'";
$SettingArray= $updateDB->queryUniqueObject($query);
$query = "SELECT SafeFolder from comics where comiccrypt ='$ComicID'";
$SafeFolder= $updateDB->queryUniqueValue($query);
$query = "SELECT * from Applications where ID ='$AppInstallID'";
$ApplicationArray = $updateDB->queryUniqueObject($query);
$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;
$query = "SELECT * from  pf_store_items where EncryptID='$ItemID'";
$ItemArray = $updateDB->queryUniqueObject($query);	
$query = "DELETE from pf_store_items where ComicID='$ComicID' and UserID='$UserID' and EncryptID='$ItemID'";
$updateDB->query($query);	
$query = "DELETE from pf_store_images where ItemID='$ItemID'";
$updateDB->query($query);
chdir('/var/www/vhosts/panelflow.com/httpdocs');
@unlink($ItemArray->DownloadFile);
		
$ConnectKey = createKey();
$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
$updateDB->query($query);
$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey, 'p'=>$ItemID,'a'=>'delete');
$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_products.php", $post_data);
unset($post_data);
$updateDB->close();
?>

document.location = '/cms/edit/<? echo $SafeFolder;?>/?section=products';