<?php 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
require 'functions.php';

if($_FILES['image']['type']=="image/jpeg"||$_FILES['image']['type']=="image/pjpeg"||$_FILES['image']['type']=="image/png" 
||$_FILES['image']['type']=="image/gif") {

	$uploadedFile = $_FILES['image']['tmp_name'];
	$croptype = $_POST['croptype'];

$styles = '	 <link type="text/css" rel="stylesheet" href="/pf_16_core/covercrop/css/debug.css" media="screen, projection" />
	<link type="text/css" rel="stylesheet" href="/pf_16_core/covercrop/css/cropper.css" media="screen, projection" />
	<link type="text/css" rel="stylesheet" href="/pf_16_core/covercrop/css/imig.css" media="screen, projection" />
	<!--[if IE 6]><link type="text/css" rel="stylesheet" href="/pf_16_core/covercrop/css/cropper_ie6.css" media="screen, projection" /><![endif]-->
	<!--[if lte IE 5]><link type="text/css" rel="stylesheet" href="/pf_16_core/covercrop/css/cropper_ie5.css" media="screen, projection" /><![endif]-->';

$scripts = '	<script src="/pf_16_core/covercrop/lib/prototype.js" type="text/javascript"></script> 
	<script src="/pf_16_core/covercrop/lib/scriptaculous.js?load=builder,dragdrop" type="text/javascript"></script>
	<script src="/pf_16_core/covercrop/lib/cropper.js" type="text/javascript"></script><script src="/pf_16_core/covercrop/lib/init_cropper/cover.js" type="text/javascript"></script>';





	// SETUP DIRECTORY STRUCTURE WITH GOOD PERMS
	if(!is_dir("working")) { mkdir("working", 0777); chmod("working", 0777); }
	if(!is_dir("working/uploads")) { mkdir("working/uploads"); chmod("working/uploads", 0777); }
	if(!is_dir("working/cropped")) { mkdir("working/cropped"); chmod("working/cropped", 0777); }
	if(!is_dir("working/finished")) { mkdir("working/finished"); chmod("working/finished", 0777); }

	// DEFINE VARIABLES
	$maxWidth = 600;
	$maxHeight = 600;
	$minWidth = 200;
	$minHeight = 200;
	$imageFileName = basename($_FILES['image']['name']);
	$imageFileName = str_replace(" ","",$imageFileName);
	$imageFileName = str_replace("'","",$imageFileName);
	$target_path = "working/uploads/";
	$imagepath = $target_path;
	$target_path = $target_path . $imageFileName;
	$imageLocation = $target_path;
	$namearray = explode('.',$imageFileName);
	$JpgFile = $imagepath.$namearray[0].'.jpg';
	
	// DELETE FILE IF EXISTING
	if(file_exists($imageLocation)) { chmod($imageLocation, 0777); unlink($imageLocation); }

	// CHECK FOR IMAGE UPLOAD
	if(move_uploaded_file($uploadedFile, $imageLocation)) {
		chmod($imageLocation, 0777);
		
		if($_FILES['image']['type']=="image/png" ||$_FILES['image']['type']=="image/gif") {
			$convertString = "convert $imageLocation $JpgFile";
			exec($convertString);
			$imageLocation = $JpgFile;
			chmod($imageLocation,0777);
		}

		$dimensions['height'] = getHeight($imageLocation);
		$dimensions['width'] = getWidth($imageLocation);
			
		// RESIZE IF UPLOAD IS TOO BIG
		if(($dimensions['width']>$maxWidth) || ($dimensions['width']>$maxWidth)){
			$cmd = "convert " . $imageLocation . " -resize " . $maxWidth . " " . $imageLocation;
			$results = exec($cmd);
			$dimensions['height'] = getHeight($imageLocation);
			$dimensions['width'] = getWidth($imageLocation);
		}
		if(($dimensions['height']>$maxHeight) || ($dimensions['height']>$maxHeight)){
			$cmd = "convert " . $imageLocation . " -resize x" . $maxHeight . " " . $imageLocation;
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
		

?>
<?php if($styles) echo $styles; ?>

<?php if($scripts) echo $scripts; ?>
<LINK href="/<? echo $PFDIRECTORY;?>/css/pf_css.css" rel="stylesheet" type="text/css">
<div align="center">
  <? if ($_POST['step'] == 'new') {?>
<form action="/<? echo $PFDIRECTORY;?>/install/last_step.php?comic=<? echo $_GET['comic'];?>" method="post" class="frmCrop">
<? } else { ?>
<form action="/cover/complete/<? echo $_GET['comic'];?>/" method="post" class="frmCrop">


<? }?>
 <table width="100%"><tr><td>
 <div align="center">
		<div class="med_blue">Select the area to crop for your cover and click   <input type="submit" name="save" id="save" value="CROP IT!" style="background-color:#0f498c; color:#FFFFFF; font-weight:bold; border:#000000 1px solid;cursor:pointer;"/> when finished. </div>
		             </div>
	  
	<div id="cropContainer" align="center">

			<div id="crop">
			<div id="cropWrap">
				<img src="/<? echo $PFDIRECTORY;?>/covercrop/<?php echo $imageLocation ?>" alt="Image to crop" id="cropImage" border="2" style="border-color:#000000" />
			</div> <!-- /cropWrap -->
		</div> <!-- /crop -->
		<div id="crop_save">
			
			
					<input type="hidden" class="hidden" name="imageWidth" id="imageWidth" value="<?php echo $dimensions['width'] ?>" />
					<input type="hidden" class="hidden" name="imageHeight" id="imageHeight" value="<?php echo $dimensions['height'] ?>" />
					<input type="hidden" class="hidden" name="imageFileName" id="imageFileName" value="<?php echo $imageFileName ?>" />
					<input type="hidden" class="hidden" name="cropX" id="cropX" value="0" />
					<input type="hidden" class="hidden" name="cropY" id="cropY" value="0" />
					<input type="hidden" class="hidden" name="cropWidth" id="cropWidth" value="<?php echo $dimensions['width'] ?>" />
					<input type="hidden" class="hidden" name="cropHeight" id="cropHeight" value="<?php echo $dimensions['height'] ?>" /> 
                    <input type="hidden"  name="txtComic" value="<? echo $_POST['txtComic'];?>" id="txtComic" />
                    <input type="hidden"  name="txtStory" value="<? echo $_POST['txtStory'];?>" id="txtStory" />
                <input type="hidden"  name="txtUrl" value="<? echo $_POST['txtUrl'];?>" id="txtUrl" />
                <input type="hidden"  name="txtSafeFolder" value="<? echo $_GET['comic'];?>" id="txtSafeFolder" />
                <input  type="hidden" name="step" value="<? echo $_POST['step'];?>" id="step" />
					
			
			
		</div> <!-- /crop_save -->
	</div> <!-- /cropContainer -->
    </form>
	</td></tr></table>
	</div>

<?php } } else { 

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
		$error = 'You must use a PNG, JPEG or GIF for your thumb image.';
	}
	 
	 include 'header.php';

?> 

	<div class="info" align="center">
		<h1>Error</h1>
		<p>There was an error uploading the file.	 <?php echo $error; ?></p>

	</div>

<?php } 
 ?>