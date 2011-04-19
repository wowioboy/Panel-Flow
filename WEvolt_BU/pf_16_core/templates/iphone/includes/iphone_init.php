<?php
 if(!isset($_SESSION)) {
    session_start();
  } 
$Version = '1-6 Pro';

//include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/includes/db.class.php';	
$settingsdb = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comics as c
		join comic_settings as cs on c.comiccrypt=cs.ComicID
		 where c.SafeFolder = '$SafeFolder'";
$settingsdb->query($query);
$SettingArray= $settingsdb->queryUniqueObject($query);
	$ComicTitle = stripslashes($SettingArray->title);
	$Creator = $SettingArray->creator;
	$Writer = $SettingArray->writer;
	$Artist = $SettingArray->artist;
	$Colorist = $SettingArray->colorist;
	$Letterist = $SettingArray->letterist;
	$Synopsis = $SettingArray->synopsis;
	$Tags = $SettingArray->tags;
	$Genre = $SettingArray->genre;
	$ComicFolder = $SettingArray->HostedUrl;
	$ComicID = $SettingArray->comiccrypt;

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
$BarColor = $SettingArray->ControlBg;
$TextColor= $SettingArray->TitleColor;
$MovieColor= $SettingArray->SiteBg;
$ButtonColor= $SettingArray->ButtonBg;
$ArrowColor= $SettingArray->ArrowBg;
$Copyright = $SettingArray->Copyright;
$HeaderImage = $SettingArray->Header;
$Remote = $_SERVER['REMOTE_ADDR'];
$RemoteID = $_SESSION['userid'];
$Referal = substr($_SERVER['HTTP_REFERER'],7,strlen($_SERVER['HTTP_REFERER'])-1);
$Pagetracking = 'iphone'; 
addpageview($ComicID,$Pagetracking,$Remote,$RemoteID,$Referal);

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