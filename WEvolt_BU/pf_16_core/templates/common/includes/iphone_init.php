<?php
 if(!isset($_SESSION)) {
    session_start();
  } 
$Version = '1-5 Pro';

//include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/includes/db.class.php';	
$settingsdb = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "SELECT * from comic_settings where ComicID='$ComicID'";
$SettingArray= $settingsdb->queryUniqueObject($query);
$ContactSetting = $SettingArray->Contact;
$CommentSetting = $SettingArray->AllowComments;
$ArchiveSetting = $SettingArray->ShowArchive;
$CalendarSetting = $SettingArray->ShowCalendar;
$ChapterSetting = $SettingArray->ShowChapter;
$EpisodeSetting = $SettingArray->ShowEpisode;
$Assistant1 = $SettingArray->Assistant1;
$Assistant2 = $SettingArray->Assistant2;
$Assistant3 = $SettingArray->Assistant3;
$ShowBio = $SettingArray->BioSetting;
$TEMPLATE = $SettingArray->Template;
$Remote = $_SERVER['REMOTE_ADDR'];
$RemoteID = $_SESSION['userid'];
file_get_contents ('https://www.panelflow.com/processing/updatecomic.php?action=tracking&comicid='.$ComicID.'&page='.$Pagetracking.'&remote='.$Remote.'&id='.$RemoteID);
$query = "select * from comics where comiccrypt = '$ComicID'";
$settingsdb->query($query);
while ($setting = $settingsdb->fetchNextObject()) { 
	$BarColor = $setting->ControlBg;
	$TextColor= $setting->TitleColor;
	$MovieColor= $setting->SiteBg;
	$ButtonColor= $setting->ButtonBg;
	$ArrowColor= $setting->ArrowBg;
	$ComicTitle = stripslashes($setting->title);
	$Creator = $setting->creator;
	$Writer = $setting->writer;
	$Artist = $setting->artist;
	$Colorist = $setting->colorist;
	$Letterist = $setting->letterist;
	$Synopsis = $setting->synopsis;
	$Tags = $setting->tags;
	$Genre = $setting->genre;
	$Copyright = $setting->Copyright;
	$HeaderImage = $setting->Header;
	$ComicFolder = $setting->url;
}
$query = "select Avatar from creators where ComicID = '$ComicID'";
$Avatar = $settingsdb->queryUniqueValue($query);
$query = "select realname from creators where ComicID = '$ComicID'";
$CreatorName = $settingsdb->queryUniqueValue($query);
$query = "select Email from creators where ComicID = '$ComicID'";
$CreatorEmail = $settingsdb->queryUniqueValue($query);
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
} else if (($_SESSION['email'] == $Assistant1)|| ($_SESSION['email'] == $Assistant2) || ($_SESSION['email'] == $Assistant3) || ($_SESSION['email'] == $CreatorEmail)) {
$_SESSION['usertype'] = '2';
$_SESSION['comicassist'] = $ComicID;
} else {
$_SESSION['usertype'] = '0';
}

if ($_SESSION['email'] == "") {
$_SESSION['usertype'] = '0';
} 
$settingsdb->close();


?>