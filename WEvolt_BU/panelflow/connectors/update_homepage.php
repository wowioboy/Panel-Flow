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
//print $query."<br/>";
//print "USER = " . $UserID."<br/>";
$ComicArray = $settings->queryUniqueObject($query);
//print "admin = " . $ComicArray->userid."<br/>";
//print "creator = " . $ComicArray->CreatorID."<br/>";
$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);
$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {
	$post_data = array('u' => $UserID, 'c' => $ComicID, 'k' => $_POST['k'], 'l'=>$key);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/update_homepage.php", $post_data);
	unset($post_data);
	echo 'UPDATE RESULT = '.$updateresult.'<br/>';
			if ($updateresult != 'Not Authorized') {
				$values = unserialize ($updateresult); 
				$HomepageType = $values['HomepageType'];
				$HomepageActive = $values['HomepageActive'];
				$HomepageHTML =mysql_real_escape_string($values['HomepageHTML']);
				$LeftColumnOrder = explode(',',$values['leftcolumnorder']);
				$RightColumnOrder = explode(',',$values['rightcolumnorder']);
				$InactiveColumnOrder = explode(',',$values['InactiveColumnOrder']);
				$RightColumnOrderPub = explode(',',$values['rightcolumnorderpub']);
				$LeftColumnOrderPub = explode(',',$values['leftcolumnorderpub']);
				
				print_r($RightColumnOrderPub);
				print_r($LeftColumnOrderPub);
				//UPDATE LEFT COLUMN
				$Count = 1;
				foreach ($LeftColumnOrder as $module) {
						$ModulePublished = $LeftColumnOrderPub[$Count-1];
						$query = "SELECT ID from pf_modules 
								  where ModuleCode='$module' and ComicID ='$ComicID' and Homepage=1";
						$settings->query($query);
						 print $query."<br/>";
					    $Found = $settings->numRows();
						print 'MODULE FOUND = ' . $Found. '<br/>';
						if ($Found == 0) {
							$query = "INSERT into pf_modules (Position, IsPublished, Placement, ModuleCode, ComicID, Homepage) values ('$Count','$ModulePublished','left','$module','$ComicID',1)";
							$settings->query($query);
							print $query."<br/>";
				
						} else {
							$query = "UPDATE pf_modules set Position='$Count', IsPublished='$ModulePublished', Placement='left' where ModuleCode='$module' and ComicID ='$ComicID' and Homepage=1";
							$settings->query($query);
							print $query."<br/>";
						}
						$Count++;
				}
				
				$Count = 1;
				foreach ($RightColumnOrder as $module) {
					$ModulePublished = $RightColumnOrderPub[$Count-1];
					$query = "SELECT ID from pf_modules where ModuleCode='$module' and ComicID ='$ComicID' and Homepage=1";		$settings->query($query);
					print $query."<br/>";
					$Found = $settings->numRows();
					if ($Found == 0) {
						$query = "INSERT into pf_modules (Position, IsPublished, Placement, ModuleCode, ComicID, Homepage) values ('$Count','$ModulePublished','right','$module','$ComicID',1)";
						$settings->query($query);
						print $query."<br/>";
				
					} else {
						$query = "UPDATE pf_modules set Position='$Count', IsPublished='$ModulePublished', Placement='right' where ModuleCode='$module' and ComicID ='$ComicID' and Homepage=1";
						$settings->query($query);
						print $query."<br/>";
					}
					
					$Count++;
					print $query."<br/>";
				}
				
				$Count = 1;
				foreach ($InactiveColumnOrder as $module) {
					$query = "SELECT ID from pf_modules where ModuleCode='$module' and ComicID ='$ComicID' and Homepage=1";		$settings->query($query);
					print $query."<br/>";
					$Found = $settings->numRows();
					if ($Found == 0) {
						$query = "INSERT into pf_modules (Position, IsPublished, Placement, ModuleCode, ComicID, Homepage) values ('$Count','0','','$module','$ComicID',1)";
						$settings->query($query);
						print $query."<br/>";
				
					} else {
						$query = "UPDATE pf_modules set Position='$Count', IsPublished='0', Placement='' where ModuleCode='$module' and ComicID ='$ComicID' and Homepage=1";
						$settings->query($query);
						print $query."<br/>";
					}
					
					$Count++;
					print $query."<br/>";
				}
				
				$query = "UPDATE comic_settings SET HomepageActive='$HomepageActive',HomepageHTML='$HomepageHTML', HomepageType='$HomepageType' where ComicID='$ComicID'";
				$settings->query($query); 
				print $query."<br/>";
				echo 'Updated';
			
		} else {
			echo 'Not Authorized';

		}
	
} else {
			echo 'Not Authorized';

		}



?>