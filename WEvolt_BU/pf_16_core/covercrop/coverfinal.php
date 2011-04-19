<?php 
if(isset($_POST['imageFileName'])) { 

session_start();

	$imageWidth			 = $_POST['imageWidth'];
	$imageHeight		 = $_POST['imageHeight'];
	$imageFileName		 = $_POST['imageFileName'];
	$cropX				 = $_POST['cropX'];
	$cropY				 = $_POST['cropY'];
	$cropWidth			 = $_POST['cropWidth'];
	$cropHeight			 = $_POST['cropHeight'];
	// DEFINE VARIABLES
	if($cropWidth == 0) { $cropWidth = $imageWidth; }
	if($cropHeight == 0) { $cropHeight = $imageHeight; }
	$sourceFile			 = "working/uploads/". $imageFileName;
	$destinationFile = "working/cropped/" . $imageFileName;

	if(file_exists($destinationFile)) { chmod($destinationFile, 0777); unlink($destinationFile); }

	// CHECK TO SEE IF WE NEED TO CROP
	if($imageWidth != $cropWidth || $imageHeight != $cropHeight) {
		$convertString = "convert $sourceFile -crop " . $cropWidth . "x" . $cropHeight . "+" . $cropX . "+" . $cropY . " $destinationFile";
		exec($convertString);
		 //  print    $convertString ;
		chmod($destinationFile, 0777);
		chmod($sourceFile, 0777);
		chmod($destinationFile, 0777);
	
	} else {
		// CROP WAS SKIPPED -- MOVE TO CROPPED FOLDER ANYWAY	
		copy($sourceFile,$destinationFile);
		chmod($destinationFile, 0777);
	}
    $resizeWidth		 = '400';
	$sourceFile			 = "working/cropped/". $imageFileName;
	$destinationFile = "working/finished/" . $imageFileName;


	if(file_exists($destinationFile)) { chmod($destinationFile, 0777); unlink($destinationFile); }	// delete if existing

	// CHECK TO SEE IF WE NEED TO CROP
	if($imageWidth != $resizeWidth) {
		$convertString = "convert $sourceFile -resize $resizeWidth $destinationFile";
		 //  print    $convertString ;
		exec($convertString);
		chmod($destinationFile, 0777);
		chmod($sourceFile, 0777);
		chmod($destinationFile, 0777);

	} else { // RESIZE WAS SKIPPED
		copy($sourceFile,$destinationFile);
		chmod($destinationFile, 0777);
	}

		$fileName = explode(".",$imageFileName);
		$fileName = $fileName[0];
		$comicthumb = $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['basefolder'].'/'.$_POST['txtUrl'].'/images/comicthumb.jpg';
		$comiccover =  $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['basefolder'].'/'.$_POST['txtUrl'].'/images/comiccover.jpg';
		if(file_exists($comiccover)) { chmod($comiccover, 0777); unlink($comiccover); }
		if(file_exists($comicthumb)) { chmod($comicthumb, 0777); unlink($comicthumb); }
		
		copy($destinationFile, $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['basefolder'].'/'.$_POST['txtUrl'].'/images/comiccover.jpg');
		
		$convertString = "convert $destinationFile -resize 100 $comicthumb";

		   exec($convertString);
		   chmod($comicthumb,0777);
		   chmod($_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['basefolder'].'/'.$_POST['txtUrl'].'/images/comiccover.jpg',0777);
		   
}

		   header("location:/".$_SESSION['pfdirectory']."/section/settings_inc.php");

?>