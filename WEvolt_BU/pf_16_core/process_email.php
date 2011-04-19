<?php 
$includespath = "/var/www/vhosts/panelflow.com/httpdocs/pf_16_core/includes/";
$includes = dirname($includespath);
$attachmentsspath = "/var/www/vhosts/panelflow.com/httpdocs/email/attachments/";
$attachments = dirname($attachmentsspath);

include $includes.'/includes/init.php';
include $includes.'/includes/connect_functions.php';
include $includes.'/includes/image_resizer.php';
include $includes.'/includes/image_functions.php';
$pagedb = new DB($db_database,$db_host, $db_user, $db_pass);
$db2 = new DB($db_database,$db_host, $db_user, $db_pass);
$query = 'SELECT * from panel_email.emailtodb_email as re 
		  join panel_panel.users as u on re.EmailFrom=u.email
		   join panel_email.emailtodb_attach as a on a.IDEmail=re.ID
		  where re.Status=0';
$db2->query($query);
echo $query;
$output = '';
$output .=  $query."<br/><br/>";
while ($mail = $db2->fetchNextObject()) { 	
		$MailSubject = $mail->Subject;
		$EmailID = $mail->IDEmail;
		$Comment = mysql_real_escape_string($mail->Message);
		$SubjectNameArray = explode('||',$MailSubject);
		$output .=  'MailSubject = ' . $MailSubject."<br/>";
		$ComicName = trim($SubjectNameArray[0]);
		$output .=  'ComicName = ' . $ComicName."<br/>";
		$Datelive = trim($SubjectNameArray[1]);
		$output .=  'DateLive = ' . $DateLive."<br/>";
		//$DateLive = trim($SubjectNameArray[1]);
		$UserID = $mail->encryptid;
		if ($Datelive == '') {
			$Datelive = date("m-d-Y"); 
				echo 'DATE LIVE = '. $DateLive."<br/>";
		}
		$Filename = $mail->Filename;
		$output .=  'MY FILENAME = ' . $Filename .'\n\r';
		$NewNameArray = explode('/var/www/vhosts/panelflow.com/httpdocs/email/attachments/',trim($Filename));
		$output .=  'Namearray 0 = ' . $NewNameArray[1].'\n\r';
		$FilePathSplit = explode('/',$NewNameArray[1]);
		$Filename = $FilePathSplit[1];
		$output .=  'MY FILENAME = ' . $Filename .'\n\r';
		$Targetpath = $FilePathSplit[0];
		$output .=  'MY Targetpath = ' . $Targetpath .'\n\r';
		$Source_dir = '../email/attachments/'.$Targetpath.'/';
		$query = "SELECT * from comics where title='$ComicName' and (userid='$UserID' or CreatorID='$UserID')";	
		$ComicArray = $pagedb->queryUniqueObject($query);
		$output .=  'SOURCE DIR = ' . $Source_dir."\n\r";
		$output .=  $query."\n\r";
		if ($ComicArray->comiccrypt != '') {
			$ComicID = $ComicArray->comiccrypt;
			$query = "SELECT * 
			FROM comics as c 
			JOIN comic_settings as cs on c.comiccrypt=cs.ComicID 
			JOIN template_skins as ts on ts.SkinCode=cs.Skin 
			JOIN Applications as a on c.AppInstallation=a.ID 
			WHERE c.comiccrypt='$ComicID'";
			echo $query."<br/>";
			$SettingArray= $pagedb->queryUniqueObject($query);
			$output .=  $query."<br/><br/>";
			$AppInstallID= $SettingArray->AppInstallation;
			$SkinCode= $SettingArray->Skin;
			$GlobalSiteWidth = $SettingArray->GlobalSiteWidth;
			$KeepWidth = $SettingArray->KeepWidth;
			$ApplicationLink = "http://".$SettingArray->Domain."/".$SettingArray->PFPath;
			$NewPageDate = substr($DateLive,6,4).'-'.substr($DateLive,0,2).'-'.substr($DateLive,3,2);
			$todays_date = date("Y-m-d"); 
			$Today = strtotime($todays_date); 
			$ComicFolder = $SettingArray->HostedUrl;
			$TestPageDate = strtotime($NewPageDate); 
							
			if ($TestPageDate <= $Today) {
				$AddPage = 1;
			} else {
				$AddPage = 0;
			}
			$Date = date('Y-m-d H:i:s'); 

			list($width,$height)=getimagesize($attachments.'/attachments/'.$Targetpath.'/'.$Filename);
			$originalimage = $Source_dir.$Filename;

			$ext = substr(strrchr($Filename, "."), 1);
// make the random file name
			$randName = md5(rand() * time());
//print 'MY FILE NAME = ' . $Filename."<br/>";
// and now we have the unique file name for the upload file
			$filePath = $Source_dir . $randName . '.' . $ext;
			$Filename = $randName . '.' . $ext;
			$Finalimage = $filePath;
//print 'MY FILE NAME = ' . $Finalimage."<br/>";

				$FinalPageImage = '../comics/'.$ComicFolder .'/images/pages/'.$Filename;
				$IphoneSmImage = '../comics/'.$ComicFolder .'/iphone/images/pages/320/'.$Filename;
				$IphoneLgImage = '../comics/'.$ComicFolder .'/iphone/images/pages/480/'.$Filename;

//print 'MY FINAL PAGE IMAGE = ' . $FinalPageImage."<br/>";
//print "MY FINAL " . $FinalPageImage."<br/>";
			if (($width > 1024) && ($KeepWidth == 0)){
				$convertString = "convert $originalimage -resize 1024 $Finalimage";
				exec($convertString);
				list($width,$height)=getimagesize($Finalimage);
			} else if (($KeepWidth == 1) && ($width > $GlobalSiteWidth)){
				$convertString = "convert $originalimage -resize $GlobalSiteWidth $Finalimage";
				exec($convertString);
				list($width,$height)=getimagesize($Finalimage);
			} else {
				copy($originalimage,$Finalimage);
				$ImageDimensions = $width.'x'.$height;
			}
			$ImageDimensions = $width.'x'.$height;
			copy($Finalimage,$FinalPageImage);
			chmod(FinalPageImage,0777);
			print 'FINAL PAGE IMAGE = ' . $FinalPageImage;
//Create Small Iphone Page
			$convertString = "convert $FinalPageImage -resize 320 $IphoneSmImage";
			exec($convertString);
			print 'STRING = ' .$convertString."<br/>";
//Create Large Iphone Page
			$convertString = "convert $FinalPageImage -resize 480 $IphoneLgImage";
			exec($convertString);
print 'STRING = ' .$convertString."<br/>"; 
			$image = new imageResizer($FinalPageImage);
			$Thumbsm = 'comics/'.$ComicFolder ."/images/pages/thumbs/".$randName . '_sm.' . $ext;
			$Thumbmd = 'comics/'.$ComicFolder ."/images/pages/thumbs/".$randName . '_md.' . $ext;
			$Thumblg = 'comics/'.$ComicFolder ."/images/pages/thumbs/".$randName . '_lg.' . $ext;
			unlink($originalimage);
			
			$image->resize(110, 70, 110, 70);
			$image->save('../'.$Thumbsm, JPG);
			chmod('../'.$Thumbsm,0777);
	
		$image->resize(150, 200, 150, 200);
			$image->save('../'.$Thumbmd, JPG);
			chmod('../'.$Thumbmd,0777);

			$convertString = "convert $Finalimage -resize 480 -quality 60 ../$Thumblg";
			exec($convertString);
			chmod('../'.$Thumblg,0777);
print 'STRING = ' .$convertString."<br/>";
			$query ="SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType='pages')";
				$NewPosition = $pagedb->queryUniqueValue($query);
				$NewPosition++;
				echo $query."<br/>";
		$output .=  $query."\n\r\n\r";
		$Title = 'Page '.$NewPosition;
				$query = "INSERT into comic_pages(ComicID, Title, Comment, Image, ImageDimensions, Datelive, ThumbSm, ThumbMd, ThumbLg, Filename, Position, UploadedBy, PageType) values ('$ComicID','$Title', '$Comment','$Filename','$ImageDimensions', '$Datelive','$Thumbsm','$Thumbmd','$Thumblg','$Filename', $NewPosition,'$UserID','pages')";
				echo $query."<br/>";
				$pagedb->execute($query);
				$output .=  $query."\n\r\n\r";
					if ($AddPage == 1) {
						$query ="SELECT pages from comics where comiccrypt='$ComicID'";
						$NumPages = $pagedb->queryUniqueValue($query);
						if (($NumPages == 0) ||($NumPages < 0)) {
							$NumPages = 1;
						} else {
							$NumPages++;
						}
						$Status = 'add';
						$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
						$pagedb->execute($query);
						$output .= $query."\n\r\n\r";
					}
					$query ="SELECT ID from comic_pages WHERE ComicID='$ComicID' and Position='$NewPosition' and PageType='pages'";
					$PageID = $pagedb->queryUniqueValue($query);
					$output .=  $query."\n\r\n\r";
					$Encryptid = substr(md5($PageID), 0, 8).dechex($PageID);
					$query = "UPDATE comic_pages SET EncryptPageID='$Encryptid' WHERE ID='$PageID'";
					$pagedb->query($query);	
					$output .=  $query."\n\r";
					$output .= 'PAGE CONNECT =  ' . sendPageConnect('pages', $Encryptid, 'add','',$Status, 'pages').'<br/><br/>';				
					
					require_once("includes/curl_http_client.php"); 
 					require_once("includes/create_key_func.php");
					$curl = &new Curl_HTTP_Client();
					$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
					$ConnectKey = createKey();
					$db =  new DB($db_database,$db_host, $db_user, $db_pass);
					$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='$UserID'";
					$db->query($query);
					$output .= '\n\r'.$query.'\n\r';
					$post_data = array('u' => $UserID, 'c' => $ComicID, 'k' => $ConnectKey,'s' => 'pages','p' => $Encryptid,'a' => 'add','f' => 'yes','t'=>'pages');
	//print_r($post_data);
	//echo ($curl->send_post_data($ApplicationLink."/connectors/import_pages.php", $post_data));
						
 					$output .= $curl->send_post_data($ApplicationLink."/connectors/import_pages.php", $post_data);
					$db->close();
					
					
						
		//$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey, 's' => $Section,'p' => $Encryptid,'a' => 'add','status' => $Status,'t'=>$PageType);
		//$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_pages.php", $post_data);
		} else {
			$output .= ' COMIC NOT FOUND !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';
		}

		$query = "UPDATE panel_email.emailtodb_email set Status=1 where ID='$EmailID'";
		$pagedb->query($query);
		echo $query."<br/>";
		$output .= $query."\n\r";
		echo $output;
}
//$Filename= date('Y_m_d_hh_mm_ss');
//$newfile="emaillogs/email_result_".$Filename.".txt";
//$file = fopen ($newfile, "w");
//echo 'FILE = ' . $newfile."<br/>";
//fwrite($file, $output);
//fclose ($file); 
//chmod($newfile,0777);
?>