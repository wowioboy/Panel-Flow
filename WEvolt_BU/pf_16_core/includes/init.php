<?php
 if(!isset($_SESSION)) {
    session_start();
  }
 
 $DEBUG=false;
  
 if ($DEBUG) {
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL ^ E_NOTICE);

}
$Version = 'Pro1-5';
$config = array(); 
include 'db.class.php'; 
include 'config.php';
//include 'settings_inc.php'; 
$AdminUser = $_SESSION['username'];
$AdminEmail = $_SESSION['email'];
$AdminUserID = $_SESSION['userid'];
$SiteAdmins = array('d67d8ab427','7e7757b1a6','d61e4bbd1c1','9778d5d252','a8c88a00134','44f683a83e');
//print 'MY ADMIN EMAIL = ' . $AdminEmail;
$PFDIRECTORY = $config['pathtopf'];
$db_user = 'panel_panel';
$db_pass = 'pfout.08';
$db_database = 'panel_panel';
$db_host = 'localhost';
$key = $config['liscensekey'];
$settings = new DB($db_database,$db_host, $db_user, $db_pass);

if ($ContentType != 'story') {
$query = "SELECT ComicID from comic_settings where Assistant1='$AdminEmail' or Assistant2='$AdminEmail' or Assistant3='$AdminEmail'";
} else {
$query = "SELECT StoryID from story_settings where Assistant1='$AdminEmail' or Assistant2='$AdminEmail' or Assistant3='$AdminEmail'";
}
$settings->query($query);
$IsAssistant = $settings->numRows();

if ((isset($_GET['id'])) || (isset($_POST['txtComic']))|| (isset($_POST['txtStory']))) {
	$SafeFolder = $_GET['id'];
	
	if ($SafeFolder == '') {
		if ($ContentType != 'story') {
			$ComicID = $_POST['txtComic'];
			$query = "SELECT * 
				FROM comics as c 
				JOIN comic_settings as cs on c.comiccrypt=cs.ComicID 
				JOIN Applications as a on c.AppInstallation=a.ID 
				WHERE c.comiccrypt='$ComicID'";
		} else {
			$StoryID = $_POST['txtStory'];
			$query = "SELECT * 
				FROM stories as c 
				JOIN story_settings as cs on c.StoryID=cs.StoryID 
				JOIN Applications as a on c.AppInstallation=a.ID 
				WHERE c.StoryID='$StoryID'";
		
		}
	} else {
		if ($ContentType != 'story') 
			$query = "SELECT * 
				FROM comics as c 
				JOIN comic_settings as cs on c.comiccrypt=cs.ComicID 
				JOIN Applications as a on c.AppInstallation=a.ID 
				JOIN creators as cr on c.comiccrypt=cr.ComicID
				WHERE c.SafeFolder='$SafeFolder'";
		else 
			$query = "SELECT * 
				FROM stories as c 
				JOIN story_settings as cs on c.StoryID=cs.StoryID 
				JOIN Applications as a on c.AppInstallation=a.ID 
				JOIN creators as cr on c.StoryID=cr.StoryID
				WHERE c.SafeFolder='$SafeFolder'";
	}
	//print $query;
	$ComicArray = $settings->queryUniqueObject($query);
	$ComicTitle = $ComicArray->title;
	$ComicFolder = $ComicArray->HostedUrl;
	$ComicAdmin = $ComicArray->userid;
	$SafeFolder = $ComicArray->SafeFolder;
	$CreatorID = $ComicArray->CreatorID;
	$AdminUserID = $ComicArray->userid;
	$ComicID = $ComicArray->comiccrypt;
	$StoryID = $ComicArray->StoryID;
	$ExternalUrl = $ComicArray->url;
	$CreatorEmail = $ComicArray->Email;
	$Assistant1 = $ComicArray->Assistant1;
	$Assistant2 = $ComicArray->Assistant3;
	$Assistant3 = $ComicArray->Assistant2;
	$OwnerID = $ComicArray->userid;
	$Hosted = $ComicArray->Hosted;
	if ($Hosted == 1)
		$ExternalUrl .= '/';
	//print 'MY COMIC ID = ' . $ComicID;
	if ($_SESSION['email'] == $CreatorEmail) {
		$_SESSION['comicassist'] = $ComicID;
		$_SESSION['storyassist'] = $StoryID;
	}
	
} else {

	
}

	$CreatorComics = array ();
	if ($ContentType != 'story') 
		$query = "select comiccrypt from comics where (userid='$AdminUserID' or CreatorID='$AdminUserID')";
	else
		$query = "select StoryID from stories where (userid='$AdminUserID' or CreatorID='$AdminUserID')";
 	$settings->query($query);
	$numComics = $settings->numRows();
 	while ($setting = $settings->fetchNextObject()) { 
			if ($ContentType != 'story') 
				$CreatorComics[$i] = $setting->comiccrypt;
			else
				$CreatorComics[$i] = $setting->StoryID;
			$i++;
	}
	
	$AssistantComics = array ();
	if ($ContentType != 'story') 
	$query = "select ComicID from comic_assistants where UserID='$AdminUserID'";
	else
	$query = "select StoryID from comic_assistants where UserID='$AdminUserID'";
 	$settings->query($query);
	$numassistantComics = $settings->numRows();
 	while ($setting = $settings->fetchNextObject()) { 
			if ($ContentType != 'story') 
				$AssistantComics[$i] = $setting->ComicID;
			else
				$AssistantComics[$i] = $setting->StoryID;
			$i++;
	}
	
	
	$settings->close();	 

function is_authed()
{
     // Check if the encrypted username is the same
     // as the unencrypted one, if it is, it hasn't been changed
	 
     if (isset($_SESSION['email']) && (md5($_SESSION['email']) == $_SESSION['encrypted_email']))
     {
          return true;
     }
     else
     {
          return false;
     }
}
 
if (is_authed()) {  
	$loggedin = 1;
} else {
	$loggedin = 0;
} 

if ((($_SESSION['userid'] == $OwnerID) && (isset($_GET['id']))) || ($_SESSION['userid'] == $AdminUserID)){
	 $_SESSION['usertype'] = '1';

} else if (($_SESSION['email'] == $Assistant1)|| ($_SESSION['email'] == $Assistant2) || ($_SESSION['email'] == $Assistant3) || (		$_SESSION['email'] == $CreatorEmail)) {
	$_SESSION['usertype'] = '2';
	$_SESSION['comicassist'] == $ComicID;
	$_SESSION['storyassist'] = $StoryID;
} else {
	if ($IsAssistant > 0) // $_SESSION['usertype'] = '2';
		// $_SESSION['comicassist'] == $ComicID;
	//} else {
		$_SESSION['usertype'] = '2';
	else 
		$_SESSION['usertype'] = '0';
	//}
}

if ($_SESSION['email'] == "") {
	$_SESSION['usertype'] = '0';
} 

 if (!function_exists("file_get_contents")) {
   /**
    * Reads entire file into a string
    * This function is not available in early versions of PHP 4 and it is used by FORMfields, therefore it is implemented in FORMfields.
    * @see file_get_contents
    * @since FORMfields v3.0
    */
   function file_get_contents($filename)
   {
      return implode('', file($filename));
   }
} 
include 'liscense.php';
?>