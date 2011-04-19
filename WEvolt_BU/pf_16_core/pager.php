<?php
$Source_dir = "temp/";
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
include 'includes/connect_functions.php';
include 'includes/image_resizer.php';
include 'includes/image_functions.php';
$pagedb =new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);

$Filename = $_POST['txtFilename'];
$PeelOneFilename = $_POST['txtPeelOneFilename'];
$PeelTwoFilename = $_POST['txtPeelTwoFilename'];
$PeelThreeFilename = $_POST['txtPeelThreeFilename'];
$PeelFourFilename = $_POST['txtPeelFourFilename'];
$SafeFolder = $_POST['txtSafeFolder'];
$AccessType = $_POST['txtAccessType'];
if ($AccessType == '')
	$AccessType = 'public';
$Section = $_POST['txtSection'];
$Comment = mysql_real_escape_string($_POST['txtComment']);
$Comment = str_replace(chr(13).chr(10), "\n", $Comment);
$Comment = str_replace('\r', '\n', $Comment);
$EpisodeDesc = mysql_real_escape_string($_POST['txtEpisodeDesc']);
$EpisodeDesc = str_replace(chr(13).chr(10), "\n", $EpisodeDesc);
$EpisodeDesc = str_replace('\r', '\n', $EpisodeDesc);
$EpisodeWriter = mysql_real_escape_string($_POST['txtEpisodeWriter']);
$EpisodeArtist = mysql_real_escape_string($_POST['txtEpisodeArtist']);
$EpisodeColorist = mysql_real_escape_string($_POST['txtEpisodeColorist']);
$EpisodeLetterer = mysql_real_escape_string($_POST['txtEpisodeLetterer']);
$Datelive = $_POST['txtDatelive'];
$ViewType = $_POST['txtViewType'];
if ($ViewType == '')
	$ViewType = 'html';
$AllowPdf = $_POST['txtAllowPdf'];
if ($AllowPdf == '')
	$AllowPdf = '0';
$PublishDate = substr($Datelive,6,4).'-'. substr($Datelive,0,2).'-'. substr($Datelive,3,2).' 00:00:00';
$Chapter = $_POST['txtChapter'];
$Episode = $_POST['txtEpisode'];
//var_dump($_POST);
if ($Chapter == '') 
	$Chapter = 0;
if ($Episode == '')   
	$Episode = 0;	
$EpisodeNum = $_POST['ep'];
if ($EpisodeNum == '')
	$EpisodeNum = $_POST['txtEpisode'];
if ($EpisodeNum == '')
	$EpisodeNum = 1;

$SeriesNum = $_POST['series'];
if ($SeriesNum == '')
	$SeriesNum = 1;
$ComicID = $_SESSION['sessionproject'];

$UserID = $_SESSION['userid'];
$Action = $_POST['txtAction'];
$ComicFolder = $_POST['txtUrl'];
$AddPage = $_POST['cleartoAdd'];
$AddedBefore =$_POST['addedbefore'];
$PageID = $_POST['txtPage'];
$PageType = $_POST['txtType'];
$DbTable = 'comic_pages';
if ($Section == '')
	$Section = 'pages';
if ($PageType == '')
	$PageType = $Section;
$FileSet = 'no';
$Date = date('Y-m-d H:i:s'); 
$ItemPosition = $_POST['txtPosition'];
$Title = mysql_real_escape_string($_POST['txtTitle']);

$query = "SELECT * 
			FROM projects as c 
			JOIN comic_settings as cs on c.ProjectID=cs.ComicID 
			left join project_skins as ts on ts.SkinCode=cs.Skin 
			
			WHERE c.ProjectID='".$_SESSION['sessionproject']."'";
			$SettingArray= $pagedb->queryUniqueObject($query);
		//	$AppInstallID= $SettingArray->AppInstallation;
			$SkinCode= $SettingArray->Skin;
			$GlobalSiteWidth = $SettingArray->GlobalSiteWidth;
			$KeepWidth = $SettingArray->KeepWidth;
			//$ApplicationLink = "http://".$SettingArray->Domain."/".$SettingArray->PFPath;
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

