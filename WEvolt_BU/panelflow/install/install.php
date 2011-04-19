<?php require("install_functions.php"); 
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
 
$Version ='Pro1-6';
function db_connect($server, $username, $password, $link = 'db_link') {
	global $$link, $db_error;
	$db_error = false;
	if (!$server) {
		$db_error = 'No Server selected.';
		return false;
	}
	$$link = @mysql_connect($server, $username, $password) or $db_error = mysql_error();
	return $$link;
}
# FUNCTION TO SELECT DATABASE ACCESS
function db_select_db($database) {
	echo mysql_error();
	return mysql_select_db($database);
}
# FUNCTION TO TEST DATABASE ACCESS
function db_test_create_db_permission($database) {
	global $db_error;
	$db_created = false;
	$db_error = false;
	if (!$database) {
		$db_error = 'No Database selected.';
		return false;
	}
	if ($db_error) {
		return false;
	} else {
		if (!@db_select_db($database)) {
			$db_error = mysql_error();
			return false;
		}else {
			return true;
		}
	return true;
	}
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="http://www.panelflow.com/lib/prototype.js"></script>
<script type="text/javascript" src="http://www.panelflow.com/lib/scriptaculous.js"></script>
<script type="text/javascript" src="http://www.panelflow.com/lib/init_wait.js"></script>
<script type="text/javascript" src="http://www.panelflow.com/scripts/swfobject.js"></script>
<meta name="description" content="Flash Web Comic Content Management System"></meta>
<meta name="keywords" content="Webcomics, Comics, Flash"></meta>
<LINK href="http://www.panelflow.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PANEL FLOW - INSTALL </title>
</head>
<body>
<?php include 'includes/header.php';?>
<?php 
$usercreated =$_POST['usercreated']; 
$configcreated = $_POST['configcreated']; 
$keyset = $_POST['keyset']; 
if (!isset($_POST['email']) && ($usercreated != 1)) {
     // Show the form
      include 'install_user_inc.php';
	  include 'includes/footer.php';
     exit;
} else {
if ($usercreated != 1){
$post_data = array('email' => $_POST['email'], 'pass' => md5($_POST['userpass']),'action' => 'logincrypt');
//and send request to http://www.foo.com/login.php. Result page is stored in $html_data string
$logresult = $curl->send_post_data("https://www.panelflow.com/processing/pfusers_post.php", $post_data);
 unset($post_data);
//$logresult = file_get_contents ('http://www.panelflow.com/processing/pfusers.php?action=logincrypt&email='.$_POST['email'].'&pass='.md5($_POST['userpass']));
       if ((trim($logresult) == 'Not Logged') || (trim($logresult) == 'Not Verified'))  {
	      if (trim($logresult) == 'Not Logged') {
	     print "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>There was an error logging into your account. Please check your login information and try again. If you've forgotten your Panel Flow Account information. <a href='http://www.panelflow.com/forgotaccount.php'>CLICK HERE</a></b><div class='spacer'></div> <div class='spacer'></div></div>";
		 } else if (trim($logresult)  == 'Not Verified') {
		 print  "<div style='padding-left:15px; padding-right:15px;'>You have not yet verified your account, please click the link that was sent to your email that you registered with. If you have not recieved the email, please goto: <a href='http://www.panelflow.com/resend.php' target='blank'>www.panelflow.com/resend.php</a></div>";
		 
		 }
		 include 'install_user_inc.php';
		 include 'includes/footer.php';
		 exit;
      }  else {
	        $ID = trim($logresult);
			include 'pf_key_inc.php';
			include 'includes/footer.php';
	  }// Close Login result check 

} else if ($keyset != 1){ 
$post_data = array('key' => $_POST['txtKey'], 'userid' => $_POST['id']);
//and send request to http://www.foo.com/login.php. Result page is stored in $html_data string
$logresult = $curl->send_post_data("https://www.panelflow.com/processing/liscense_post.php", $post_data);
 unset($post_data);
 
//$logresult = file_get_contents ('http://www.panelflow.com/processing/liscense.php?key='.$_POST['txtKey'].'&userid='.$_POST['id']);
//print 'http://www.panelflow.com/processing/liscense.php?key='.$_POST['txtKey'].'&userid='.$_POST['id'];

if (trim($logresult) == 'Verified')  {
 	include 'db_form_inc.php';
	include 'includes/footer.php';
//VERIFIED GO TO DATABASE FORM

} else if (trim($logresult) == 'Not Verified'){
 print "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>There was an error verifying your Liscense Key, please check your key with the one emailed to you and try again.</div> <div class='spacer'></div></div>";
//DIDN'T WORK
include 'pf_key_inc.php';
include 'includes/footer.php';
} else if (trim($logresult) == 'Exceeded'){
 print "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>It appears that you have exceeded the number of domains licenses. If you need to purchase more liscenses, please click here <a href='http://www.panelflow.com/purchase_liscense.php' target='blank'>GET LICESNSE</a></b><div class='spacer'></div> <div class='spacer'></div></div>";
include 'includes/footer.php';
}

}else if ($configcreated != 1){

$db_error = false;
db_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_pass']);
if ($db_error == false) {
	if (!db_test_create_db_permission($_POST['db_database'])) {
			$error = $db_error;
	    }
} else {
  $error = $db_error;
}

if ($db_error != false) {
   echo "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>Could Not Connect to the Database, Please check your settings and try again!</div></b>";
		 include 'db_form_inc.php';
		 include 'includes/footer.php';
} else {
	
$connect=mysql_connect($_POST['db_host'],$_POST['db_user'],$_POST['db_pass']); 
$tableconnect = mysql_select_db($_POST['db_database']); 

$query = 'CREATE TABLE IF NOT EXISTS characters ('.
  'ID int(11) NOT NULL auto_increment,'.
  'ComicID varchar(50) NOT NULL,'.
  'Name varchar(100) NOT NULL,'.
  'Hometown varchar(100) NOT NULL,'.
  'Race varchar(50) NOT NULL,'.
  'Age varchar(20) NOT NULL,'.
  'HeightFt int(11) NOT NULL,'.
  'HeightIn int(11) NOT NULL,'.
  'Weight varchar(20) NOT NULL,'.
  'Abilities longtext NOT NULL,'.
  'Description longtext NOT NULL,'.
  'Notes longtext NOT NULL,'.
  'Image varchar(100) NOT NULL,'.
  'Thumb varchar(100) NOT NULL,'.
  'EncryptID varchar(100) NOT NULL,'.
  'PRIMARY KEY (ID))';
  
$result = mysql_query($query);
$query = 'CREATE TABLE IF NOT EXISTS comics ('.
  'comicid int(5) NOT NULL auto_increment,'.
 'userid varchar(100) NOT NULL default \'0\','.
  'title varchar(100) NOT NULL default \'\','.
  'genre text NOT NULL,'.
  'tags text NOT NULL,'.
  'synopsis longtext NOT NULL,'.
  'short varchar(150) NOT NULL default \'\','.
  'writer varchar(100) NOT NULL default \'\','.
  'creator varchar(100) NOT NULL default \'\','.
  'artist varchar(100) NOT NULL default \'\','.
  'colorist varchar(100) NOT NULL default \'\','.
  'letterist varchar(100) NOT NULL default \'\','.
  'url varchar(60) NOT NULL default \'\','.
  'thumb varchar(255) NOT NULL default \'\','.
  'cover varchar(255) NOT NULL default \'\','. 
  'pages int(11) NOT NULL default \'0\','.
  'createdate varchar(30) NOT NULL default \'\','.
  'updated timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,'.
  'votes int(11) NOT NULL default \'0\','.
  'comiccrypt varchar(100) NOT NULL default \'\','.
  'installed int(11) NOT NULL default \'0\','.
  'hits int(11) NOT NULL default \'0\','.
  'version varchar(50) NOT NULL default \'\','.
  'Footer varchar(100) NOT NULL,'.
  'CreatorID varchar(50) NOT NULL,'.
  'CreatorEmail varchar(100) NOT NULL,'.
  'PagesUpdated varchar(50) NOT NULL,'.
  'SafeFolder varchar(100) NOT NULL,'.
  'PRIMARY KEY  (comicid))';
$result = mysql_query($query);

$query ='CREATE TABLE IF NOT EXISTS comic_pages ('.
  'ID int(11) NOT NULL auto_increment,'.
  'EncryptPageID varchar(50) NOT NULL,'.
  'ComicID varchar(50) NOT NULL,'.
  'Title varchar(100) NOT NULL,'.
  'Comment longtext NOT NULL,'.
  'Image varchar(100) NOT NULL,'.
  'ImageDimensions varchar(20) NOT NULL,'.
  'Datelive varchar(20) NOT NULL,'.
  'ThumbSm varchar(100) NOT NULL,'.
  'ThumbMd varchar(100) NOT NULL,'.
  'ThumbLg varchar(100) NOT NULL,'.
  'Chapter int(11) NOT NULL,'.
  'Episode int(11) NOT NULL,'. 
  'EpisodeDesc longtext NOT NULL,'.
  'EpisodeWriter varchar(255) NOT NULL,'.
  'EpisodeArtist varchar(255) NOT NULL,'.
  'EpisodeColorist varchar(255) NOT NULL,'.
  'EpisodeLetterer varchar(255) NOT NULL,'.
  'PageType varchar(100) default \'pages\','. 
  'ParentPage varchar(100) NOT NULL,'.
  'Filename varchar(100) NOT NULL,'.
  'Position int(11) NOT NULL,'.
  'UploadedBy varchar(50) NOT NULL,'.
  'PageType varchar(50) NOT NULL,'.
  'ParentPage varchar(50) NOT NULL,'.
  'PRIMARY KEY  (ID))';
  $result = mysql_query($query);
  
   $query = 'CREATE TABLE template_skins ('.
  'ID int(11) NOT NULL auto_increment,'.
  'Title` varchar(100) NOT NULL,'.
  'Description text NOT NULL,'.
  'ModTopRightImage varchar(100) NOT NULL,'.
  'ModTopRightBGColor varchar(20) NOT NULL,'.
  'ModTopLeftImage varchar(100) NOT NULL,'.
  'ModTopLeftBGColor varchar(6) NOT NULL,'.
  'ModBottomLeftImage varchar(100) NOT NULL,'.
  'ModBottomLeftBGColor varchar(6) NOT NULL,'.
  'ModBottomRightImage varchar(100) NOT NULL,'.
  'ModBottomRightBGColor varchar(6) NOT NULL,'.
  'ModRightSideImage varchar(100) NOT NULL,'.
  'ModRightSideBGColor varchar(6) NOT NULL,'.
  'ModLeftSideImage varchar(100) NOT NULL,'.
  'ModLeftSideBGColor varchar(6) NOT NULL,'.
  'ModTopImage varchar(100) NOT NULL,'.
  'ModTopBGColor varchar(6) NOT NULL,'.
  'ModBottomImage varchar(100) NOT NULL,'.
  'ModBottomBGColor varchar(6) NOT NULL,'.
  'ContentBoxImage varchar(100) NOT NULL,'.
  'ContentBoxImageRepeat varchar(10) NOT NULL,'.
  'ContentBoxBGColor varchar(6) NOT NULL,'.
  'ContentBoxTextColor varchar(6) NOT NULL,'.
  'ContentBoxFontSize varchar(7) NOT NULL,'.
  'Corner varchar(20) NOT NULL,'.
  'ModuleSeparation` int(11) NOT NULL default \'1\','.
  'LeftColumnWidth varchar(5) NOT NULL default \'340\','.
  'RightColumnWidth varchar(5) NOT NULL default \'340\','.
  'ControlBarImage varchar(100) NOT NULL,'.
  'ControlBarImageRepeat varchar(20) NOT NULL,'.
  'ControlBarBGColor varchar(6) NOT NULL,'.
  'ControlTextColor varchar(6) NOT NULL,'.
  'ControlBarFontSize varchar(7) NOT NULL,'. 
  'ControlBarFontStyle varchar(15) NOT NULL,'.
  'ReaderButtonBGColor varchar(10) NOT NULL,'.
  'ReaderButtonAccentColor varchar(10) NOT NULL,'.
  'PageBGColor varchar(10) NOT NULL,'.
  'GlobalSiteBGColor varchar(10) NOT NULL,'.
  'GlobalSiteBGImage varchar(100) NOT NULL,'.
  'GlobalSiteImageRepeat varchar(15) NOT NULL,'.
  'GlobalSiteTextColor varchar(10) NOT NULL,'.
  'GlobalSiteFontSize varchar(7) NOT NULL,'.
  'GlobalSiteWidth varchar(4) NOT NULL,'.
  'KeepWidth int(11) NOT NULL default \'0\','.
  'ButtonImage varchar(100) NOT NULL,'.
  'ButtonBGColor varchar(20) NOT NULL,'.
  'ButtonImageRepeat varchar(20) NOT NULL,'.
  'ButtonFontSize varchar(7) NOT NULL default \'12\','.
  'ButtonFontStyle varchar(20) NOT NULL,'.
  'CommentButtonImage varchar(100) NOT NULL,'.
  'CommentButtonRolloverImage varchar(100) NOT NULL,'.
  'CommentButtonBGColor varchar(20) NOT NULL,'.
  'CommentButtonTextColor varchar(10) NOT NULL,'.
  'VoteButtonImage varchar(100) NOT NULL,'.
  'VoteButtonBGColor varchar(20) NOT NULL,'.
  'VoteButtonTextColor varchar(10) NOT NULL,'.
  'VoteRolloverImage varchar(100) NOT NULL,'.
  'LogOutButtonImage varchar(100) NOT NULL,'.
  'LogOutButtonRolloverImage varchar(100) NOT NULL,'.
  'LogOutButtonBGColor varchar(20) NOT NULL,'.
  'LogOutButtonTextColor varchar(10) NOT NULL,'.
  'FirstButtonImage varchar(100) NOT NULL,'.
  'FirtButtonRolloverImage varchar(100) NOT NULL,'.
  'FirstButtonBGColor varchar(20) NOT NULL,'.
  'FirstButtonTextColor varchar(20) NOT NULL,'.
  'NextButtonImage varchar(100) NOT NULL,'.
  'NextButtonRolloverImage varchar(100) NOT NULL,'.
  'NextButtonBGColor varchar(6) NOT NULL,'.
  'NextButtonTextColor varchar(6) NOT NULL,'.
  'BackButtonImage varchar(100) NOT NULL,'.
  'BackButtonRolloverImage varchar(100) NOT NULL,'.
  'BackButtonBGColor varchar(6) NOT NULL,'.
  'BackButtonTextColor varchar(6) NOT NULL,'.
  'LastButtonImage varchar(100) NOT NULL,'.
  'LastButtonRolloverImage varchar(100) NOT NULL,'.
  'LastButtonBGColor varchar(6) NOT NULL,'.
  'LastButtonTextColor varchar(6) NOT NULL,'.
  'HomeButtonImage varchar(100) NOT NULL,'.
  'HomeButtonRollOverImage varchar(100) NOT NULL,'.
  'HomeButtonBGColor varchar(20) NOT NULL,'.
  'HomeButtonTextColor varchar(20) NOT NULL,'. 
  'CreatorButtonImage varchar(100) NOT NULL,'.
  'CreatorButtonRollOverImage varchar(100) NOT NULL,'.
  'CreatorButtonBGColor varchar(20) NOT NULL,'.
  'CreatorButtonTextColor varchar(20) NOT NULL,'.
  'CharactersButtonImage varchar(100) NOT NULL,'.
  'CharactersButtonRollOverImage varchar(100) NOT NULL,'.
  'CharactersButtonBGColor varchar(20) NOT NULL,'.
  'CharactersButtonTextColor varchar(20) NOT NULL,'.
  'DownloadsButtonImage varchar(100) NOT NULL,'.
  'DownloadsButtonRollOverImage varchar(100) NOT NULL,'.
  'DownloadsButtonBGColor varchar(20) NOT NULL,'.
  'DownloadsButtonTextColor varchar(20) NOT NULL,'.
  'ExtrasButtonImage varchar(100) NOT NULL,'.
  'ExtrasButtonRollOverImage varchar(100) NOT NULL,'.
  'ExtrasButtonBGColor varchar(20) NOT NULL,'.
  'ExtrasButtonTextColor varchar(20) NOT NULL,'.
  'EpisodesButtonImage varchar(100) NOT NULL,'.
  'EpisodesButtonRollOverImage varchar(100) NOT NULL,'.
  'EpisodesButtonBGColor varchar(20) NOT NULL,'.
  'EpisodesButtonTextColor varchar(20) NOT NULL,'.
  'MobileButtonImage varchar(100) NOT NULL,'.
  'MobileButtonRollOverImage varchar(100) NOT NULL,'.
  'MobileButtonBGColor varchar(20) NOT NULL,'.
  'MobileButtonTextColor varchar(20) NOT NULL,'.
  'ProductsButtonImage varchar(100) NOT NULL,'.
  'ProductsButtonRollOverImage varchar(100) NOT NULL,'.
  'ProductsButtonBGColor varchar(20) NOT NULL,'.
  'ProductsButtonTextColor varchar(20) NOT NULL,'.
  'GlobalHeaderImage varchar(100) NOT NULL,'.
  'GlobalHeaderBGColor varchar(10) NOT NULL,'.
  'GlobalHeaderImageRepeat varchar(10) NOT NULL,'.
  'GlobalHeaderTextColor varchar(10) NOT NULL,'.
  'GlobalHeaderFontSize varchar(7) NOT NULL,'.
  'HeaderPlacement varchar(20) NOT NULL default \'inside\','. 
   'MobileContentImage varchar(100) NOT NULL,'.
  'MobileContentBGColor varchar(10) NOT NULL,'.
  'MobileContentImageRepeat varchar(10) NOT NULL,'.
  'MobileContentTextColor varchar(10) NOT NULL,'.
  'MobileContentFontSize varchar(7) NOT NULL,'.
  'MobileContentFontStyle varchar(15) NOT NULL,'.
  
   'ProductsImage varchar(100) NOT NULL,'. 
  'ProductsBGColor varchar(10) NOT NULL,'.
  'ProductsImageRepeat varchar(10) NOT NULL,'.
  'ProductsTextColor varchar(10) NOT NULL,'.
  'ProductsFontSize varchar(7) NOT NULL,'.
  'ProductsFontStyle varchar(15) NOT NULL,'.
  
  'AuthorCommentImage varchar(100) NOT NULL,'.
  'AuthorCommentBGColor varchar(10) NOT NULL,'.
  'AuthorCommentImageRepeat varchar(10) NOT NULL,'.
  'AuthorCommentTextColor varchar(10) NOT NULL,'.
  'AuthorCommentFontSize varchar(7) NOT NULL,'.
  'AuthorCommentFontStyle varchar(15) NOT NULL,'.
  'ComicInfoImage varchar(100) NOT NULL,'.
  'ComicInfoBGColor varchar(10) NOT NULL,'.
  'ComicInfoImageRepeat varchar(10) NOT NULL,'.
  'ComicInfoTextColor varchar(10) NOT NULL,'.
  'ComicInfoFontSize varchar(7) NOT NULL,'.
  'ComicInfoFontStyle varchar(15) NOT NULL,'.
  'UserCommentsImage varchar(100) NOT NULL,'.
  'UserCommentsBGColor varchar(10) NOT NULL,'.
  'UserCommentsImageRepeat varchar(10) NOT NULL,'.
  'UserCommentsTextColor varchar(10) NOT NULL,'.
  'UserCommentsFontSize varchar(7) NOT NULL,'.
  'UserCommentsFontStyle varchar(15) NOT NULL,'.
  'ComicSynopsisImage varchar(100) NOT NULL,'.
  'ComicSynopsisBGColor varchar(10) NOT NULL,'.
  'ComicSynopsisImageRepeat varchar(10) NOT NULL,'.
  'ComicSynopsisTextColor varchar(10) NOT NULL,'.
  'ComicSynopsisFontSize varchar(7) NOT NULL,'.
  'ComicSynopsisFontStyle varchar(15) NOT NULL,'. 
  'GlobalHeaderFontStyle varchar(15) NOT NULL,'.
  'LeftColumnWidth varchar(5) NOT NULL default \'340\','.
  'RightColumnWidth varchar(5) NOT NULL default \'340\','.
  'GlobalSiteLinkTextColor varchar(8) NOT NULL default \'327efd\','.
  'GlobalSiteLinkFontStyle varchar(15) NOT NULL default \'regular\','.
  'GlobalSiteHoverTextColor varchar(8) NOT NULL default \'d2e2fc\','.
  'GlobalSiteHoverFontStyle varchar(15) NOT NULL default \'underline\','.
  'GlobalSiteVisitedTextColor varchar(8) NOT NULL default \'327efd\','.
  'GlobalSiteVisitedFontStyle varchar(15) NOT NULL default \'regular\','.
  'GlobalButtonLinkTextColor varchar(8) NOT NULL default \'FFFFFF\','.
  'GlobalButtonLinkFontStyle varchar(15) NOT NULL default \'regular\','.
  'GlobalButtonHoverTextColor varchar(8) NOT NULL default \'000000\','.
  'GlobalButtonHoverFontStyle varchar(15) NOT NULL default \'underline\','.
  'GlobalButtonVisitedTextColor varchar(8) NOT NULL default \'FFFFFF\','.
  'GlobalButtonVisitedFontStyle varchar(15) NOT NULL default \'regular\','.
  'GlobalTabActiveBGColor varchar(8) NOT NULL default \'f58434\','.
  'GlobalTabActiveFontStyle varchar(15) NOT NULL default \'bold\','.
  'GlobalTabActiveTextColor varchar(8) NOT NULL default \'FFFFFF\','.
  'GlobalTabActiveFontSize varchar(15) NOT NULL default \'14\','.
  'GlobalTabInActiveBGColor varchar(8) NOT NULL default \'dc762f\','.
  'GlobalTabInActiveFontStyle varchar(15) NOT NULL default \'bold\','.
  'GlobalTabInActiveTextColor varchar(8) NOT NULL default \'FFFFFF\','.
  'GlobalTabInActiveFontSize varchar(15) NOT NULL default \'14\','.
  'GlobalTabHoverBGColor varchar(8) NOT NULL default \'ffab6f\','.
  'GlobalTabHoverActiveFontStyle varchar(15) NOT NULL default \'bold\','.
  'GlobalTabHoverActiveTextColor varchar(8) NOT NULL default \'FFFFFF\','. 
  'GlobalTabHoverActiveFontSize varchar(15) NOT NULL default \'14\','.
  'GlobalHeaderFontStyle varchar(15) NOT NULL,'.
  'FlashReaderStyle varchar(25) NOT NULL default \'standard\','.
  'NavBarAlignment varchar(15) NOT NULL default \'right\','.
  'NavBarPlacement varchar(15) NOT NULL default \'both\','.
  'GlobalHeaderTextTransformation varchar(15) NOT NULL default \'normal\','.
  'CharacterReader varchar(25) NOT NULL default \'html_one\','.
  'UserID varchar(100) NOT NULL,'.
  'Published int(11) NOT NULL,'.
  'Public int(11) NOT NULL,'. 
  'CreatedDate timestamp NOT NULL default CURRENT_TIMESTAMP,'.
  'SkinCode varchar(20) NOT NULL,'.
  'PRIMARY KEY  (ID))';
   $result = mysql_query($query);
   
   $query='CREATE TABLE pf_modules ('.
  'ID int(11) NOT NULL auto_increment,'. 
  'Title varchar(100) NOT NULL,'.
  'ModuleCode varchar(30) NOT NULL,'.
  'ComicID varchar(50) NOT NULL,'.
  'Position int(11) NOT NULL,'.
  'Placement varchar(20) NOT NULL,'.
  'IsPublished int(11) NOT NULL default \'1\','.
  'PRIMARY KEY  (ID))';
  $result = mysql_query($query);
   
 $query = 'CREATE TABLE IF NOT EXISTS comic_settings ('.
  'ID int(11) NOT NULL auto_increment,'.
  'ComicID varchar(50) NOT NULL,'.
  'Contact int(11) NOT NULL,'.
  'AllowComments int(11) NOT NULL,'.
  'ShowArchive int(11) NOT NULL,'.
  'ShowChapter int(11) NOT NULL,'.
  'ShowEpisode int(11) NOT NULL,'.
  'ShowCalendar int(11) NOT NULL,'.
  'Assistant1 varchar(50) NOT NULL,'.
  'Assistant2 varchar(50) NOT NULL,'.
  'Assistant3 varchar(50) NOT NULL,'.
  'BioSetting int(11) NOT NULL,'.
  'ProfileSync int(11) NOT NULL default \'1\','.
  'Template varchar(50) NOT NULL default \'TPL-001\','.
  'ReaderType varchar(50) NOT NULL default \'flash\','.
  'ButtonSet int(11) NOT NULL ,'.
  'ControlBg varchar(10) NOT NULL default \'0x000000\','.
  'TitleColor varchar(10) NOT NULL default \'0xFFFFFF\','.
  'ButtonBg varchar(10) NOT NULL default \'0xFDA96D\','.
  'SiteBg varchar(10) NOT NULL default \'0xFFFFFF\','. 
  'ArrowBg varchar(10) NOT NULL default \'0x000000\','.
  'Copyright varchar(100) NOT NULL,'.
  'Header varchar(100) NOT NULL,'.
  'ComicFormat varchar(50) NOT NULL,'.
  'UpdateSchedule varchar(20) NOT NULL,'.
  'Skin varchar(50) NOT NULL default \'PFSK-00001\','.
  'PRIMARY KEY  (ID))';
  $result = mysql_query($query);
  
  $query='CREATE TABLE IF NOT EXISTS creators ('.
  'ID int(10) NOT NULL auto_increment,'.
  'avatar text NOT NULL,'.
  'realname varchar(80) NOT NULL default \'\','.
  'location varchar(60) NOT NULL default \'\','.
  'about longtext NOT NULL,'.
  'website varchar(100) NOT NULL default \'\','.
  'music longtext NOT NULL,'.
  'books longtext NOT NULL,'.
  'hobbies longtext NOT NULL,'.
  'influences longtext NOT NULL,'.
  'credits longtext NOT NULL,'.
  'link1 text NOT NULL,'.
  'link2 text NOT NULL,'.
  'link3 text NOT NULL,'.
  'link4 text NOT NULL,'.
  'ComicID varchar(50) NOT NULL,'.
  'Email varchar(100) NOT NULL,'.
  'CreatorID varchar(100) NOT NULL,'.
  'PRIMARY KEY  (ID))';
   $result = mysql_query($query);

$query ='CREATE TABLE IF NOT EXISTS downloads ('.
  'ID int(11) NOT NULL auto_increment,'.
  'ComicID varchar(25) NOT NULL,'.
  'Name varchar(100) NOT NULL,'.
  'Description longtext NOT NULL,'.
  'DlType varchar(25) NOT NULL,'.
  'Resolution varchar(25) NOT NULL,'.
  'Image varchar(60) NOT NULL,'.
  'Thumb varchar(60) NOT NULL,'.
  'EncryptID varchar(100) NOT NULL,'.
  'PRIMARY KEY  (ID))';
   $result = mysql_query($query);
   
   $query ='CREATE TABLE IF NOT EXISTS templates ('.
  'ID int(11) NOT NULL auto_increment,'.
  'Title varchar(25) NOT NULL,'.
  'PathToXML varchar(100) NOT NULL,'.
  'TemplateCode varchar(100) NOT NULL,'.
  'Published int(11) NOT NULL default \'1\','.
   'PRIMARY KEY  (ID))';
   $result = mysql_query($query);
   
   $query = "INSERT INTO templates (Title,PathToXML,TemplateCode, Published) VALUES ('Standard', '/TPL-0001/template.xml','TPL-0001' ,'1'),". 
   "('Right Hand', '/TPL-002/template.xml','TPL-0002', '1'),".
   "('Left Hand', '/TPL-003/template.xml','TPL-0003', '1')";
   $result = mysql_query($query);
	   
	    $query ='CREATE TABLE IF NOT EXISTS adspaces ('.
   'ID int(11) NOT NULL auto_increment,'.
  'ComicID varchar(50) NOT NULL,'.
  'Template varchar(50) NOT NULL,'.
  'Position int(11) NOT NULL,'.
  'Active int(11) NOT NULL default \'0\','.
  'Published int(11) NOT NULL default \'0\','.
  'AdCode longtext NOT NULL,'.
  'PRIMARY KEY  (ID))';
     $result = mysql_query($query);
	 
	 
	  $query= 'CREATE TABLE IF NOT EXISTS mobile_content (
  ID int(11) NOT NULL auto_increment,
  Title varchar(100) NOT NULL,
  Type varchar(100) NOT NULL,
  ComicID varchar(100) NOT NULL,
  EncryptID varchar(100) NOT NULL,
  CreatedDate timestamp NOT NULL default CURRENT_TIMESTAMP,
  Thumb varchar(100) NOT NULL,
  Image varchar(100) NOT NULL,
  PRIMARY KEY  (ID))'; 
	   $result = mysql_query($query); 
	   
	    $query= 'CREATE TABLE IF NOT EXISTS products (
ID INT NOT NULL AUTO_INCREMENT,
EncryptID VARCHAR( 100 ) NOT NULL ,
Title VARCHAR( 255 ) NOT NULL ,
Description LONGTEXT NOT NULL ,
Tags LONGTEXT NOT NULL ,
Price VARCHAR( 10 ) NOT NULL ,
ProductType VARCHAR( 20 ) NOT NULL ,
ProductCategory VARCHAR( 150 ) NOT NULL,
IsActive INT NOT NULL DEFAULT \'1\',
ThumbSm VARCHAR( 100 ) NOT NULL ,
ThumbMd VARCHAR( 100 ) NOT NULL ,
ThumbLg VARCHAR( 100 ) NOT NULL,
ComicID VARCHAR( 100 ) NOT NULL,
  PRIMARY KEY  (ID))'; 
	    $result = mysql_query($query); 
		
	   $query= 'CREATE TABLE IF NOT EXISTS links (
  ID int(11) NOT NULL auto_increment,
  ComicID varchar(50) NOT NULL,
  Title varchar(100) NOT NULL,
  Description longtext NOT NULL,
  Link varchar(100) NOT NULL,
  EncryptID varchar(100) NOT NULL,
  Image varchar(100) NOT NULL,
  PRIMARY KEY  (ID))';
	     $result = mysql_query($query);
		 
		 $query ='CREATE TABLE IF NOT EXISTS pagecomments ('.
  'comicid varchar(50) NOT NULL default \'\','.
  'pageid varchar(50) NOT NULL default \'\','.
  'userid varchar(50) NOT NULL default \'\','.
 'comment longtext NOT NULL,'.
  'site varchar(100) NOT NULL default \'\','.
  'commentdate varchar(20) NOT NULL default \'\','.
  'creationdate timestamp NOT NULL default CURRENT_TIMESTAMP,'.
  'id int(11) NOT NULL auto_increment,'.
  'PRIMARY KEY  (id))';
		  $result = mysql_query($query);
		  
		  $query ='CREATE TABLE IF NOT EXISTS creatorinvites ('.
  'InviteCode varchar(100) NOT NULL default \'\','.
  'Email varchar(100) NOT NULL default \'\','.
  'ComicID varchar(100) NOT NULL default \'\','.
   'ID int(11) NOT NULL auto_increment,'.
  'PRIMARY KEY  (ID))';
		  $result = mysql_query($query);
		  
		   $query ='CREATE TABLE IF NOT EXISTS users ('.
  'username varchar(50) NOT NULL default \'\','.
  'avatar varchar(255) NOT NULL default \'\','.
  'encryptid varchar(50) NOT NULL default \'\','.
  'timesvisited int(11) NOT NULL default \'1\','.
  'lastvisited timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,'.
  'id int(11) NOT NULL auto_increment,'.
  'PRIMARY KEY  (id))';
		  $result = mysql_query($query);
		  
mysql_close($connect) ; 

       $file_to_write = 'tempconfig.php';
			$content = "<?php \n$";
			$content .= "email='".$_POST['email']."';\n";
			$content .= "$";
			$content .= "userid ='".$_POST['id']."';\n";
			$content .= "$";
			$content .= "db_user ='".$_POST['db_user']."';\n";
			$content .= "$";
			$content .= "db_pass ='".$_POST['db_pass']."';\n";
			$content .= "$";
			$content .= "db_database ='".$_POST['db_database']."';\n";
			$content .= "$";
			$content .= "db_host ='".$_POST['db_host']."';\n";
			$content .= "?>";
			$fp = fopen($file_to_write, 'w');
			fwrite($fp, $content);
			fclose($fp);
			$configcreated = 1;
			include 'app_form_inc.php';
		    include 'includes/footer.php';
			exit;
			
			   
	   } // end config else
	   
} else if (($configcreated == 1) && ($usercreated == 1) && ($keyset == 1)) {
   if ($_POST['appfolder'] == "") {
     // Show the form
	  echo "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>You must enter the full path to the folder</div></b>";
      include 'app_form_inc.php';
	  include 'includes/footer.php';
     exit;
} else {
			include 'tempconfig.php';
	        $file_to_write = 'config.php';
			$content ="<?php \n";
			$content .="\$config['adminemail'] = '".$email."';\n";
			$content .="\$config['adminuserid'] = '".$userid."';\n";
			$content .="\$config['pathtopf'] = '".$_POST['appfolder']."';\n";
			$content .="\$config['db_user'] = '".$db_user."';\n";
			$content .="\$config['db_pass'] = '".$db_pass."';\n";
			$content .="\$config['db_database'] = '".$db_database."';\n";
			$content .="\$config['db_host'] = '".$db_host."';\n";
			$content .="\$config['liscensekey'] = '".$_POST['txtKey']."';\n";
			$content .="?>";
			$fp = fopen($file_to_write, 'w');
			fwrite($fp, $content);
			fclose($fp);
			rename($file_to_write, '../includes/config.php');
			chmod('../includes/config.php', 0644);
			@copy('htaccess','../.htaccess');
			@copy('index2.html','index.html');
			echo '<div class="errormsg"><div class="spacer"</div><h1 style="color:yello">CONGRATUALTIONS!</h1><div class="spacer"></div>INSTALLATION COMPLETE. YOU CAN NOW LOG INTO PANEL FLOW AND ACCESS THE ADMIN SECTION TO START YOUR COMICS. <a href="http://www.panelflow.com/login.php"> CLICK HERE </a>TO START<br></div>';
			// INSTALL APP with URL, 
			$post_data = array('key' => $_POST['txtKey'], 'userid' => $userid,'action'=>'add','domain'=>$_SERVER['SERVER_NAME'],'version'=>$Version,'pfpath'=>$_POST['appfolder']);
//and send request to http://www.foo.com/login.php. Result page is stored in $html_data string
$logresult = $curl->send_post_data("https://www.panelflow.com/processing/liscense_post.php", $post_data);
 unset($post_data);
			//$logresult = file_get_contents ('http://www.panelflow.com/processing/liscense.php?action=add&key='.$_POST['txtKey'].'&userid='.$userid.'&domain='.$_SERVER['SERVER_NAME'].'&version='.$Version);
			include 'includes/footer.php';
} 
			
}
			
			
} // Comic Information Else 

?>

</body>
</html>
