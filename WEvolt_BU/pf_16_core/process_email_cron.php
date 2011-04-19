<?php 
$includespath = "/var/www/httpdocs/pf_16_core/includes/";
$includes = dirname($includespath);
$attachmentsspath = "/var/www/httpdocs/email/attachments/";
$attachments = dirname($attachmentsspath);

include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
//include $includespath.'/connect_functions.php';
include $includespath.'image_resizer.php';
include $includespath.'image_functions.php';
include $includespath.'email_functions.php';
$pagedb =new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$db2 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$query = 'SELECT * from panel_email.emailtodb_email as re 
		  join panel_panel.users as u on re.EmailFrom=u.email
		   join panel_email.emailtodb_attach as a on a.IDEmail=re.ID
		  where re.Status=0';
$db2->query($query);
//echo $query."\n\r\n\r";
$output = '';
$output .=  $query."\n\r";
while ($mail = $db2->fetchNextObject()) { 	
		$MailSubject = $mail->Subject;
		$EmailID = $mail->IDEmail;
		$Comment = mysql_real_escape_string($mail->Message);
		$SubjectNameArray = explode('||',$MailSubject);
		$NumOptions = sizeof($SubjectNameArray);
		$output .=  'MailSubject = ' . $MailSubject."\n\r";
		$PostCode = trim($SubjectNameArray[0]);
		$output .=  'PostCode = ' . $PostCode."\n\r";
		if ($NumOptions > 1) {
			$pos = strpos(trim($SubjectNameArray[1]),'/');
			$output .=  'TARGET = '.$SubjectNameArray[1].' and String Position = ' . $pos."\n\r";
			if ($pos === false) {
				$Title = mysql_real_escape_string($SubjectNameArray[1]);
				$output .=  'Title 1 options = ' . $Title."\n\r";
			} else if ($pos == 2) {
				$Datelive = trim($SubjectNameArray[1]);
				$output .=  'DateLive 1 options= ' . $Datelive."\n\r";
			} else {
				$Title = mysql_real_escape_string($SubjectNameArray[1]);
			}
			if ($NumOptions == 3) {
				$pos = strpos(trim($SubjectNameArray[2]),'/');
				$output .=  'TARGET = '.$SubjectNameArray[2].' and String Position = ' . $pos."\n\r";
				if ($pos === false) {
					$Title = mysql_real_escape_string($SubjectNameArray[2]);
					$output .=  'Title 3 options= ' . $Title."\n\r";
				} else if ($pos == 2) {
					$Datelive = trim($SubjectNameArray[2]);
					$output .=  'DateLive 3 options= ' . $Datelive."\n\r";
				} else {
					$Title = mysql_real_escape_string($SubjectNameArray[2]);
				}
			}
		}
	
		$UserID = $mail->encryptid;
		 
		if ($Datelive == '') {
			$Datelive = date("m-d-Y"); 
				$output .=  'DATE LIVE = '. $Datelive."\n\r\n\r";
				$PublishDate = date('Y-m-d 00:00:00');
		} else {
			$PublishDate = date('Y-m-d 00:00:00',strtotime($Datelive));	
			
		}
		
		
		
		$Filename = $mail->Filename;
		$output .=  'MY FILENAME = ' . $Filename .'\n\r';
		$NewNameArray = explode($attachmentsspath,trim($Filename));
		$output .=  'Namearray 0 = ' . $NewNameArray[1].'\n\r';
		$FilePathSplit = explode('/',$NewNameArray[1]);
		$Filename = $FilePathSplit[1];
		$output .=  'MY NEW FILENAME = ' . $Filename .'\n\r';
		$Targetpath = $FilePathSplit[0];
		$output .=  'MY Targetpath = ' . $Targetpath .'\n\r';
		$Source_dir = $attachmentsspath.$Targetpath.'/';
		$query = "SELECT cs.ComicID 
				   from comic_settings as cs
				  join projects as c on cs.ComicID=c.ProjectID
				  where (c.userid='$UserID' or c.CreatorID='$UserID') and cs.PostCode='$PostCode'";	
		$ComicID = $pagedb->queryUniqueValue($query);
		$output .=  'SOURCE DIR = ' . $Source_dir."\n\r";
		$output .=  $query."\n\r\n\r";
		
		
		if ($ComicID != '') {
			//$ComicID = $ComicArray->comiccrypt;
			$query = "SELECT * 
			FROM projects as c 
			JOIN comic_settings as cs on c.comiccrypt=cs.ComicID 
			WHERE c.ProjectID='$ComicID'";
		//	echo $query."\n\r\n\r";
			$SettingArray = $pagedb->queryUniqueObject($query);
			$NewPageDate = substr($DateLive,6,4).'-'.substr($DateLive,0,2).'-'.substr($DateLive,3,2);
			$todays_date = date("Y-m-d"); 
			$Today = strtotime($todays_date); 
			$ComicFolder = $SettingArray->HostedUrl;
			$TestPageDate = strtotime($NewPageDate);
			$ProjectDirectory = $SettingArray->ProjectDirectory;
			$ComicsPath =  '/var/www/httpdocs/'.$ProjectDirectory.'/'.$ComicFolder;
			$SeriesNum = 1;
			$query ="SELECT EpisodeNum from Episodes WHERE EpisodeNum=(SELECT MAX(EpisodeNum) FROM Episodes where ProjectID='$ComicID' and SeriesNum='$SeriesNum')";
			$EpisodeNum = $pagedb->queryUniqueValue($query);
			
			$Date = date('Y-m-d H:i:s'); 
			$AttachmentImage = $attachmentsspath.$Targetpath.'/'.$Filename;
			list($width,$height)=getimagesize($AttachmentImage);
			 $originalimage = $Source_dir.$Filename;
			
			 $ext = substr(strrchr($Filename, "."), 1);
// make the random file name
			 $randName = md5(rand() * time());
//print 'MY FILE NAME = ' . $Filename."<br/>";
// and now we have the unique file name for the upload file
			$filePath = $Source_dir . $randName . '.' . $ext;
			$Filename = $randName . '.' . $ext;
			 $Finalimage = $filePath;
			 $output .='MY originalimage= ' . $originalimage."\n\r\n\r";
				$output .='MY Finalimage= ' . $Finalimage."\n\r\n\r";
				

				$FinalPageImage = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$Filename;
				$FinalPageImagePro = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/images/pages/pro/'.$Filename;
				$IphoneSmImage = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/iphone/images/pages/320/'.$Filename;
				$IphoneLgImage = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/iphone/images/pages/480/'.$Filename;
				
				if ($width > 1000) {
						$convertString = "convert $originalimage -resize 1000 $FinalPageImagePro";
						@exec($convertString);
						@chmod($FinalPageImagePro, 0777);
						$FinalPageImagePro = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/pro/'.$Filename;
				} else if ($width > 800) {
						copy($originalimage,$FinalPageImagePro);
						@chmod($FinalPageImagePro, 0777);
						$FinalPageImagePro =  $ProjectDirectory.'/'.$ComicFolder .'/images/pages/pro/'.$Filename;
				} else if ($width <= 800) {
						$FinalPageImagePro = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$Filename;
				}
				
				if ($width > 800) {
					$convertString = "convert $originalimage -resize 800 $FinalPageImage";
					exec($convertString);
					@chmod($FinalPageImage, 0777);
				} else {
					copy($originalimage,$FinalPageImage);
					@chmod($FinalPageImage, 0777);
				}
				@unlink($originalimage);			
				list($width,$height)=getimagesize($FinalPageImage);
				$ImageDimensions = $width.'x'.$height;	
						
				//CREATE IPHONE IMAGES							
				$convertString = "convert $FinalPageImage -resize 320 $IphoneSmImage";
				exec($convertString);
				$convertString = "convert $FinalPageImage -resize 480 $IphoneLgImage";
				exec($convertString);
				chmod($IphoneLgImage,0777);
				chmod($IphoneSmImage,0777);
						
				//CREATE THUMBS
				$image = new imageResizer($FinalPageImage);
				$Thumbsm = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/thumbs/'.$randName . '_sm.' . $ext;
				$Thumbmd = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/thumbs/'.$randName . '_md.' . $ext;
				$Thumblg = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/thumbs/'.$randName . '_lg.' . $ext;
				$image->resize(110, 70, 110, 70);
				$image->save( $_SERVER['DOCUMENT_ROOT'].'/'.$Thumbsm, JPG);
				chmod($_SERVER['DOCUMENT_ROOT'].'/'.$Thumbsm,0777);
				$convertString = "convert $FinalPageImage -resize 200 -quality 60  ".$_SERVER['DOCUMENT_ROOT']."/".$Thumbmd;
				exec($convertString);
				chmod($_SERVER['DOCUMENT_ROOT'].'/'.$Thumbmd,0777);
				$convertString = "convert $FinalPageImage -resize 480 -quality 60  ".$_SERVER['DOCUMENT_ROOT']."/".$Thumblg;
				exec($convertString);
				chmod($_SERVER['DOCUMENT_ROOT'].'/'.$Thumblg,0777);
				
				$query ="SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType='pages')";
				$NewPosition = $pagedb->queryUniqueValue($query);
				$NewPosition++;
				//echo $query."\n\r\n\r";
				$output .=  $query."\n\r\n\r";
				if ($Title == '') 
				$Title = 'Page '.$NewPosition;
				$query ="SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType='$PageType' and SeriesNum='$SeriesNum')";
				$NewPosition = $pagedb->queryUniqueValue($query);
				$NewPosition++;
				
				$Output .= $query.'<br/>';
				$query ="SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='$ComicID' and PageType='$PageType' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum')";
				$NewEpPosition = $pagedb->queryUniqueValue($query);
				$NewEpPosition++;
				$output .= $query.'<br/>';
				$EpisodeWriter = mysql_escape_string($_POST['txtEpisodeWriter']);
				$EpisodeArtist = mysql_escape_string($_POST['txtEpisodeArtist']);
				$EpisodeColorist = mysql_escape_string($_POST['txtEpisodeColorist']);
				$EpisodeLetterer = mysql_escape_string($_POST['txtEpisodeLetterer']);
				
				//CHECK FOR EPISODES
				$query ="SELECT EpisodeNum from Episodes WHERE EpisodeNum=(SELECT MAX(EpisodeNum) FROM Episodes where ProjectID='$ComicID' and SeriesNum='$SeriesNum')";
				$LastEpisode = $pagedb->queryUniqueValue($query);
				$NewEpisode = ($LastEpisode + 1);
				$output .= $query.'<br/>';
				
			 
				if ($EpisodeNum == '')
					$EpisodeNum = $LastEpisode;
					$query = "INSERT into comic_pages(ComicID, Title, Comment, Image, ImageDimensions, Datelive, ThumbSm, ThumbMd, ThumbLg, Chapter, Episode, EpisodeDesc,EpisodeWriter,EpisodeArtist,EpisodeColorist,EpisodeLetterer, Filename, Position, UploadedBy, PageType,PublishDate, EpisodeNum,ProImage, FileType,HTMLFile,Pdffile,ViewType,AllowPdf, SeriesNum,EpPosition) values ('$ComicID','$Title', '$Comment','$Filename','$ImageDimensions', '$Datelive','$Thumbsm','$Thumbmd','$Thumblg',$Chapter,$EpisodeNum, '$EpisodeDesc', '$EpisodeWriter','$EpisodeArtist','$EpisodeColorist','$EpisodeLetterer','$Filename', $NewPosition,'$UserID','$PageType','$PublishDate','$EpisodeNum','$FinalPageImagePro','$ext','$HTMLFile','$ScriptPDFFile','$ViewType','$AllowPdf', '$SeriesNum','$NewEpPosition')";
					$pagedb->execute($query);
				$output .= $query.'<br/>';
				if ($Section == 'pages') {
					$CurrentDate = date('Y-m-d'). ' 00:00:00';
					$query ="SELECT count(*) from comic_pages where ComicID='$ComicID' and PageType='pages' and PublishDate<='$CurrentDate'";
					$NumPages = $pagedb->queryUniqueValue($query);
					$Status = 'add';
					$query = "UPDATE projects SET pages='$NumPages',PagesUpdated='$Date' WHERE ProjectID='$ComicID'";
					$output .= $query.'<br/>';
					$pagedb->execute($query);			
				}	
				$query ="SELECT ID from comic_pages WHERE ComicID='$ComicID' and EpPosition='$NewEpPosition' and PageType='$PageType' and EpisodeNum='$EpisodeNum' and SeriesNum='$SeriesNum'";
				$PageID = $pagedb->queryUniqueValue($query);
				$output .= $query.'<br/>';
				$Encryptid = substr(md5($PageID), 0, 8).dechex($PageID);
				$query = "UPDATE comic_pages SET EncryptPageID='$Encryptid' WHERE ID='$PageID'";
				$pagedb->query($query);
				$output .= $query.'<br/>';
				sendPageConnect($Section, $Encryptid, 'add','',$Status,$PageType);
				$query = "SELECT * from comic_pages where ComicID='$ComicID' and PageType='$PageType' and SeriesNum='$SeriesNum' order by SeriesNum, EpisodeNum, EpPosition";
				$pagedb->query($query);
				$ResetPos = 1;
				while ($line = $pagedb->fetchNextObject()) {
						$SPageID = $line->EncryptPageID;
						$query = "update comic_pages set Position='$ResetPos' where ComicID='$ComicID' and EncryptPageID='$SPageID' and SeriesNum='$SeriesNum'";
						$pagedb->execute($query);
						$output .= $query.'<br/>';
						$ResetPos++;
				}
		
				$output .= $query."\n\r\n\r";
					//$output .= 'PAGE CONNECT =  ' . sendPageConnect('pages', $Encryptid, 'add','',$Status, 'pages').'<br/><br/>';				
					
					
					$db->close();
					$output .= '\n\r\n\r';
					
						
		//$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey, 's' => $Section,'p' => $Encryptid,'a' => 'add','status' => $Status,'t'=>$PageType);
		//$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_pages.php", $post_data);
		} else {
			$output .= ' COMIC NOT FOUND !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';
		}

		$query = "UPDATE panel_email.emailtodb_email set Status=1 where ID='$EmailID'";
		$pagedb->execute($query);
		SendPageReport($MailSubject,$ComicID);
		//echo $query."\n\r\n\r";
		$output .= $query."\n\r";
		//echo $output."\n\r\n\r";
			@unlink($originalimage);
			@unlink($AttachmentImage);
			@unlink($Finalimage);
}
$Filename= date('Y_m_d_h_m_s');
$newfile="/var/www/httpdocs/pf_16_core/emaillogs/email_result_".$Filename.".txt";
$file = fopen ($newfile, "w");
$output .= 'FILE = ' . $newfile."\n\r\n\r";
fwrite($file, $output);
fclose ($file); 
chmod($newfile,0777);
?>