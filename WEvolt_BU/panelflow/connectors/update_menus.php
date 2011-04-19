<?
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$config = array();
$Completed = 0;
include '../includes/db.class.php'; 
include '../includes/config.php';
$ComicID= $_POST['c'];
if ($ComicID == '') 
	$ComicID= $_GET['c'];
$UserID = $_POST['u'];
if ($UserID == '') 
	$UserID= $_GET['u'];
$MenuID = $_POST['m']; 
if ($MenuID == '') 
	$MenuID= $_GET['m']; 
$Action = $_POST['a'];
if ($Action == '') 
	$Action= $_GET['a'];
$Connect = $_POST['k'];
if ($Connect == '') 
	$Connect= $_GET['k'];
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
//print $query.'<br/>';
$ComicDir = substr($ComicFolder,0,1);

$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);
$AssistantArray = explode(',',$updateresult);	
//print 'ASSSIT RESULT = ' . $updateresult.'<br/>';

//print 'User ID = '  .$UserID.'<br/>';
//print' Comic User ='.  $ComicArray->userid.'<br/>';
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {

	$post_data = array('u' => $UserID, 'c' => $ComicID, 'k' => $Connect, 'l'=>$key,'m'=>$MenuID,'a'=>$Action);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_menus.php", $post_data);
	unset($post_data);
      print 'MY EXPORT RESULT = ' . $updateresult.'<br/>';
		if ($updateresult != 'Not Authorized') {
			$values = unserialize ($updateresult); 
			
			$Title = mysql_real_escape_string($values['Title']); 
			$Url = mysql_real_escape_string($values['Url']);
			$LinkType = mysql_real_escape_string($values['LinkType']);
			$Published = mysql_real_escape_string($values['IsPublished']);
			$Parent = mysql_real_escape_string($values['Parent']);
			$Position = mysql_real_escape_string($values['Position']);
			$ButtonImage = mysql_real_escape_string($values['ButtonImage']);
			$RolloverButtonImage = mysql_real_escape_string($values['RolloverButtonImage']);
			$MenuParent = mysql_real_escape_string($values['MenuParent']);
			$Target = mysql_real_escape_string($values['Target']);
			
			if ($ButtonImage != '') {
					$LocalName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/'. $ButtonImage;
					print 'LocalName IMAGE = ' . 	$LocalName.'<br/>';
					$RemoteFile = 'http://www.panelflow.com/comics/'.$ComicDir.'/'.$ComicFolder.'/images/'.$ButtonImage;
					print 'RemoteFile IMAGE = ' . 	$RemoteFile.'<br/>';
					$gif = file_get_contents(trim($RemoteFile)) or die('Could not grab the file');
					$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
					fputs($fp, $gif) or die('Could not write to the file');
					fclose($fp);
					chmod($LocalName,0777); 
			}
			if ($RolloverButtonImage != '') {
					$LocalName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/'. $RolloverButtonImage;
					$RemoteFile = 'http://www.panelflow.com/comics/'.$ComicDir.'/'.$ComicFolder.'/images/'.$RolloverButtonImage;
					$gif = file_get_contents(trim($RemoteFile)) or die('Could not grab the file');
					$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
					fputs($fp, $gif) or die('Could not write to the file');
					fclose($fp);
					chmod($LocalName,0777); 
			
			}
			if ($Action == 'delete') {
					$query = "DELETE from menu_links where EncryptID='$MenuID' and ComicID='$ComicID'";
					 $settings->execute($query);
					   print  $query.'<br/>';
			} else if ($Action == 'new') {
						$query = "INSERT into menu_links (ComicID, 
					   Title,
		  		       IsPublished,
					   LinkType,
					   Url,
					   Parent,
					   Position,
					   MenuParent,
					   Target,
					   ButtonImage,
					   RolloverButtonImage,EncryptID)
					    values 
						('$ComicID',
						'$Title',
						'$Published',
						'$LinkType',
						'$Url',
						'$Parent',
						'$Position',
						'$MenuParent',
						'$Target',
						'$ButtonImage',
						'$RolloverButtonImage','$MenuID')";
					   $settings->execute($query);
			  print  $query.'<br/>';
			} else if ($Action == 'edit') {
			$query = "UPDATE menu_links SET 
					   Title='$Title',
		  		       IsPublished='$Published',
					   LinkType='$LinkType',
					   Url='$Url',
					   Parent='$Parent',
					   Position='$Position',
					   MenuParent='$MenuParent',
					   Target='$Target',
					   ButtonImage='$ButtonImage',
					   RolloverButtonImage='$RolloverButtonImage'
					    where EncryptID='$MenuID' and ComicID='$ComicID'";
					   $settings->execute($query);
					     print  $query.'<br/>';
			}
			
			
			
		} else {
			echo 'Not Authorized';
		}
		
		$settings->close();
} else {
		echo 'Can\'t Complete Request';
} 
?>