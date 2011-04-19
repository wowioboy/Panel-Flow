<?
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$config = array();
include '../includes/db.class.php'; 
include '../includes/config.php';
$ComicID= $_POST['c'];
$UserID = $_POST['u'];
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
	echo $dirdest;
    } 
  } 
  closedir($dir_handle); 
  return true; 
}
//print "MY COMIC ID = " . $ComicID."<br/>";
//print "MY UserID  = " . $UserID."<br/>"; 
//print "MY Section  = " . $Section."<br/>";
//print "MY file set ID = " . $_POST['f']."<br/>";

$AdminEmail = $config['adminemail'];
$AdminUserID = $config['adminuserid'];  
$PFDIRECTORY = $config['pathtopf']; 
$db_user = $config['db_user']; 
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];  
$key = $config['liscensekey'];
$settings = new DB($db_database,$db_host, $db_user, $db_pass);

//print "MY COMIC FOLDER = " . $ComicFolder."<br/>";
//print "admin = " . $ComicArray->userid."<br/>";
//print "creator = " . $ComicArray->CreatorID."<br/>"; 

//if ($UserID == $AdminUserID)  {
		$post_data = array('u' => $UserID, 'c' => $ComicID, 's' => 'Install','k' => $_POST['k'], 'l'=>$key);
		$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_info.php", $post_data);
		unset($post_data);
		print 'MY UPDATE RESULT FROM EXPORT COMIC INFO: '.$updateresult."<br/><br/><br/>";
		if ($updateresult != 'Not Authorized') {
		$values = unserialize ($updateresult);
		$ComicFormat = $values['comicformat'];
		$UpdateSchedule = $values['updateschedule'];
		$SkinCode = $values['skincode'];
		$Template = $values['template'];
		$Comictitle = mysql_real_escape_string($values['title']);
		$SafeFolder = $values['safefolder'];
		$ComicDir = substr(trim($SafeFolder), 0, 1);
		$FullUrl = 'comics/'.$ComicDir."/".$SafeFolder;
		$Genre = $values['genre'];
	//	print 'MY FULL DIR = ' . $FullUrl.'<br/>';
		$AdPositions = $values['adpositions'];
		$CreatorName = mysql_real_escape_string($values['username']);
		$CreatorEmail = $values['creatoremail'];
		$Influences = mysql_real_escape_string($values['influences']); 
		$About = mysql_real_escape_string($values['about']);
		$Location = mysql_real_escape_string($values['location']);
		$Hobbies = mysql_real_escape_string($values['hobbies']);
		$Website = mysql_real_escape_string($values['website']);
		$Link1 = mysql_real_escape_string($values['link1']);
		$Link2 = $values['link2'];
		$Link3 = $values['link3'];
		$Link4 = $values['link4'];
		$Music = mysql_real_escape_string($values['music']);
		$Credits = mysql_real_escape_string($values['credits']);
		$Books = mysql_real_escape_string($values['books']);
		$Avatar = $values['avatar'];
		$ComicURL =$_POST['l'];
	    $file_to_write = 'config.php';
		$content ="<?php \n";
		$content .="\$config['comicid'] = '".$ComicID."';\n";
		$content .="\$config['name'] = '".$CreatorName."';\n";
		$content .="\$config['adminemail'] = '".$CreatorEmail."';\n";
		$content .="\$config['adminuserid'] = '".$UserID."';\n";
		$content .="\$config['pathtopf'] = '".$PFDIRECTORY."';\n";
		$content .="\$config['liscensekey'] = '".$key."';\n";
		$content .="\$config['db_user'] = '".$db_user."';\n";
		$content .="\$config['db_database'] = '".$db_database."';\n";
		$content .="\$config['db_host'] = '".$db_host."';\n";
		$content .="\$config['db_pass'] = '".$db_pass."';\n";
		$content .="?>";
		$fp = fopen($file_to_write, 'w');
		fwrite($fp, $content);
		fclose($fp);

		 if(!is_dir("../../comics/". $ComicDir)) { 
					mkdir("../../comics/". $ComicDir); 
					chmod("../../comics/". $ComicDir, 0777); 
			}
					
			if(!is_dir("../../comics/". $ComicDir."/".$SafeFolder)) { 
					mkdir("../../comics/". $ComicDir."/".$SafeFolder); 
					chmod("../../comics/". $ComicDir."/".$SafeFolder, 0777); 
			}

			$dirsource = "../templates/installsource";
			$dirdest = "../../".$FullUrl;
			COPY_RECURSIVE_DIRS($dirsource, $dirdest);
			
			$dirsource = "../templates/skins/PFSK-00001";
			$dirdest = "../templates/skins/".$SkinCode;
			COPY_RECURSIVE_DIRS($dirsource, $dirdest);
			
			rename($file_to_write, '../../'.$FullUrl.'/includes/config.php');
			chmod('../../'.$FullUrl.'/includes/config.php', 0644);
			//@copy('htaccess','../../'.$_POST['comicfolder'].'.htaccess');
			rename('../../'.$FullUrl.'/htaccess.txt', '../../'.$FullUrl.'/.htaccess');
			$Date = date('Y-m-d H:i:s');  

	 		$Thumb = $_SERVER['SERVER_NAME']."/".$FullUrl . "/images/comicthumb.jpg";
	 		$Cover = $_SERVER['SERVER_NAME']."/".$FullUrl . "/images/comiccover.jpg";
	
		
		$comicDB =  new DB($db_database,$db_host, $db_user, $db_pass);
	
		$query = "INSERT into comics (userid, title, genre, url, thumb, cover, createdate, installed, version, CreatorID, CreatorEmail, comiccrypt, SafeFolder) values ('$UserID', '$Comictitle','$Genre','$SafeFolder','$Thumb','$Cover', '$Date',1,'$Version','$UserID','$CreatorEmail','$ComicID','$SafeFolder')";
		$comicDB->query($query);
		
		print $query."<br/><br/>";
		
		$query = "INSERT into creators (avatar, realname, location, about, website, music, books, hobbies, influences, credits, link1, link2, link3, link4, ComicID, Email) values ('$Avatar', '$CreatorName','$Location','$About','$Website','$Music', '$Books','$Hobbies','$Influences','$Credits','$Link1','$Link2','$Link3','$Link4','$ComicID','$CreatorEmail')";
		$comicDB->query($query);
		
		print $query."<br/><br/>";
			  
	    $ComicFormat = $values['comicformat'];
		$UpdateSchedule = $values['updateschedule'];
		$ArrowBg = $values['arrowbg'];
		$ButtonBg = $values['buttonbg'];
		$SiteBg = $values['sitebg'];
		$TitleColor = $values['titlecolor'];
		$ControlBg = $values['controlbg'];
		$ComicFormat = $values['comicformat'];
		$UpdateSchedule = $values['updateschedule'];
		$Template = $values['template'];
		
		$query = 'SHOW COLUMNS FROM template_skins;';
		$results = mysql_query($query);

// Generate the duplication query with those fields except the key
		$query = 'INSERT INTO template_skins(SELECT ';

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
		print $query.'<br/><br/>';
		$new_id = mysql_insert_id();
		$query = "UPDATE template_skins set Title='$Comictitle', SkinCode='$SkinCode', UserID='$UserID' WHERE ID='$new_id'";
		$comicDB->execute($query);
		print $query;
				
		$query = "INSERT into comic_settings (ComicID, Contact, AllowComments, ShowArchive, ShowChapter, ShowEpisode, ShowCalendar, BioSetting, Template, ComicFormat, UpdateSchedule, Skin) values ('$ComicID', 1,1,1,1,1,1,1,'$Template', '$ComicFormat', '$UpdateSchedule','$SkinCode')";
		$comicDB->query($query); 
		if ($Template == 'TPL-001') { 
		$query = "INSERT INTO pf_modules (Title, ModuleCode, ComicID, Position, Placement, IsPublished) VALUES ('Author Comment', 'authcom', '$ComicID', 1, 'left', 1),('Page Comments', 'pagecom', '$ComicID', 2, 'left', 1),('Comic Info', 'comicinfo', '$ComicID', 1, 'right', 1),('Comic Synopsis', 'comicsyn', '$ComicID', 2, 'right', 1),('Comment Form', 'comform', '$ComicID', 3, 'right', 1),('Login Form', 'logform', '$ComicID', 4, 'right', 1),('Links Box', 'linksbox', '$ComicID', 5, 'right', 1)";
		} else if ($Template == 'TPL-002') {
		$query = "INSERT INTO pf_modules (Title, ModuleCode, ComicID, Position, Placement, IsPublished) VALUES ('Author Comment', 'authcom', '$ComicID', 1, 'left', 1),('Page Comments', 'pagecom', '$ComicID', 1, 'right', 1),('Comic Info', 'comicinfo', '$ComicID', 1, 'left', 1),('Comic Synopsis', 'comicsyn', '$ComicID', 2, 'left', 1),('Comment Form', 'comform', '$ComicID', 3, 'left', 1),('Login Form', 'logform', '$ComicID', 4, 'left', 1),('Links Box', 'linksbox', '$ComicID', 5, 'left', 1)";
		}else if ($Template == 'TPL-003') {
		$query = "INSERT INTO pf_modules (Title, ModuleCode, ComicID, Position, Placement, IsPublished) VALUES ('Author Comment', 'authcom', '$ComicID', 1, 'right', 1),('Page Comments', 'pagecom', '$ComicID', 1, 'left', 1),('Comic Info', 'comicinfo', '$ComicID', 2, 'right', 1),('Comic Synopsis', 'comicsyn', '$ComicID', 3, 'right', 1),('Comment Form', 'comform', '$ComicID', 4, 'right', 1),('Login Form', 'logform', '$ComicID', 5, 'right', 1),('Links Box', 'linksbox', '$ComicID', 6, 'right', 1)";
		}
		$comicDB->query($query);
		//print 'MY ADPSOTIONS--------------------- = ' . $AdPositions.'-----------<br/>';
		$TemplateAds = explode(',',$AdPositions); 
		foreach ($TemplateAds as $AdPosition) {  
				 $query = "INSERT into adspaces (ComicID, Template, Position, Active) values ('$ComicID','$Template','$AdPosition',1)";
				$comicDB->query($query);
			//	print $query."<br/><br/>";
		} 
	} else {
		echo 'Not Authorized';
	}		

            ?>