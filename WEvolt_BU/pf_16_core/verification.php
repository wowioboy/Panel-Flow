<?php include 'includes/init.php';
$InviteCode = $_GET['id'];
$Email = $_GET['email'];

if (($_GET['id'] != '') && ($_GET['email'] != '')) {
$comicdb = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from creatorinvites where InviteCode='$InviteCode' and Email='$Email'";
$comicdb->query($query);
$Result = $comicdb->numRows();
while ($invite = $comicdb->fetchNextObject()) { 
$ComicID = $invite->ComicID;
}
$CreatorLoaded = 0;
if ($Result == 1) {

	$query = "SELECT * from users where email='$Email' and verified=1";
			$UserArray = $comicdb->queryUniqueObject($query);
		if ($UserArray->username == '') {
			$Found = 0;
		} else {
			$Found = 1;
			$myValues = array (
 			'avatar' => trim($UserArray->avatar),
			'location' => trim($UserArray->location),
 			'username' => trim($UserArray->username),
 			'about' => trim($UserArray->about),
 			'music' => trim($UserArray->music),
 			'books' => trim($UserArray->books),
 			'influences' => trim($UserArray->influences),
 			'credits' => trim($UserArray->credits),
 			'hobbies' => trim($UserArray->hobbies),
 			'link1' => trim($UserArray->link1),
 			'link2' => trim($UserArray->link2),
 			'link3' => trim($UserArray->link3),
 			'link4' => trim($UserArray->link4),
 			'website' => trim($UserArray->website));
			$ProfileArray = serialize ($myValues);
		}

		if ($Found == 0) {
			$Error = '<div style="padding:20px;">You have not verified your Panel Flow Account yet. Please check the links sent to your email and try again.</div>';
			$CreatorLoaded = 0;
		} else {
			$CreatorLoaded = 1;
			$values = unserialize ($profileresult);
			$CreatorName = $values['username'];
			$Influences = $values['influences'];
			$Bio = $values['about'];
			$Location = $values['location'];
			$Hobbies = $values['hobbies'];
			$Website = $values['website'];
			$Link1 = $values['link1'];
			$Link2 = $values['link2'];
			$Link3 = $values['link3'];
			$Link4 = $values['link4'];
			$Music = $values['music'];
			$Credits = $values['credits'];
			$Books = $values['books'];
			$Avatar = $values['avatar'];
			 $query = "Update creators set avatar='$Avatar', realname='$CreatorName', location='$Location', about='$Bio', website='$Website', music='$Music', books='$Books', hobbies='$Hobbies', influences='$Influences', credits='$Credits', link1='$Link1', link2='$Link2', link3='$Link3', link4='$Link4', Email='$Email' where ComicID ='$ComicID'";
	// print  $query;
	$query = "UPDATE users SET iscreator=1 WHERE email='$Email'";
	$comicdb->query($query);
	
	$query = "SELECT encryptid from users where email='$Email'";
	$CreatorID = $comicdb->queryUniqueValue($query);
	
	$query = "UPDATE comics set CreatorID='$CreatorID' where comiccrypt='$ComicID'";
	 $comicdb->query($query);
	 
	 $query = "SELECT SafeFolder from comics where comiccrypt='$ComicID'";
	 $SafeFolder = $comicdb->queryUniqueValue($query);
	 
		 $query = "delete from creatorinvites where InviteCode='$InviteCode' and Email='$Email'";
	 $comicdb->query($query);
		}
		} else {
		$Error = '<div style="padding:20px;">The Invitation Code or Email Do Not Match, or you have not verified your Panel Flow Account yet. Please check the links sent to your email and try again.</div>';
		}
		
}
$comicdb->close();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK href="http://www.panelflow.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://www.panelflow.com/scripts/swfobject.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PANEL FLOW - CREATOR VERIFICATION</title>
</head>

<body>
<?php include 'includes/header.php'; ?>
<div style="height:300px; padding:30px;">
<?php 
if ($CreatorLoaded == 0) {
echo $Error;
} else { ?>
Your invitation has been confirmed, you can now log in with access to the administration tools for your comic. <br />
<br />
Click <a href='/cms/edit/<? echo $SafeFolder;?>/'>HERE</a> to get started!
<? }

?>
</div>
<?php include 'includes/footer.php'; ?>