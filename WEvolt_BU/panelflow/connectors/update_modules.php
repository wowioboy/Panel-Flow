<?php
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$config = array();
include '../includes/db.class.php'; 
include '../includes/config.php';
$ComicID= $_POST['c'];
$UserID = $_POST['u'];
$AdminEmail = $config['adminemail'];
$AdminUserID = $config['adminuserid'];
$PFDIRECTORY = $config['pathtopf'];  
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host']; 
$key = $config['liscensekey'];
$settings = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comics where comiccrypt ='$ComicID'";
$ComicArray = $settings->queryUniqueObject($query);
$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);
$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {
	$post_data = array('u' => $UserID, 'c' => $ComicID, 'k' => $_POST['k'], 'l'=>$key);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/update_modules.php", $post_data);
	print 'MODULES RESULT = ' . $updateresult."<br/>";
	unset($post_data);
	 
		if ($updateresult != 'Not Authorized') {  
				$values = unserialize ($updateresult);
				$LeftColumnOrder = explode(',',$values['leftcolumnorder']);
				$RightColumnOrder = explode(',',$values['rightcolumnorder']);
				$RightColumnOrderPub = explode(',',$values['rightcolumnorderpub']);
				$RightColumnOrderCustom1 = explode(',',$values['rightcolumnordercustom1']);
				$LeftColumnOrderPub = explode(',',$values['leftcolumnorderpub']);
				$LeftColumnOrderCustom1 = explode(',',$values['leftcolumnordercustom1']);
				$LeftColumnOrderHtml = explode('||||',$values['leftcolumnorderhtml']);
				$RightColumnOrderHtml = explode('||||',$values['rightcolumnorderhtml']);
				
				
				$Count = 1;
				foreach ($LeftColumnOrder as $module) {
						$ModulePublished = $LeftColumnOrderPub[$Count-1];
						$CustomVar1 = $LeftColumnOrderCustom1[$Count-1];
						$HtmlCode = mysql_real_escape_string($LeftColumnOrderHtml[$Count-1]);
						$query = "SELECT * from pf_modules where ModuleCode='$module' and ComicID='$ComicID' and Homepage=0";
						$settings->query($query);
						$Found = $settings->numRows();
						
						if ($Found == 0) {
							$query = "INSERT into pf_modules(ModuleCode, ComicID, CustomVar1, Placement, IsPublished, Position, HTMLCode) values ('$module', '$ComicID', '$CustomVar1', 'left','$ModulePublished', '$Count','$HtmlCode')";       
						
						} else {
							$query = "UPDATE pf_modules set Position='$Count', Placement='left',IsPublished='$ModulePublished', CustomVar1='$CustomVar1', HTMLCode='$HtmlCode' where ModuleCode='$module' and ComicID ='$ComicID'";       
							}
						$settings->query($query);
						$Count++;
						print $query."<br/>";
				}
				
				$Count = 1;
				foreach ($RightColumnOrder as $module) {
						$ModulePublished = $RightColumnOrderPub[$Count-1];
						$CustomVar1 = $RightColumnOrderCustom1[$Count-1];
						$HtmlCode = mysql_real_escape_string($RightColumnOrderHtml[$Count-1]);
						
						$query = "SELECT * from pf_modules where ModuleCode='$module' and ComicID='$ComicID' and Homepage=0";
						$settings->query($query);
						$Found = $settings->numRows();
							
						if ($Found == 0) {
							$query = "INSERT into pf_modules(ModuleCode, ComicID, CustomVar1, Placement, IsPublished, Position, HTMLCode) values ('$module', '$ComicID', '$CustomVar1', 'right','$ModulePublished', '$Count','$HtmlCode')";       
							
						} else {
							$query = "UPDATE pf_modules set Position='$Count', Placement='right',IsPublished='$ModulePublished', CustomVar1='$CustomVar1', HTMLCode='$HtmlCode' where ModuleCode='$module' and ComicID ='$ComicID'";       
						}
						$settings->query($query);
						$Count++;
				}
				$settings->close();
				echo 'Updated';
	} else {
		echo 'Not Authorized';
	}
	
} else {
	echo 'No Access';
}



?>