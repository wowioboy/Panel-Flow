<?

$AdminEmail = $config['adminemail'];
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
$Change = $_POST['c'];
$File = $_POST['f'];

print "MY COMIC ID + " . $ComicID."<br/>";
print "MY UserID ID + " . $UserID."<br/>";
print "MY DownID ID + " . $ItemID."<br/>";
print "MY Section ID + " . $Section."<br/>";
print "MY Action ID + " . $Action."<br/>";
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
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_download.php", $post_data);
	unset($post_data);
	print '<br/>IMPORT RESULT = ' . $updateresult.'<br/><br/>';
	if ($updateresult != 'Not Authorized') {
	$values = unserialize ($updateresult);
		$Name = mysql_real_escape_string($values['name']); 
		$Comment = mysql_real_escape_string($values['comment']);
		$DLtype = $values['dltype'];
		$Filename = $values['filename'];
		$Resolution = $values['resolution'];
		$Image = $values['image'];
		$Thumb = $values['thumb']; 
		$Description = mysql_real_escape_string($values['description']);
		$CreateDate = $values['CreateDate'];
		if ($CreateDate == '')
			$CreateDate = date('Y-m-d').' 00:00:00';

//GRAB SMALL THUMB 
//print "THUMBSM = " . $Thumbsm."<br/>";
	if (($File == 'yes') || ($Action == 'add')) {
		$NameArray = explode('/',$Thumb);
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//if ($DLtype == '3') {
				//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
				//$NewThumb = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			//} else {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6].'/'.$NameArray[7];
			//$NewThumb = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6].'/'.$NameArray[7];
			//}
			
		//} else {
			if ($DLtype == '3') { 
				$LocalName = '../../'.$Thumb;
				$NewThumb = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			} else {
				$LocalName = '../../'.$Thumb;
				$NewThumb = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6].'/'.$NameArray[7];
			}
			
			
		//}
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumb)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp); 
		chmod($LocalName,0777);
		unset($NameArray);

//GRAB MEDIUM THUMB 

		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			//$NewImage = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//} else {
			$NameArray = explode('/',$Image);
			$LocalName = '../../'.$Image;
			$NewImage = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//}
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Image)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		
		unset($NameArray);
		
		if ($DLtype == '4') { 
			$NameArray = explode('/',$Filename);
			$LocalName = '../../'.$Filename;
			$Filename = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//}
			$gif = file_get_contents('http://www.panelflow.com/'.trim($Filename)) or die('Could not grab the file');
			$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
			fputs($fp, $gif) or die('Could not write to the file');
			fclose($fp);
			chmod($LocalName,0777);
		
			unset($NameArray);
		}
 
	}	 
	if ($Action == 'add') {
	 $query = "INSERT into downloads (ComicID, Name, Description, DlType,  Image, Thumb, EncryptID,Filename, CreateDate) values ('$ComicID','$Name','$Description','$DLtype','$NewImage', '$NewThumb','$ItemID','$Filename','$CreateDate')";
$settings->query($query);
			print $query.'<br/><br/>';
	} else if (($Action == 'edit') && ($File = 'yes')) {
			$query = "UPDATE downloads SET Image='$NewImage', Thumb='$NewThumb' WHERE EncryptID='$ItemID'";
		$settings->query($query);
	} else if (($Action == 'edit') || ($Action == 'editinfo')) {
	 $query = "UPDATE downloads SET Name='$Name', Description='$Description', DlType='$DLtype'  WHERE EncryptID='$ItemID'";
	$settings->query($query);
print $query.'<br/><br/>';
 } else if ($Action == 'delete') {
  	$query = "DELETE from downloads WHERE EncryptID='$ItemID'";
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