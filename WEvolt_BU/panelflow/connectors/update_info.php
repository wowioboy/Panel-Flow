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
$File = $_POST['f'];
$RemoveHeader = $_POST['r'];

print "MY COMIC ID = " . $ComicID."<br/>";
print "MY UserID  = " . $UserID."<br/>"; 
print "MY Section  = " . $Section."<br/>";
print "MY file set ID = " . $_POST['f']."<br/>";

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
	$post_data = array('u' => $UserID, 'c' => $ComicID, 's' => $Section, 'k' => $_POST['k'], 'l'=>$key);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_info.php", $post_data);
	print 'Result from PF = ' . $updateresult;
	unset($post_data);
	 
	if ($updateresult != 'Not Authorized') {

	if ($Section == 'Creator') {
		$values = unserialize ($updateresult); 
		$CreatorName = mysql_real_escape_string($values['username']);
		$Influences = mysql_real_escape_string($values['influences']); 
		$About = mysql_real_escape_string($values['about']); 
		$Location = mysql_real_escape_string($values['location']);
		$Hobbies = mysql_real_escape_string($values['hobbies']);
		$Website = $values['website'];
		$Link1 = $values['link1'];
		$Link2 = $values['link2'];
		$Link3 = $values['link3'];
		$Link4 = $values['link4'];
		$Music = mysql_real_escape_string($values['music']);
		$Credits = mysql_real_escape_string($values['credits']);
		$Books = mysql_real_escape_string($values['books']);
		$Avatar = $values['avatar'];
		$CreatorOne = $values['CreatorOne']; 
		$CreatorTwo = $values['CreatorTwo'];
		$CreatorThree = $values['CreatorThree'];
	}
	
	if ($Section =='Comic') {	
		$values = unserialize ($updateresult);
		$Writer = mysql_real_escape_string($values['writer']);
		$Genre = mysql_real_escape_string($values['genre']);
		$Tags = mysql_real_escape_string($values['tags']);
		$Synopsis = mysql_real_escape_string($values['synopsis']);
		$Creator = mysql_real_escape_string($values['creator']);
		$Artist = mysql_real_escape_string($values['artist']);
		$Colorist = mysql_real_escape_string($values['colorist']);
		$Letterist = mysql_real_escape_string($values['letterist']);
		$ComicFormat = $values['comicformat'];
		$UpdateSchedule = $values['updateschedule'];
		$ArrowBg = $values['arrowbg'];
		$ButtonBg = $values['buttonbg'];
		$SiteBg = $values['sitebg'];
		$TitleColor = $values['titlecolor'];
		$ControlBg = $values['controlbg'];
		$Copyright = $values['copyright'];
		$Header = $values['header'];
	} 
//GRAB SMALL THUMB 
//print "THUMBSM = " . $Thumbsm."<br/>";
	if (($File == 'yes') && ($Section == 'Comic')) {
		$NameArray = explode('/',$Header);
		//$ComicDir = substr(trim($ComicFolder), 0, 1);
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4];
			//$NewHeader = $NameArray[3].'/'.$NameArray[4];
	//	} else {
			$LocalName = '../../'.$Header;
			$NewHeader = $NameArray[3].'/'.$NameArray[4];
		//}
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Header)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);  
		chmod($LocalName,0777);
		unset($NameArray);

	}	   
	if ($Section == 'Creator') {
	 
	$query = "UPDATE creators SET realname='$CreatorName', avatar='$Avatar',influences='$Influences', about='$About', location='$Location', website='$Website', link1='$Link1', link2='$Link2',link3='$Link3',link4='$Link4',hobbies='$Hobbies', books='$Books', music='$Music', credits='$Credits' WHERE comicid='$ComicID'";
	$settings->query($query); 
	print $query."<br/>";
	$query = "UPDATE comic_settings set CreatorOne='$CreatorOne', CreatorTwo='$CreatorTwo',CreatorThree='$CreatorThree' where ComicID='$ComicID'";
$settings->execute($query);

	print $query."<br/>";
	} else if ($Section == 'Comic') {
	$query = "UPDATE comics SET genre='$Genre', tags='$Tags', writer='$Writer', creator='$Creator', artist='$Artist', colorist='$Colorist', letterist='$Letterist', synopsis='$Synopsis'  WHERE comiccrypt='$ComicID'";
		$settings->query($query);
		print $query."<br/>";
	$query = "UPDATE comic_settings SET ComicFormat='$ComicFormat', UpdateSchedule='$UpdateSchedule', Copyright='$Copyright' where ComicID='$ComicID'";
		$settings->query($query);
		print $query."<br/>"; 
		if ($File == 'yes') {
			$query = "UPDATE comic_settings SET Header='$NewHeader' where ComicID='$ComicID'";
			$settings->query($query);
		print $query."<br/>";
		}
		if ($RemoveHeader == 1) {
			$query = "UPDATE comic_settings SET Header='' where ComicID='$ComicID'";
			$settings->query($query);
		}
 print  $query ;  
 } 
  
 $settings->close();
 echo 'Finished';
 } else {
 	'Not Authorized';
 }
} else {
echo 'Can\'t Complete Request';

} 
?>