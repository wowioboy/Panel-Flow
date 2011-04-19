<?
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$config = array();
include '../includes/db.class.php'; 
include '../includes/config.php';
$ComicID= $_POST['c'];
$UserID = $_POST['u'];
$ItemID = $_POST['p'];
$Section = $_POST['s']; 
$Action = $_POST['a'];

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
$ComicFolder = $ComicArray->url; 
$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);
$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {
	$post_data = array('u' => $UserID, 'c' => $ComicID, 'k' => $_POST['k'], 'l'=>$key);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_cover.php", $post_data);
	unset($post_data);
	if ($updateresult != 'Not Authorized') {
		$values = unserialize ($updateresult); 
		$Cover = $values['image']; 
		$Thumb = $values['thumb']; 
		
		$NameArray = explode('/',$Cover);
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4];
			//$NewHeader = $NameArray[3].'/'.$NameArray[4];
		//} else {
			$LocalName = '../../'.$Cover;
			
		//}
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Cover)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);  
		chmod($LocalName,0777);
		unset($NameArray);
		
		$NameArray = explode('/',$Thumb);
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4];
		//} else {
			$LocalName = '../../'.$Thumb;
	
		//}
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumb)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);  
		chmod($LocalName,0777);
		unset($NameArray);
 		$settings->close();
 		echo 'Finished';
		} else {
			echo 'Not Authorized';
		}
} else {
echo 'Can\'t Complete Request';

} 
?>