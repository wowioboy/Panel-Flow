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
$PageID = $_POST['p'];
$Section = $_POST['s']; 
$Action = $_POST['a'];
$Change = $_POST['c'];
$File = $_POST['f']; 
$Sub = $_POST['sub']; 
$PageType = $_POST['t'];
$Status = $_POST['status'];  
if (($Section == 'extras') && ($_POST['t'] == '')) {
	$PageType = 'extras';  
} else if (($Section == 'pages') && ($_POST['t'] == '')) {
	$PageType = 'pages';   
} 
print 'MY PAGE TPYE = ' . $PageType .'<br/>';
$AdminEmail = $config['adminemail'];
$AdminUserID = $config['adminuserid']; 
$PFDIRECTORY = $config['pathtopf'];
$db_user = $config['db_user']; 
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];  
$key = $config['liscensekey'];
$settings = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comics where comiccrypt ='$ComicID'"; 

$ComicArray = $settings->queryUniqueObject($query); 
$ComicFolder = $ComicArray->url;
 $ComicDir = substr(trim($ComicFolder), 0, 1);
$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);

$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {
	$post_data = array('u' => $UserID, 'c' => $ComicID,'p' => $PageID, 'k' => $_POST['k'], 'l'=>$key,'sub' => $Sub,'t'=>$PageType);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_pages.php", $post_data);
	unset($post_data);
	echo '<br/>export_pages RESULT = ' . $updateresult.'<br/><br/>';
	if ($updateresult != 'Not Authorized') {
		$values = unserialize ($updateresult);
		$Title = mysql_real_escape_string($values['title']);  
		$Comment = mysql_real_escape_string($values['comment']);
		$Filename = $values['filename']; 
		$ImageDimensions = $values['imagedimensions'];  
		$Datelive = $values['datelive'];
		$PublishDate = $values['PublishDate'];
		$Thumbsm = $values['thumbsm'];
		$Thumbmd = $values['thumbmd'];
		$Thumblg = $values['thumblg'];
		$Chapter = $values['chapter'];
		$Episode = $values['episode'];
		$EpisodeDesc = mysql_real_escape_string($values['episodedesc']);
		$EpisodeWriter = mysql_real_escape_string($values['episodewriter']);
		$EpisodeArtist = mysql_real_escape_string($values['episodeartist']);
		$EpisodeColorist = mysql_real_escape_string($values['episodecolorist']);
		$EpisodeLetterer = mysql_real_escape_string($values['episodeletterer']);
		$ItemPosition = $values['position']; 
		$PageImage = $values['pageimage'];  
//GRAB SMALL THUMB 
//print "THUMBSM = " . $Thumbsm."<br/>";
	if ((($File == 'yes') || ($Action == 'add')|| ($PageType == 'script') || ($PageType == 'inks') || ($PageType == 'colors')|| ($PageType == 'pencils')) && ($Action != 'remove')) {
		$NameArray = explode('/',$Thumbsm);
	//	if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			//$NewThumbsm = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//} else {
			$LocalName = '../../'.$Thumbsm;
			$NewThumbsm = $Thumbsm;
		//}
		print 'MY LOCALNAME = ' . $LocalName.'<br/><br/>';
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumbsm)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		unset($NameArray);

//GRAB MEDIUM THUMB
		$NameArray = explode('/',$Thumbmd); 
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			//$NewThumbmd = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//} else {
			$LocalName = '../../'.$Thumbmd;
			$NewThumbmd = $Thumbmd;
		//}
		print 'MY LOCALNAME = ' . $LocalName.'<br/><br/>';
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumbmd)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		
		unset($NameArray);

//GRAB LARGE THUMB
		$NameArray = explode('/',$Thumblg);
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			//$NewThumblg = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//} else {
			$LocalName = '../../'.$Thumblg;
			$NewThumblg = $Thumblg;
		//}
		print 'MY LOCALNAME = ' . $LocalName.'<br/><br/>';
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumblg)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		 
		unset($NameArray); 
		
//GRAB PAGE
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
				//$LocalName = '../../images/pages/'.$Filename;
		//} else {
		$LocalName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$Filename;
		//} 
		 print 'MY LOCALNAME = ' . $LocalName.'<br/><br/>';
		$gif = file_get_contents('http://www.panelflow.com/'.trim($PageImage)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		
		if ($PageType == 'script') {
		$FileNameArray = explode('.',$Filename);
		$FileNoExt = $FileNameArray[0];
		$RemotePDF = 'http://www.panelflow.com/comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$FileNoExt.'.pdf';
		$RemoteHTML = 'http://www.panelflow.com/comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$FileNoExt.'.html';
		
		$LocalPdfName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$FileNoExt.'.pdf';
		$LocalHtmlName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$FileNoExt.'.html';
		//} 
		 print 'MY LOCALNAME = ' . $LocalPdfName.'<br/><br/>';
		$gif = file_get_contents($RemotePDF) or die('Could not grab the file');
		$fp  = fopen($LocalPdfName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalPdfName,0777);
		
		 print 'MY LOCALNAME = ' . $LocalHtmlName.'<br/><br/>';
		$gif = file_get_contents($RemoteHTML) or die('Could not grab the file');
		$fp  = fopen($LocalHtmlName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalHtmlName,0777);
				
		}
		
} 

