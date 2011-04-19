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
$Template = $_POST['t'];
$Published = $_POST['pub'];
$AdSpace = $_POST['p'];
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
print $query."<br/>";
print "USER = " . $UserID."<br/>";
$ComicArray = $settings->queryUniqueObject($query);
print "admin = " . $ComicArray->userid."<br/>";
print "creator = " . $ComicArray->CreatorID."<br/>";  
$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);

$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {
	$post_data = array('u' => $UserID, 'c' => $ComicID,'p' =>$AdSpace,'t' =>$Template, 'k' => $_POST['k'], 'l'=>$key);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/update_ads.php", $post_data);
	unset($post_data); 
	print 'MY UPDATE ADS RESULT FROM PF= ' . $updateresult.'<br/>';
	if ($updateresult != 'Not Authorized') { 
		$AdCode = mysql_real_escape_string(trim($updateresult));
		$query = "UPDATE adspaces SET AdCode='$AdCode', Published='$Published' where ComicID='$ComicID' and Position='$AdSpace' and Template='$Template'";
		$settings->query($query); 
		print $query.'<br/>';
		echo 'Updated';	
	} else {
		echo 'Not Authorized';
	}  
} else { 
	echo 'No Access';	
}
?>