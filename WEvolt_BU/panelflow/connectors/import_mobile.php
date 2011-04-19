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
$Action = $_POST['a'];
$File = $_POST['f'];

//print "MY COMIC ID + " . $ComicID."<br/>";
//print "MY UserID ID + " . $UserID."<br/>";
//print "MY DownID ID + " . $ItemID."<br/>";
//print "MY Section ID + " . $Section."<br/>";
//print "MY Action ID + " . $Action."<br/>";
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
$ComicFolder = $ComicArray->url; 
//print "MY COMIC FOLDER = " . $ComicFolder."<br/>";
//print "admin = " . $ComicArray->userid."<br/>";
//print "creator = " . $ComicArray->CreatorID."<br/>";
$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);
$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {
	$post_data = array('u' => $UserID, 'c' => $ComicID,'p' => $ItemID, 'k' => $_POST['k'], 'l'=>$key);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_mobile.php", $post_data);
	unset($post_data);
	 if ($updateresult != 'Not Authorized') {
	$values = unserialize ($updateresult);
		$Title = mysql_real_escape_string($values['title']);
		$Image = $values['image'];
		$Thumb = $values['thumb'];
		$Type = $values['type'];
		$CreateDate = $values['CreateDate'];
		if ($CreateDate == '')
			$CreateDate = date('Y-m-d').' 00:00:00';
		
//GRAB SMALL THUMB 
//print "THUMBSM = " . $Thumbsm."<br/>";
	if (($File == 'yes') || ($Action == 'add')) {
		$NameArray = explode('/',$Thumb);
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5];
			//$NewThumb = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5];
		//} else {
			$LocalName = '../../'.$Thumb;
			$NewThumb = $ComicFolder.'/'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5];
		//}
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumb)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);  
		chmod($LocalName,0777);
		unset($NameArray);

//GRAB MEDIUM THUMB
		$NameArray = explode('/',$Image);
	//	if (($ComicFolder == '') || ($ComicFolder == '/')) {
		//	$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5];
			//$NewImage = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5];
		//} else {
			$LocalName = '../../'.$Image;
			$NewImage = $ComicFolder.'/'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5];
		//}
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Image)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		
		unset($NameArray);
 
	}	   
	if ($Action == 'add') {
	 $query = "INSERT into mobile_content (Title,Type,ComicID,Thumb,Image,EncryptID,CreateDate) values ('$Title','wallpaper','$ComicID','$NewThumb','$NewImage','$ItemID','$CreateDate')";
			$settings->query($query);
			
	} else if ($Action == 'edit') {
		$query = "UPDATE mobile_content set Title='$Title', Thumb ='$NewThumb', Image='$NewImage' where EncryptID='$ItemID'";
		$settings->query($query);
	} else if ($Action == 'update') {
		$query = "UPDATE mobile_content set Title='$Title' where EncryptID='$ItemID'"; 
	$settings->query($query);
 //print  $query ; 
 } else if ($Action == 'delete') {
  	$query = "DELETE from mobile_content where EncryptID='$ItemID'"; 
	$settings->query($query);

 }
 $settings->close();
 echo 'Finished';
 } else {
 	echo 'Not Authorized';
 }
} else {
echo 'Can\'t Complete Request';

} 
?>