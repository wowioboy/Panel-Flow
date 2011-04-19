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
$key = $config['liscensekey'];
//print "MY COMIC ID = " . $ComicID."<br/>";
//print "MY UserID  = " . $UserID."<br/>"; 
//print "MY Section  = " . $Section."<br/>";
//print "MY file set ID = " . $_POST['f']."<br/>";

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
if ($UserID == $ComicArray->userid) {
	$post_data = array('u' => $UserID, 'c' => $ComicID, 's' => $Section, 'k' => $_POST['k'], 'l'=>$key);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_creator.php", $post_data);
	unset($post_data);
	if ($updateresult != 'Not Authorized') {
	print 'THE UPDATE RESULT ON REMOTE = ' . $updateresult. "<br/><br/>";
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
		$CreatorID = $values['cid'];
		$Email = $values['email'];
		$CreatorOne = $values['CreatorOne']; 
		$CreatorTwo = $values['CreatorTwo'];
		$CreatorThree = $values['CreatorThree'];

	$query = "UPDATE creators SET realname='$CreatorName', avatar='$Avatar',influences='$Influences', about='$About', location='$Location', website='$Website', link1='$Link1', link2='$Link2',link3='$Link3',link4='$Link4',hobbies='$Hobbies', books='$Books', music='$Music', credits='$Credits', Email='$Email' WHERE comicid='$ComicID'";
	$settings->execute($query); 
	 print $query.'<br/>';
$query = "UPDATE comics set CreatorID='$CreatorID', CreatorEmail='$Email' where comiccrypt='$ComicID'";
$settings->execute($query);
print $query.'<br/>';
$query = "UPDATE comic_settings set CreatorOne='$CreatorOne', CreatorTwo='$CreatorTwo',CreatorThree='$CreatorThree' where ComicID='$ComicID'";
$settings->execute($query);
  print $query.'<br/>';
 $settings->close();
 echo 'Finished';
 } else {
  echo 'Not Authorized';
 }
} else {
echo 'Can\'t Complete Request';
 
} 
?>