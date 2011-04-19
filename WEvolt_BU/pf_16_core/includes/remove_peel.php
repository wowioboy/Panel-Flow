<?php 
header( 'Content-Type: text/javascript' );
 include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
 include_once(INCLUDES.'/db.class.php');
$ComicID = $_GET['comic'];
$PageType = $_GET['type'];
$PageID = $_GET['pageid'];

$updateDB = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);

$query = "SELECT * from comic_settings where (ComicID ='$ComicID' or ProjectID='$ComicID')";
$SettingArray= $updateDB->queryUniqueObject($query);

$query = "DELETE from comic_pages where (ComicID ='$ComicID' or ProjectID='$ComicID') and ParentPage='$PageID' and PageType='$PageType'";
$updateDB->query($query);	
		
//$ConnectKey = createKey();
//$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
//$updateDB->query($query);
//$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey, 'p'=>$PageID,'a'=>'remove','t'=>$PageType,'sub'=>'peel');
//$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_pages.php", $post_data);
//unset($post_data);
$updateDB->close();
?>
document.getElementById('<? echo $PageType;?>div').innerHTML ='<img src=\"/images/cms/no_content.png\" />';
document.getElementById('<? echo $PageType;?>remove').style.display = 'none';