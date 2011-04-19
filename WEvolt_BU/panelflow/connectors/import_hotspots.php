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
$PageID = $_POST['p'];
$Section = $_POST['s']; 
$Action = $_POST['a'];
$ItemID = $_POST['hsid'];

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
	$post_data = array('u' => $UserID, 'c' => $ComicID,'p' => $PageID,'hsid'=>$ItemID, 'k' => $_POST['k'], 'l'=>$key);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_hotspot.php", $post_data);
	unset($post_data);
	 echo 'EXPORT HOTSPOT = ' . $updateresult.'<br/>';
	if ($updateresult != 'Not Authorized') { 
	    $values = unserialize ($updateresult);
		$AsCoords = $values['ascoords']; 
		$MapCoords = $values['mapcoords']; 
		$HTMLCode = mysql_real_escape_string($values['htmlcode']); 
		$RGEntry = $values['rgentry'];  
		//$PageID = $values['pageid']; 
		//$UserID = $values['userid'];   
		if ($rgentry == ''); 
			$RGEntry = 0;
	print 'MY ACTION = ' . 	$Action;	
	if ($Action == 'new') {
	  $query = "INSERT into pf_hotspots (ComicID, PageID, AsterickCoords, HotSpotCoords, RGEntryID,HTMLCode,CreatedBy,EncryptID) values ('$ComicID','$PageID','$AsCoords','$MapCoords','$RGEntry','$HTMLCode','$UserID','$ItemID')";
			$settings->query($query);
			print $query.'<br/><br/>';
	} else if ($Action == 'edit') {
		 $query = "UPDATE pf_hotspots SET HTMLCode='$HTMLCode',RGEntryID='$RGEntry' WHERE PageID='$PageID' and AsterickCoords = '$AsCoords'";
		$settings->query($query);
		print $query.'<br/><br/>';
	}  else if ($Action == 'delete') {
   $query = "DELETE from pf_hotspots WHERE EncryptID='$ItemID'";
	$settings->query($query);
print $query.'<br/><br/>';
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