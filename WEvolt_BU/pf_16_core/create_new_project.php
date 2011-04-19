<?php 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
include 'includes/connect_functions.php';
$Version = '2.0';
$AdminUserID = $_SESSION['userid'];
$StartType = $_GET['type'];
  //require_once("includes/curl_http_client.php");
//$curl = &new Curl_HTTP_Client();
//$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
//$curl->set_user_agent($useragent);
 
include("classes/class_dirtool.php");
require_once("includes/create_key_func.php");
include 'includes/create_functions.php';
if (isset($_POST['comcid'])) {
	$ComicID = $_POST['comcid'];
}

$ComicCreated = 0;
$NotAllowed = 0;
$AdminUserID = $_SESSION['userid'];
$query = "SELECT * from pf_subscriptions where UserID='$UserID' and Status='active'";
$InitDB->query($query);
$IsPro = $InitDB->numRows();

$query = "SELECT HostedAccount from users where encryptid='$AdminUserID'";
$HostedAccount = $InitDB->queryUniqueValue($query);
$SelectedDays = $_POST['week_day'];
if ($SelectedDays == null)
	$SelectedDays = array();
if (is_array($SelectedDays)) {
	$DayList =@implode(",",$SelectedDays);
} 

if ($HostedAccount != ''){
	$query = "SELECT * from comics where userid='$AdminUserID' and Hosted=1";
	$InitDB->query($query);
	$NumComics = $InitDB->numRows();
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
	//header("location:/cms/admin/");
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
	$InitDB->query($query);
	$NumDomains = $InitDB->numRows();
	$AppSelectString = '<select name="txtApp">';
	while ($app = $InitDB->fetchNextObject()) {
			$AppSelectString .= '<option value="'.$app->ID.'">'.$app->Domain.'</option>';
	}
	$AppSelectString .= '</select>';
} else {
	if ($LocalHost) 
		$AppInstallID = 2;
	else 
		$AppInstallID = $_POST['txtApp'];
		
	$query = "SELECT * from Applications where ID ='$AppInstallID'";
	$ApplicationArray = $InitDB->queryUniqueObject($query);
	//print $query;
	//if ($LocalHost) 
		//$ApplicationLink = 'http://www.needcomics.com/panelflow';
	//else 
		$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;
	if ((isset($_POST['TitleSafe'])) &&  (($_POST['TitleSafe'] == 0)||($_POST['TitleSafe'] == ''))) { 
		$pattern = '/[*\+?{}.@`\~#$%^;:<>=]/';
		if (preg_match($pattern, $_POST['txtTitle']) == 0) {
 			$comicresult = checkcomictitle(trim($_POST['txtTitle']));
			if (trim($comicresult) == 'Project Exists'){
				$Message= "That project name is already taken. Please eneter a new Title.";
			} else {
				$TitleSafe = 1;
			}
		} else {
			$Message= "You have invalid characters in your comic title, <br/>other than Alpha Numeric characters only these characters are allowed ( ' _ - !)";
		}
	}
}