if (($PageType == 'colors')|| ($PageType == 'pencils')||($PageType == 'inks')||($PageType == 'script')){
	if ($Action != 'remove') {
		$query = "SELECT * from comic_pages where ParentPage='$PageID' and PageType='$PageType'";
		$settings->query($query);
		$PageFound = $settings->numRows();
	
		if ($PageFound == 1) {
			$query = "UPDATE comic_pages set Image='$Filename',ImageDimensions='$ImageDimensions', ThumbSm='$NewThumbsm',ThumbMd='$NewThumbmd',ThumbLg='$NewThumblg', Filename='$Filename' where ParentPage='$PageID' and PageType='$PageType'";
			$settings->query($query);
			
		} else { 
				$query = "INSERT into comic_pages(ComicID, Image, ImageDimensions,ThumbSm, ThumbMd, ThumbLg, Filename, UploadedBy, PageType, ParentPage) values ('$ComicID','$Filename','$ImageDimensions', '$NewThumbsm','$NewThumbmd','$NewThumblg','$Filename','$UserID','$PageType','$PageID')";
				$settings->query($query);
				
		} 
	} else {
		if ($Action == 'remove') {
			$query = "DELETE from comic_pages where ParentPage='$PageID' and PageType='$PageType' and ComicID='$ComicID'";
			$settings->query($query);
		
		}
	}
}	
		
