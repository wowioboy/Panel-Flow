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
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_link.php", $post_data);
	unset($post_data);
	
	if ($updateresult != 'Not Authorized') {
	$values = unserialize ($updateresult);
		$Title = mysql_real_escape_string($values['title']);
		$Link = $values['link']; 
		$Image = $values['image']; 
		$InternalLink = $values['internallink']; 
		$Description = mysql_real_escape_string($values['description']); 
	if ($Action == 'add') {
	  $query = "INSERT into links (ComicID, Title, Description, Link, EncryptID,Image,InternalLink) values ('$ComicID','$Title','$Description','$Link','$ItemID','$Image','$InternalLink')";
			$settings->query($query);
			
	} else if ($Action == 'edit') {
		 $query = "UPDATE links SET Title='$Title', InternalLink='$InternalLink', Description='$Description', Link='$Link',Image='$Image' WHERE EncryptID='$ItemID'";
		$settings->query($query);
	}  else if ($Action == 'delete') {
   $query = "DELETE from links WHERE EncryptID='$ItemID'";
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