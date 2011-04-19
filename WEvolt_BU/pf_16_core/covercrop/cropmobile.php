<?php 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
require 'functions.php';
				   
$ComicID = $_POST['sessionproject'];
if ($ComicID == '')		
	$ComicID = $_GET['id'];	
	
$Action = $_POST['txtAction'];
if ($Action == '')		
	$Action = $_GET['action'];	

$ComicFolder = $_POST['txtUrl'];
if ($ComicFolder == '')		
	$ComicFolder = $_GET['url'];	

$Title = $_POST['txtTitle'];
if ($Title == '')		
	$Title = $_GET['title'];	



if(($_FILES['image']['type']=="image/jpeg"||$_FILES['image']['type']=="image/pjpeg"||$_FILES['image']['type']=="image/png" 
||$_FILES['image']['type']=="image/gif") ||(isset($_POST['txtFilename']))||(isset($_GET['file']))) {
	if (isset($_POST['txtFilename'])) {
		$uploadedFile = $_POST['txtFilename'];
	} else if (isset($_GET['file'])) {
		$uploadedFile = $_GET['file'];
	} else {
		$uploadedFile = $_FILES['image']['tmp_name'];
	}
	
	
	$croptype = $_POST['croptype'];

$styles = '	 <link type="text/css" rel="stylesheet" href="/pf_16_core/covercrop/css/debug.css" media="screen, projection" />
	<link type="text/css" rel="stylesheet" href="/pf_16_core/covercrop/css/cropper.css" media="screen, projection" />
	<link type="text/css" rel="stylesheet" href="/pf_16_core/covercrop/css/imig.css" media="screen, projection" />
	<!--[if IE 6]><link type="text/css" rel="stylesheet" href="/pf_16_core/covercrop/css/cropper_ie6.css" media="screen, projection" /><![endif]-->
	<!--[if lte IE 5]><link type="text/css" rel="stylesheet" href="/pf_16_core/covercrop/css/cropper_ie5.css" media="screen, projection" /><![endif]-->';

$scripts = '	<script src="/pf_16_core/covercrop/lib/prototype.js" type="text/javascript"></script> 
	<script src="/pf_16_core/covercrop/lib/scriptaculous.js?load=builder,dragdrop" type="text/javascript"></script>
	<script src="/pf_16_core/covercrop/lib/cropper.js" type="text/javascript"></script><script src="/pf_16_core/covercrop/lib/init_cropper/mobile_image.js" type="text/javascript"></script>';






	// SETUP DIRECTORY STRUCTURE WITH GOOD PERMS
	if(!is_dir("working")) { mkdir("working", 0777); chmod("working", 0777); }
	if(!is_dir("working/uploads")) { mkdir("working/uploads"); chmod("working/uploads", 0777); }
	if(!is_dir("working/cropped")) { mkdir("working/cropped"); chmod("working/cropped", 0777); }
	if(!is_dir("working/finished")) { mkdir("working/finished"); chmod("working/finished", 0777); }

	// DEFINE VARIABLES
	$maxWidth = 1280;
	$maxHeight = 1280;
	$minWidth = 500;
	$minHeight = 500;
	
	if ($FileNoGood == 0) {
		if ((isset($_POST['txtFilename'])) ||  (isset($_GET['file']))){
	
	
	
			$imageFileName = $uploadedFile;
		
			if ($imageFileName == '') 
				$imageFileName = $_GET['file'];
		
			$target_path = $_POST['txtUrl'];
		
			if ($target_path == '') 
					$target_path = $_GET['url'];
				
			$TargetFileName = str_replace(" ","",trim($imageFileName));
	   	 	$TargetFileName = str_replace("'","",$TargetFileName);
		//$dimensions['height'] = getHeight("../../".$target_path."/".$imageFileName);
		//$dimensions['width'] = getWidth("../../".$target_path."/".$imageFileName);
			if (($_POST['txtAction'] == 'add') || ($_POST['txtAction'] == 'edit')) {
				copy($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/temp/".$imageFileName,'working/uploads/'.$TargetFileName);
			
			} else {
			//copy("../../".$target_path."/images/pages/".$imageFileName,'../temp/'.$imageFileName);
			//copy("../temp/".$imageFileName,'working/uploads/'.$imageFileName);
				copy($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$target_path."/images/pages/".$imageFileName,'working/uploads/'.$TargetFileName);
			
			}
		} else {
			$imageFileName = basename($_FILES['image']['name']);
			$TargetFileName = str_replace(" ","",trim($imageFileName));
	    	$TargetFileName = str_replace("'","",$TargetFileName);
		}
	
		$target_path = "working/uploads/";
		$imageFileName = $TargetFileName;
		$target_path = $target_path . $TargetFileName;
		$imageLocation = $target_path;
	
		$namearray = explode('.',$imageFileName);
		$JpgFile = $imagepath.$namearray[0].'.jpg';
	// DELETE FILE IF EXISTING
		if ((!isset($_POST['txtFilename'])) &&(!isset($_GET['file'])))  {
			if(file_exists($imageLocation)) { 
				chmod($imageLocation, 0777); 
				unlink($imageLocation); 
			}

	// CHECK FOR IMAGE UPLOAD
			if(move_uploaded_file($uploadedFile, $imageLocation)) {
				chmod($imageLocation, 0777);
				if	($_FILES['image']['type']=="image/png" ||$_FILES['image']['type']=="image/gif") {
					$convertString = "convert $imageLocation $JpgFile";
					exec($convertString);
					$imageLocation = $JpgFile;
					chmod($imageLocation,0777);
				}
				
				$dimensions['height'] = getHeight($imageLocation);
				$dimensions['width'] = getWidth($imageLocation);
			
				if (($dimensions['height'] < 500) || ($dimensions['width'] < 500))
					$FileNoGood = 1;
				else 
					$FileNoGood = 0;
	
			//	print 'HEIGHT = ' . $dimensions['height'];
	
				//print 'WIDTH = ' . $dimensions['width'];
		// RESIZE IF UPLOAD IS TOO BIG
		
		if ($FileNoGood == 0) {
				if(($dimensions['width']>$maxWidth) || ($dimensions['width']>$maxWidth)){
					$cmd = "convert " . $imageLocation . " -resize " . $maxWidth . "x" . $maxHeight . " " . $imageLocation;
					$results = exec($cmd);
					$dimensions['height'] = getHeight($imageLocation);
					$dimensions['width'] = getWidth($imageLocation);
				}
		
		// RESIZE IF UPLOAD IS TOO SMALL
				if(($dimensions['width']<$minWidth) || ($dimensions['width']<$minWidth)){
					$cmd = "convert " . $imageLocation . " -resize " . $minWidth . "x" . $minHeight . " " . $imageLocation;
					$results = exec($cmd);
					$dimensions['height'] = getHeight($imageLocation);
					$dimensions['width'] = getWidth($imageLocation);
				}
				
				//print 'UPLOADED FILE = ' . $uploadedFile;
	//list($width,$height)=getimagesize($Source_dir.$PeelOneFilename);
				//$Height = getHeight($uploadedFile);
				//$Width = getWidth($uploadedFile);
				
			   }
			}
	
		}
	}
//	print 'CHMOD ! ';
	//chmod($imageLocation, 0777); 
$PageTitle .= ' mobile cropper';
$TrackPage = 0;
include $_SERVER['DOCUMENT_ROOT'].'/includes/header_template_new.php';?>
<?php if($styles) echo $styles; ?>

<?php if($scripts) echo $scripts; ?>
<div align="left">
    <table cellpadding="0" cellspacing="0" border="0"  width="100%">
    <tr>
    <td valign="top" style="padding:5px; color:#FFFFFF;width:60px;">
    <? include  $_SERVER['DOCUMENT_ROOT'].'/includes/site_menu_popup_inc.php';?>
    </td> 
    
    <td valign="top" align="center">
    

	 
     <? if ($FileNoGood == 0) {?>
     
     <div align="center">
     <table width="500" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="484" align="center">
		<div class="grey_text">Select the area to crop for your cover and click SAVE when finished. </div>
		<div class="spacer"></div>
        <div class="grey_text">You may click and drag an area within the image to crop.	 </div>
        <div class="spacer"></div>
        </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>
        </div>
<form action="/pf_16_core/covercrop/mobile_crop_final.php" method="post" class="frmCrop">
	<div id="cropContainer" align="center">
     <input type="submit" name="save" id="save" value="CROP IT!" style="background-color:#FF6600; color:#FFFFFF; font-weight:bold; border:#000000 1px solid;cursor:pointer;"/>
      <div class="spacer"></div>
			<div id="crop">
			<div id="cropWrap">
				<img src="/pf_16_core/covercrop/<?php echo $imageLocation ?>" alt="Image to crop" id="cropImage" border="2" style="border-color:#000000" />
			</div> <!-- /cropWrap -->
		</div> <!-- /crop -->
		<div id="crop_save">
			
			
					<input type="hidden" class="hidden" name="imageWidth" id="imageWidth" value="<?php echo $dimensions['width'] ?>" />
					<input type="hidden" class="hidden" name="imageHeight" id="imageHeight" value="<?php echo $dimensions['height'] ?>" />
					<input type="hidden" class="hidden" name="imageFileName" id="imageFileName" value="<?php echo $imageFileName ?>" />
					<input type="hidden" class="hidden" name="cropX" id="cropX" value="0" />
					<input type="hidden" class="hidden" name="cropY" id="cropY" value="0" />
					<input type="hidden" class="hidden" name="cropWidth" id="cropWidth" value="<?php echo $dimensions['width'] ?>" />
					<input type="hidden" class="hidden" name="cropHeight" id="cropHeight" value="<?php echo $dimensions['height'] ?>" /> <input type="hidden"  name="txtComic" value="<? echo $ComicID;?>" id="txtComic" />
                <input type="hidden"  name="txtUrl" value="<? echo $ComicFolder;?>" id="txtUrl" />
                <input type="hidden"  name="txtTitle" value="<? echo $Title;?>" id="txtTitle" />
                 <input type="hidden"  name="txtType" value="<? echo $_POST['txtType'];?>" id="txtType" />
                  <input type="hidden"  name="txtAction" value="<? echo $Action;?>" id="txtAction" />
                  <input type="hidden"  name="txtItem" value="<? echo $_REQUEST['item'];?>" id="txtItem" />
                   <input type="hidden"  name="txtFilename" value="<?php echo $imageFileName ?>" id="txtFilename" />
                   <input type="hidden"  name="txtSafeFolder" value="<? echo $_GET['comic'];?>" id="txtSafeFolder" />
					<div id="submit">
                     <div class="spacer"></div>
						 <input type="submit" name="save" id="save" value="CROP IT!" style="background-color:#FF6600; color:#FFFFFF; font-weight:bold; border:#000000 1px solid;cursor:pointer;"/>
					</div>
			
			
		</div> <!-- /crop_save -->
	</div> <!-- /cropContainer -->
    </form>
    <? } else {?>
    
      <div align="center">
       <table width="500" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="484" align="center">
		The Image you uploaded was not big enough to crop. <br />
<br />
The minimum size for a Mobile Wallpaper is <b>500x500</b>. <br />
Please choose another image and try again. <br />
<br />
<div class="cms_links">[<a href="/cms/edit/<? echo $_SESSION['safefolder'];?>/?tab=content&section=mobile">BACK TO ADMIN</a>]</div></div>   </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div></div>
    <? }?>
	
	</div>

<?php } else { 

	if($_FILES['image'] ['error']) {
		switch ($_FILES['image'] ['error']) {
			case 1:
				$error = 'The file is bigger than this PHP installation allows.';
				break;
			case 2:
				$error = 'The file is bigger than 50k.';
				break;
			case 3:
				$error = 'Only part of the file was uploaded.';
				break;
			case 4:
				$error = 'No file was uploaded.';
				break;
		}
	} else {
		$error = 'File is not of type .jpg';
	}
	 

?> 

	<div class="info" align="center">
		<h1>Error</h1>
		<p>There was an error uploading the file.	 <?php echo $error; ?></p>

	</div>

<?php }  ?>
    </td>
    </tr>
    </table>
</div>

<?
include $_SERVER['DOCUMENT_ROOT'].'/includes/footer_template_new.php';?> 