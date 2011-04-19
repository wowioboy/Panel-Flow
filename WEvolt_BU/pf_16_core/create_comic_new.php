<?php 
include 'includes/init.php';
include 'includes/connect_functions.php';
$Version = '1-6';
$AdminUserID = $_SESSION['userid'];

  require_once("includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
 
include("classes/class_dirtool.php");
require_once("includes/create_key_func.php");
include 'includes/create_functions.php';
if (isset($_POST['comcid'])) {

	$ComicID = $_POST['comcid'];
}

$ComicCreated = 0;
$NotAllowed = 0;
$AdminUserID = $_SESSION['userid'];
$createDB = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "SELECT * from pf_subscriptions where UserID='$UserID' and Status='active'";
$createDB->query($query);
$IsPro = $createDB->numRows();

$query = "SELECT HostedAccount from users where encryptid='$AdminUserID'";
$HostedAccount = $createDB->queryUniqueValue($query);


if ($HostedAccount != ''){
	$query = "SELECT * from comics where userid='$AdminUserID' and Hosted=1";
	$createDB->query($query);
	$NumComics = $createDB->numRows();
	if ($HostedAccount == 1) {
		$LocalHost = true;
		if ($NumComics > 8) 
			$NotAllowed = 1;
	} else if ($HostedAccount == 0) {
		$LocalHost = true;
		if ($NumComics > 0) 
			$NotAllowed = 1;
			if (($_SESSION['userid'] == 'd67d8ab427') || ($_SESSION['userid'] == '7e7757b1a6'))
				$NotAllowed = 0;
	} else {
		$LocalHost = false;
	}
} else {
	$NotAllowed = 1;
}


if ($NotAllowed == 1) {
	header("location:/cms/admin/");
}
function COPY_RECURSIVE_DIRS($dirsource, $dirdest) 
{ // recursive function to copy 
  // all subdirectories and contents: 
  if(is_dir($dirsource))$dir_handle=opendir($dirsource); 
     @mkdir($dirdest, 0777); 
  while($file=readdir($dir_handle)) 
  { 
    if($file!="." && $file!="..") 
    { 
      if(!is_dir($dirsource."/".$file)) 
	  	copy ($dirsource."/".$file, $dirdest."/".$file); 
      else 
	  		COPY_RECURSIVE_DIRS($dirsource."/".$file, $dirdest."/".$file); 
	  chmod ($dirdest,0777);
    } 
  } 
  closedir($dir_handle); 
  return true; 
}
$TitleSafe = 0;
$UserID = $_SESSION['userid'];
if ((!isset($_POST['appset'])) && (!$LocalHost)) {
	$query = "SELECT * from Applications where UserID = '$UserID'";
	$createDB->query($query);
	$NumDomains = $createDB->numRows();
	$AppSelectString = '<select name="txtApp">';
	while ($app = $createDB->fetchNextObject()) {
			$AppSelectString .= '<option value="'.$app->ID.'">'.$app->Domain.'</option>';
	}
	$AppSelectString .= '</select>';
} else {
	if ($LocalHost) 
		$AppInstallID = 0;
	else 
		$AppInstallID = $_POST['txtApp'];
	$query = "SELECT * from Applications where ID ='$AppInstallID'";
	$ApplicationArray = $createDB->queryUniqueObject($query);
	//print $query;
	//if ($LocalHost) 
		//$ApplicationLink = 'http://www.needcomics.com/panelflow';
	//else 
		$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;
	if ((isset($_POST['TitleSafe'])) &&  (($_POST['TitleSafe'] == 0)||($_POST['TitleSafe'] == ''))) { 
		$pattern = '/[*\+?{}.@`\~#$%^;:<>=]/';
		if (preg_match($pattern, $_POST['comictitle']) == 0) {
 			$comicresult = checkcomictitle(trim($_POST['comictitle']));
			if (trim($comicresult) == 'Comic Exists'){
				$Message= "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>That comic name is already taken. Please select a new Title.</div></b>";
			} else {
				$TitleSafe = 1;
			}
		} else {
			$Message= "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>You have invalid characters in your comic title, other than Alpha Numeric characters only these characters are allowed ( ' _ - !)</div></b>";
		}
	}
}



if ($TitleSafe == 1) {
       	$dirsource = "templates/installsource";
		$ComicFolder = str_replace(" ","_",$_POST['comictitle']);
		//$ComicFolder = str_replace("","",$ComicFolder);
		$ComicFolder = str_replace("&","and",$ComicFolder);
		$ComicFolder = preg_replace("/[*\+?{}.@`)\,'(~#$%^;:<>=]/","",$ComicFolder);

		//$ComicFolder = str_replace("'","",$ComicFolder);
		$ComicFolder = str_replace('"','',$ComicFolder);
		//$ComicFolder = str_replace('.','',$ComicFolder);
		//$ComicFolder = str_replace('!','',$ComicFolder);
		//$ComicFolder = str_replace('@','',$ComicFolder);
		//$ComicFolder = str_replace('#','',$ComicFolder);
		//$ComicFolder = str_replace('%','',$ComicFolder);
		//$ComicFolder = str_replace('^','',$ComicFolder);
		//$ComicFolder = str_replace('(','',$ComicFolder);
		//$ComicFolder = str_replace(')','',$ComicFolder);
		//$ComicFolder = str_replace('+','',$ComicFolder);
		//$ComicFolder = str_replace('=','',$ComicFolder);
		//$ComicFolder = str_replace('$','',$ComicFolder);
		//$ComicFolder = str_replace('`','',$ComicFolder);
		//$ComicFolder = str_replace('~','',$ComicFolder);
		//$ComicFolder = str_replace(',','',$ComicFolder);
		$ComicFolder = stripslashes($ComicFolder);
		
		$SafeFolder = $ComicFolder;
		
		$ComicDir = substr(trim($_POST['comictitle']), 0, 1);
		$HostedUrl = $ComicDir."/".$ComicFolder;
		 if(!is_dir("../comics/". $ComicDir)) { 
					mkdir("../comics/". $ComicDir); 
					chmod("../comics/". $ComicDir, 0777); 
		}
					
		if(!is_dir("../comics/". $ComicDir."/".$ComicFolder)) { 
					mkdir("../comics/". $ComicDir."/".$ComicFolder); 
					chmod("../comics/". $ComicDir."/".$ComicFolder, 0777); 
		}
		$dirdest = "../comics/".$ComicDir."/".$ComicFolder;
		COPY_RECURSIVE_DIRS($dirsource, $dirdest);
		$Genres = "";
		for ($i=1; $i< 17; $i++){
	 		if (isset($_POST['g'.$i])){
 				if ($Genres != "" ) {
 					$Genres .=", ";
				}
			$Genres .= $_POST['g'.$i];
			}

		}
		$Thumb = "/comics/".$ComicDir."/".$ComicFolder . "/images/comicthumb.jpg";
	 	$Cover = "/comics/".$ComicDir."/".$ComicFolder . "/images/comiccover.jpg";
		
		if (($_POST['comicfolder'] != '/') || ($HostedAccount == 1) || ($HostedAccount == 0)) {
			if (($HostedAccount != 1) && ($HostedAccount != 0)) {
				$ExternalUrl = 'http://'.$ApplicationArray->Domain."/".$_POST['comicfolder'];
			} else {
				$ExternalUrl = 'http://'.$ApplicationArray->Domain."/".$ComicFolder;
			}
		} else {
			$ExternalUrl = 'http://'.$ApplicationArray->Domain;
		}
		
		$comicresult = CreateComic(stripslashes($_POST['comictitle']),$ExternalUrl, $AdminUserID, trim($Genres), $Cover, $Thumb);
		$ComicID = trim($comicresult);
	    $Date = date('Y-m-d h:i:s'); 
		$AdminEmail = $_SESSION['email'];
	 	$ComicURL = $ComicDir.'/'.$ComicFolder;
		$comicDB =  new DB($db_database,$db_host, $db_user, $db_pass);
		$Comictitle =mysql_real_escape_string( $_POST['comictitle']);
		$Template = $_POST['txtTemplate'];
			
		$templatearray = array();
		$c_elem = null;
  
		function startElement3( $parser, $name, $attrs ) {
  				global $templatearray, $c_elem;
  				if ( $name == 'INFORMATION' )$templatearray []= array();
  					$c_elem = $name;
 				 }
  
  		function endElement3( $parser, $name ) {
 	 		global $c_elem;
				$c_elem = null;
  		}
  
		function textData3( $parser, $text ) {
		  global $templatearray, $c_elem;
		  if ( $c_elem == 'CONTROLCOLOR' ||
			  $c_elem == 'TITLECOLOR' ||
			  $c_elem == 'BACKGROUNDCOLOR' ||
			  $c_elem == 'BUTTONARROWCOLOR' ||
			  $c_elem == 'ADPOSITIONS' ||
			  $c_elem == 'BUTTONCOLOR') {
				  $templatearray[ count($templatearray ) - 1 ][ $c_elem ] = $text;
		  }
 		}
  
  		$parser = xml_parser_create();
  
		xml_set_element_handler( $parser, "startElement3", "endElement3" );
  		xml_set_character_data_handler( $parser, "textData3" );
  
 		 $f = fopen('templates/'.$Template.'/template.xml', 'r' );
  
  		while( $data = fread( $f, 4096 ) ) {
  			xml_parse( $parser, $data );
  		}
  
  		xml_parser_free( $parser );
  
  		foreach($templatearray as $templateitem ){
				$ControlColor = $templateitem['CONTROLCOLOR'];
				$TitleColor = $templateitem['TITLECOLOR'];
				$BackgroundColor = $templateitem['BACKGROUNDCOLOR'];
				$ButtonArrowColor = $templateitem['BUTTONARROWCOLOR'];
				$ButtonColor = $templateitem['BUTTONCOLOR'];
				$AdSpaces = $templateitem['ADPOSITIONS'];
 		} 
	 	$AdminEmail = $_SESSION['email'];
		$AdminUserID = $_SESSION['userid'];
		$ComicFormat = $_POST['txtComicFormat'];
		$UpdateSchedule = $_POST['txtSchedule'];
		if ($LocalHost) {
			$App = '0';
			$Hosted = '1';
		}else {
			$App = $_POST['txtApp'];
			$Hosted = '2';
		
		}
		$query = "UPDATE comics SET SafeFolder='$SafeFolder', Hosted='$Hosted', HostedUrl='$HostedUrl',AppInstallation='$App', Version='$Version' where comiccrypt = '$ComicID'";
		$comicDB->execute($query);
			 
	  $query = "INSERT into projects (userid, title, genre, url, thumb, cover, createdate, CreatorID,ProjectID,ProjectType,SafeFolder,Hosted,HostedUrl) values ('$AdminUserID', '$Comictitle','$Genres','$ComicUrl','$Thumb','$Cover', '$Date','$AdminUserID','$ComicID','comic','$SafeFolder','$Hosted','$HostedUrl')";
		$comicDB->execute($query);
		
		$query ="SELECT Position from pf_forum_categories WHERE Position=(SELECT MAX(Position) FROM pf_forum_categories where UserID='$AdminUserID')";
		$NewPosition = $comicDB->queryUniqueValue($query);
		$NewPosition++;
		
		$query = "INSERT into pf_forum_categories (UserID, ProjectID, Title, Description, Position, CreatedDate) values ('$AdminUserID','$ComicID', '$Comictitle','The Forum for ".$Comictitle."','$NewPosition','$Date')";
		$comicDB->execute($query);
		
		$query ="SELECT ID from from pf_forum_categories WHERE Title = '$Comictitle' and CreatedDate='$Date' and UserID='$AdminUserID'";
		$NewID = $comicDB->queryUniqueValue($query);
		$Encryptid = substr(md5($NewID), 0, 12).dechex($NewID);
			
		$query = "UPDATE pf_forum_categories set EncryptID='$Encryptid' where ID='$NewID'";
		$comicDB->execute($query);
		
		$query = "INSERT into pf_forum_boards (UserID, ProjectID, CatID, Title, Description, Position, CreatedDate, PrivacySetting) values ('$AdminUserID','$ComicID', $NewID,'".$Comictitle." General','General Discussion board for ".$Comictitle."',1,'$Date','public')";
		$comicDB->execute($query);
		
		$query ="SELECT ID from from pf_forum_boards WHERE Title = '$Comictitle' and CreatedDate='$Date' and UserID='$AdminUserID'";
		$NewID = $comicDB->queryUniqueValue($query);
		$Encryptid = substr(md5($NewID), 0, 12).dechex($NewID);
			
		$query = "UPDATE pf_forum_boards set EncryptID='$Encryptid' where ID='$NewID'";
		$comicDB->execute($query);
		
		$query = "SELECT * from users where encryptid ='$AdminUserID'";
		$CreatorArray = $comicDB->queryUniqueObject($query);
		$CreatorName = mysql_real_escape_string($CreatorArray->username);
		$Influences =  mysql_real_escape_string($CreatorArray->influences);
		$Bio =  mysql_real_escape_string($CreatorArray->about);
		$Location =  mysql_real_escape_string($CreatorArray->location);
		$Hobbies =  mysql_real_escape_string($CreatorArray->hobbies);
		$Website =  mysql_real_escape_string($CreatorArray->website);
		$Link1 =  $CreatorArray->link1;
		$Link2 =  $CreatorArray->link2;
		$Link3 =  $CreatorArray->link3;
		$Link4 = $CreatorArray->link4;
		$Music =  mysql_real_escape_string($CreatorArray->music);
		$Credits =  mysql_real_escape_string($CreatorArray->credits);
		$Books =  mysql_real_escape_string($CreatorArray->books);
		$Avatar = $CreatorArray->avatar;
		
		$query ="SELECT ID from project_skins WHERE ID=(SELECT MAX(ID) FROM project_skins)";
		$MaxID = $comicDB->queryUniqueValue($query);
		//print 'MY MAX VALUE = ' . $MaxID;
		if ($MaxID > 9) {
			if ($MaxID > 99) {
				if ($MaxID > 999) {
					if ($MaxID > 9999) {
						if ($MaxID > 99999) {
							echo 'Not Able To Add Skin Too Many IDS';
						} else {
							$NewSkinCode = 'PFPSK-'.($MaxID+1);
						}
					} else {
						$NewSkinCode = 'PFPSK-0'.($MaxID+1);
					}
				} else {
					$NewSkinCode = 'PFPSK-00'.($MaxID+1);
				//print 'NewSkinCode' .$NewSkinCode;
				}
			} else {
				$NewSkinCode = 'PFPSK-000'.($MaxID+1);
			//print 'NewSkinCode' .$NewSkinCode;
			}
		} else {
	
			$NewSkinCode = 'PFPSK-0000'.($MaxID+1);
		//print 'NewSkinCode' .$NewSkinCode;
		}
		$query = "INSERT into creators (avatar, realname, location, about, website, music, books, hobbies, influences, credits, link1, link2, link3, link4, ComicID, Email) values ('$Avatar', '$CreatorName','$Location','$Bio','$Website','$Music', '$Books','$Hobbies','$Influences','$Credits','$Link1','$Link2','$Link3','$Link4','$ComicID','$AdminEmail')";
		$comicDB->query($query);
			 
		$query = "INSERT into comic_settings (ComicID, Contact, AllowComments, ShowArchive, ShowChapter, ShowEpisode, ShowCalendar, BioSetting, Template,ReaderType,ComicFormat,UpdateSchedule, Skin) values ('$ComicID', 1,1,1,1,1,1,1,'$Template','flash','$ComicFormat','$UpdateSchedule','$NewSkinCode')";
		$comicDB->query($query);

		$query = 'SHOW COLUMNS FROM template_skins;';
		$results = mysql_query($query);

// Generate the duplication query with those fields except the key
		$query = 'INSERT INTO project_skins(SELECT ';

		while ($row = mysql_fetch_array($results)) {
			if ($row[0] == 'ID') {
				$query .= 'NULL, ';
			} else if ($row[0] == 'Title') {
				$query .= 'NULL, ';
			} else if ($row[0] == 'SkinCode') {
				$query .= 'NULL, ';
			}else if ($row[0] == 'UserID') {
				$query .= 'NULL, ';
			} else {
				$query .= $row[0] . ', ';
			} // END IF
		} // END WHILE

		$query = substr($query, 0, strlen($query) - 2);
		$query .= ' FROM template_skins WHERE SkinCode = "PFSK-00001")';
		
		mysql_query($query);
		//print $query.'<br/><br/>';
		$new_id = mysql_insert_id();
		$query = "UPDATE project_skins set Title='$Comictitle', SkinCode='$NewSkinCode', UserID='".$_SESSION['userid']."' WHERE ID='$new_id'";
		$comicDB->execute($query);
		//print $query;
		$dirsource = "templates/skins/PFSK-00001";
		$dirdest = "templates/skins/".$NewSkinCode;
		COPY_RECURSIVE_DIRS($dirsource, $dirdest);
		//mkdir('../templates/skins/'.$NewSkinCode);
		//chmod('../templates/skins/'.$NewSkinCode,0777);
		//mkdir('../templates/skins/'.$NewSkinCode.'/images');
		//chmod('../templates/skins/'.$NewSkinCode.'/images',0777);

		if ($Template == 'TPL-001') { 
		$query = "INSERT INTO pf_modules (Title, ModuleCode, ComicID, Position, Placement, IsPublished) VALUES ('Author Comment', 'authcom', '$ComicID', 1, 'left', 1),('Page Comments', 'pagecom', '$ComicID', 2, 'left', 1),('Comic Info', 'comicinfo', '$ComicID', 1, 'right', 1),('Comic Synopsis', 'comicsyn', '$ComicID', 2, 'right', 1),('Comment Form', 'comform', '$ComicID', 3, 'right', 1),('Login Form', 'logform', '$ComicID', 4, 'right', 1),('Links Box', 'linksbox', '$ComicID', 5, 'right', 1),('Twitter', 'twitter', '$ComicID', 6, 'right',0),('Menu One', 'menuone', '$ComicID', 7, 'right', 0),('Menu Two', 'menutwo', '$ComicID', 8, 'right', 0),('Blog', 'blog', '$ComicID', 3, 'left', 0),('Custom', 'custommod', '$ComicID', 4, 'left', 0)";
		} else if ($Template == 'TPL-002') {
		$query = "INSERT INTO pf_modules (Title, ModuleCode, ComicID, Position, Placement, IsPublished) VALUES ('Author Comment', 'authcom', '$ComicID', 1, 'left', 1),('Page Comments', 'pagecom', '$ComicID', 1, 'right', 1),('Comic Info', 'comicinfo', '$ComicID', 1, 'left', 1),('Comic Synopsis', 'comicsyn', '$ComicID', 2, 'left', 1),('Comment Form', 'comform', '$ComicID', 3, 'left', 1),('Login Form', 'logform', '$ComicID', 4, 'left', 1),('Links Box', 'linksbox', '$ComicID', 5, 'left', 1),('Twitter', 'twitter', '$ComicID', 6, 'left',0),('Menu One', 'menuone', '$ComicID', 7, 'left', 0),('Menu Two', 'menutwo', '$ComicID', 8, 'left', 0),('Blog', 'blog', '$ComicID', 9, 'left', 0),('Custom', 'custommod', '$ComicID', 10, 'left', 0)";
		}else if ($Template == 'TPL-003') {
		$query = "INSERT INTO pf_modules (Title, ModuleCode, ComicID, Position, Placement, IsPublished) VALUES ('Author Comment', 'authcom', '$ComicID', 1, 'right', 1),('Page Comments', 'pagecom', '$ComicID', 1, 'left', 1),('Comic Info', 'comicinfo', '$ComicID', 2, 'right', 1),('Comic Synopsis', 'comicsyn', '$ComicID', 3, 'right', 1),('Comment Form', 'comform', '$ComicID', 4, 'right', 1),('Login Form', 'logform', '$ComicID', 5, 'right', 1),('Links Box', 'linksbox', '$ComicID', 6, 'right', 1),('Twitter', 'twitter', '$ComicID', 6, 'right',0),('Menu One', 'menuone', '$ComicID', 7, 'right', 0),('Menu Two', 'menutwo', '$ComicID', 8, 'right', 0),('Blog', 'blog', '$ComicID', 9, 'right', 0),('Custom', 'custommod', '$ComicID', 10, 'right', 0)";
		}
		$comicDB->query($query);
		
		$query = "INSERT INTO pf_modules (Title, ModuleCode, ComicID, Position, Placement, IsPublished,Homepage) VALUES ('Comic Credits', 'comiccredits', '$ComicID', 1, 'left',0, 1),('Other Comics', 'pagecom', '$ComicID', 2, 'left', 0,1),('Comic Synopsis', 'comicsynopsis', '$ComicID', 1, 'right', 0,1),('Links', 'linksbox', '$ComicID', 2, 'right', 0,1),('Mobile Content', 'mobile', '$ComicID', 3, 'right',0, 1),('Status Box', 'status', '$ComicID', 4, 'right', 0,1),('Products', 'products', '$ComicID', 5, 'right', 0,1),('Characters', 'characters', '$ComicID', 6, 'right', 0,1),('Twitter', 'twitter', '$ComicID', 7, 'right',0,1),('Menu One', 'menuone', '$ComicID', 8, 'right', 0,1),('Menu Two', 'menutwo', '$ComicID', 9, 'right', 0,1),('Downloads', 'downloads', '$ComicID', 3, 'left', 0,1),('Author Comment', 'authcomm', '$ComicID', 4, 'left', 0,1),('Blog', 'blog', '$ComicID', 5, 'left', 0, 1)";
		
		$comicDB->query($query);
		
		$TemplateAds = explode(',',$AdSpaces);
		foreach ($TemplateAds as $AdPosition) {
				 $query = "INSERT into adspaces (ComicID, Template, Position, Active) values ('$ComicID','$Template','$AdPosition',1)";
				// print $query."<br/>";
				$comicDB->query($query);
		}
		//print 'AD CREATING --- FROM TEMPLATE = ' . $AdSpaces."<br/>";
			
		$ConnectKey = createKey();
		$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
		$comicDB->query($query);
		$post_data = array('u' => $_SESSION['userid'],'l'=> $_POST['comicfolder'], 'c' => $ComicID, 'k' => $ConnectKey);
		$updateresult = $curl->send_post_data($ApplicationLink."/connectors/install_comic.php", $post_data);
		//if ($_SESSION['userid'] == 'd61e4bbd1c1')
			//echo 'CREATION RESULT = -----------------<br/> ' .$updateresult;
		unset($post_data);
		$ComicCreated = 1;
		$TitleSafe = 1;
		insertUpdate('comic', 'created', $ComicID, 'project', $_SESSION['userid'],'http://'.$_SERVER['SERVER_NAME'].'/'.$SafeFolder.'/');

 
		$comicDB->close();
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
<title>PANEL FLOW - CREATE A NEW COMIC </title>
</head>
<body>
<?php include 'includes/header.php';?>
<?php 
if ((!isset($_POST['appset'])) && (!$LocalHost)) {
   include 'includes/app_select_form_inc.php';
} else if (!isset($_POST['comictitle'])) {
	 include 'includes/comic_form_inc.php';
} else if ($_POST['comictitle'] == "") {
	echo "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>You must enter the Comic Title</div></b>";
     include 'includes/comic_form_inc.php';
} else if (($TitleSafe == 1)&& ($ComicCreated == 1)) {
   	  include 'includes/crop_form_inc.php';
} else if ($TitleSafe == 0) {
echo "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div>$Message</div></b>";
   	   include 'includes/comic_form_inc.php';
}
include 'includes/footer.php';			
?>

</body>
</html>