function convert_to_pdf($html, $path_to_pdf, $base_path='') {
	global $PDFWIDTH; 
  $pipeline = PipelineFactory::create_default_pipeline('', // Attempt to auto-detect encoding
                                                       '');

  // Override HTML source 
  // @TODO: default http fetcher will return null on incorrect images 
  // Bug submitted by 'imatronix' (tufat.com forum).
  $pipeline->fetchers[] = new MyFetcherMemory($html, $base_path);

  // Override destination to local file
  $pipeline->destination = new MyDestinationFile($path_to_pdf);

  $baseurl = '';
  $media =& Media::predefined('A4');
  $media->set_landscape(false);
  $media->set_margins(array('left'   => 0,
                            'right'  => 0,
                            'top'    => 0,
                            'bottom' => 0));
  $media->set_pixels($PDFWIDTH); 

  global $g_config;
  $g_config = array( 
                    'cssmedia'     => 'screen',
                    'scalepoints'  => '1',
                    'renderimages' => false,
                    'renderlinks'  => false,
                    'renderfields' => true,
                    'renderforms'  => false,
					'pixels' => $PDFWIDTH,
                    'mode'         => 'html',
					'output' => '1',
					'media' => 'A3',
					'scalepoint' => '1',
                    'encoding'     => '',
					'method' => 'fpdf',
					'imagequality_workaround' => '1',
					'html2xhtml' => '1',
                    'debugbox'     => false,
                    'pdfversion'    => '1.4',
					'pslevel' => '3',
                    'draw_page_border' => false
                    );

  $pipeline->configure($g_config);
  $pipeline->process_batch(array($baseurl), $media);
}

