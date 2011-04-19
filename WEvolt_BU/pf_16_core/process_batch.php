<?php
$Source_dir = "temp/";
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
include 'includes/connect_functions.php';
include 'includes/image_resizer.php';
include 'includes/image_functions.php'; 
$pagedb =new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
ini_set('max_execution_time', 300);

$Section = $_GET['section'];
$SafeFolder = $_SESSION['safefolder'];
$ComicID = $_SESSION['sessionproject'];
$UserID = $_SESSION['userid'];
$SeriesNum = $_GET['series'];
if ($SeriesNum == '')
	$SeriesNum = 1;
$EpisodeNum = $_POST['txtEpisode'];
if ($EpisodeNum == '')
	$EpisodeNum = 'new';	
$query = "SELECT * 
			FROM projects as c 
			JOIN comic_settings as cs on c.ProjectID=cs.ComicID 
			JOIN project_skins as ts on ts.SkinCode=cs.Skin 
			WHERE (c.ProjectID='$SafeFolder' or c.SafeFolder='$SafeFolder')";
			$SettingArray= $pagedb->queryUniqueObject($query);
			$SkinCode= $SettingArray->Skin;
			$GlobalSiteWidth = $SettingArray->GlobalSiteWidth;
			$KeepWidth = $SettingArray->KeepWidth;
			$NewPageDate = substr($DateLive,6,4).'-'.substr($DateLive,0,2).'-'.substr($DateLive,3,2);
			$todays_date = date("Y-m-d"); 
			$Today = strtotime($todays_date); 
			$TestPageDate = strtotime($NewPageDate); 
			$ComicFolder = $SettingArray->HostedUrl;
			$ProjectDirectory = $SettingArray->ProjectDirectory;


