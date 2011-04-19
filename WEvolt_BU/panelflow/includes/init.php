<?php
 if(!isset($_SESSION)) {
    session_start();
  } 
$Version = 'Pro1-5';
$config = array();
include 'db.class.php'; 
include 'config.php';
//include 'settings_inc.php'; 
$AdminUser = $config['name'];
$AdminEmail = $config['adminemail'];
$AdminUserID = $config['adminuserid'];
$PFDIRECTORY = $config['pathtopf'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];
$key = $config['liscensekey'];
$settings = new DB($db_database,$db_host, $db_user, $db_pass);
if ((isset($_GET['id'])) || (isset($_POST['txtComic']))) {
	$ComicID = $_GET['id'];
	$query = "select Email from creators where ComicID='$ComicID'";
	$CreatorEmail = $settings->queryUniqueObject($query);
	if ($_SESSION['email'] == $CreatorEmail) {
		$_SESSION['comicassist'] = $ComicID;
	}
	$query = "select * from comics where comiccrypt = '$ComicID'";
	$settings->query($query);
	while ($setting = $settings->fetchNextObject()) { 
		$BarColor = $setting->ControlBg;
		$TextColor= $setting->TitleColor; 
		$MovieColor= $setting->SiteBg;
		$ButtonColor= $setting->ButtonBg;
		$ArrowColor= $setting->ArrowBg;
		$AdminID = $setting->userid;
		$ReaderType = $setting->ReaderType;
	}
} else {
	
}
$CreatorEmails = array ();
	$query = "select Email from creators";
 	$settings->query($query);
 	$i=0;
	while ($setting = $settings->fetchNextObject()) { 
		$CreatorEmails[$i] = $setting->Email;
		$i++;
	}


$settings->close();
if (in_array($_SESSION['email'], $CreatorEmails)) {
   		 $_SESSION['usertype'] = '2';
		 $CreatorAccessEmail = $_SESSION['email'];
		 $CreatorComics = array ();
		$query = "select ComicID from creators where Email ='$CreatorAccessEmail'";
 		$settings->query($query);
		$numComics = $settings->numRows();
 		$i=0;
		while ($setting = $settings->fetchNextObject()) { 
			$CreatorComics[$i] = $setting->ComicID;
			$i++;
		}
		if ($numComics == 1) {
			$_SESSION['comicassist'] = $ComicID;
		}
		 
}


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

if ($_SESSION['email'] == $AdminEmail){
	 $_SESSION['usertype'] = '1';
} else if (($_SESSION['email'] == $Assistant1)|| ($_SESSION['email'] == $Assistant2) || ($_SESSION['email'] == $Assistant3) || (		$_SESSION['email'] == $CreatorEmail)) {
	$_SESSION['usertype'] = '2';
} else {
	if (in_array($_SESSION['email'], $CreatorEmails)) {
   		 $_SESSION['usertype'] = '2';
	} else {
		$_SESSION['usertype'] = '0';
	}
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