function create_peel_page($NewFilename, $PageType) {
	global $Source_dir, $PageID, $ComicID,$ProjectDirectory,$ComicFolder,$pagedb,$Action,$SeriesNum, $EpisodeNum;
	
	if ($PageType == 'script') {
				require_once('html2ps/config.inc.php');
				require_once(HTML2PS_DIR.'pipeline.factory.class.php');
				@set_time_limit(10000);
				parse_config_file(HTML2PS_DIR.'html2ps.config');
				$randName = md5(rand() * time());
				$htmlFile = 'temp/'.$PeelFourFilename;
				$pdfFile = 'temp/'.$randName.'.pdf';
				$htmlFilename = $randName.'.html';
				$ScriptPDFFile = $randName.'.pdf';
				$PDFWIDTH = 1000;
				class MyDestinationFile extends Destination {
							var $_dest_filename;
								function MyDestinationFile($dest_filename) {
										$this->_dest_filename = $dest_filename;
								}
					
								function process($tmp_filename, $content_type) {
									 copy($tmp_filename, $this->_dest_filename);
								 }
				}
		
				class MyFetcherMemory extends Fetcher {
							 var $base_path;
							 var $content;
		
							 function MyFetcherMemory($content, $base_path) {
								 $this->content   = $content;
									$this->base_path = $base_path;
								}
		
							function get_data($url) {
								if (!$url) {
									 return new FetchedDataURL($this->content, array(), "");
								} else {
				  // remove the "file:///" protocol
									if (substr($url,0,8)=='file:///') {
									 $url=substr($url,8);
					// remove the additional '/' that is currently inserted by utils_url.php
									if (PHP_OS == "WINNT") $url=substr($url,1);
									}
							 return new FetchedDataURL(@file_get_contents($url), array(), "");
							}
						 }
		
						 function get_base_url() {
								return 'file:///'.$this->base_path.'/dummy.html';
							}
					}
						
					convert_to_pdf(file_get_contents($htmlFile), $pdfFile);	
					$ScriptHTML = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$randName.'.html';
					$ScriptPDF = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$randName.'.pdf';
					copy($pdfFile,$ScriptPDF);
					unlink($pdfFile);
					chmod($ScriptPDF, 0777);
					
					copy($htmlFile,$ScriptHTML);
					unlink($htmlFile);
					chmod($ScriptHTML, 0777);
	
			} 
			list($width,$height)=getimagesize($_SERVER['DOCUMENT_ROOT']."/".$Source_dir.$NewFilename);
			$randName = md5(rand() * time());
			if ($PageType == 'script') {
					$originalimage = $_SERVER['DOCUMENT_ROOT'].'/'.$Source_dir .$randName.'.jpg';
					$originalthumb = $_SERVER['DOCUMENT_ROOT'].'/'.$Source_dir .'thumbs/'.$randName.'.jpg';
					$convertString = "convert  -geometry 1600x1600 -density 300x300  -quality 100 $pdfFile $originalimage";
					exec($convertString);
					$ext = 'jpg';
			
			} else {
				$originalimage = $_SERVER['DOCUMENT_ROOT'].'/'.$Source_dir.$NewFilename;
				$originalthumb = $_SERVER['DOCUMENT_ROOT'].'/'.$Source_dir.'/thumbs/'.$NewFilename;
				$ext = substr(strrchr($NewFilename, "."), 1);
			}
			
			$filePath = $_SERVER['DOCUMENT_ROOT'].'/'.$Source_dir . $randName . '.' . $ext;
			$PeelFilename = $randName . '.' . $ext;
			$Finalimage = $filePath;
			$FinalPageImage = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$PeelFilename;
			$FinalPageImagePro = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/images/pages/pro/'.$PeelFilename;
			$IphoneSmImage = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/iphone/images/pages/320/'.$PeelFilename;
			$IphoneLgImage = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/iphone/images/pages/480/'.$PeelFilename;
			
			if ($width > 1000) {
				$convertString = "convert $originalimage -resize 1000 $FinalPageImagePro";
				@exec($convertString);
				@chmod($FinalPageImagePro, 0777);
				$FinalPageImagePro = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/pro/'.$PeelFilename;
			} else if ($width > 800) {
				copy($originalimage,$FinalPageImagePro);
				@chmod($FinalPageImagePro, 0777);
				$FinalPageImagePro = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/pro/'.$PeelFilename;
			} else if ($width <= 800) {
					$FinalPageImagePro = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$PeelFilename;
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
			//$image = new imageResizer($FinalPageImage);
			$Thumbsm = $ProjectDirectory.'/'.$ComicFolder ."/images/pages/thumbs/".$randName . '_sm.' . $ext;
			$Thumbmd = $ProjectDirectory.'/'.$ComicFolder ."/images/pages/thumbs/".$randName . '_md.' . $ext;
			$Thumblg = $ProjectDirectory.'/'.$ComicFolder ."/images/pages/thumbs/".$randName . '_lg.' . $ext;
			$convertString = "convert $FinalPageImage -resize 110x110 -quality 60  ".$_SERVER['DOCUMENT_ROOT']."/".$Thumbsm;
			exec($convertString);
			chmod($_SERVER['DOCUMENT_ROOT'].'/'.$Thumbsm,0777);
	
			$convertString = "convert $FinalPageImage -resize 200 -quality 60  ".$_SERVER['DOCUMENT_ROOT']."/".$Thumbmd;
			exec($convertString);
			chmod($_SERVER['DOCUMENT_ROOT'].'/'.$Thumbmd,0777);

			$convertString = "convert $FinalPageImage -resize 480 -quality 60 ".$_SERVER['DOCUMENT_ROOT']."/".$Thumblg;
			exec($convertString);
			chmod($_SERVER['DOCUMENT_ROOT'].'/'.$Thumblg,0777);
			$query = "SELECT * from comic_pages where ParentPage='$PageID' and PageType='$PageType'";
			$pagedb->query($query);
			$PageFound = $pagedb->numRows();
			if ($PageFound == 1) {
				$query = "UPDATE comic_pages set Image='$PeelFilename',ImageDimensions='$ImageDimensions', ThumbSm='$Thumbsm',ThumbMd='$Thumbmd',ThumbLg='$Thumblg', Filename='$PeelFilename',ProImage='$FinalPageImagePro', HTMLFile='$htmlFilename',Pdffile='$ScriptPDFFile', AccessType='$AccessType' where ParentPage='$PageID' and PageType='$PageType'";
				$pagedb->execute($query);
				
			} else {
				$query = "INSERT into comic_pages(ComicID, Image, ImageDimensions,ThumbSm, ThumbMd, ThumbLg, Filename, UploadedBy, PageType, ParentPage,ProImage,HTMLFile,Pdffile, SeriesNum, EpisodeNum,AccessType) values ('$ComicID','$PeelFilename','$ImageDimensions', '$Thumbsm','$Thumbmd','$Thumblg','$PeelFilename','$UserID','$PageType','$PageID','$FinalPageImagePro','$htmlFilename','$ScriptPDFFile','$SeriesNum', '$EpisodeNum','$AccessType')";
				
				$pagedb->execute($query);
				$query ="SELECT ID from comic_pages WHERE ComicID='$ComicID' and ParentPage='$PageID' and PageType='$PageType'";
				$PageID = $pagedb->queryUniqueValue($query);
				$output .= $query.'<br/>';
				$Encryptid = substr(md5($PageID), 0, 15).dechex($PageID);
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
			}
		     if ($Action == 'add')
		   		sendPageConnect($Section, $PageID, 'add','','',$PageType);	
}

if ($PeelOneFilename != '')
		create_peel_page($PeelOneFilename, 'pencils');
		
if ($PeelTwoFilename != '')
		create_peel_page($PeelTwoFilename, 'inks');

if ($PeelThreeFilename != '')
		create_peel_page($PeelThreeFilename, 'colors');
		
if ($PeelFourFilename != '')
		create_peel_page($PeelFourFilename, 'script');
	

if ($_SESSION['projecttype'] == 'writing') {
				
				if ($_POST['txtPDFFile'] != '') {
					
					
					
					
				}
				require_once('html2ps/config.inc.php');
				require_once(HTML2PS_DIR.'pipeline.factory.class.php');
				@set_time_limit(10000);
				parse_config_file(HTML2PS_DIR.'html2ps.config');
				$randName = md5(rand() * time());
				$HTMLFile = $randName.".html"; 
				$ScriptPDFFile =$randName.".pdf"; 
				//print 'temp/'.$HTMLFile.'<br/>'; 
				$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/temp/'.$HTMLFile,'w');
				//$Content = preg_replace("/<img[^>]+\>/i", "", $_POST['content']);
				//$Content = preg_replace("/<a[^>]+\>/i", "", $this->description);
				
				$Content = preg_replace("/<object[^>]+\>/i", "", $_POST['content']);
				$Content = preg_replace("/<script[^>]+\>/i", "", $Content);
				//$Content = preg_replace("/<embed[^>]+\>/i", "", $this->description);
				$Content = preg_replace("/<param[^>]+\>/i", "",$Content);		
				$write = fwrite($fp,$Content);
				
				@chmod($_SERVER['DOCUMENT_ROOT'].'/temp/'.$HTMLFile,0777);
				$htmlFile = $_SERVER['DOCUMENT_ROOT'].'/temp/'.$HTMLFile;
				$pdfFile = $_SERVER['DOCUMENT_ROOT'].'/temp/'.$randName.'.pdf';
				$PDFWIDTH = 1000;
				class MyDestinationFile extends Destination {
							var $_dest_filename;
								function MyDestinationFile($dest_filename) {
										$this->_dest_filename = $dest_filename;
								}
					
								function process($tmp_filename, $content_type) {
									 copy($tmp_filename, $this->_dest_filename);
								 }
				}
		
				class MyFetcherMemory extends Fetcher {
							 var $base_path;
							 var $content;
		
							 function MyFetcherMemory($content, $base_path) {
								 $this->content   = $content;
									$this->base_path = $base_path;
								}
		
							function get_data($url) {
								if (!$url) {
									 return new FetchedDataURL($this->content, array(), "");
								} else {
				  // remove the "file:///" protocol
									if (substr($url,0,8)=='file:///') {
									 $url=substr($url,8);
					// remove the additional '/' that is currently inserted by utils_url.php
									if (PHP_OS == "WINNT") $url=substr($url,1);
									}
							 return new FetchedDataURL(@file_get_contents($url), array(), "");
							}
						 }
		
						 function get_base_url() {
								return 'file:///'.$this->base_path.'/dummy.html';
							}
					}
						
					convert_to_pdf(file_get_contents($htmlFile), $pdfFile);	
					$ScriptHTML = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$randName.'.html';
					$ScriptPDF = $_SERVER['DOCUMENT_ROOT'].'/'.$ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$randName.'.pdf';
					@copy($pdfFile,$ScriptPDF);
					
					//print 'SCRIPT HTML = ' . $ScriptHTML.'<br/>';
						//print 'SCRIPT ScriptPDF = ' . $ScriptPDF.'<br/>';
					@unlink($pdfFile);
					@chmod($ScriptPDF, 0777);
					
					@copy($htmlFile,$ScriptHTML);
					@unlink($htmlFile);
					@chmod($ScriptHTML, 0777);
					
					$originalimage = $_SERVER['DOCUMENT_ROOT'].'/'.$Source_dir .$randName.'.jpg';
					$originalthumb = $_SERVER['DOCUMENT_ROOT'].'/'.$Source_dir .'thumbs/'.$randName.'.jpg';
					$convertString = "convert  -geometry 1600x1600 -density 300x300  -quality 100 $ScriptPDF $originalimage";
					@exec($convertString);
					$Filename = $randName.'.jpg';
					$ext = 'jpg';
					
					
}
/*
if ($Action == 'delete') {
			$query ="SELECT Datelive from comic_pages WHERE EncryptPageID='$PageID' and EpisodeNum='$EpisodeNum' and SeriesNum='$SeriesNum'";
			$CurrentPageDate = $pagedb->queryUniqueValue($query);
			$CurrentPageDate =  strtotime(substr($CurrentPageDate,6,4).'-'.substr($CurrentPageDate,0,2).'-'.substr($CurrentPageDate,3,2));
			if ($CurrentPageDate <= $Today) {
				$AddedBefore = 1;
			} else {
				$AddedBefore = 0;
			}
} else if ($Action == 'edit') {
			$query ="SELECT Datelive from comic_pages WHERE EncryptPageID='$PageID' and EpisodeNum='$EpisodeNum' and SeriesNum='$SeriesNum'";
			$CurrentPageDate = $pagedb->queryUniqueValue($query);
			$CurrentPageDate =  strtotime(substr($CurrentPageDate,6,4).'-'.substr($CurrentPageDate,0,2).'-'.substr($CurrentPageDate,3,2));
			if ($CurrentPageDate <= $Today) {
				$AddedBefore = 1;
			} else {
				$AddedBefore = 0;
			}
}

*/


	list($width,$height)=@getimagesize($_SERVER['DOCUMENT_ROOT']."/".$Source_dir.$Filename);
if ($Filename != '') {
	$originalimage =$_SERVER['DOCUMENT_ROOT']."/".$Source_dir.$Filename;
	$originalthumb = $_SERVER['DOCUMENT_ROOT']."/".$Source_dir.'/thumbs/'.$Filename;
}

//print 'ACTION = ' . $Action.'<br/>';
if (($Action == 'add') || (($Action == 'edit') && ($_POST['txtFilename'] != '')) || ($_SESSION['projecttype'] == 'writing')) {
	if ($_SESSION['projecttype'] != 'writing') {
		$ext = substr(strrchr($Filename, "."), 1);
		$randName = md5(rand() * time());
	}
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
			$output .= 'SIZE GREATER THAN 1000<br/>';
	} else if ($width > 800) {
			@copy($originalimage,$FinalPageImagePro);
			@chmod($FinalPageImagePro, 0777);
			$FinalPageImagePro =  $ProjectDirectory.'/'.$ComicFolder .'/images/pages/pro/'.$Filename;
			$output .= 'SIZE GREATER THAN 800<br/>';
	} else if ($width <= 800) {
			$FinalPageImagePro = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/'.$Filename;
			$output .= 'SIZE LESS THAN 800<br/>';
	}
	

		$output .=  'WIDTH = ' .$width.'<br/>';
		$output .=  'FinalPageImagePro = ' .$FinalPageImagePro.'<br/>'; 	

	if ($width > 800) {
		$convertString = "convert $originalimage -resize 800 $FinalPageImage";
		@exec($convertString);
		@chmod($FinalPageImage, 0777);
	} else {
		@copy($originalimage,$FinalPageImage);
		@chmod($FinalPageImage, 0777);
	}
	@unlink($originalimage);			
	list($width,$height)=@getimagesize($FinalPageImage); 
	$ImageDimensions = $width.'x'.$height;	
			
	//CREATE IPHONE IMAGES							
	$convertString = "convert $FinalPageImage -resize 320 $IphoneSmImage";
	@exec($convertString);
	$convertString = "convert $FinalPageImage -resize 480 $IphoneLgImage";
	@exec($convertString);
	@chmod($IphoneLgImage,0777);
	@chmod($IphoneSmImage,0777);
			
	//CREATE THUMBS
	
	$Thumbsm = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/thumbs/'.$randName . '_sm.' . $ext;
	$Thumbmd = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/thumbs/'.$randName . '_md.' . $ext;
	$Thumblg = $ProjectDirectory.'/'.$ComicFolder .'/images/pages/thumbs/'.$randName . '_lg.' . $ext;
	if ($_SESSION['projecttype'] == 'writing') {
		$convertString = "convert $FinalPageImage -resize 110 -quality 60  ".$_SERVER['DOCUMENT_ROOT']."/".$Thumbsm;
		@exec($convertString);
	} else {
		$image = new imageResizer($FinalPageImage);
		$image->resize(110, 70, 110, 70);
		$image->save($_SERVER['DOCUMENT_ROOT'].'/'.$Thumbsm, JPG);
		@chmod($_SERVER['DOCUMENT_ROOT'].'/'.$Thumbsm,0777);
		$image = null;
	}
	$convertString = "convert $FinalPageImage -resize 200 -quality 60  ".$_SERVER['DOCUMENT_ROOT']."/".$Thumbmd;
	@exec($convertString);
	@chmod($_SERVER['DOCUMENT_ROOT'].'/'.$Thumbmd,0777);
	$convertString = "convert $FinalPageImage -resize 480 -quality 60  ".$_SERVER['DOCUMENT_ROOT']."/".$Thumblg;
	@exec($convertString);
	@chmod($_SERVER['DOCUMENT_ROOT'].'/'.$Thumblg,0777);
			
	if (($Action == 'add') || ($Action == 'new')) {
			if (($PageType != 'pencils') && ($PageType != 'inks') && ($PageType != 'colors')) {
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
			if (($Episode == 'new') || ($_POST['addtype'] == 'episode') ||($LastEpisode == '')) {
		 		$query = "INSERT into Episodes (ProjectID, Title,EpisodeNum, Description, Writer, Artist, Colorist, Letterist, Editor, Publisher, ThumbSm, ThumbMd, ThumbLg,SeriesNum,AccessType) values ('$ComicID','$Title','$NewEpisode','$EpisodeDesc','$EpisodeWriter','$EpisodeArtist','$EpisodeColorist','$EpisodeLetterer','$EpisodeEditor','$EpisodePublisher','$Thumbsm','$Thumbmd','$Thumblg', '$SeriesNum', '$AccessType')";			
				$output .= $query.'<br/>';
				$pagedb->execute($query);
				$EpisodeNum = $NewEpisode;
			}
			if ($_POST['addtype'] != 'episode') {
				if ($EpisodeNum == '')
					$EpisodeNum = $LastEpisode;
					if ($_SESSION['IsPro'] != 1){
								$Comment = preg_replace("/<img[^>]+\>/i", "", $Comment);
								$Comment = preg_replace("/<a[^>]+\>/i", "", $Comment);
								$Comment = preg_replace("/<object[^>]+\>/i", "", $Comment);
								$Comment = preg_replace("/<script[^>]+\>/i", "", $Comment);
								$Comment = preg_replace("/<embed[^>]+\>/i", "", $Comment);
								$Comment = preg_replace("/<param[^>]+\>/i", "", $Comment);
							}
					$query = "INSERT into comic_pages(ComicID, Title, Comment, Image, ImageDimensions, Datelive, ThumbSm, ThumbMd, ThumbLg, Chapter, Episode, EpisodeDesc,EpisodeWriter,EpisodeArtist,EpisodeColorist,EpisodeLetterer, Filename, Position, UploadedBy, PageType,PublishDate, EpisodeNum,ProImage, FileType,HTMLFile,Pdffile,ViewType,AllowPdf, SeriesNum,EpPosition, AccessType) values ('$ComicID','$Title', '$Comment','$Filename','$ImageDimensions', '$Datelive','$Thumbsm','$Thumbmd','$Thumblg',$Chapter,$EpisodeNum, '$EpisodeDesc', '$EpisodeWriter','$EpisodeArtist','$EpisodeColorist','$EpisodeLetterer','$Filename', $NewPosition,'$UserID','$PageType','$PublishDate','$EpisodeNum','$FinalPageImagePro','$ext','$HTMLFile','$ScriptPDFFile','$ViewType','$AllowPdf', '$SeriesNum','$NewEpPosition', '$AccessType')";
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
				$Encryptid = substr(md5($PageID), 0, 15).dechex($PageID);
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
				//$query = "UPDATE comic_pages SET EncryptPageID='$Encryptid' WHERE ID='$PageID'";
				//$pagedb->query($query);
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
			}
		} 

	} else if ($Action == 'edit') {
		if ($_POST['edittype'] == 'episode') {
			$query = "UPDATE Episodes set ThumbSm='$Thumbsm', ThumbMd='$Thumbmd', ThumbLg='$Thumblg' where EpisodeNum='$EpisodeNum' and SeriesNum='$SeriesNum' and ProjectID='".$_SESSION['sessionproject']."'";
			$output .= $query.'<br/>';
			$pagedb->execute($query);	
		} else {
			if (($PageType != 'pencils') && ($PageType != 'inks') && ($PageType != 'colors')) {
			
					$query = "UPDATE comic_pages set ThumbSm='$Thumbsm', ThumbMd='$Thumbmd', ThumbLg='$Thumblg', Filename='$Filename',Image='$Filename',ImageDimensions='$ImageDimensions', ProImage='$FinalPageImagePro', FileType='$ext', HTMLFile='$HTMLFile', Pdffile='$ScriptPDFFile', AccessType='$AccessType' where EncryptPageID='$PageID'";
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
			} 
		}
	}

} 