if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/".$ComicFolder."/images/pages/pro")) 
	 mkdir($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/".$ComicFolder."/images/pages/pro/", 0777);

if ($Section == 'extras') {
	$PageType = 'extras';
} else if (($Section == 'pages') && ($PageType == '')) { 
	$PageType = 'pages';
} 

if ($PageType == '')
	$PageType = 'pages';
if ($TestPageDate <= $Today) {
	$AddPage = 1;
} else {
	$AddPage = 0;
}

$Date = date('Y-m-d H:i:s'); 

while(list($key,$value) = each($_FILES['images']['name']))
		{
			if(!empty($value))
			{
				$filename = $value;
					$filename=str_replace(" ","_",$filename);// Add _ inplace of blank space in file name, you can remove this line
					$add = "temp/$filename";
                      // echo $_FILES['images']['type'][$key];
			           // echo "<br>";
					copy($_FILES['images']['tmp_name'][$key], $add);
					chmod("$add",0777);
					
					$CommentNumber = 'comment'.$key;
					$DateNumber = 'date'.$key;
					$TitleNumber = 'title'.$key;
					$ChapterNumber = 'chapter'.$key;
					//$EpisodeNumber = 'episode'.$key;
					
					//print "MY DATE NUMBER = " . $DateNumber."<br/>";
					//print "MY ChapterNumber = " . $ChapterNumber."<br/>";
					//print "MY EpisodeNumber = " . $EpisodeNumber."<br/>";
					$Comment = mysql_escape_string($_POST[$CommentNumber]);
					$Comment = str_replace(chr(13).chr(10), "\n", $Comment);
					$Comment = str_replace('\r', '\n', $Comment);
					$Title = mysql_escape_string($_POST[$TitleNumber]);
					if ($Title == '') {
						$Title = 'Page '.$NewPosition;
					} 
					$Chapter = $_POST[$ChapterNumber];
					if ($Chapter == '')
						$Chapter = 0;
					//$Episode = $_POST[$EpisodeNumber];
					//if ($Episode == '')
						$Episode = 0;
					$Datelive = $_POST[$DateNumber];
				    $PublishDate = substr($Datelive,6,4).'-'. substr($Datelive,0,2).'-'. substr($Datelive,3,2).' 00:00:00';
					//print "MY DATELIVE = " . $DateLive;
					//print "MY POST DATE 0 = " . $_POST['date0'];
					list($width,$height)=getimagesize($Source_dir.$filename);
					$originalimage = $Source_dir.$filename;
					$ext = substr(strrchr($filename, "."), 1);
					$randName = md5(rand() * time());
					$filePath = $Source_dir . $randName . '.' . $ext;
					$Filename = $randName . '.' . $ext; 
					$Finalimage = $filePath;
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
					if ($EpisodeNum == 'new') {
							$query = "INSERT into Episodes (ProjectID, Title,EpisodeNum, Description, Writer, Artist, Colorist, Letterist, Editor, Publisher, ThumbSm, ThumbMd, ThumbLg,SeriesNum) values ('$ComicID','$Title','1','$EpisodeDesc','$EpisodeWriter','$EpisodeArtist','$EpisodeColorist','$EpisodeLetterer','$EpisodeEditor','$EpisodePublisher','$Thumbsm','$Thumbmd','$Thumblg', '$SeriesNum')";			
							$output .= $query.'<br/>';
							$pagedb->execute($query);
							$EpisodeNum =1;
						}
						
					$query ="SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='$ComicID' and PageType='$PageType' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum')";
						$NewPosition = $pagedb->queryUniqueValue($query);
						$NewPosition = $NewPosition+1;
						$output .= $query.'<br/>';
						$output.= 'NEW POSITION = ' . $NewPosition.'<br/>';
						$EpisodeWriter = mysql_escape_string($_POST['txtEpisodeWriter']);
						$EpisodeArtist = mysql_escape_string($_POST['txtEpisodeArtist']);
						$EpisodeColorist = mysql_escape_string($_POST['txtEpisodeColorist']);
						$EpisodeLetterer = mysql_escape_string($_POST['txtEpisodeLetterer']);
						
						//CHECK FOR EPISODES
						
								///	print $query.'<br/>';
						//if ($Episode == 1) {
							//$query = "INSERT into Episodes (ProjectID, Title,EpisodeNum, Description, Writer, Artist, Colorist, Letterist, Editor, Publisher, ThumbSm, ThumbMd, ThumbLg, SeriesNum) values ('$ComicID','$Title','$NewEpisode','$EpisodeDesc','$EpisodeWriter','$EpisodeArtist','$EpisodeColorist','$EpisodeLetterer','$EpisodeEditor','$EpisodePublisher','$Thumbsm','$Thumbmd','$Thumblg','$SeriesNum')";			//print $query.'<br/>';
						//	$pagedb->execute($query);
							//$EpisodeNum = $NewEpisode;
						//} else {
							//$EpisodeNum = $_POST['EpisodeNum'];
						//}
						$query = "INSERT into comic_pages(ComicID, Title, Comment, Image, ImageDimensions, Datelive, ThumbSm, ThumbMd, ThumbLg, Chapter, Episode, EpisodeDesc,EpisodeWriter,EpisodeArtist,EpisodeColorist,EpisodeLetterer, Filename, Position, UploadedBy, PageType,PublishDate, EpisodeNum,ProImage, FileType, SeriesNum, EpPosition) values ('$ComicID','$Title', '$Comment','$Filename','$ImageDimensions', '$Datelive','$Thumbsm','$Thumbmd','$Thumblg',$Chapter,$Episode, '$EpisodeDesc', '$EpisodeWriter','$EpisodeArtist','$EpisodeColorist','$EpisodeLetterer','$Filename',$NewPosition,'$UserID','$PageType','$PublishDate','$EpisodeNum','$FinalPageImagePro','$ext','$SeriesNum','$NewPosition')";
					$pagedb->execute($query);
					$output .= $query.'<br/>';
						if ($Section == 'pages') {
							$CurrentDate = date('Y-m-d'). ' 00:00:00';
							$query ="SELECT count(*) from comic_pages where ComicID='$ComicID' and PageType='pages' and PublishDate<='$CurrentDate'";
							$NumPages = $pagedb->queryUniqueValue($query);
							$output .= $query.'<br/>';
							$Status = 'add';
							$query = "UPDATE projects SET pages='$NumPages',PagesUpdated='$Date' WHERE ProjectID='$ComicID'";
							$output .= $query.'<br/>';
							$output .= $query.'<br/>';
							$pagedb->execute($query);			
						}
						$query ="SELECT ID from comic_pages WHERE ComicID='$ComicID' and EpPosition='$NewPosition' and PageType='$PageType' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
						$PageID = $pagedb->queryUniqueValue($query);
						$output .= $query.'<br/>';
						$Encryptid = substr(md5($PageID), 0,15).dechex($PageID);
						$IdClear = 0;
						$Inc = 5;
						while ($IdClear == 0) {
								$query = "SELECT count(*) from comic_pages where EncryptPageID='$Encryptid'";
								$Found = $pagedb->queryUniqueValue($query);
								$output .= $query.'<br/>';
								if ($Found == 1) {
									$Encryptid = substr(md5(($PageID+$Inc)), 0, 15).dechex($PageID+$Inc);
								} else {
									$query = "UPDATE comic_pages SET EncryptPageID='$Encryptid' WHERE ID='$PageID'";
									$pagedb->execute($query);
									$output .= $query.'<br/>';
									$IdClear = 1;
								
								}
								$Inc++;
						}
						$output .= $query.'<br/>';
						sendPageConnect($Section, $Encryptid, 'add','',$Status,$PageType);
				
			}
		}
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
//print "MY TEXT PAGE = " . $PageID;
$pagedb->close();
//if ($_SESSION['username'] == 'matteblack')
	//print $output;
//else
header("location:/cms/edit/".$_SESSION['safefolder']."/?tab=content&section=pages&series=".$SeriesNum."&ep=".$EpisodeNum);
?>