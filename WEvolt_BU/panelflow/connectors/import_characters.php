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
$Change = $_POST['c'];
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
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_character.php", $post_data);
	unset($post_data);
	echo '<br/><br/>UPDATE RESULT FROM EXPORT CHARACTER = ' . $updateresult.'<br/><br/>';
	if ($updateresult != 'Not Authorized') {
	$values = unserialize ($updateresult);
		$Name = mysql_real_escape_string($values['name']);
		$Hometown = mysql_real_escape_string($values['hometown']);
		$Race = mysql_real_escape_string($values['race']);
		$HeightFt = mysql_real_escape_string($values['heightft']);
		$HeightIn = mysql_real_escape_string($values['heightin']);
		$Weight = mysql_real_escape_string($values['weight']);
		$Notes = mysql_real_escape_string($values['notes']);
		$Image = $values['image']; 
		$Thumb = $values['thumb']; 
		$Filename = $values['filename']; 
		$Abilities = mysql_real_escape_string($values['abilities']); 
		$Age = mysql_real_escape_string($values['age']); 
		$Description = mysql_real_escape_string($values['description']);
		$CreateDate = $values['CreateDate'];
		if ($CreateDate == '')
			$CreateDate = date('Y-m-d').' 00:00:00';

//GRAB SMALL THUMB 
//print "THUMBSM = " . $Thumbsm."<br/>";
	if (($File == 'yes') || ($Action == 'add')|| ($Action == 'finish')) {
		$NameArray = explode('/',$Thumb);
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			//$NewThumb = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//} else {
			$LocalName = '../../'.$Thumb;
			$NewThumb = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//}
		print 'LOCALNAME = ' . $LocalName.'<br/>';
		print 'NewThumb = ' . $NewThumb.'<br/>';
		print 'Thumb = ' . $Thumb.'<br/>';
		
		
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumb)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);  
		chmod($LocalName,0777);
		unset($NameArray);

//GRAB MEDIUM THUMB
		$NameArray = explode('/',$Image);
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5];
			//$NewImage = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5]; 
		//} else {
			$LocalName = '../../'.$Image;
			$NewImage = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5];
		//}
		print 'LOCALNAME = ' . $LocalName.'<br/>';
		print 'NewThumb = ' . $NewThumb.'<br/>';
		print 'Thumb = ' . $Image.'<br/>';
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Image)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		 
		unset($NameArray);
 
	}	   
	if (($Action == 'add') || ($Action == 'finish')) {
	 $query = "INSERT into characters (ComicID, Name, Hometown, Race, Age, HeightFt, HeightIn, Weight, Abilities, Description, Notes, Image, Thumb, EncryptID,CreateDate) values ('$ComicID','$Name','$Hometown','$Race','$Age','$HeightFt', '$HeightIn', '$Weight', '$Abilities','$Description', '$Notes','$NewImage', '$NewThumb','$ItemID','$CreateDate')";
			$settings->query($query);
			print $query.'<br/><br/>';
	} else if ((($Action == 'edit')||($Action == 'save')) && ($File == 'yes')) {
		$query = "UPDATE characters SET Image='$NewImage', Thumb='$NewThumb' WHERE EncryptID='$ItemID'";
		$settings->query($query);
	} else if (($Action == 'edit') || ($Action == 'editinfo')||($Action == 'save')) {
	$query = "UPDATE characters SET Name='$Name', Hometown='$Hometown', Race='$Race', Age='$Age', HeightFt='$HeightFt', HeightIn='$HeightIn', Weight='$Weight',Abilities='$Abilities',Description='$Description',Notes='$Notes' WHERE EncryptID='$ItemID'";
	$settings->query($query);
print $query.'<br/><br/>';
 } else if ($Action == 'delete') {
   $query = "DELETE from characters WHERE EncryptID='$ItemID'";
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