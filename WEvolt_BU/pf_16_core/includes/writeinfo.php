<?php 
include_once("init.php"); 
include 'image_resizer.php';
include 'image_functions.php';
require_once("create_key_func.php");
$comicinfoDB = new DB($db_database,$db_host, $db_user, $db_pass);
require_once("curl_http_client.php");
$curl = &new Curl_HTTP_Client();

//pretend to be IE6 on windows
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$Action = $_GET['txtAction'];

$Creator = mysql_real_escape_string($_GET['txtCreator']);
$Writer = mysql_real_escape_string($_GET['txtWriter']);
$Artist = mysql_real_escape_string($_GET['txtArtist']);
$Colorist = mysql_real_escape_string($_GET['txtColorist']);
$Letterist = mysql_real_escape_string($_GET['txtLetterer']);
$Synopsis = mysql_real_escape_string($_GET['txtSynopsis']);
$ControlBG = $_GET['txtControlBg'];
$TitleBG = $_GET['txtTitleBg'];
$SiteBG = $_GET['txtSiteBg'];
$ButtonBG = $_GET['txtButtonBg'];
$ArrowBG = $_GET['txtArrowBg'];
$Header = $_GET['txtHeader'];
$Genres = $_GET['txtGenres'];
$Url = $_GET['txtUrl'];
$SafeFolder = $_GET['safefolder'];
$Server = $_SERVER['SERVER_NAME'];
$Tags = mysql_real_escape_string($_GET['txtTags']);
$Copyright = mysql_real_escape_string($_GET['txtCopyright']);
$User = $_GET['txtUser'];
$ComicID = $_GET['txtComic'];
$StoryID = $_GET['txtStory'];
$ContentType = $_GET['txtType'];

if ($StoryID == '') 
	$TargetID = $ComicID;
else
	$TargetID = $StoryID;

if ($StoryID == '')
$Query = "SELECT title from comics where comiccrypt='$ComicID'";
else
$Query = "SELECT title from stories where StoryID='$StoryID'";

$Title =  mysql_real_escape_string($comicinfoDB->queryUniqueValue($Query));