if ($TitleSafe == 1) {
		if ($_POST['txtProjectCategory'] == 'image') {
			
			if ($_POST['txtSubCategory'] == 'comic_series') {
				$ProjectType = 'comic';
				$Format = 'series';
				$ProjectDirectory = 'comics';
				
			} else if ($_POST['txtSubCategory'] == 'comic_strip') {
				$ProjectType = 'comic';
				$Format = 'strip';
				$ProjectDirectory = 'comics';
			} else if ($_POST['txtSubCategory'] == 'portfolio') {
				$ProjectType = 'portfolio';
				$Format = 'artwork';
				$ProjectDirectory = 'portfolios';
			}else if ($_POST['txtSubCategory'] == 'photos') {
				$ProjectType = 'portfolio';
				$Format = 'photos';
				$ProjectDirectory = 'portfolios';
			}
		
		} else if ($_POST['txtProjectCategory'] =='writing') {
			if ($_POST['txtSubCategory'] == 'blog') {
				$ProjectType = 'blog';
				$Format = 'journal';
				$ProjectDirectory = 'blogs';
				
			} else if ($_POST['txtSubCategory'] == 'novel') {
				$ProjectType = 'writing';
				$Format = 'novel';
				$ProjectDirectory = 'writing';
			} else if ($_POST['txtSubCategory'] == 'short') {
				$ProjectType = 'writing';
				$Format = 'short';
				$ProjectDirectory = 'writing';
			}		
		}

       	$dirsource = "templates/installsource";
		$ComicFolder = str_replace(" ","_",trim($_POST['txtTitle']));
		$ComicFolder = str_replace("&","and",$ComicFolder);
		$ComicFolder = preg_replace("/[*\+?{}.@`)\,'(~#$%^;:<>=]/","",$ComicFolder);
		$ComicFolder = str_replace('"','',$ComicFolder);
		$ComicFolder = stripslashes($ComicFolder);
		$SafeFolder = $ComicFolder;
		$ComicDir = substr(trim($_POST['txtTitle']), 0, 1);
		$HostedUrl = $ComicDir."/".$ComicFolder;
	//	print 'DIRECTORY = ' . $ProjectDirectory;
		 if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory)) { 
					mkdir($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory); 
					chmod($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory, 0777); 
		}
		 if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/". $ComicDir)) { 
					mkdir($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/". $ComicDir); 
					chmod($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/". $ComicDir, 0777); 
		}
					
		if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/". $ComicDir."/".$ComicFolder)) { 
					mkdir($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/". $ComicDir."/".$ComicFolder); 
					chmod($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/". $ComicDir."/".$ComicFolder, 0777); 
		}
		$dirdest = $_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/".$ComicDir."/".$ComicFolder;
		
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
		$Thumb = "/".$ProjectDirectory."/".$ComicDir."/".$ComicFolder . "/images/comicthumb.jpg";
	 	$Cover = "/".$ProjectDirectory."/".$ComicDir."/".$ComicFolder . "/images/comiccover.jpg";
		
		if (($_POST['comicfolder'] != '/') || ($HostedAccount == 1) || ($HostedAccount == 0)) {
			if (($HostedAccount != 1) && ($HostedAccount != 0)) {
				$ExternalUrl = 'http://'.$ApplicationArray->Domain."/".$_POST['comicfolder'];
			} else {
				$ExternalUrl = 'http://'.$ApplicationArray->Domain."/".$ComicFolder;
			}
		} else {
			$ExternalUrl = 'http://'.$ApplicationArray->Domain;
		}
		
		$comicresult = CreateComic(stripslashes(trim($_POST['txtTitle'])),$ExternalUrl, $AdminUserID, trim($Genres), $Cover, $Thumb);
		$ComicID = trim($comicresult);
	    $Date = date('Y-m-d h:i:s'); 
		$AdminEmail = $_SESSION['email'];
	 	$ComicURL = $ComicDir.'/'.$ComicFolder;
		
		$Comictitle =mysql_real_escape_string(trim($_POST['txtTitle']));
		$Template = $_POST['txtTemplate'];
	 	$AdminEmail = $_SESSION['email'];
		$AdminUserID = $_SESSION['userid'];
		$Category = $_POST['txtProjectCategory'];
		$SubCategory = $_POST['txtSubCategory'];
		$UpdateSchedule = $DayList;
		
		if ($LocalHost) {
			$App = '2';
			$Hosted = '1';
		}else {
			$App = $_POST['txtApp'];
			$Hosted = '2';
		
		}
		$query = "UPDATE comics SET SafeFolder='$SafeFolder', Hosted='$Hosted', HostedUrl='$HostedUrl',AppInstallation='$App', Version='$Version' where comiccrypt = '$ComicID'";
		$InitDB->execute($query);
			 	//print $query.'<br/><br/>'; 
				
		if ($_POST['rating'] != 'a')
			$Rating = 'g';
		else
			$Rating = 'a';		
	  $query = "INSERT into projects (userid, title, genre, url, thumb, cover, createdate, CreatorID,ProjectID,ProjectType,SafeFolder,Hosted,HostedUrl,ProjectDirectory, installed,Rating) values ('$AdminUserID', '$Comictitle','$Genres','$ComicUrl','$Thumb','$Cover', '$Date','$AdminUserID','$ComicID','$ProjectType','$SafeFolder','1','$HostedUrl','$ProjectDirectory',1,'$Rating')";
		$InitDB->execute($query);
		//print $query.'<br/><br/>';
		$query ="SELECT Position from pf_forum_categories WHERE Position=(SELECT MAX(Position) FROM pf_forum_categories where UserID='$AdminUserID')";
		$NewPosition = $InitDB->queryUniqueValue($query);
		$NewPosition++;
			//print $query.'<br/><br/>';
		$query = "INSERT into pf_forum_categories (UserID, ProjectID, Title, Description, Position, CreatedDate, ProjectCat) values ('$AdminUserID','$ComicID', '$Comictitle','The Forum for ".$Comictitle."','$NewPosition','$Date',1)";
		$InitDB->execute($query);
			//print $query.'<br/><br/>';
		$query ="SELECT ID from pf_forum_categories WHERE CreatedDate='$Date' and UserID='$AdminUserID'";
		$NewID = $InitDB->queryUniqueValue($query);
		$Encryptid = substr(md5($NewID), 0, 12).dechex($NewID);
			//print $query.'<br/><br/>';	
		$query = "UPDATE pf_forum_categories set EncryptID='$Encryptid' where ID='$NewID'";
		$InitDB->execute($query);
			//print $query.'<br/><br/>';
		$query = "INSERT into pf_forum_boards (UserID, ProjectID, CatID, Title, Description, Position, CreatedDate, PrivacySetting,ProjectBoard) values ('$AdminUserID','$ComicID', $NewID,'".$Comictitle." General','General Discussion board for the project ".$Comictitle."',1,'$Date','public',1)";
		$InitDB->execute($query);
			//print $query.'<br/><br/>';
		$CreatedDate = $Date;
		$query ="SELECT ID from pf_forum_boards WHERE CreatedDate='$Date' and UserID='$AdminUserID'";
		$NewID = $InitDB->queryUniqueValue($query);
		$Encryptid = substr(md5($NewID), 0, 12).dechex($NewID);
				//print $query.'<br/><br/>';
		$query = "UPDATE pf_forum_boards set EncryptID='$Encryptid' where ID='$NewID'";
		$InitDB->execute($query);
		//	print $query.'<br/><br/>';
		$query = "SELECT * from users where encryptid ='$AdminUserID'";
		$CreatorArray = $InitDB->queryUniqueObject($query);
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
		
		$query = "INSERT into pf_themes (Title,UserID,TemplateCode,CreatedDate, IsPublic, TemplateHTML, CategoryID, Description, Tags) values ('$Comictitle','".$_SESSION['userid']."','$Template','$CreatedDate',0,'$HTMLCode',2,'$Description', '$Tags')";
			//print $query.'<br/><br/>';
			$InitDB->execute($query);
			$query ="SELECT ID from pf_themes where CreatedDate='$CreatedDate' and UserID='$UserID'";
			$ThemeID = $InitDB->queryUniqueValue($query);
//print $query.'<br/><br/>';
			$query ="SELECT ID from template_skins WHERE ID=(SELECT MAX(ID) FROM template_skins)";
			$MaxID = $InitDB->queryUniqueValue($query);
			//print $query.'<br/><br/>';
			$query = "SELECT * from templates where TemplateCode='$Template'";
			$TemplateArray = $InitDB->queryUniqueObject($query);
		//	print $query.'<br/><br/>';
			@mkdir($_SERVER['DOCUMENT_ROOT'].'/themes/'.$ThemeID);
			@chmod($_SERVER['DOCUMENT_ROOT'].'/themes/'.$ThemeID,0777);
			@mkdir($_SERVER['DOCUMENT_ROOT'].'/themes/'.$ThemeID.'/images');
			@chmod($_SERVER['DOCUMENT_ROOT'].'/themes/'.$ThemeID.'/images',0777);
			$query = "INSERT into template_settings (ThemeID, ProjectID, TemplateCode, TemplateWidth, HeaderImage, HeaderBackground, HeaderBackgroundRepeat, HeaderWidth, HeaderHeight, HeaderContent, HeaderLink, HeaderRollover, HeaderAlign, HeaderVAlign, HeaderPadding, HeaderBackgroundImagePosition, MenuAlign, MenuVAlign, MenuPadding, MenuBackground, MenuBackgroundRepeat, MenuHeight, MenuWidth, MenuContent, MenuBackgroundImagePosition, ContentAlign, ContentVAlign, ContentPadding, ContentBackgroundImagePosition, ContentBackground,ContentBackgroundRepeat, ContentWidth, ContentHeight, ContentScroll, FooterAlign, FooterVAlign, FooterPadding, FooterBackgroundImagePosition, FooterImage, FooterBackground, FooterBackgroundRepeat, FooterWidth, FooterHeight, FooterContent) values ('$ThemeID','$ComicID','$Template',
			'".$TemplateArray->TemplateWidth."', '".$TemplateArray->HeaderImage."', '".$TemplateArray->HeaderBackground."',  '".$TemplateArray->HeaderBackgroundRepeat."', '".$TemplateArray->HeaderWidth."', '".$TemplateArray->HeaderHeight."','".$TemplateArray->HeaderContent."', '".$TemplateArray->HeaderLink."','".$TemplateArray->HeaderRollover."' ,'".$TemplateArray->HeaderAlign."' , '".$TemplateArray->HeaderVAlign."', '".$TemplateArray->HeaderPadding."', '".$TemplateArray->HeaderBackgroundImagePosition."', '".$TemplateArray->MenuAlign."', '".$TemplateArray->MenuVAlign."', '".$TemplateArray->MenuPadding."', '".$TemplateArray->MenuBackground."','".$TemplateArray->MenuBackgroundRepeat."' , '".$TemplateArray->MenuHeight."', '".$TemplateArray->MenuWidth."', '".$TemplateArray->MenuContent."', '".$TemplateArray->MenuBackgroundImagePosition."', '".$TemplateArray->ContentAlign."','".$TemplateArray->ContentVAlign."' , '".$TemplateArray->ContentPadding."', '".$TemplateArray->ContentBackgroundImagePosition."',  '".$TemplateArray->ContentBackground."','".$TemplateArray->ContentBackgroundRepeat."','".$TemplateArray->ContentWidth."' ,'".$TemplateArray->ContentHeight."' , '".$TemplateArray->ContentScroll."', '".$TemplateArray->FooterAlign."',  '".$TemplateArray->FooterVAlign."', '".$TemplateArray->FooterPadding."' ,'".$TemplateArray->FooterBackgroundImagePosition."'  , '".$TemplateArray->FooterImage."' , '".$TemplateArray->FooterBackground."' , '".$TemplateArray->FooterBackgroundRepeat."',  '".$TemplateArray->FooterWidth."', '".$TemplateArray->FooterHeight."', '".$TemplateArray->FooterContent."')";
			$InitDB->execute($query);
		//		print $query.'<br/><br/>';
			$query = "INSERT into template_settings_locks (ThemeID, TemplateCode) values ('$ThemeID','$Template')";
			$InitDB->execute($query);
			//print $query.'<br/><br/>';
			if ($MaxID > 9) {
				if ($MaxID > 99) {
					if ($MaxID > 999) {
						if ($MaxID > 9999) {
							if ($MaxID > 99999) {
								if ($MaxID > 999999) {
									echo 'Not Able To Add Skin Too Many IDS';
								} else {
									$NewSkinCode = 'PFSK-'.($MaxID+1);
								}
							} else {
								$NewSkinCode = 'PFSK-0'.($MaxID+1);
							}
						} else {
							$NewSkinCode = 'PFSK-00'.($MaxID+1);
						}
					} else {
						$NewSkinCode = 'PFSK-000'.($MaxID+1);
						//print 'NewSkinCode' .$NewSkinCode;
					}
				} else {
					$NewSkinCode = 'PFSK-0000'.($MaxID+1);
					//print 'NewSkinCode' .$NewSkinCode;
				}
			} else {
			
				$NewSkinCode = 'PFSK-00000'.($MaxID+1);
				//print 'NewSkinCode' .$NewSkinCode;
			}
			

		
			@mkdir($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode);
			//print 'DIRECTORY = ' . $_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode;
			@chmod($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode,0777);
			@mkdir($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode.'/images');
			@chmod($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode.'/images',0777);
			
			$query ="UPDATE pf_themes set SkinCode='$NewSkinCode',ProjectTheme='1' where ID='$ThemeID'";
			$InitDB->execute($query);
			$output .= $query.'<br/><br/>';
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
				//$output .= $query.'<br/><br/>';
				$new_id = mysql_insert_id();
				$query = "UPDATE template_skins set Title='".mysql_escape_string($_POST['txtTitle'])."', Description='".mysql_escape_string($_POST['txtDescription'])."',SkinCode='$NewSkinCode', UserID='".$_SESSION['userid']."', ThemeID='$ThemeID' WHERE ID='$new_id'";
				$InitDB->execute($query);
				$output .= $query.'<br/><br/>';
				$dirsource = $_SERVER['DOCUMENT_ROOT'].'/templates/skins/PFSK-00001';
				$dirdest = $_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode;
				COPY_RECURSIVE_DIRS($dirsource, $dirdest);

				$query ="SELECT ID from project_skins WHERE ID=(SELECT MAX(ID) FROM project_skins)";
				$MaxID = $InitDB->queryUniqueValue($query);
				$output .= $query.'<br/><br/>';
				$output .= $MaxID.'<br/><br/>';
				if ($MaxID > 9) {
				if ($MaxID > 99) {
					if ($MaxID > 999) {
						if ($MaxID > 9999) {
							if ($MaxID > 99999) {
								if ($MaxID > 999999) {
									echo 'Not Able To Add Skin Too Many IDS';
								} else {
									$NewSkinCode = 'PFPSK-'.($MaxID+1);
								}
							} else {
								$NewSkinCode = 'PFPSK-0'.($MaxID+1);
							}
						} else {
							$NewSkinCode = 'PFPSK-00'.($MaxID+1);
						}
					} else {
						$NewSkinCode = 'PFPSK-000'.($MaxID+1);
						//print 'NewSkinCode' .$NewSkinCode;
					}
				} else {
					$NewSkinCode = 'PFPSK-0000'.($MaxID+1);
					//print 'NewSkinCode' .$NewSkinCode;
				}
			} else {
			
				$NewSkinCode = 'PFPSK-00000'.($MaxID+1);
				//print 'NewSkinCode' .$NewSkinCode;
			}
				$query = "INSERT into creators (avatar, realname, location, about, website, music, books, hobbies, influences, credits, link1, link2, link3, link4, ComicID, Email) values ('$Avatar', '$CreatorName','$Location','$Bio','$Website','$Music', '$Books','$Hobbies','$Influences','$Credits','$Link1','$Link2','$Link3','$Link4','$ComicID','$AdminEmail')";
				$InitDB->query($query);
				
				$query = "INSERT into comic_settings (ComicID, Contact, AllowComments, ShowArchive, ShowChapter, ShowEpisode, ShowCalendar, BioSetting, Template,ReaderType,ComicFormat,UpdateSchedule, Skin,SubCategory, CurrentTheme,ProjectID,MenuOneCustom) values ('$ComicID', 1,1,1,1,1,1,1,'$Template','html','$SubCategory','$UpdateSchedule','$NewSkinCode','$SubCategory','$ThemeID','$ComicID','1')";
				$output .= $query.'<br/><br/>';
				$InitDB->query($query);
	
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
				$output .= $query.'<br/><br/>';
				$new_id = mysql_insert_id();
				$query = "UPDATE project_skins set Title='$Comictitle', SkinCode='$NewSkinCode', UserID='".$_SESSION['userid']."' WHERE ID='$new_id'";
				$InitDB->execute($query);
					$output .= $query.'<br/><br/>';
				$dirsource = $_SERVER['DOCUMENT_ROOT']."/templates/skins/PFSK-00001";
				$dirdest = $_SERVER['DOCUMENT_ROOT']."/templates/skins/".$NewSkinCode;
				COPY_RECURSIVE_DIRS($dirsource, $dirdest);
				//mkdir('../templates/skins/'.$NewSkinCode);
				//chmod('../templates/skins/'.$NewSkinCode,0777);
				//mkdir('../templates/skins/'.$NewSkinCode.'/images');
				//chmod('../templates/skins/'.$NewSkinCode.'/images',0777);
		
			
				$query = "INSERT INTO pf_modules 
				                    (Title, ModuleCode, ComicID, Homepage, Position, Placement, ReaderPosition, ReaderPlacement, ReaderMod, IsPublished,EncryptID,CustomVar1) VALUES 
									('Author Comment', 'authcom', '$ComicID',0,1,'', 1, 'left', 1,1,'".$ComicID."-auth','$SafeFolder'),
									('Page Comments', 'pagecom', '$ComicID',0,1,'', 2, 'left', 1,1,'".$ComicID."-pagecom','$SafeFolder'),
									('Comment Form', 'comform', '$ComicID',0,1,'', 3, 'left',1, 1,'".$ComicID."-comform','$SafeFolder'),
									('Latest Page', 'latestpage', '$ComicID',1,1,'left',1, '', 0,1,'".$ComicID."-latest','$SafeFolder'),
									('Credits', 'credits', '$ComicID',1,3,'right',1, '', 0,1,'".$ComicID."-latest','$SafeFolder'),
									('Synopsis', 'synopsis', '$ComicID',1,2,'right',1,'', 0,1,'".$ComicID."-synopsis','$SafeFolder')";
				
				$InitDB->query($query);
				//print $query.'<br/><br/>';
				//$query = "INSERT INTO pf_modules (Title, ModuleCode, ComicID, Position, Placement, IsPublished,Homepage) VALUES ('Comic Credits', 'credits', '$ComicID', 1, 'left',0, 1),('Synopsis', 'synopsis', '$ComicID', 1, 'right', 0,1),('Latest Page', 'synopsis', '$ComicID', 1, 'right', 0,1)";
				
				if (($ProjectType == 'comic')|| ($ProjectType == 'writing')) {
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Episodes', '$ComicID', '".$_SESSION['userid']."', 0, 'tabbed', '$CreatedDate','episodes')";
					$InitDB->query($query);
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Links', '$ComicID', '".$_SESSION['userid']."', 0, 'list', '$CreatedDate','links')";
					$InitDB->query($query);
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Reader', '$ComicID', '".$_SESSION['userid']."', 0, 'list', '$CreatedDate','reader')";
					$InitDB->query($query);
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Credits', '$ComicID', '".$_SESSION['userid']."', 0, 'tabbed', '$CreatedDate','credits')";
					$InitDB->query($query);
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Home', '$ComicID', '".$_SESSION['userid']."', 0, 'reader', '$CreatedDate','home')";
					$InitDB->query($query);
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Archives', '$ComicID', '".$_SESSION['userid']."', 0, 'thumb_list', '$CreatedDate','archives')";
					$InitDB->query($query);
				}
				
				if ($ProjectType == 'portfolio') {
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Gallery', '$ComicID', '".$_SESSION['userid']."', 0, 'lightbox', '$CreatedDate','gallery')";
					$InitDB->query($query);
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Home', '$ComicID', '".$_SESSION['userid']."', 0, 'gallery', '$CreatedDate','home')";
					$InitDB->query($query);
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Links', '$ComicID', '".$_SESSION['userid']."', 0, 'list', '$CreatedDate','links')";
					$InitDB->query($query);

				}
				if ($ProjectType == 'blog') {
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Blog', '$ComicID', '".$_SESSION['userid']."', 0, '2_column', '$CreatedDate','blog')";
					$InitDB->query($query);
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Home', '$ComicID', '".$_SESSION['userid']."', 0, 'blog', '$CreatedDate','home')";
					$InitDB->query($query);
					$query = "INSERT into content_section  (Title, ProjectID, UserID, IsCustom, Template, CreatedDate, TemplateSection) values ('Links', '$ComicID', '".$_SESSION['userid']."', 0, 'list', '$CreatedDate','links')";
					$InitDB->query($query);
				
				
				}
				
			//print $query.'<br/><br/>';
		//$TemplateAds = explode(',',$AdSpaces); 
		//foreach ($TemplateAds as $AdPosition) {
				// $query = "INSERT into adspaces (ComicID, Template, Position, Active) values ('$ComicID','$Template','$AdPosition',1)";
				// print $query."<br/>";
				//$InitDB->query($query);
		//}
		//print 'AD CREATING --- FROM TEMPLATE = ' . $AdSpaces."<br/>";
			
		//$ConnectKey = createKey();
		//$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
		//$InitDB->query($query);
		//$post_data = array('u' => $_SESSION['userid'],'l'=> $_POST['comicfolder'], 'c' => $ComicID, 'k' => $ConnectKey);
		//$updateresult = $curl->send_post_data($ApplicationLink."/connectors/install_comic.php", $post_data);
		//if ($_SESSION['username'] == 'matteblack')
			//print $output;
			//echo 'CREATION RESULT = -----------------<br/> ' .$updateresult;
		//unset($post_data);
			$ComicCreated = 1;
			$TitleSafe = 1;
		insertUpdate($Format, 'created', $ComicID, 'project', $_SESSION['userid'],'http://'.$_SERVER['SERVER_NAME'].'/'.$SafeFolder.'/',$ComicID,'',$Comictitle);


 
	
} 
?>
 <link type="text/css" rel="stylesheet" href="http://www.wevolt.com/css/pf_css_new.css" />
 <link type="text/css" rel="stylesheet" href="http://www.wevolt.com/<? echo $_SESSION['pfdirectory'];?>/css/cms_css.css" />
 <table width="100%" cellspacing="3">
                         <tr><td></td><td colspan="2"><table width="720" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="blue_cmsBox_TL"></td>
										<td id="blue_cmsBox_T"></td>
										<td id="blue_cmsBox_TR"></td></tr>
										<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
										<td class="blue_cmsboxcontent" valign="top" width="704" align="left">
                                        <div style="float:left"><? if (($TitleSafe == 1)&& ($ComicCreated == 1)) echo 'Create Project Thumbnail;'; else echo 'Create new Project';?></div><div style="float:right;"><? if (($TitleSafe == 1)&& ($ComicCreated == 1)) echo 'select a thumbnail to use for your project'; else echo 'start a new project on WEvolt.';?></div>
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table><div class="spacer"></div></td></tr>
                         <tr><td valign="top" align="left">  
                         <? if ($TitleSafe != 1) {?>      
                         <img src="http://www.wevolt.com/images/next_thumbnail.png" border="0" onclick="finish();" class="navbuttons"/>       
                         <? }?>
                        </td>
                        
                        
                        <td valign="top">
                        
<? 
if ((!isset($_POST['appset'])) && (!$LocalHost)) {
   include 'includes/app_select_form_inc.php';
} else if (!isset($_POST['txtTitle'])) {
	if ($_SESSION['username'] == 'matteblack')
	include 'includes/comic_form_inc_2.php';
	else
	 include 'includes/comic_form_inc_2.php';
} else if ($_POST['txtTitle'] == "") {
	echo "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>You must enter the Comic Title</div></b>";
     include 'includes/comic_form_inc_2.php';
} else if (($TitleSafe == 1)&& ($ComicCreated == 1)) {
   	  include 'includes/crop_form_inc.php';
} else if ($TitleSafe == 0) {
   	   include 'includes/comic_form_inc_2.php';
}
	
?>
   </td>
                        
                        </tr>
                        </table>