if ($Action == 'edit') {
	if ($_POST['edittype'] == 'episode') {
			$query = "UPDATE Episodes set Title='$Title',Description='$EpisodeDesc', AccessType='$AccessType', Writer='$EpisodeWriter',Artist='$EpisodeArtist',Colorist='$EpisodeColorist',Letterist='$EpisodeLetterer', Editor='$EpisodeEditor', Publisher='$EpisodePublisher' where EpisodeNum='$EpisodeNum' and SeriesNum='$SeriesNum' and ProjectID='".$_SESSION['sessionproject']."'";
			$pagedb->execute($query);
			$output .= $query.'<br/>';	
		} else {
				if (($PageType != 'pencils') && ($PageType != 'inks') && ($PageType != 'colors')) {
					$query = "SELECT * from comic_pages where ComicID='$ComicID' and PageType='$PageType' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition";
					$pagedb->query($query);
					$output .= $query.'<br/>';
					$TotalLinks = $pagedb->numRows();
					//print 'TOTAL LINKS = '. $TotalLinks.'<br/>';
					$query = "SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType='$PageType' and SeriesNum='$SeriesNum')";
					$MaxPosition = $pagedb->queryUniqueValue($query);
					$output .= $query.'<br/>';
					
					$query ="SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='$ComicID' and PageType='$PageType' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum')";
					$MaxEpPosition = $pagedb->queryUniqueValue($query);
								
					$NewItemPosition = $ItemPosition;
					
					$query = "SELECT EpPosition from comic_pages where EncryptPageID='$PageID' and SeriesNum='$SeriesNum'";
					$CurrentPosition = $pagedb->queryUniqueValue($query);
					$output .= $query.'<br/>';
					
					if ($NewItemPosition != $CurrentPosition) {
								$CurrentOrder = array();
						if ($NewItemPosition < $CurrentPosition)
							$query = "SELECT EncryptPageID, EpPosition from comic_pages where ComicID='$ComicID' and PageType='$PageType' and EpPosition BETWEEN '$NewItemPosition' and '$CurrentPosition' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition";
						else
							$query = "SELECT EncryptPageID, EpPosition from comic_pages where ComicID='$ComicID' and PageType='$PageType' and EpPosition BETWEEN '$CurrentPosition' and '$NewItemPosition' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition";
					//print $query.'<br/>';
						$pagedb->query($query);
						
						while ($line = $pagedb->fetchNextObject()) { 
								$CurrentOrder[] = $line->EncryptPageID;
						}
			
						if ($NewItemPosition < $CurrentPosition) {
							if ($CurrentPosition != 1) {
								$UpdatePosition = $CurrentPosition;
								for ( $counter =(sizeof($CurrentOrder)-1); $counter > 0; $counter--) {
									$SelectItemID = $CurrentOrder[$counter-1];
									$query = "UPDATE comic_pages set EpPosition='$UpdatePosition' where EncryptPageID ='$SelectItemID' and SeriesNum='$SeriesNum'  and EpisodeNum='$EpisodeNum'";
									$UpdatePosition--;
									$pagedb->execute($query);
								//	print $query.'<br/>';
								}
								$query = "UPDATE comic_pages set EpPosition='$NewItemPosition' where EncryptPageID='$PageID' and SeriesNum='$SeriesNum'  and EpisodeNum='$EpisodeNum'";
								$pagedb->execute($query);
							//	print $query.'<br/>';
							}
						} else if ($NewItemPosition > $CurrentPosition) {
								$UpdatePosition = $CurrentPosition;
								if ($CurrentPosition != $TotalLinks) {
									for ($counter =0; $counter < (sizeof($CurrentOrder)-1); $counter++) {
										$SelectItemID = $CurrentOrder[$counter+1];
										$query = "UPDATE comic_pages set EpPosition='$UpdatePosition' where EncryptPageID ='$SelectItemID' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
										$UpdatePosition++; 
										$pagedb->query($query);
									//	print $query.'<br/>';
									}
									$query = "UPDATE comic_pages set EpPosition='$NewItemPosition' where ComicID='$ComicID' and EncryptPageID='$PageID' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
									$pagedb->execute($query);
									//print $query.'<br/>';
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
					}
				}
				
				if ($_SESSION['IsPro'] != 1){
					$Comment = preg_replace("/<img[^>]+\>/i", "", $Comment);
					$Comment = preg_replace("/<a[^>]+\>/i", "", $Comment);
					$Comment = preg_replace("/<object[^>]+\>/i", "", $Comment);
					$Comment = preg_replace("/<script[^>]+\>/i", "", $Comment);
					$Comment = preg_replace("/<embed[^>]+\>/i", "", $Comment);
					$Comment = preg_replace("/<param[^>]+\>/i", "", $Comment);
				}
				
				$query = "UPDATE comic_pages set Title='$Title', Comment='$Comment', EpisodeDesc='$EpisodeDesc', Datelive='$Datelive', Chapter='$Chapter', EpisodeWriter='$EpisodeWriter',EpisodeArtist='$EpisodeArtist',EpisodeColorist='$EpisodeColorist',EpisodeLetterer='$EpisodeLetterer',PublishDate='$PublishDate', AccessType='$AccessType',ViewType='$ViewType', AllowPdf='$AllowPdf' where EncryptPageID='$PageID'";
				$pagedb->query($query);
				$output .= $query.'<br/>';
		}
} else if ($Action == 'delete') {
		if (($Section == 'pages') || ($Section =='extras')) {
			$query = "SELECT EpPosition from comic_pages where EncryptPageID='$PageID' and SeriesNum='$SeriesNum'  and EpisodeNum='$EpisodeNum'";
			$CurrentPosition = $pagedb->queryUniqueValue($query);

			$query = "SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='$ComicID' and PageType='$PageType' and SeriesNum='$SeriesNum'  and EpisodeNum='$EpisodeNum')";
			$MaxPosition = $pagedb->queryUniqueValue($query);
		//if ($ComicID = '8bf1211f17a') 
			//print $query.'<br/>';
			$query = "SELECT ID from comic_pages where ComicID='$ComicID' and PageType ='$PageType' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition";
			$pagedb->query($query);
		//if ($ComicID = '8bf1211f17a') 
				//print $query.'<br/>';
			$TotalLinks = $pagedb->numRows();
			$CurrentOrder = array();
			$query = "SELECT ID, EpPosition from comic_pages where ComicID='$ComicID' and PageType='$PageType' and EpPosition BETWEEN '$CurrentPosition' and '$MaxPosition' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition";
			$pagedb->query($query);	
		
			while ($line = $pagedb->fetchNextObject()) { 
				$CurrentOrder[] = $line->ID;
			}
			$UpdatePosition = $CurrentPosition;
			for ($counter =0; $counter < (sizeof($CurrentOrder)-1); $counter++) {
		   	 	$SelectItemID = $CurrentOrder[$counter+1];
				$query = "UPDATE comic_pages set EpPosition='$UpdatePosition' where id ='$SelectItemID' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
				$UpdatePosition++; 
				
				$pagedb->execute($query);
			}
			$query = "SELECT * from comic_pages where ComicID='$ComicID' and PageType='$PageType' and SeriesNum='$SeriesNum' order by SeriesNum, EpisodeNum, EpPosition";
			$pagedb->query($query);
			$ResetPos = 1;
			while ($line = $pagedb->fetchNextObject()) {
				    $SPageID = $line->EncryptPageID;
					$query = "update comic_pages set Position='$ResetPos' where ComicID='$ComicID' and EncryptPageID='$SPageID' and SeriesNum='$SeriesNum'";
					$pagedb->execute($query);
					$ResetPos++;
			}
			$query ="DELETE from comic_pages WHERE ComicID='$ComicID' and (EncryptPageID='$PageID' or ParentPage='$PageID' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum')";
			$pagedb->execute($query);	
		
			if ($Section == 'pages') { 
					$CurrentDate = date('Y-m-d'). ' 00:00:00';
					$query ="SELECT count(*) from comic_pages where ComicID='$ComicID' and PageType='pages' and PublishDate<='$CurrentDate'";
					$NumPages = $pagedb->queryUniqueValue($query);
					$Status = 'add';
					$query = "UPDATE projects SET pages='$NumPages',PagesUpdated='$Date' WHERE ProjectID='$ComicID'";
					$pagedb->execute($query);			
				}	
	
    	  $query ="DELETE from pagecomments WHERE comicid='$ComicID' and pageid='$PageID'";
		  $pagedb->execute($query);
	} else {
		$query ="DELETE from comic_pages WHERE ComicID='$ComicID' and ParentPage='$PageID' and PageType='$PageType' and SeriesNum='$SeriesNum'";
		$pagedb->execute($query);	
	
	}

} 
//if ($_SESSION['username'] != 'matteblack')
$RedirURL= '?series='.$SeriesNum;

if (($EpisodeNum != '')&& ($_POST['edittype'] != 'episode')&&($_POST['addtype'] != 'episode'))
		$RedirURL .= '&ep='.$EpisodeNum;
else if (($_POST['edittype'] == 'episode')||($_POST['addtype'] == 'episode'))
	$RedirURL .= '&sub=episodes';
	
header("location:/".$_SESSION['pfdirectory'].'/section/pages_inc.php'.$RedirURL);
//else 
//	print $output;

	

?>