$Creatorname = mysql_escape_string($_GET['txtCreatorName']);
$Influences = mysql_escape_string($_GET['txtInfluences']);
$About = mysql_escape_string($_GET['txtAbout']);
$Location = mysql_escape_string($_GET['txtLocation']);
$Hobbies = mysql_escape_string($_GET['txtHobbies']);
$Website = $_GET['txtWebsite'];
$Link1 = $_GET['txtLinkOne'];
$Link2 = $_GET['txtLinkTwo'];
$Link3 = $_GET['txtLinkThree'];
$Link4 = $_GET['txtLinkFour'];
$CreatorOne = $_GET['txtCreator1'];
$CreatorTwo = $_GET['txtCreator2'];
$CreatorThree = $_GET['txtCreator3'];
$ProfileSync = $_GET['txtProfileSync'];
$RemoveHeader = $_GET['txtHeaderRemove'];
$Credits = mysql_escape_string($_GET['txtCredits']);
$Music = mysql_escape_string($_GET['txtMusic']);
$Books = mysql_escape_string($_GET['txtBooks']);
$FileSet = 'no';
if ($RemoveHeader == '') {
	$RemoveHeader = 0;
}
if ($StoryID == '') {
	$query = "SELECT AppInstallation from comics where comiccrypt ='$ComicID'";
	$AppInstallID= $comicinfoDB->queryUniqueValue($query);
	$query = "SELECT * from comic_settings where ComicID ='$ComicID'";
	$SettingArray= $comicinfoDB->queryUniqueObject($query);
} else {
	$query = "SELECT AppInstallation from stories where StoryID ='$StoryID'";
	$AppInstallID= $comicinfoDB->queryUniqueValue($query);
	$query = "SELECT * from story_settings where StoryID ='$StoryID'";
	$SettingArray= $comicinfoDB->queryUniqueObject($query);
}
$query = "SELECT * from Applications where ID ='$AppInstallID'";
$ApplicationArray = $comicinfoDB->queryUniqueObject($query);
$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;
if ($Action != 'creator') {
	$Section = 'Comic';
	if ($Header != '') {
		if ($StoryID == '') {
			$ext = substr(strrchr($Header, "."), 1);
			$randName = md5(rand() * time());
			$NewHeader = $randName . '.' . $ext;
			$HeaderImage = '../../comics/'.$Url.'/images/'.$NewHeader;
			@copy('../temp/'.$Header,'../../comics/'.$Url.'/images/'.$NewHeader);
			@chmod('../../comics/'.$Url.'/images/'.$NewHeader,0777);
			@chmod('../temp/'.$Header,0777);
			$output .= 'Header  = ' .$Header.'<br/><br/>';
			$output .= 'NewHeader  = ' .$NewHeader.'<br/><br/>';
			
			$old = getcwd(); // Save the current directory
			chdir('../temp');
			//print 'CURRENT = '. getcwd();
			@unlink($Header);
			chdir($old);
			@unlink('../temp/'.$Header);
			$IphoneHeader = '../../comics/'.$Url.'/iphone/images/'.$NewHeader;
			$convertString = "convert $HeaderImage -resize 320 $IphoneHeader";
			exec($convertString);
			@chmod($IphoneHeader,0777);
			$FileSet = 'yes';
			$query = "UPDATE comic_settings SET Header='$NewHeader' where ComicID='$ComicID'";
			$comicinfoDB->query($query);
		} else {
			$ext = substr(strrchr($Header, "."), 1);
			$randName = md5(rand() * time());
			$NewHeader = $randName . '.' . $ext;
			$HeaderImage = '../../stories/'.$Url.'/images/'.$NewHeader;
			@copy('../temp/'.$Header,'../../stories/'.$Url.'/images/'.$NewHeader);
			@chmod('../../stories/'.$Url.'/images/'.$NewHeader,0777);
			@chmod('../temp/'.$Header,0777);
			$output .= 'Header  = ' .$Header.'<br/><br/>';
			$output .= 'NewHeader  = ' .$NewHeader.'<br/><br/>';
			
			$old = getcwd(); // Save the current directory
			chdir('../temp');
			//print 'CURRENT = '. getcwd();
			@unlink($Header);
			chdir($old);
			@unlink('../temp/'.$Header);
			$IphoneHeader = '../../stories/'.$Url.'/iphone/images/'.$NewHeader;
			$convertString = "convert $HeaderImage -resize 320 $IphoneHeader";
			exec($convertString);
			@chmod($IphoneHeader,0777);
			$FileSet = 'yes';
			$query = "UPDATE story_settings SET Header='$NewHeader' where StoryID='$StoryID'";
			$comicinfoDB->query($query);

		
		}
	}
	if ($RemoveHeader == 1) {
		if ($StoryID == '') 
			$query = "UPDATE comic_settings SET Header='' where ComicID='$ComicID'";
		else
			$query = "UPDATE story_settings SET Header='' where StoryID='$StoryID'";
		$comicinfoDB->query($query);
	}
		if ($StoryID == '') 
			$query = "UPDATE comics SET genre='$Genres', tags='$Tags', writer='$Writer', creator='$Creator', artist='$Artist', colorist='$Colorist', letterist='$Letterist', synopsis='$Synopsis'  WHERE comiccrypt='$ComicID'";
		else 
			$query = "UPDATE stories SET genre='$Genres', tags='$Tags', writer='$Writer', creator='$Creator', artist='$Artist', colorist='$Colorist',synopsis='$Synopsis'  WHERE StoryID='$StoryID'";
		
		$comicinfoDB->query($query);
	if ($StoryID == '') 
	$query = "UPDATE comic_settings SET ControlBg='$ControlBG', TitleColor='$TitleBG',SiteBg='$SiteBG',ButtonBg='$ButtonBG',ArrowBg='$ArrowBG',Copyright='$Copyright' where ComicID='$ComicID'";
	else
	$query = "UPDATE story_settings SET ControlBg='$ControlBG', TitleColor='$TitleBG',SiteBg='$SiteBG',ButtonBg='$ButtonBG',ArrowBg='$ArrowBG',Copyright='$Copyright' where StoryID='$StoryID'";
	$comicinfoDB->query($query);

if ($StoryID == '') 
	$query = "SELECT userid from comics WHERE comiccrypt='$ComicID'";
else
$query = "SELECT userid from stories WHERE StoryID='$StoryID'";
	$AdminID = $comicinfoDB->queryUniqueValue($query);
	$ComicXML ='<comic>';
		$ComicXML .= '<info>';
	  		$ComicXML .= '<title>'.$Title.'</title>';
			$ComicXML .= '<creator>'.$Creator.'</creator>';
			$ComicXML .= '<writer>'.$Writer.'</writer>';
			$ComicXML .= '<artist>'.$Artist.'</artist>';
			$ComicXML .= '<colorist>'.$Colorist.'</colorist>';
			$Synopsis = str_replace(chr(13), '\n', $Synopsis);
			$Synopsis = str_replace(chr(10), '\n', $Synopsis);
			$ComicXML .= '<synopsis>'.$Synopsis.'</synopsis>';
			$ComicXML .= '<letterist>'.$Letterist.'</letterist>';
			$ComicXML .= '<tags>'.$Tags.'</tags>';
			$ComicXML .= '<genre>'.$Genre.'</genre>';
			$ComicXML .= '<headerimage>'.$Header.'</headerimage>';
			$ComicXML .= '<copyright>'.$Copyright.'</copyright>';
			$ComicXML .= '</info>';
		$ComicXML .='</comic>';
	if ($StoryID == '')  {
		$fp = fopen("../../comics/".$Url."/xml/infoXML.xml",'w');
		$write = fwrite($fp,$ComicXML);
		@chmod("../../comics/".$Url."/xml/infoXML.xml",0777);
	} else {
		$fp = fopen("../../stories/".$Url."/xml/infoXML.xml",'w');
		$write = fwrite($fp,$ComicXML);
		@chmod("../../stories/".$Url."/xml/infoXML.xml",0777);

	}
// $post_data = array('userid' => $AdminID, 'comicid' => $ComicID,'action' => 'info');
//$result = $curl->send_post_data("https://www.panelflow.com/processing/updatecomic_post.php", $post_data);
// unset($post_data);
//$result = file_get_contents ("http://www.panelflow.com/processing/updatecomic_post.php?action=info&userid=".$AdminID."&comicid=".$ComicID);
} else {
$Section = 'Creator';
if ($StoryID == '')  
	$query = "SELECT Email from creators where ComicID ='$ComicID'";
else
	$query = "SELECT Email from creators where StoryID ='$StoryID'";
	
$CreatorArray = $comicinfoDB->queryUniqueObject($query);
if ($StoryID == '')  
$query = "UPDATE creators SET realname='$Creatorname', influences='$Influences', about='$About', location='$Location', website='$Website', link1='$Link1', link2='$Link2',link3='$Link3',link4='$Link4',hobbies='$Hobbies', books='$Books', music='$Music', credits='$Credits' WHERE comicid='$ComicID'";
else 
$query = "UPDATE creators SET realname='$Creatorname', influences='$Influences', about='$About', location='$Location', website='$Website', link1='$Link1', link2='$Link2',link3='$Link3',link4='$Link4',hobbies='$Hobbies', books='$Books', music='$Music', credits='$Credits' WHERE StoryID='$StoryID'";

$comicinfoDB->query($query);

if ($StoryID == '')  
	$query = "UPDATE comic_settings set ProfileSync = '$ProfileSync',CreatorOne='$CreatorOne', CreatorTwo='$CreatorTwo',CreatorThree='$CreatorThree' where ComicID='$ComicID'";
else
	$query = "UPDATE story_settings set ProfileSync = '$ProfileSync',CreatorOne='$CreatorOne', CreatorTwo='$CreatorTwo',CreatorThree='$CreatorThree' where StoryID='$StoryID'";
//print $query;

$comicinfoDB->query($query);
//print 'SYNC = ' . $ProfileSync;
if ($ProfileSync == 1) {

$query = "UPDATE users SET realname='$Creatorname', influences='$Influences', about='$About', location='$Location', website='$Website', link1='$Link1', link2='$Link2',link3='$Link3',link4='$Link4',hobbies='$Hobbies', books='$Books', music='$Music', credits='$Credits' WHERE email='".$CreatorArray->Email."'";

$comicinfoDB->query($query);
//print $query;
   	$ComicXML ='<creatorinfo>';
	  	$ComicXML .= '<creator>';
	  	$ComicXML .= '<avatar>'.$Avatar.'</avatar>';
		$ComicXML .= '<creatorname>'.$Creatorname.'</creatorname>';
		$ComicXML .= '<location>'.$Location.'</location>';
		$ComicXML .= '<website>'.$Website.'</website>';
		$ComicXML .= '<link1>'.$Link1.'</link1>';
		$ComicXML .= '<link2>'.$Link2.'</link2>';
		$ComicXML .= '<link3>'.$Link3.'</link3>';
		$ComicXML .= '<link4>'.$Link4.'</link4>';
		$About = str_replace(chr(13), '\n', $About);
		$About = str_replace(chr(10), '\n', $About);
		$ComicXML .= '<about>'.$About.'</about>';
		$Music = str_replace(chr(13), '\n', $Music);
		$Music = str_replace(chr(10), '\n', $Music);
		$ComicXML .= '<music>'.$Music.'</music>';
		$Books = str_replace(chr(13), '\n', $Books);
		$Books = str_replace(chr(10), '\n', $Books);
		$ComicXML .= '<books>'.$Books.'</books>';
		$Influences = str_replace(chr(13), '\n', $Influences);
		$Influences = str_replace(chr(10), '\n', $Influences);
		$ComicXML .= '<influences>'.$Influences.'</influences>';
		$Credits = str_replace(chr(13), '\n', $Credits);
		$Credits = str_replace(chr(10), '\n', $Credits);
		$ComicXML .= '<credits>'.$Credits.'</credits>';
		$Hobbies = str_replace(chr(13), '\n', $Hobbies);
		$Hobbies = str_replace(chr(10), '\n', $Hobbies);
		$ComicXML .= '<hobbies>'.$Hobbies.'</hobbies>';
		$ComicXML .= '</creator>';
		$ComicXML .= '</creatorinfo>';
		if ($StoryID == '')  {
			$fp = fopen("../../comics/".$Url."/xml/creatorXML.xml",'w');
			$write = fwrite($fp,$ComicXML); 
			@chmod("../../comics/".$Url."/xml/creatorXML.xml",0777);
		} else {
			$fp = fopen("../../stories/".$Url."/xml/creatorXML.xml",'w');
			$write = fwrite($fp,$ComicXML); 
			@chmod("../../stories/".$Url."/xml/creatorXML.xml",0777);
		}
//print "MY COMIC XML = " . $ComicXML;
//$post_data = array('email' => $CreatorArray->Email, 'comicid' => $ComicID);
//$result = $curl->send_post_data("https://www.panelflow.com/processing/updatecreator_post.php", $post_data);
// unset($post_data);
//$result = file_get_contents ("http://www.panelflow.com/processing/updatecreator.php?email=".$CreatorArray->Email."&comicid=".$ComicID);
}

 
}
$ConnectKey = createKey();
$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
$comicinfoDB->query($query);
$comicinfoDB->close();

//print $query;
$post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID, 's' => $Section,'f' => $FileSet,'k' => $ConnectKey,'r' => $RemoveHeader,'t'=>$ContentType);
//print $ApplicationLink."connectors/update_info.php";
$updateresult = $curl->send_post_data($ApplicationLink."connectors/update_info.php", $post_data);
unset($post_data);
$output .= 'UPDATE RESULT = ' . $updateresult;

//if ($_SESSION['userid'] = '9778d5d252') 
//print $output;
//} else {
if ($_GET['change'] == 1) {
	header("Location:/creator/avatar/".$SafeFolder."/");
} else {

//if ($_SESSION['userid'] != '9778d5d252') 
	if ($StoryID == '')
		header("Location:/cms/edit/".$SafeFolder."/");
	else
		
		header("Location:/story/edit/".$SafeFolder."/");
}

//}



?>

