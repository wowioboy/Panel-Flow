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
$Status = $_POST['status'];
if ($Section == 'extras') {
	$DbTable = 'extra_pages';
} else {
	$DbTable = 'comic_pages';
}
//print "MY COMIC ID + " . $ComicID."<br/>";
//print "MY UserID ID + " . $UserID."<br/>";
//print "MY PageID ID + " . $PageID."<br/>";
//print "MY Section ID + " . $Section."<br/>";
//print "MY Action ID + " . $Action."<br/>";
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
//print $query."<br/>";
//print "USER = " . $UserID."<br/>";
$ComicArray = $settings->queryUniqueObject($query);
$ComicFolder = $ComicArray->url;
//print "MY COMIC FOLDER = " . $ComicFolder."<br/>";
//print "admin = " . $ComicArray->userid."<br/>";
//print "creator = " . $ComicArray->CreatorID."<br/>";
$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);
$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray)) {
	$post_data = array('u' => $UserID, 'c' => $ComicID,'p' => $PageID, 'k' => $_POST['k'], 'l'=>$key,'sub' => $Sub);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_pages.php", $post_data);
	unset($post_data);
	$values = unserialize ($updateresult);
		$Title = $values['title'];
		$Comment = $values['comment'];
		$Filename = $values['filename'];
		$ImageDimensions = $values['imagedimensions'];
		$Datelive = $values['datelive'];
		$Thumbsm = $values['thumbsm'];
		$Thumbmd = $values['thumbmd'];
		$Thumblg = $values['thumblg'];
		$Chapter = $values['chapter'];
		$Episode = $values['episode'];
		$NewPosition = $values['position']; 
		$PageImage = $values['pageimage'];   
//print "MY UPDATE RESULT = " . $updateresult."<br/><br/>";
//GRAB SMALL THUMB 
//print "THUMBSM = " . $Thumbsm."<br/>";
	if (($File == 'yes') || ($Action == 'add')) {
		$NameArray = explode('/',$Thumbsm);
		if (($ComicFolder == '') || ($ComicFolder == '/')) {
			$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			$NewThumbsm = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		} else {
			$LocalName = '../../'.$ComicFolder.'/'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			$NewThumbsm = $ComicFolder.'/'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		}
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumbsm)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		unset($NameArray);

//GRAB MEDIUM THUMB
		$NameArray = explode('/',$Thumbmd);
		if (($ComicFolder == '') || ($ComicFolder == '/')) {
			$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			$NewThumbmd = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		} else {
			$LocalName = '../../'.$ComicFolder.'/'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			$NewThumbmd = $ComicFolder.'/'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		}
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumbsm)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		
		unset($NameArray);

//GRAB LARGE THUMB
		$NameArray = explode('/',$Thumblg);
		if (($ComicFolder == '') || ($ComicFolder == '/')) {
			$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			$NewThumblg = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		} else {
			$LocalName = '../../'.$ComicFolder.'/'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			$NewThumblg = $ComicFolder.'/'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		}
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumbsm)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		
		unset($NameArray); 
		
