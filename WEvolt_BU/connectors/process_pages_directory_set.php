<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
include $_SERVER['DOCUMENT_ROOT'].'/pf_16_core/includes/image_resizer.php';
include $_SERVER['DOCUMENT_ROOT'].'/pf_16_core/includes/image_functions.php'; 
$pagedb =new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
ini_set('max_execution_time', 300);
$PublishDate = '2010-12-03';
$imagetypes = array("image/jpeg", "image/gif");
function getImages($dir) { 
global $imagetypes; 
# array to hold return value 
$retval = array(); 
# add trailing slash if missing 
if(substr($dir, -1) != "/") $dir .= "/"; 
# full server path to directory  
$fulldir = "{$_SERVER['DOCUMENT_ROOT']}/$dir"; $d = @dir($fulldir) or die("getImages: Failed opening directory $dir for reading"); while(false !== ($entry = $d->read())) { 
# skip hidden files 

	if($entry[0] == ".") continue; 
# check for image files 
	$f = escapeshellarg("$fulldir$entry"); 
	if(in_array($mimetype = trim( `file -bi $f` ), $imagetypes)) { 
		$retval[] = array( "file" => "/$dir$entry", "size" => getimagesize("$fulldir$entry") ); 

	}
} $d->close(); 
return $retval; 
}

$SafeFolder = $_GET['project'];
$UserID = $_SESSION['userid'];
$SeriesNum = $_GET['series'];	
$EpisodeNum = $_GET['ep'];
	