if ($Action == 'add') {
	if (($PageType != 'pencils') && ($PageType != 'inks') && ($PageType != 'colors') && ($PageType != 'script')) {
		$query = "INSERT into comic_pages(ComicID, Title, Comment, Image, ImageDimensions, Datelive, ThumbSm, ThumbMd, ThumbLg, Chapter, Episode, EpisodeDesc, EpisodeWriter,EpisodeArtist,EpisodeColorist,EpisodeLetterer,Filename, Position, UploadedBy,EncryptPageID, PageType, PublishDate) values ('$ComicID','$Title', '$Comment','$Filename','$ImageDimensions', '$Datelive','$NewThumbsm','$NewThumbmd','$NewThumblg',$Chapter,$Episode,'$EpisodeDesc','$EpisodeWriter','$EpisodeArtist','$EpisodeColorist','$EpisodeLetterer','$Filename',$ItemPosition,'$UserID','$PageID','$PageType','$PublishDate')";
		$settings->query($query);
		echo '<br/>'.$query.'<br/><br/>';
		if ($Status == 'add')  {
			if (($PageType != 'pencils') && ($PageType != 'inks') && ($PageType != 'colors') && ($PageType != 'script')) {
				$query ="SELECT pages from comics where comiccrypt='$ComicID'";
				$NumPages = $settings->queryUniqueValue($query);
				
				if (($NumPages == 0) ||($NumPages < 0)) {
					$NumPages = 1;
				} else {
					$NumPages++;
				} 
				$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
				$settings->query($query);
			}
		}
	}
} else if ($Action == 'edit') {

			if (($PageType != 'pencils') && ($PageType != 'inks') && ($PageType != 'colors') && ($PageType != 'script')) {
				if ($Status == 'remove') {
					$query ="SELECT pages from comics where ComicID='$ComicID' and PageType='pages'";
					$NumPages = $settings->queryUniqueValue($query);
					$NumPages--;
					$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
					$settings->query($query);	
				} else if ($Status == 'add'){
					$query ="SELECT pages from comics where comiccrypt='$ComicID' and PageType='pages'";
					$NumPages = $settings->queryUniqueValue($query);
					if (($NumPages == 0) ||($NumPages < 0))  {
						$NumPages = 1;
					} else { 
						$NumPages++; 
					}
					
					$query = "UPDATE comics SET pages='$NumPages',PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
					$settings->query($query);	
					
				}
					$query = "SELECT Position from comic_pages where EncryptPageID='$PageID'";
					$CurrentPosition = $settings->queryUniqueValue($query);
					$NewItemPosition = $ItemPosition;
					
					
					if ($NewItemPosition != $CurrentPosition) {
					$query = "SELECT * from comic_pages where ComicID='$ComicID' and PageType = 'pages' order by position";
					$settings->query($query);
					$TotalLinks = $settings->numRows();
					$query = "SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType = '$PageType')";
					$MaxPosition = $settings->queryUniqueValue($query);
						$CurrentOrder = array();
						if ($NewItemPosition < $CurrentPosition) {
							$query = "SELECT EncryptPageID, Position from comic_pages where ComicID='$ComicID' and PageType='$PageType' and Position BETWEEN '$NewItemPosition' and '$CurrentPosition' order by Position";
						} else {
							$query = "SELECT EncryptPageID, Position from comic_pages where ComicID='$ComicID' and PageType='$PageType' and Position BETWEEN '$CurrentPosition' and '$NewItemPosition' order by Position";
						}
						$settings->query($query);
						
						while ($line = $settings->fetchNextObject()) { 
							$CurrentOrder[] = $line->EncryptPageID; 
						}

						if ($NewItemPosition < $CurrentPosition) { 
							if ($CurrentPosition != 1) {
								$UpdatePosition = $CurrentPosition;
								for ( $counter =(sizeof($CurrentOrder)-1); $counter > 0; $counter--) {
		   		 						$SelectItemID = $CurrentOrder[$counter-1];
		   								$query = "UPDATE comic_pages set Position='$UpdatePosition' where EncryptPageID ='$SelectItemID'";
										$UpdatePosition--;
										$settings->query($query);
					
								}
							$query = "UPDATE comic_pages set Position='$NewItemPosition' where EncryptPageID='$PageID'";
							$settings->query($query);
							}	
						} else if ($NewItemPosition > $CurrentPosition) {
							$UpdatePosition = $CurrentPosition;
							if ($CurrentPosition != $TotalLinks) {
								for ($counter =0; $counter < (sizeof($CurrentOrder)-1); $counter++) {
		   	 						$SelectItemID = $CurrentOrder[$counter+1];
		   							$query = "UPDATE comic_pages set Position='$UpdatePosition' where EncryptPageID ='$SelectItemID'";
									$UpdatePosition++; 
									$settings->query($query);
								}
								$query = "UPDATE comic_pages set Position='$NewItemPosition' where EncryptPageID='$PageID'";
								$settings->query($query);
							}
						}
				}
			 
		if ($File == 'yes') {
				$query = "UPDATE comic_pages set ThumbSm='$NewThumbsm', ThumbMd='$NewThumbmd', ThumbLg='$NewThumblg', Filename='$Filename',Image='$Filename',ImageDimensions='$ImageDimensions' where EncryptPageID='$PageID'";
				$settings->query($query);	
				print '<br/>MY UPDATE QUESRY =='.$query.'<br/><br/>';
		}
		$query = "UPDATE comic_pages set Title='$Title', Comment='$Comment', Datelive='$Datelive', Chapter='$Chapter', Episode='$Episode',EpisodeDesc='$EpisodeDesc',EpisodeWriter='$EpisodeWriter',EpisodeArtist='$EpisodeArtist',EpisodeColorist='$EpisodeColorist',EpisodeLetterer='$EpisodeLetterer',PublishDate='$PublishDate' where EncryptPageID='$PageID'";
		$settings->query($query);
		echo '<br/>MY UPDATE QUESRY<br/><br>'.$query.'<br/><br/>';
	}

} else if ($Action == 'delete') {
		if (($PageType != 'pencils') && ($PageType != 'inks') && ($PageType != 'colors') && ($PageType != 'script')) {
			$query = "SELECT Position from comic_pages where EncryptPageID='$PageID'";
			$CurrentPosition = $settings->queryUniqueValue($query);
			$query = "SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType='$PageType')";
			$MaxPosition = $settings->queryUniqueValue($query);
			$query = "SELECT ID from comic_pages where ComicID='$ComicID' and PageType='$PageType' order by Position";
			$settings->query($query);
			$TotalLinks = $settings->numRows(); 
			$CurrentOrder = array();
			$query = "SELECT ID, Position from comic_pages where ComicID='$ComicID' and PageType='$PageType' and Position BETWEEN '$CurrentPosition' and '$MaxPosition' order by Position";
			$settings->query($query);	
			while ($line = $settings->fetchNextObject()) { 
				$CurrentOrder[] = $line->ID;
			} 
			$UpdatePosition = $CurrentPosition; 
			for ($counter =0; $counter < (sizeof($CurrentOrder)-1); $counter++) {
		   	 		$SelectItemID = $CurrentOrder[$counter+1];
		   			$query = "UPDATE comic_pages set Position='$UpdatePosition' where id ='$SelectItemID'";
					$UpdatePosition++; 
					$settings->query($query);
			}
			$query ="DELETE from comic_pages WHERE ComicID='$ComicID' and (EncryptPageID='$PageID' or ParentPage='$PageID')";
			$settings->query($query);	
			if ($Status == 'remove') {
				$query ="SELECT pages from comics where comiccrypt='$ComicID'";
				$NumPages = $settings->queryUniqueValue($query);
				$NumPages--;
				$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
				$settings->query($query);	
			}
			$query ="DELETE from pagecomments WHERE comicid='$ComicID' and pageid='$PageID'";
			$settings->query($query);
		} else {
			$query ="DELETE from comic_pages WHERE ComicID='$ComicID' and ParentPage='$PageID' and PageType='PageType'";
			$settings->query($query);	
		} 
}
$settings->close();
echo 'Finished';
} else {
	echo 'Not Authorized';
}
} else {
	echo 'Can\'t Complete Request';

} 
?>