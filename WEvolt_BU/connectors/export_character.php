<?php 
$userhost = 'localhost';
$dbuser = 'panel_panel';
$userpass ='pfout.08';
$userdb = 'panel_panel';
$ComicID = $_POST['c'];
$ItemID = $_POST['p'];
$UserID = $_POST['u'];
$Section = $_POST['s'];
$License = $_POST['l'];
$ConnectKey = $_POST['k'];
mysql_connect ($userhost, $dbuser,$userpass) or die ('Could not connect to the database.');
mysql_select_db ($userdb) or die ('Could not select database.');

$query = "SELECT * from users where encryptid ='$UserID' and ConnectKey='$ConnectKey'";
 $result = mysql_query($query);
 $Connected = mysql_num_rows($result);
 $user = mysql_fetch_array($result);
 
 if ($Connected == 1) {
 
 $query = "UPDATE users set ConnectKey='inactive' where encryptid ='$UserID'";
 $result = mysql_query($query);
 
 $query = "SELECT * from comics where comiccrypt ='$ComicID' and (userid='$UserID' or CreatorID='$UserID')";
 $result = mysql_query($query);
 $Authorized = mysql_num_rows($result);
 $comic = mysql_fetch_array($result);
 $ComicFolder = $comic['HostedUrl'];
 $CreatorID = $comic['CreatorID'];
 $AppInstalltion = $comic['AppInstallation'];
	if ($Authorized == 0) {
		 $query = "SELECT * from comic_settings where ComicID ='$ComicID'";
 		 $result = mysql_query($query);
 		 $comicsettings = mysql_fetch_array($result);
		 $UserEmail = $user['email'];
		if (($UserEmail == $comicsettings['Assistant1']) || ($UserEmail == $comicsettings['Assistant2']) || ($UserEmail == $comicsettings['Assistant3'])) {
			$Authorized = 1;
			$query = "SELECT * from comics where comiccrypt ='$ComicID'";
 	 $result = mysql_query($query);
// print 'EXPORT PAGES : ' . $query.'<br/><br/><br/>';
 	$comic = mysql_fetch_array($result);
    $ComicFolder = $comic['HostedUrl'];
    $AppInstallation = $comic['AppInstallation'];
		}
	}
	
	if ($Authorized == 1) {
		 $query = "SELECT * from Applications where ID='$AppInstalltion' and LicenseID='$License'";
 		 $result = mysql_query($query);
 		 $Authorized = mysql_num_rows($result);
	}
 	
	if ($Authorized == 0) {
		echo 'Not Authorized';
	} else {
 	$query = "SELECT * from characters where EncryptID ='$ItemID'";
 	$result = mysql_query($query);
 	$page = mysql_fetch_array($result);
	$myValues = array (
 	'name' => trim($page['Name']),
	'hometown' => trim($page['Hometown']),
	 'race' => trim($page['Race']),
	 'heightft' => trim($page['HeightFt']),
	 'heightin' =>  trim($page['HeightIn']),
	 'weight' =>  trim($page['Weight']),
	 'notes' =>  trim($page['Notes']),
	 'image' =>  'comics/'.$ComicFolder.'/'.trim($page['Image']),
	 'thumb' =>  'comics/'.$ComicFolder.'/'.trim($page['Thumb']),
	 'filename' =>  trim($page['Filename']),
	 'abilities' =>  trim($page['Abilities']),
	 'CreateDate' =>  trim($page['CreateDate']),
	 'age' =>  trim($page['Age']),
	 'description' => trim($page['Description']));
	echo serialize ($myValues);
 }
} else {
echo 'Connection Failed';
}
?>


