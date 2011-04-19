<?php 
include 'includes/init.php';
$AdminUserID = $_SESSION['userid'];
include("classes/class_dirtool.php");
include 'includes/create_functions.php';
if (isset($_POST['comcid'])) {
	$ComicID = $_POST['comcid'];
}
$NotAllowed = 0;
$AdminUserID = $_SESSION['userid'];
$createDB = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "SELECT HostedAccount from users where encryptid='$AdminUserID'";
$HostedAccount = $createDB->queryUniqueValue($query);
if ($HostedAccount == 1) {
	$query = "SELECT title from comics where userid='$AdminUserID' and Hosted=1";
	$createDB->query($query);
	$NumComics = $createDB->numRows();
	if ($NumComics > 4) {
		$NotAllowed = 1;
	} 
} else {
	$NotAllowed = 1;
}


if ($NotAllowed == 1) {
	header("location:/".$PFDIRECTORY."/admin/");
}
function COPY_RECURSIVE_DIRS($dirsource, $dirdest) 
{ // recursive function to copy 
  // all subdirectories and contents: 
  if(is_dir($dirsource))$dir_handle=opendir($dirsource); 
     @mkdir($dirdest, 0755); 
  while($file=readdir($dir_handle)) 
  { 
    if($file!="." && $file!="..") 
    { 
      if(!is_dir($dirsource."/".$file)) copy ($dirsource."/".$file, $dirdest."/".$file); 
      else COPY_RECURSIVE_DIRS($dirsource."/".$file, $dirdest."/".$file); 
	  chmod ($dirdest,0755);
    } 
  } 
  closedir($dir_handle); 
  return true; 
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
if (!isset($_POST['comictitle'])) {
     // Show the form
      include 'includes/comic_form_inc.php';
	  include 'includes/footer.php';
     exit;
} else {
   if ($_POST['comictitle'] == "") {
     // Show the form
	  echo "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>You must enter the Comic Title</div></b>";
      include 'includes/comic_form_inc.php';
	  include 'includes/footer.php';
     exit;
   } else {
   	$comicresult = checkcomictitle($_POST['comictitle'],$pf_db, $db_host, $pf_user, $pf_pass);
	if (trim($comicresult) == 'Comic Exists'){
	echo "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>That comic name is already taken. Please select a new Title.</div></b>";
      include 'includes/comic_form_inc.php';
	  include 'includes/footer.php';
	  exit;
	} else {
		$TitleSafe = 1;
	}
		
	if ($TitleSafe == 1) {
		//$dir = new dirtool("installsource");
		//$dir->debug(TRUE);
		//copy the "your_test_dir" to the parent-directory and rename it to dummy  ( file-permissons  rwxrwxrwx)
		//$dir->copy("../".$_POST['comicfolder'],0777);
		$dirsource = "templates/installsource";
		$ComicFolder = str_replace(" ","_",$_POST['comictitle']);
		$ComicFolder = str_replace("&","and",$ComicFolder);
		$ComicFolder = str_replace("'","",$ComicFolder);
		$ComicFolder = str_replace('"','',$ComicFolder);
		$SafeFolder = $ComicFolder;
		$ComicDir = substr(trim($_POST['comictitle']), 0, 1);
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
	
	}
	$comicresult = 'Found';
	if (trim($comicresult) == 'Found') {
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
	$comicresult = CreateComic($_POST['comictitle'],$_SERVER['SERVER_NAME']."/".$ComicFolder.'/', $ComicFolder, $AdminUserID, trim($Genres), $Cover, $Thumb);
	$ComicID = trim($comicresult);
	        $file_to_write = 'config.php';
			$content ="<?php \n";
			$content .="\$config['comicid'] = '".$ComicID."';\n";
			$content .="\$config['name'] = '".$_SESSION['username']."';\n";
			$content .="\$config['adminemail'] = '".$_SESSION['email']."';\n";
			$content .="\$config['adminuserid'] = '".$AdminUserID."';\n";
			$content .="\$config['pathtopf'] = '".$PFDIRECTORY."';\n";
			$content .="\$config['db_user'] = '".$nc_user."';\n";
			$content .="\$config['db_database'] = '".$nc_db."';\n";
			$content .="\$config['db_host'] = '".$db_host."';\n";
			$content .="\$config['db_pass'] = '".$nc_pass."';\n";
			$content .="?>";
			$fp = fopen($file_to_write, 'w');
			fwrite($fp, $content);
			fclose($fp);
			rename($file_to_write, '../comics/'.$ComicDir.'/'.$ComicFolder.'/includes/config.php');
			chmod('../comics/'.$ComicDir.'/'.$ComicFolder.'/includes/config.php', 0644);
			//@copy('install/htaccess','../comics/'.$ComicDir.'/'.$ComicFolder.'.htaccess');
			$Date = date('Y-m-d H:i:s'); 
			$AdminEmail = $_SESSION['email'];
	 		$ComicURL = $ComicDir.'/'.$ComicFolder;
			 $comicDB =  new DB($nc_db,$db_host, $nc_user, $nc_pass);
			$Comictitle = $_POST['comictitle'];
			$Template = $_POST['txtTemplate'];
			
			$templatearray = array();
$c_elem = null;
  
function startElement3( $parser, $name, $attrs ) 
  				{
  				global $templatearray, $c_elem;
  				if ( $name == 'INFORMATION' )$templatearray []= array();
  					$c_elem = $name;
 				 }
  
  function endElement3( $parser, $name ) 
  {
  global $c_elem;
  $c_elem = null;
  }
  
  function textData3( $parser, $text )
  {
  global $templatearray, $c_elem;
  if ( $c_elem == 'CONTROLCOLOR' ||
  $c_elem == 'TITLECOLOR' ||
  $c_elem == 'BACKGROUNDCOLOR' ||
  $c_elem == 'BUTTONARROWCOLOR' ||
  $c_elem == 'BUTTONCOLOR')
  {
  $templatearray[ count($templatearray ) - 1 ][ $c_elem ] = $text;
  }
  }
  
  $parser = xml_parser_create();
  
  xml_set_element_handler( $parser, "startElement3", "endElement3" );
  xml_set_character_data_handler( $parser, "textData3" );
  
  $f = fopen('templates/'.$Template.'/template.xml', 'r' );
  
  while( $data = fread( $f, 4096 ) )
  {
  xml_parse( $parser, $data );
  }
  
  xml_parser_free( $parser );
  
  foreach($templatearray as $templateitem )
  {
  		$ControlColor = $templateitem['CONTROLCOLOR'];
  		$TitleColor = $templateitem['TITLECOLOR'];
  		$BackgroundColor = $templateitem['BACKGROUNDCOLOR'];
  		$ButtonArrowColor = $templateitem['BUTTONARROWCOLOR'];
  		$ButtonColor = $templateitem['BUTTONCOLOR'];

 } 
$query = "INSERT into comics (userid, title, genre, url, thumb, cover, createdate, installed, version, CreatorID, CreatorEmail, comiccrypt, ControlBg, TitleColor, ButtonBg, SiteBg, ArrowBg, SafeFolder) values ('$AdminUserID', '$Comictitle','$Genres','$ComicURL','$Thumb','$Cover', '$Date',1,'$Version','$AdminUserID','$AdminEmail','$ComicID','$ControlColor', '$TitleColor', '$ButtonColor', '$BackgroundColor', '$ButtonArrowColor','$SafeFolder')";

			$comicDB->query($query);
			$profileresult = file_get_contents ('http://www.panelflow.com/processing/getprofile.php?email='.$AdminEmail);
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
			 $query = "INSERT into creators (avatar, realname, location, about, website, music, books, hobbies, influences, credits, link1, link2, link3, link4, ComicID, Email, UserID) values ('$Avatar', '$CreatorName','$Location','$Bio','$Website','$Music', '$Books','$Hobbies','$Influences','$Credits','$Link1','$Link2','$Link3','$Link4','$ComicID','$AdminEmail','$AdminUserID')";
			 $comicDB->query($query);
			  $query = "INSERT into comic_settings (ComicID, Contact, AllowComments, ShowArchive, ShowChapter, ShowEpisode, ShowCalendar, BioSetting, Template) values ('$ComicID', 1,1,1,1,1,1,1,'$Template')";
			$comicDB->query($query);
				$comicDB->close();
			
       		include 'includes/crop_form_inc.php';
			include 'includes/footer.php';
			
			
	} else {
	echo "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>The Folder you have entered for the comic doesn't seem to be working. Please check and make sure the foldername is correct, your comic currently sits at http://".$_SERVER['SERVER_NAME']."/".$_POST['comicfolder']." Is that Correct?</div></b>";
      include 'includes/comic_form_inc.php';
	  include 'includes/footer.php';
	  exit;
	}
	}	
} 
			
?>

</body>
</html>