if ($_GET['project'] != '') {	
$PageType = 'pages';		
$query = "SELECT * 
			FROM projects as c 
			JOIN comic_settings as cs on c.ProjectID=cs.ComicID 
			WHERE (c.ProjectID='$SafeFolder' or c.SafeFolder='$SafeFolder')";
			$SettingArray= $pagedb->queryUniqueObject($query);
			$ComicFolder = $SettingArray->HostedUrl;
			$ProjectDirectory = $SettingArray->ProjectDirectory;
			$ProjectID = $SettingArray->ProjectID;


if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/".$ComicFolder."/images/pages/pro")) 
	 mkdir($_SERVER['DOCUMENT_ROOT']."/".$ProjectDirectory."/".$ComicFolder."/images/pages/pro/", 0777);
if ($_GET['series'] != '') {
if ($_GET['ep'] != '') {
		if ($_GET['dir'] != '') {
			$FTPDIRECTORY = "publisher_ftp/".$_GET['dir'];
			if ($EpisodeNum != 'new') {
				$query ="SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='$ProjectID' and PageType='$PageType' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum')";
				$NextPosition = $pagedb->queryUniqueValue($query);
			} else {
				$NextPosition = 1;	
			}
			
		$images = getImages($FTPDIRECTORY); 
		sort($images);
		
		$Date = date('2010-12-03 00:00:00'); 
		$datelive = date('12-03-2010');
		if ($images[0]['file'] != '') {
	
			foreach($images as $img) { 
					$FileArray = explode(".", basename($img['file']));
					$Filename = $FileArray[0];
					$Title = 'Page '.$NextPosition;
					$Filename = basename($img['file']);
					print 'FILE = ' . $Filename.'<br/>';
					$originalimage = $_SERVER['DOCUMENT_ROOT'].'/'.$FTPDIRECTORY.'/'.$Filename;
					list($width,$height)=getimagesize($_SERVER['DOCUMENT_ROOT'].'/'.$FTPDIRECTORY.'/'.$Filename);
					
					$ext = substr(strrchr($Filename, "."), 1);
					$randName = md5(rand() * time());
					$PageFilename = $randName.'.'.$ext;
					
					$FinalPageImage = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$PageFilename;
					$FinalPageImagePro = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/images/pages/pro/'.$PageFilename;
					$IphoneSmImage = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/iphone/images/pages/320/'.$PageFilename;
					$IphoneLgImage = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/iphone/images/pages/480/'.$PageFilename;
				
					if ($width > 1000) {
						$convertString = "convert $originalimage -resize 1000 $FinalPageImagePro";
						@exec($convertString);
						@chmod($FinalPageImagePro, 0777);
						$FinalPageImagePro = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/pro/'.$PageFilename;
					} else if ($width > 800) {
								copy($originalimage,$FinalPageImagePro);
								@chmod($FinalPageImagePro, 0777);
								$FinalPageImagePro =  $ProjectDirectory.'/'.$ComicFolder .'/images/pages/pro/'.$PageFilename;
					} else if ($width <= 800) {
								$FinalPageImagePro = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$PageFilename;
					}
			
					if ($width > 800) {
						$convertString = "convert $originalimage -resize 800 $FinalPageImage";
						exec($convertString);
						@chmod($FinalPageImage, 0777);
						print $convertString.'<br/>';
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
										$query = "INSERT into Episodes (ProjectID, Title,EpisodeNum, Description, Writer, Artist, Colorist, Letterist, Editor, Publisher, ThumbSm, ThumbMd, ThumbLg,SeriesNum) values ('$ProjectID','$Title','1','$EpisodeDesc','$EpisodeWriter','$EpisodeArtist','$EpisodeColorist','$EpisodeLetterer','$EpisodeEditor','$EpisodePublisher','$Thumbsm','$Thumbmd','$Thumblg', '$SeriesNum')";			
										$output .= $query.'<br/>';
										$pagedb->execute($query);
										$EpisodeNum =1;
								}
									
								$query ="SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='$ProjectID' and PageType='$PageType' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum')";
									$NewPosition = $pagedb->queryUniqueValue($query);
									$NewPosition = $NewPosition+1;
									$output .= $query.'<br/>';
									$output.= 'NEW POSITION = ' . $NewPosition.'<br/>';
									$EpisodeWriter = mysql_escape_string($_POST['txtEpisodeWriter']);
									$EpisodeArtist = mysql_escape_string($_POST['txtEpisodeArtist']);
									$EpisodeColorist = mysql_escape_string($_POST['txtEpisodeColorist']);
									$EpisodeLetterer = mysql_escape_string($_POST['txtEpisodeLetterer']);
									
								
									$query = "INSERT into comic_pages(ComicID, Title, Image, ImageDimensions, Datelive, ThumbSm, ThumbMd, ThumbLg, Chapter, Episode, Filename, PageType,PublishDate, EpisodeNum,ProImage, FileType, SeriesNum, EpPosition) values ('$ProjectID','$Title','$PageFilename','$ImageDimensions', '".$datelive."','$Thumbsm','$Thumbmd','$Thumblg',0,0,'$PageFilename','$PageType','$Date','$EpisodeNum','$FinalPageImagePro','$ext','$SeriesNum','$NewPosition')";
								$pagedb->execute($query);
								$output .= $query.'<br/>';
									if ($Section == 'pages') {
										$CurrentDate = date('Y-m-d'). ' 00:00:00';
										$query ="SELECT count(*) from comic_pages where ComicID='$ProjectID' and PageType='pages' and PublishDate<='$CurrentDate'";
										$NumPages = $pagedb->queryUniqueValue($query);
										$output .= $query.'<br/>';
										$Status = 'add';
										$query = "UPDATE projects SET pages='$NumPages',PagesUpdated='$Date' WHERE ProjectID='$ProjectID'";
										$output .= $query.'<br/>';
										
										$pagedb->execute($query);			
									}
									$query ="SELECT ID from comic_pages WHERE ComicID='$ProjectID' and EpPosition='$NewPosition' and PageType='$PageType' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
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
									//sendPageConnect($Section, $Encryptid, 'add','',$Status,$PageType);
					$NextPosition++;
					}
				
					print $output;
					$query = "SELECT * from comic_pages where ComicID='$ProjectID' and PageType='$PageType' and SeriesNum='$SeriesNum' order by SeriesNum, EpisodeNum, EpPosition";
					$pagedb->query($query);
					$ResetPos = 1;
					while ($line = $pagedb->fetchNextObject()) {
							$SPageID = $line->EncryptPageID;
							$query = "update comic_pages set Position='$ResetPos' where ComicID='$ProjectID' and EncryptPageID='$SPageID' and SeriesNum='$SeriesNum'";
							$pagedb->execute($query);
							$output .= $query.'<br/>';
							$ResetPos++;
					}
				
		} else { ?>
        
        There were no pages found. Please make sure you folder is correct and try again. 
        <br />

        <a href="http://www.wevolt.com/connectors/process_pages_directory.php">START OVER</a>
        
        <? }
				$pagedb->close();
			
					
		} else  {?>
		
		 Please enter the directory the pages exist on the FTP. Just enter the directory after publisher_ftp. <br />
		<br />
		So if you placed your pages to publisher_ftp/NAME. You would just enter NAME. Or if it was publisher_ftp/NAME/FOLDER, you would enter NAME/FOLDER
		 
		 <form method="get" action="#">
		FTP DIRECTORY<br />
		
		 <input type="text" name="dir" id="dir" value=""/>
          <input type="hidden" value="<? echo $_GET['project'];?>" name="project" />
           <input type="hidden" value="<? echo $_GET['series'];?>" name="series" />
           <input type="hidden" value="<? echo $_GET['ep'];?>" name="ep" />
		 <input type="submit"  value="NEXT"/>
		 
		 </form>
		<? } 
	} else {
		$query = "SELECT * from Episodes where ProjectID ='$ProjectID'  and SeriesNum='".$_GET['series']."' order by EpisodeNum ASC";
		$InitDB->query($query);
		$HasEp = 0;
		$TotalEP = $InitDB->numRows();
		$EpisodeSelect = '<select name="ep">';
		while ($line = $InitDB->fetchNextObject()) {
		$HasEp = 1;
		//	print 'EPISODE = ' . $EpisodeNum.'<br/>';
			//print 'EPISODE = ' .$line->EpisodeNum.'<br/>';
				$EpisodeSelect .= '<option value="'.$line->EpisodeNum.'"';
				
				if ($line->EpisodeNum == $TotalEP) 
					$EpisodeSelect .= ' selected' ;
				$EpisodeSelect .='>'.$line->EpisodeNum.' - '. $line->Title.'</option>';
		}
			$EpisodeSelect .= '<option value="new">Start New Episode</option>';
		$EpisodeSelect .= '</select>';
		
		?>
		 <form method="get" action="#">
		 
		 <? echo $EpisodeSelect;?>
		 <input type="submit"  value="NEXT->SELECT DIRECTORY"/>
          <input type="hidden" value="<? echo $_GET['project'];?>" name="project" />
           <input type="hidden" value="<? echo $_GET['series'];?>" name="series" />
		</form>
		<?
		
	}
} else { 

$query = "SELECT * from series where ProjectID ='$ProjectID'";
		$InitDB->query($query);
		$HasEp = 0;
		$EpisodeSelect = '<select name="series">';
		while ($line = $InitDB->fetchNextObject()) {
		$HasEp = 1;
		//	print 'EPISODE = ' . $EpisodeNum.'<br/>';
			//print 'EPISODE = ' .$line->EpisodeNum.'<br/>';
				$EpisodeSelect .= '<option value="'.$line->SeriesNum.'"';
			
				$EpisodeSelect .='>'.$line->Title.'</option>';
		}
		if ($HasEp == 0)
			$EpisodeSelect .= '<option value="new">Start New Series</option>';
		$EpisodeSelect .= '</select>';?>
<form method="get" action="#">
		 
		 <? echo $EpisodeSelect;?>
		 <input type="submit"  value="NEXT->SELECT EPISODE"/>
         <input type="hidden" value="<? echo $_GET['project'];?>" name="project" />
		</form>



<? }
} else { ?>

 Please enter the project URL title. I.e. - For Stupid Users, you would enter Stupid_Users. 
 
 <form method="get" action="#">
 URL TITLE
 <input type="text" name="project" id="project" value=""/>
 <input type="submit"  value="NEXT->SELECT SERIES"/>
 
 </form>
<? } 
//header("location:/cms/edit/".$_SESSION['safefolder']."/?tab=content&section=pages&series=".$SeriesNum."&ep=".$EpisodeNum);
?>