//GRAB PAGE
		if (($ComicFolder == '') || ($ComicFolder == '/')) {
			$LocalName = '../../images/pages/'.$Filename;
		} else {
			$LocalName = '../../'.$ComicFolder.'/images/pages/'.$Filename;
		}
		
		$gif = file_get_contents('http://www.panelflow.com/'.trim($PageImage)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
	} 
		
		
	if ($Action == 'add') {
		$query = "INSERT into comic_pages(ComicID, Title, Comment, Image, ImageDimensions, Datelive, ThumbSm, ThumbMd, ThumbLg, Chapter, Episode, Filename, Position, UploadedBy,EncryptPageID) values ('$ComicID','$Title', '$Comment','$Filename','$ImageDimensions', '$Datelive','$NewThumbsm','$NewThumbmd','$NewThumblg',$Chapter,$Episode,'$Filename',$ItemPosition,'$UserID','$PageID')";
			$settings->query($query);
			
			if ($Status == 'add') {
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
	} else if ($Action == 'edit') {
			if ($Section == 'pages') {
				$query = "UPDATE comic_pages set ThumbSm='$Thumbsm', ThumbMd='$Thumbmd', ThumbLg='$Thumblg', Filename='$Filename',Image='$Filename',ImageDimensions='$ImageDimensions' where EncryptPageID='$PageID'";
				$settings->query($query);	
				if ($Status == 'remove') {
					$query ="SELECT pages from comics where ComicID='$ComicID'";
					$NumPages = $settings->queryUniqueValue($query);
					$NumPages--;
					$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
					$settings->query($query);	
				} else if ($Status == 'add'){
					$query ="SELECT pages from comics where comiccrypt='$ComicID'";
					$NumPages = $settings->queryUniqueValue($query);
					if (($NumPages == 0) ||($NumPages < 0))  {
						$NumPages = 1;
					} else {
						$NumPages++;
					}
					$query = "UPDATE comics SET pages='$NumPages',PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
					$settings->query($query);			
				}
			} else {
				$query = "UPDATE extra_pages set ThumbSm='$Thumbsm', ThumbMd='$Thumbmd',ThumbLg='$Thumblg', Filename='$Filename',Image='$Filename',ImageDimensions='$ImageDimensions' where EncryptPageID='$PageID'";
			$settings->query($query);
			}
			
			if ($Section == 'pages') {
				$query = "SELECT * from comic_pages where ComicID='$ComicID' order by position";
			} else {
				$query = "SELECT * from extra_pages where ComicID='$ComicID' order by position";
			}
			$settings->query($query);
			$TotalLinks = $settings->numRows();
	
			if ($Section == 'pages') {
				$query = "SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID')";
			} else {
				$query = "SELECT Position from extra_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID')";
			}
			$MaxPosition = $settings->queryUniqueValue($query);
			$NewItemPosition = $ItemPosition;
			if ($Section == 'pages') {
				$query = "SELECT Position from comic_pages where EncryptPageID='$PageID'";
			} else {
				$query = "SELECT Position from extra_pages where EncryptPageID='$PageID'";
			}
			$CurrentPosition = $settings->queryUniqueValue($query);

			if ($NewItemPosition != $CurrentPosition) {
				$CurrentOrder = array();
				if ($NewItemPosition < $CurrentPosition) {
					$query = "SELECT EncryptPageID, Position from $DbTable where ComicID='$ComicID' and Position BETWEEN '$NewItemPosition' and '$CurrentPosition' order by Position";
				} else {
					$query = "SELECT EncryptPageID, Position from $DbTable where ComicID='$ComicID' and Position BETWEEN '$CurrentPosition' and '$NewItemPosition' order by Position";
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
		   						$query = "UPDATE $DbTable set Position='$UpdatePosition' where EncryptPageID ='$SelectItemID'";
								$UpdatePosition--;
								$settings->query($query);
					
						}
					$query = "UPDATE $DbTable set Position='$NewItemPosition' where EncryptPageID='$PageID'";
					$settings->query($query);
					}	
				} else if ($NewItemPosition > $CurrentPosition) {
					$UpdatePosition = $CurrentPosition;
					if ($CurrentPosition != $TotalLinks) {
						for ($counter =0; $counter < (sizeof($CurrentOrder)-1); $counter++) {
		   	 				$SelectItemID = $CurrentOrder[$counter+1];
		   					$query = "UPDATE $DbTable set Position='$UpdatePosition' where EncryptPageID ='$SelectItemID'";
							$UpdatePosition++; 
							$settings->query($query);
						}
						$query = "UPDATE $DbTable set Position='$NewItemPosition' where EncryptPageID='$PageID'";
						$settings->query($query);
					}
				}
		}
		$query = "UPDATE $DbTable set Title='$Title', Comment='$Comment', Datelive='$Datelive', Chapter='$Chapter', Episode='$Episode' where EncryptPageID='$PageID'";
		$settings->query($query);
		
	} else if ($Action == 'delete') {
		if ($Section == 'pages') {
			$query = "SELECT Position from comic_pages where EncryptPageID='$PageID'";
		} else {
			$query = "SELECT Position from extra_pages where EncryptPageID='$PageID'";
		}
		$CurrentPosition = $settings->queryUniqueValue($query);
	
		if ($Section == 'pages') {
			$query = "SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID')";
		} else {
			$query = "SELECT Position from extra_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID')";
	}
		$MaxPosition = $settings->queryUniqueValue($query);
	//print $query."<br/>";
		if ($Section == 'pages') {
			$query = "SELECT ID from comic_pages where ComicID='$ComicID' order by Position";
		} else {
			$query = "SELECT ID from extra_pages where ComicID='$ComicID' order by Position";
		}
		$settings->query($query);
		$TotalLinks = $settings->numRows();
	//print $query."<br/>";
		$CurrentOrder = array();
		if ($Section == 'pages') {
			$query = "SELECT ID, Position from comic_pages where ComicID='$ComicID' and Position BETWEEN '$CurrentPosition' and '$MaxPosition' order by Position";
		} else {
			$query = "SELECT ID, Position from extra_pages where ComicID='$ComicID' and Position BETWEEN '$CurrentPosition' and '$MaxPosition' order by Position";
		}
		$settings->query($query);	
	//print $query."<br/>";
		while ($line = $settings->fetchNextObject()) { 
			$CurrentOrder[] = $line->ID;
		//print "MY LINE ID = " . $line->ID."<br/>";
		}
		$UpdatePosition = $CurrentPosition;
		for ($counter =0; $counter < (sizeof($CurrentOrder)-1); $counter++) {
		   	 	$SelectItemID = $CurrentOrder[$counter+1];
					//$UpdatePosition = $counter;
					if ($Section == 'pages') {
		   			$query = "UPDATE comic_pages set Position='$UpdatePosition' where id ='$SelectItemID'";
					} else {
					$query = "UPDATE extra_pages set Position='$UpdatePosition' where id ='$SelectItemID'";
					}
					$UpdatePosition++; 
					$settings->query($query);
						//print $query."<br/>"; 

		}
		if ($Section == 'pages') {
			$query ="DELETE from comic_pages WHERE ComicID='$ComicID' and EncryptPageID='$PageID'";
			$settings->query($query);	
			if ($Status == 'remove')
				$query ="SELECT pages from comics where comiccrypt='$ComicID'";
				$NumPages = $settings->queryUniqueValue($query);
				$NumPages--;
				$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
				$settings->query($query);	
			}
		} else {
			$query ="DELETE from extra_pages WHERE ComicID='$ComicID' and EncryptPageID='$PageID'";
			$settings->query($query);	
		}

		if ($Section == 'pages') {
			$query ="DELETE from pagecomments WHERE comicid='$ComicID' and pageid='$PageID'";
		} else {
			$query ="DELETE from extracomments WHERE comicid='$ComicID' and pageid='$PageID'";
		}
		$settings->query($query);
	} 
$settings->close();
echo 'Finished';
} else {
echo 'Can\'t Complete Request';

} 
?>